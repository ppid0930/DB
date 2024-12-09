<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    die("Oracle 데이터베이스 연결 실패: " . htmlspecialchars($e['message']));
}

// POST 데이터 받기
$comment_content = isset($_POST['comment_content']) ? trim($_POST['comment_content']) : '';
$write_id = isset($_POST['write_id']) ? $_POST['write_id'] : '';
$user_id = $_SESSION['user_id'];

if (empty($comment_content)) {
    die("댓글 내용을 입력해주세요.");
}

try {
    oci_autocommit($conn, false);

    // COMMENT_ID 생성
    $get_comment_id_sql = "SELECT NVL(MAX(TO_NUMBER(COMMENT_ID)), 0) + 1 AS COMMENT_ID FROM COMMENT_T";
    $comment_id_stmt = oci_parse($conn, $get_comment_id_sql);
    oci_execute($comment_id_stmt);
    $row = oci_fetch_assoc($comment_id_stmt);
    $comment_id = $row['COMMENT_ID'];
    oci_free_statement($comment_id_stmt);

    // 댓글 추가
    $insert_comment_sql = "
        INSERT INTO COMMENT_T (COMMENT_ID, USER_ID, WRITE_ID, COMMENT_CONTENT, CREATED_AT)
        VALUES (:comment_id, :user_id, :write_id, :comment_content, SYSDATE)
    ";
    $stmt = oci_parse($conn, $insert_comment_sql);
    oci_bind_by_name($stmt, ":comment_id", $comment_id);
    oci_bind_by_name($stmt, ":user_id", $user_id);
    oci_bind_by_name($stmt, ":write_id", $write_id);
    oci_bind_by_name($stmt, ":comment_content", $comment_content);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        echo "<script>
            alert('댓글이 추가되었습니다.');
            window.location.href = 'board_write.php?write_id=$write_id';
        </script>";
    } else {
        $error = oci_error($stmt);
        throw new Exception("댓글 추가 실패: " . htmlspecialchars($error['message']));
    }
} catch (Exception $e) {
    oci_rollback($conn);
    die("오류: " . $e->getMessage());
} finally {
    oci_free_statement($stmt ?? null);
    oci_close($conn);
}
?>
