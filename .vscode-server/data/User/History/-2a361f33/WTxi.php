<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Oracle 데이터베이스 연결
include 'db.php';

// POST 데이터 받기
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $post_id = 2; // 홍보게시판의 POST_ID

    // 유효성 검사
    if (empty($title) || empty($content)) {
        echo "<script>
            alert('제목과 내용을 모두 입력해주세요.');
            history.back();
        </script>";
        exit;
    }

    // WRITE_ID 계산
    $query = "SELECT NVL(MAX(TO_NUMBER(WRITE_ID)), 0) + 1 AS NEXT_ID FROM WRITE";
    $stmt = oci_parse($conn, $query);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
    $write_id = str_pad($row['NEXT_ID'], 3, '0', STR_PAD_LEFT);
    oci_free_statement($stmt);

    // 데이터 삽입
    $insert_query = "INSERT INTO WRITE (WRITE_ID, POST_ID, USER_ID, CONTENT_NAME, CONTENT, CREATED_AT) 
                     VALUES (:write_id, :post_id, :user_id, :title, :content, SYSDATE)";
    $stmt = oci_parse($conn, $insert_query);
    oci_bind_by_name($stmt, ':write_id', $write_id);
    oci_bind_by_name($stmt, ':post_id', $post_id);
    oci_bind_by_name($stmt, ':user_id', $user_id);
    oci_bind_by_name($stmt, ':title', $title);
    oci_bind_by_name($stmt, ':content', $content);

    if (oci_execute($stmt)) {
        echo "<script>
            alert('게시글이 작성되었습니다.');
            window.location.href = 'promotion_board.php';
        </script>";
    } else {
        $e = oci_error($stmt);
        echo "오류 발생: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>홍보게시판 글쓰기</title>
</head>
<body>
    <form method="POST" action="">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" required></textarea><br>
        <button type="submit">작성 완료</button>
    </form>
</body>
</html>