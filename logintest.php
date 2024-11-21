<?php
session_start(); // 세션 시작

// 사용자 인증 확인
if (!isset($_SESSION['user_id'])) {
    // 세션이 없으면 로그인 페이지로 리디렉션
    header("Location: login.php");
    exit;
}

// 인증된 사용자 정보
echo "안녕하세요, " . htmlspecialchars($_SESSION['user_name']) . "님!";
echo "<a href='logout.php'>로그아웃</a>";
?>