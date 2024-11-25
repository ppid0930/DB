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

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $write_id = $_POST['write_id'];
    $comment_content = trim($_POST['comment_content']);
    $user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

    // 댓글 ID 생성
    $comment_id_sql = "SELECT NVL(MAX(COMMENT_ID), 0) + 1 AS COMMENT_ID FROM COMMENT_T";
    $comment_id_stmt = oci_parse($conn, $comment_id_sql);
    oci_execute($comment_id_stmt);
    $row = oci_fetch_assoc($comment_id_stmt);
    $comment_id = $row['COMMENT_ID'];
    oci_free_statement($comment_id_stmt);

    // 댓글 삽입
    $insert_sql = "INSERT INTO COMMENT_T (COMMENT_ID, WRITE_ID, USER_ID, COMMENT_CONTENT, CREATED_AT)
                   VALUES (:comment_id, :write_id, :user_id, :comment_content, SYSDATE)";
    $stmt = oci_parse($conn, $insert_sql);
    oci_bind_by_name($stmt, ":comment_id", $comment_id);
    oci_bind_by_name($stmt, ":write_id", $write_id);
    oci_bind_by_name($stmt, ":user_id", $user_id);
    oci_bind_by_name($stmt, ":comment_content", $comment_content);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: promotion_write.php?write_id=$write_id");
        exit;
    } else {
        $error = oci_error($stmt);
        die("댓글 작성 실패: " . htmlspecialchars($error['message']));
    }
}
?>
