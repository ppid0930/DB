<?php
session_start();

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => '데이터베이스 연결 실패']);
    exit;
}

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => '로그인이 필요합니다']);
    exit;
}

// 요청 데이터 받기
$comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0;
$new_content = isset($_POST['new_content']) ? trim($_POST['new_content']) : '';

if (!$comment_id || empty($new_content)) {
    echo json_encode(['success' => false, 'error' => '잘못된 요청입니다']);
    exit;
}

$user_id = $_SESSION['user_id'];

// 댓글 작성자 확인
$check_sql = "SELECT USER_ID FROM COMMENT_T WHERE COMMENT_ID = :comment_id";
$check_stmt = oci_parse($conn, $check_sql);
oci_bind_by_name($check_stmt, ":comment_id", $comment_id);
oci_execute($check_stmt);

$row = oci_fetch_assoc($check_stmt);

if (!$row || $row['USER_ID'] !== $user_id) {
    echo json_encode(['success' => false, 'error' => '본인만 댓글을 수정할 수 있습니다']);
    exit;
}

// 댓글 수정
$update_sql = "UPDATE COMMENT_T SET COMMENT_CONTENT = :new_content WHERE COMMENT_ID = :comment_id";
$update_stmt = oci_parse($conn, $update_sql);
oci_bind_by_name($update_stmt, ":new_content", $new_content);
oci_bind_by_name($update_stmt, ":comment_id", $comment_id);

if (oci_execute($update_stmt)) {
    echo json_encode(['success' => true]);
} else {
    $error = oci_error($update_stmt);
    echo json_encode(['success' => false, 'error' => $error['message']]);
}

oci_free_statement($check_stmt);
oci_free_statement($update_stmt);
oci_close($conn);
?>
