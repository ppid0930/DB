<?php
session_start();

// 로그인 확인 (로그인이 필요한 경우)
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'board_write.php?write_id=' . htmlspecialchars($write_id);
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
$comment_content = isset($_POST['comment_content']) ? trim($_POST['comment_content']) : '';
$write_id = isset($_POST['write_id']) ? $_POST['write_id'] : '';
$user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

// 유효성 검사 - 댓글 내용 확인
if (empty($comment_content)) {
    echo "<script>
        alert('댓글 내용을 입력해주세요.');
        history.back();
    </script>";
    exit;
}

// `COMMENT_ID` 값을 수동으로 생성
// COMMENT_ID 중복 체크
do {
    // 고유한 COMMENT_ID 값을 만들기 위해, WRITE_ID와 USER_ID를 결합하여 COMMENT_ID 생성
    $comment_id = substr($write_id . $user_id . rand(100, 999), 0, 3); // 예: "1234567" -> 3자리로 잘라냄

    // COMMENT_ID가 이미 존재하는지 확인
    $check_sql = "SELECT COUNT(*) FROM COMMENT_T WHERE COMMENT_ID = :comment_id";
    $check_stmt = oci_parse($conn, $check_sql);
    oci_bind_by_name($check_stmt, ":comment_id", $comment_id);
    oci_execute($check_stmt);
    $count = oci_fetch_assoc($check_stmt)['COUNT(*)'];
    oci_free_statement($check_stmt);
} while ($count > 0); // COMMENT_ID가 중복되면 다시 시도

// 댓글 추가 SQL
$insert_comment_sql = "
    INSERT INTO COMMENT_T (COMMENT_ID, USER_ID, WRITE_ID, COMMENT_CONTENT, CREATED_AT)
    VALUES (:comment_id, :user_id, :write_id, :comment_content, SYSDATE)
";
$stmt = oci_parse($conn, $insert_comment_sql);

// 바인딩 파라미터
oci_bind_by_name($stmt, ":comment_id", $comment_id);
oci_bind_by_name($stmt, ":user_id", $user_id);
oci_bind_by_name($stmt, ":write_id", $write_id);
oci_bind_by_name($stmt, ":comment_content", $comment_content);

// 실행
if (oci_execute($stmt)) {
    oci_free_statement($stmt);
    oci_close($conn);
    echo "<script>
        alert('댓글이 추가되었습니다.');
        window.location.href = 'board_write.php?write_id=$write_id'; // 댓글 작성 후 원래 게시물로 돌아감
    </script>";
    exit;
} else {
    $error = oci_error($stmt);
    oci_free_statement($stmt);
    oci_close($conn);
    die("댓글 작성 실패: " . htmlspecialchars($error['message']));
}
?>
