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

// POST 데이터 가져오기
$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$dept = $_POST['dept'];
$email = $_POST['email'];
$tel = $_POST['tel'];

// 사용자 정보 업데이트
$sql_update = "UPDATE USER_T 
               SET NAME = :name, DEPT = :dept, E_MAIL = :email, TEL = :tel 
               WHERE USER_ID = :user_id";
$stmt_update = oci_parse($conn, $sql_update);

if (!$stmt_update) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_update, ':name', $name);
oci_bind_by_name($stmt_update, ':dept', $dept);
oci_bind_by_name($stmt_update, ':email', $email);
oci_bind_by_name($stmt_update, ':tel', $tel);
oci_bind_by_name($stmt_update, ':user_id', $user_id);

if (oci_execute($stmt_update)) {
    echo "<script>
        alert('프로필이 성공적으로 수정되었습니다!');
        window.location.href = 'mypage.php';
    </script>";
} else {
    $e = oci_error($stmt_update);
    echo "<script>
        alert('프로필 수정 중 오류가 발생했습니다: " . htmlspecialchars($e['message']) . "');
        window.location.href = 'edit_profile.php';
    </script>";
}

oci_free_statement($stmt_update);
oci_close($conn);
?>