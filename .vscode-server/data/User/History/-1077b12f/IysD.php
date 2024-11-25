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
    echo "<script>
        alert('로그인이 필요합니다.');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// 댓글 ID와 게시글 ID 가져오기
$comment_id = isset($_GET['comment_id']) ? intval($_GET['comment_id']) : 0;
$write_id = isset($_GET['write_id']) ? intval($_GET['write_id']) : 0;
$user_id = $_SESSION['user_id']; // 현재 로그인한 사용자 ID

if ($comment_id <= 0 || $write_id <= 0) {
    echo "<script>
        alert('유효하지 않은 요청입니다.');
        history.back();
    </script>";
    exit;
}

// 댓글 작성자 확인
$check_sql = "SELECT USER_ID FROM COMMENT_T WHERE COMMENT_ID = :comment_id";
$check_stmt = oci_parse($conn, $check_sql);
oci_bind_by_name($check_stmt, ":comment_id", $comment_id);
oci_execute($check_stmt);

$row = oci_fetch_assoc($check_stmt);

if (!$row) {
    echo "<script>
        alert('댓글을 찾을 수 없습니다.');
        window.location.href = 'promotion_write.php?write_id=$write_id';
    </script>";
    exit;
}

if ($row['USER_ID'] !== $user_id) {
    echo "<script>
        alert('본인이 작성한 댓글만 삭제할 수 있습니다.');
        window.location.href = 'promotion_write.php?write_id=$write_id';
    </script>";
    exit;
}

// 댓글 삭제
$delete_sql = "DELETE FROM COMMENT_T WHERE COMMENT_ID = :comment_id";
$delete_stmt = oci_parse($conn, $delete_sql);
oci_bind_by_name($delete_stmt, ":comment_id", $comment_id);
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'board_list.php';

if (oci_execute($delete_stmt)) {
    echo "<script>
        alert('댓글이 삭제되었습니다.');
        window.location.href = '$redirect_url';
    </script>";
} else {
    $error = oci_error($delete_stmt);
    echo "<script>
        alert('댓글 삭제 실패: " . htmlspecialchars($error['message']) . "');
        window.location.href = '$redirect_url';
    </script>";
}

oci_free_statement($check_stmt);
oci_free_statement($delete_stmt);
oci_close($conn);
?>
