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

// POST로 받은 데이터
$user_id = $_POST['user_id'];
$game_id = $_POST['game_id'];

// 참가 정보 삭제
$sql_delete = "DELETE FROM PARTICIPANT 
               WHERE USER_ID = :user_id AND GAME_ID = :game_id";
$stmt_delete = oci_parse($conn, $sql_delete);

if (!$stmt_delete) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_delete, ':user_id', $user_id);
oci_bind_by_name($stmt_delete, ':game_id', $game_id);

if (oci_execute($stmt_delete)) {
    echo "<script>
        alert('참가가 성공적으로 취소되었습니다!');
        window.location.href = 'mypage.php';
    </script>";
} else {
    $e = oci_error($stmt_delete);
    echo "<script>
        alert('참가 취소 중 오류가 발생했습니다: " . htmlspecialchars($e['message']) . "');
        window.location.href = 'mypage.php';
    </script>";
}

// 쿼리 리소스 해제
oci_free_statement($stmt_delete);

// DB 연결 해제
oci_close($conn);
?>