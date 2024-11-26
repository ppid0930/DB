<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// POST 데이터 받기
$write_id = isset($_POST['write_id']) ? trim($_POST['write_id']) : '';  // 해당 게시글의 WRITE_ID
$comment_content = isset($_POST['comment_content']) ? trim($_POST['comment_content']) : '';  // 댓글 내용

// 유효성 검사
if (empty($comment_content)) {
    echo "<script>
        alert('댓글 내용을 입력해주세요.');
        history.back();
    </script>";
    exit;
}

// 댓글 추가
$insert_comment_sql = "
    INSERT INTO COMMENT_T (COMMENT_ID, USER_ID, WRITE_ID, COMMENT_CONTENT, CREATED_AT)
    VALUES (COMMENT_SEQ.NEXTVAL, :user_id, :write_id, :comment_content, SYSDATE)
";
$stmt = oci_parse($conn, $insert_comment_sql);

// 바인딩 파라미터
oci_bind_by_name($stmt, ":user_id", $_SESSION['user_id']);
oci_bind_by_name($stmt, ":write_id", $write_id);
oci_bind_by_name($stmt, ":comment_content", $comment_content);

// 실행
if (oci_execute($stmt)) {
    oci_free_statement($stmt);
    oci_close($conn);
    echo "<script>
        alert('댓글이 추가되었습니다.');
        window.location.href = 'promotion_write.php?write_id=$write_id';
    </script>";
    exit;
} else {
    $error = oci_error($stmt);
    oci_free_statement($stmt);
    oci_close($conn);
    die("댓글 작성 실패: " . htmlspecialchars($error['message']));
}
?>
