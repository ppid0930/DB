<?php
    session_start()
?>
<?php
// Oracle 데이터베이스 연결 설정
$host = "203.249.87.57/orcl";  // Oracle DB 주소 (호스트/서비스명)
$user = "DB502_PROJ_G2";       // 사용자 이름
$password = "6969";            // 비밀번호

// Oracle DB 연결
$conn = oci_connect($user, $password, $host);

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}
?>


<!DOCTYPE html>
<html>
<body>
    <header>
        <div class="logo">
            <a href="mainpage.php">
                <img src="img/로고/홍익대학교.png" alt="로고">
            </a> <!-- 로고를 링크로 변경 -->
        </div>
        <nav class="navbar">
            <ul class="nav-menu">
                <li class="nav-item dropdown">
                    <a href="LOLgamepage.php" class="nav-link">League Of Legend</a>
                    <div class="dropdown-menu">
                        <a href="LOLgamepage.php#info">대회정보</a>
                        <a href="LOLgamepage.php#date">대회일정</a>
                        <a href="LOLgamepage.php#rule">대회규정</a>
                        <a href="LOLgamepage.php#bracket">대진표</a>
                        <a href="LOLgamepage.php#prizes">상품/결과</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="Battlegamepage.php" class="nav-link">Battleground</a>
                    <div class="dropdown-menu">
                        <a href="Battlegamepage.php#info">대회 정보</a>
                        <a href="Battlegamepage.php#date">대회 일정</a>
                        <a href="Battlegamepage.php#rule">대회 규정</a>
                        <a href="Battlegamepage.php#bracket">대진표</a>
                        <a href="Battlegamepage.php#prizes">상품</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="FIFAgamepage.php" class="nav-link">FIFA Online 4</a>
                    <div class="dropdown-menu">
                        <a href="FIFAgamepage.php#info">대회 정보</a>
                        <a href="FIFAgamepage.php#date">대회 일정</a>
                        <a href="FIFAgamepage.php#rule">대회 규정</a>
                        <a href="FIFAgamepage.php#bracket">대진표</a>
                        <a href="FIFAgamepage.php#prizes">상품</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link">커뮤니티</a>
                    <div class="dropdown-menu">
                        <a href="board.php?post_id=1">자유게시판</a>
                        <a href="promotion_board.php?post_id=2">홍보게시판</a>
                        <a href="media.php?post_id=3">활동 내역</a>
                    </div>
                </li>
            </ul>
        </nav>
        
        <div class="auth">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- 로그인 상태 -->
                <a href="logout.php" class="login-btn">로그아웃</a>
                <a href="mypage.php" class="signup-btn">마이페이지</a>
            <?php else: ?>
                <!-- 비로그인 상태 -->
                <a href="login.php" class="login-btn">로그인</a>
                <a href="membership.php" class="signup-btn">회원가입</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Header */
header {
    background-color: #111;
    color: white;
    padding: 5px 15px; /* 기존 padding을 줄임 */
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px; /* 전체 헤더 높이를 줄임 */
}

.logo {
    display: flex; /* 플렉스 박스 사용으로 중앙 정렬 */
    align-items: center;
    height: auto; /* 높이를 자동으로 설정 */
    padding: 10px; /* 여백 추가 */
}

.logo img {
    max-height: 100px; /* 이미지의 최대 높이 제한 */
    max-width: 100px; /* 너비가 컨테이너를 넘지 않도록 제한 */
    object-fit: contain; /* 이미지가 잘리지 않도록 조정 */
}
.navbar {
    flex: 1;
}

.nav-menu {
    list-style: none;
    display: flex;
}

.nav-item {
    position: relative;
    margin-left: 30px;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px;
    transition: color 0.3s;
}

.nav-link:hover {
    color: #00bcd4;
}

.auth a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 8px 16px;
    border-radius: 5px;
    margin-left: 10px; /* 버튼 간 간격 추가 */
    transition: background-color 0.3s;
}

.auth .login-btn {
    background-color: #1e90ff;
}

.auth .login-btn:hover {
    background-color: #1c86ee;
}

.auth .signup-btn {
    background-color: #1e90ff;
}

.auth .signup-btn:hover {
    background-color: #1c86ee;
}

/* 드롭다운 메뉴 스타일 */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #222;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    z-index: 1000;
    min-width: 150px;
}

.dropdown-menu a {
    display: block;
    color: white;
    padding: 8px 10px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.dropdown-menu a:hover {
    background-color: #444;
}

/* 드롭다운 메뉴 표시 */
.nav-item:hover .dropdown-menu {
    display: block;
}

</style>