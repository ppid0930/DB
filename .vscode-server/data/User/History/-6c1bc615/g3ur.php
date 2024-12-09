<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    // 현재 페이지 URL 저장
    $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $redirect_url = "redirect_url=" . urlencode($current_url);

    // 로그인 페이지로 리디렉션
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = '$redirect_url';
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
$user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

if (empty($comment_content)) {
    echo "<script>
        alert('댓글 내용을 입력해주세요.');
        history.back();
    </script>";
    exit;
}

try {
    // 트랜잭션을 명시적으로 관리 (자동 커밋 비활성화)
    $commit_mode = OCI_NO_AUTO_COMMIT;

    // COMMENT_ID 생성
    $get_comment_id_sql = "SELECT NVL(MAX(TO_NUMBER(COMMENT_ID)), 0) + 1 AS COMMENT_ID FROM COMMENT_T";
    $comment_id_stmt = oci_parse($conn, $get_comment_id_sql);
    if (!$comment_id_stmt) {
        $e = oci_error($conn);
        throw new Exception("SQL 파싱 실패: " . htmlspecialchars($e['message']));
    }
    oci_execute($comment_id_stmt);
    $row = oci_fetch_assoc($comment_id_stmt);
    $comment_id = $row['COMMENT_ID'];
    oci_free_statement($comment_id_stmt);

    // 댓글 추가 SQL
    $insert_comment_sql = "
        INSERT INTO COMMENT_T (COMMENT_ID, USER_ID, WRITE_ID, COMMENT_CONTENT, CREATED_AT)
        VALUES (:comment_id, :user_id, :write_id, :comment_content, SYSDATE)
    ";
    $stmt = oci_parse($conn, $insert_comment_sql);
    if (!$stmt) {
        $e = oci_error($conn);
        throw new Exception("SQL 파싱 실패: " . htmlspecialchars($e['message']));
    }

    // 바인딩 파라미터
    oci_bind_by_name($stmt, ":comment_id", $comment_id);
    oci_bind_by_name($stmt, ":user_id", $user_id);
    oci_bind_by_name($stmt, ":write_id", $write_id);
    oci_bind_by_name($stmt, ":comment_content", $comment_content);

    if (!oci_execute($stmt, $commit_mode)) {
        $e = oci_error($stmt);
        throw new Exception("SQL 실행 실패: " . htmlspecialchars($e['message']));
    }

    // 트랜잭션 커밋
    if (!oci_commit($conn)) {
        $e = oci_error($conn);
        throw new Exception("커밋 실패: " . htmlspecialchars($e['message']));
    }

    echo "<script>
        alert('댓글이 추가되었습니다.');
        window.location.href = 'board_write.php?write_id=$write_id';
    </script>";
} catch (Exception $e) {
    // 트랜잭션 롤백
    if ($conn) {
        oci_rollback($conn);
    }
    echo "<script>
        alert('오류가 발생했습니다: " . $e->getMessage() . "');
        history.back();
    </script>";
} finally {
    // 자원 해제
    if (isset($stmt) && is_resource($stmt)) {
        oci_free_statement($stmt);
    }
    if ($conn) {
        oci_close($conn);
    }
}
?>
