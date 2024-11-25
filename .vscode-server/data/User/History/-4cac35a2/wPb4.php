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
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("DB 연결 실패: " . $e['message']);
}

// 게시글 ID와 사용자 ID 가져오기
$user_id = $_SESSION['user_id'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

if ($post_id <= 0) {
    echo "<script>
        alert('유효하지 않은 요청입니다.');
        history.back();
    </script>";
    exit;
}

// 게시글 삭제
$sql_delete = "DELETE FROM WRITE WHERE WRITE_ID = :post_id AND USER_ID = :user_id";
$stmt_delete = oci_parse($conn, $sql_delete);

if (!$stmt_delete) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_delete, ':post_id', $post_id);
oci_bind_by_name($stmt_delete, ':user_id', $user_id);

if (oci_execute($stmt_delete)) {
    echo "<script>
        alert('게시글이 삭제되었습니다.');
        window.location.href = 'mypage.php';
    </script>";
} else {
    $e = oci_error($stmt_delete);
    echo "<script>
        alert('게시글 삭제 실패: " . htmlspecialchars($e['message']) . "');
        history.back();
    </script>";
}

oci_free_statement($stmt_delete);
oci_close($conn);
?>
