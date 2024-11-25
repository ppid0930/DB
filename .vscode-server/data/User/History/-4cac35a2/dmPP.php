<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다.');
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
    $error = oci_error();
    die("DB 연결 실패: " . htmlspecialchars($error['message']));
}

// POST 데이터 확인
if (empty($_POST['WRITE_ID']) || empty($_POST['user_id'])) {
    echo "<script>
        alert('잘못된 요청입니다. 필요한 데이터가 누락되었습니다.');
        history.back();
    </script>";
    exit;
}

$write_id = $_POST['write_id'];
$user_id = $_POST['user_id'];

// 디버깅: 입력된 데이터 확인
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// 게시글 삭제 쿼리
$sql_delete = "DELETE FROM WRITE WHERE WRITE_ID = :write_id AND USER_ID = :user_id";
$stmt_delete = oci_parse($conn, $sql_delete);

if (!$stmt_delete) {
    $error = oci_error($conn);
    die("SQL 준비 실패: " . htmlspecialchars($error['message']));
}

oci_bind_by_name($stmt_delete, ':write_id', $write_id);
oci_bind_by_name($stmt_delete, ':user_id', $user_id);

if (oci_execute($stmt_delete)) {
    // 쿼리 실행 성공
    echo "<script>
        alert('게시글이 삭제되었습니다.');
        window.location.href = 'mypage.php';
    </script>";
} else {
    // 쿼리 실행 실패 시 오류 출력
    $error = oci_error($stmt_delete);
    echo "<script>
        alert('삭제 실패: " . htmlspecialchars($error['message']) . "');
        history.back();
    </script>";
}

// 리소스 정리 및 연결 종료
oci_free_statement($stmt_delete);
oci_close($conn);
?>
