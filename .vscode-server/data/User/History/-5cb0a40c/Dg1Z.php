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

// 이전 페이지로 리디렉션
header("Location: " . $redirect_url);
exit;
?>
