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
$boards = [
    ['POST_ID' => '1', 'POST_NAME' => '자유게시판'],
    ['POST_ID' => '2', 'POST_NAME' => '홍보게시판']
];
?>
<!DOCTYPE html>
<html>
<body>
    <header>
        <div class="logo">
            <a href="mainpage.php">
                <img src="img/logo2.png" alt="HEC 로고">
            </a> <!-- 로고를 링크로 변경 -->
        </div>
        <nav class="navbar">
            <ul class="nav-menu">
                <li class="nav-item dropdown">
                    <a href="LOLgamepage.php" class="nav-link">League Of Legend</a>
                    <div class="dropdown-menu">
                        <a href="LOLgamepage.php#info">게임 규칙</a>
                        <a href="LOLgamepage.php#format">진행방식</a>
                        <a href="LOLgamepage.php#prizes">상품</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="battleground.php" class="nav-link">Battleground</a>
                    <div class="dropdown-menu">
                        <a href="battleground.php#rules">게임 규칙</a>
                        <a href="battleground.php#format">진행방식</a>
                        <a href="battleground.php#prizes">상품</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="fifa.php" class="nav-link">FIFA Online 4</a>
                    <div class="dropdown-menu">
                        <a href="fifa.php#rules">게임 규칙</a>
                        <a href="fifa.php#format">진행방식</a>
                        <a href="fifa.php#prizes">상품</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="board.php" class="nav-link">커뮤니티</a>
                    <div class="dropdown-menu">
                        <a href="board.php?#rules">자유게시판</a>
                        <a href="board.php?#format">홍보게시판</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="auth">
            <a href="mainpage.php" class="logout-btn">로그아웃</a>
            <a href="membership.php" class="mypage-btn">마이페이지</a>
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
    max-height: 80px; /* 이미지의 최대 높이 제한 */
    max-width: 80px; /* 너비가 컨테이너를 넘지 않도록 제한 */
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

.auth .logout-btn {
    background-color: #1e90ff;
}

.auth .logout-btn:hover {
    background-color: #1c86ee;
}

.auth .mypage-btn {
    background-color: #1e90ff;
}

.auth .mypage-btn:hover {
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

/* 메인 이미지 섹션 스타일 
.main-image {
    text-align: center;
    margin-top: 0; 이미지와 네비게이션 바 사이의 여백 제거 
}

.main-image img {
    width: 100%;
    height: auto;
    border-radius: 0; /* 모서리를 둥글게 하지 않음 (선택 사항) 
    margin-top: -4px; /* 이미지가 네비게이션 바와 잘 연결되도록 조정 
}*/

/* 메인 이미지 섹션 스타일 
.main-image {
    position: relative;
    text-align: center;
    margin-top: 0;
}

.main-image img {
    width: 100%;
    height: auto;
}

.participate-button {
    position: absolute;
    top: 50%;  버튼을 수직 중앙에 배치 
    left: 50%;  버튼을 수평 중앙에 배치 
    transform: translate(-50%, -50%);  버튼을 정확히 가운데 정렬 
    background-color: #e1fa42;
    color: rgb(9, 9, 9);
    border: none;
    padding: 15px 30px;
    font-size: 18px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
    font-weight: bold;
}

.participate-button:hover {
    background-color: #e1fa42;
}*/

</style>
