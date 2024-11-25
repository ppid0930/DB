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

// 현재 로그인된 사용자 ID
$user_id = $_SESSION['user_id'];

// 사용자 삭제 쿼리
$sql_delete_user = "DELETE FROM USER_T WHERE USER_ID = :user_id";
$stmt_delete_user = oci_parse($conn, $sql_delete_user);

if (!$stmt_delete_user) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_delete_user, ':user_id', $user_id);

// 쿼리 실행 및 결과 처리
if (oci_execute($stmt_delete_user)) {
    // 세션 종료
    session_destroy();

    // 성공 메시지와 메인 페이지로 리디렉션
    echo "<script>
        alert('회원 탈퇴가 완료되었습니다.');
        window.location.href = 'mainpage.php';
    </script>";
} else {
    $e = oci_error($stmt_delete_user);
    echo "<script>
        alert('오류 발생: " . htmlspecialchars($e['message']) . "');
        history.back();
    </script>";
}

// 리소스 해제 및 연결 종료
oci_free_statement($stmt_delete_user);
oci_close($conn);
?>
