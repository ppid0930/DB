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

// Oracle DB 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host);

if (!$conn) {
    die("DB 연결 실패: " . oci_error());
}

// 폼 데이터 가져오기
$title = $_POST['title'];
$category = $_POST['category'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

// 게시글 저장
$sql = "INSERT INTO posts (content_name, content, user_id, created_at) VALUES (:title, :content, :user_id, SYSDATE)";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':title', $title);
oci_bind_by_name($stmt, ':content', $content);
oci_bind_by_name($stmt, ':user_id', $user_id);

if (oci_execute($stmt)) {
    echo "<script>
        alert('글이 작성되었습니다!');
        window.location.href = 'board.php';
    </script>";
} else {
    $error = oci_error($stmt);
    echo "오류 발생: " . $error['message'];
}

oci_free_statement($stmt);
oci_close($conn);
?>