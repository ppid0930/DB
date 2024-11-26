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
    // 원래 요청한 페이지로 리다이렉트
    $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'board_list.php';
    echo "<script>
        alert('로그인이 필요합니다.');
        window.location.href = '$redirect_url';
    </script>";
    exit;
}

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $write_id = $_POST['write_id']; // 게시글 ID
    $comment_content = trim($_POST['comment_content']); // 댓글 내용
    $user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

    try {
        // 트랜잭션 시작
        oci_execute(oci_parse($conn, "BEGIN NULL; END;"), OCI_NO_AUTO_COMMIT);

        // 댓글 ID 생성
        $comment_id_sql = "SELECT NVL(MAX(COMMENT_ID), 0) + 1 AS COMMENT_ID FROM COMMENT_T";
        $comment_id_stmt = oci_parse($conn, $comment_id_sql);
        if (!oci_execute($comment_id_stmt)) {
            $error = oci_error($comment_id_stmt);
            throw new Exception("댓글 ID 생성 실패: " . htmlspecialchars($error['message']));
        }

        $row = oci_fetch_assoc($comment_id_stmt);
        if (!$row || !isset($row['COMMENT_ID'])) {
            throw new Exception("댓글 ID 생성 실패: 데이터베이스에 문제가 있습니다.");
        }

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

        if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) {
            $error = oci_error($stmt);
            throw new Exception("댓글 작성 실패: " . htmlspecialchars($error['message']));
        }

        // 트랜잭션 커밋
        if (!oci_commit($conn)) {
            throw new Exception("트랜잭션 커밋 실패");
        }

        // 댓글 작성 성공 후 게시글 보기 페이지로 리다이렉트
        header("Location: board_write.php?write_id=$write_id");
        exit;
    } catch (Exception $e) {
        oci_rollback($conn); // 오류 발생 시 롤백
        echo "<script>alert('오류 발생: " . $e->getMessage() . "');</script>";
    } finally {
        // 리소스 정리
        oci_free_statement($stmt ?? null);
        oci_close($conn);
    }
}
?>
