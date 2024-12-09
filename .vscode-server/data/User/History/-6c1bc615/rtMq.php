<?php
session_start();

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

// Oracle DB 연결 설정
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $write_id = $_POST['write_id']; // 게시글 ID
    $user_id = $_SESSION['user_id']; // 현재 사용자 ID
    $comment_content = $_POST['comment_content']; // 댓글 내용

    try {
        // 트랜잭션 시작
        oci_execute(oci_parse($conn, "BEGIN NULL; END;"), OCI_NO_AUTO_COMMIT);

        // 테이블에서 최대 COMMENT_ID 조회
        $max_id_sql = "SELECT NVL(MAX(COMMENT_ID), 0) + 1 AS NEW_ID FROM COMMENT_T";
        $max_id_stmt = oci_parse($conn, $max_id_sql);

        if (!oci_execute($max_id_stmt)) {
            $e = oci_error($max_id_stmt);
            throw new Exception("COMMENT_ID 조회 쿼리 실행 실패: " . $e['message']);
        }

        $max_id_row = oci_fetch_assoc($max_id_stmt);
        if (!$max_id_row || !isset($max_id_row['NEW_ID'])) {
            throw new Exception("COMMENT_ID 생성 실패: COMMENT_T 테이블에 문제가 있습니다.");
        }

        $comment_id = $max_id_row['NEW_ID']; // 새로 생성된 COMMENT_ID

        // 댓글 삽입
        $insert_sql = "INSERT INTO COMMENT_T (COMMENT_ID, WRITE_ID, USER_ID, COMMENT_CONTENT, CREATED_AT) 
                       VALUES (:comment_id, :write_id, :user_id, :comment_content, SYSDATE)";
        $insert_stmt = oci_parse($conn, $insert_sql);

        oci_bind_by_name($insert_stmt, ":comment_id", $comment_id);
        oci_bind_by_name($insert_stmt, ":write_id", $write_id);
        oci_bind_by_name($insert_stmt, ":user_id", $user_id);
        oci_bind_by_name($insert_stmt, ":comment_content", $comment_content);

        if (!oci_execute($insert_stmt, OCI_NO_AUTO_COMMIT)) {
            $e = oci_error($insert_stmt);
            throw new Exception("댓글 삽입 실패: " . $e['message']);
        }

        // 트랜잭션 커밋
        if (!oci_commit($conn)) {
            throw new Exception("트랜잭션 커밋 실패");
        }

        // 성공 시 게시글 보기 페이지로 리다이렉트
        header("Location: board_write.php?write_id=" . $write_id);
        exit;

    } catch (Exception $e) {
        oci_rollback($conn); // 오류 발생 시 롤백
        echo "오류 발생: " . $e->getMessage();
    } finally {
        // 리소스 정리
        oci_free_statement($max_id_stmt ?? null);
        oci_free_statement($insert_stmt ?? null);
        oci_close($conn);
    }
}
?>
