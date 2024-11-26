<?php
session_start();

// Oracle DB 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $write_id = $_POST['write_id'];
    $user_id = $_SESSION['user_id'];
    $comment_content = $_POST['comment_content'];

    // COMMENT_ID 생성 (시퀀스 사용)
    $seq_sql = "SELECT COMMENT_SEQ.NEXTVAL AS NEW_ID FROM DUAL";
    $seq_stmt = oci_parse($conn, $seq_sql);
    oci_execute($seq_stmt);
    $seq_row = oci_fetch_assoc($seq_stmt);
    $comment_id = $seq_row['NEW_ID'];

    if (!$comment_id) {
        die("COMMENT_ID 생성에 실패했습니다.");
    }

    // 댓글 삽입
    $insert_sql = "INSERT INTO COMMENT_T (COMMENT_ID, WRITE_ID, USER_ID, COMMENT_CONTENT, CREATED_AT) 
                   VALUES (:comment_id, :write_id, :user_id, :comment_content, SYSDATE)";
    $insert_stmt = oci_parse($conn, $insert_sql);
    oci_bind_by_name($insert_stmt, ":comment_id", $comment_id);
    oci_bind_by_name($insert_stmt, ":write_id", $write_id);
    oci_bind_by_name($insert_stmt, ":user_id", $user_id);
    oci_bind_by_name($insert_stmt, ":comment_content", $comment_content);

    $result = oci_execute($insert_stmt);

    if ($result) {
        oci_commit($conn);
        header("Location: board_write.php?write_id=" . $write_id);
    } else {
        $e = oci_error($insert_stmt);
        echo "댓글 작성 실패: " . $e['message'];
    }
    oci_free_statement($insert_stmt);
}

oci_free_statement($seq_stmt);
oci_close($conn);
?>
