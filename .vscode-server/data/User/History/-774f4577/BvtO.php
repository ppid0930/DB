<?php
session_start(); // 세션 시작

// 현재 페이지 URL 가져오기 (로그아웃 전 페이지)
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'mainpage.php';

// 세션 데이터 초기화
$_SESSION = [];

// 세션 쿠키 제거
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 세션 종료
session_destroy();

// 현재 요청을 보낸 페이지 확인
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// 마이페이지에서 요청한 경우 메인페이지로 이동
if (strpos($referer, 'mypage.php') !== false || strpos($referer, 'edit_profile.php') !== false) {
    header('Location: mainpage.php'); // 메인페이지로 리디렉션
    exit;
}

// 나머지 경우 이전 페이지로 이동
if (!empty($referer)) {
    header("Location: $referer");
} else {
    // 이전 페이지 정보가 없는 경우 메인페이지로 이동
    header('Location: mainpage.php');
}
exit;
?>
