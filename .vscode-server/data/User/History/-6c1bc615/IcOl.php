<?php
session_start();

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'board_list.php';
    echo "<script>
        alert('로그인이 필요합니다.');
        window.location.href = '$redirect_url';
    </script>";
    exit;
}

// 댓글 추가 로직
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = 1; // 자유게시판의 post_id는 1
    $write_id = $_SESSION['user_id']; // 로그인된 사용자 ID
    $user_id = $_SESSION['user_id']; // 댓글 작성자 ID (같은 값으로 설정됨)
    $comment_content = $_POST['comment_content']; // 댓글 내용

    if (empty($comment_content)) {
        echo "<script>alert('댓글 내용을 입력해주세요.'); history.back();</script>";
        exit;
    }

    // SQL 쿼리 작성: 댓글 추가
    $sql = "INSERT INTO COMMENT_T (USER_ID, WRITE_ID, COMMENT_CONTENT, CREATED_AT)
            VALUES (:user_id, :write_id, :comment_content, SYSDATE)";

    $stid = oci_parse($conn, $sql);

    // 바인드 변수 설정
    oci_bind_by_name($stid, ":user_id", $user_id);
    oci_bind_by_name($stid, ":write_id", $write_id);
    oci_bind_by_name($stid, ":comment_content", $comment_content);

    // 실행
    if (oci_execute($stid)) {
        echo "<script>alert('댓글이 성공적으로 추가되었습니다.'); window.location.href='board_view.php?post_id=1';</script>";
    } else {
        $e = oci_error($stid); // 오류 메시지 잡기
        echo "<script>alert('댓글 추가에 실패했습니다. 오류: " . $e['message'] . "'); history.back();</script>";  // 오류 메시지 출력
    }

    // 자원 해제
    oci_free_statement($stid);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>댓글 추가 - 자유게시판</title>
</head>
<body>
    <h2>댓글 작성</h2>
    <form action="add_comment.php" method="post">
        <textarea name="comment_content" rows="4" cols="50" placeholder="댓글을 작성하세요."></textarea><br>
        <button type="submit">댓글 추가</button>
    </form>
</body>
</html>
