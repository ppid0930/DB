<?php
    session_start();
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
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hongik E-sports Competition</title>
    <?php include('navbar.php');?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden; /* 좌우 스크롤 제거 */
        }

        .game-container {
            width: 100vw;
            height: 400px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            background: rgba(0, 0, 0, 0.7);
        }

        .overlay-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('img/롤/롤 대회.jpg') no-repeat center center;
            background-size: cover; /* 이미지가 전체 화면을 덮도록 설정 */
            z-index: -1; /* overlay 내용보다 뒤에 오도록 설정 */
        }

        .overlay img {
            max-height: 300px; /* 로고 크기 */
            margin-top: 10px; /* 로고와 버튼 사이 간격 */
        }

        .overlay button {
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .overlay button:hover {
            background-color: #66bb6a;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            background-color: #ffffff;
            border-bottom: 2px solid #ddd;
            padding: 10px 0;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #555;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .tab.active {
            font-weight: bold;
            color: #000;
            border-bottom: 2px solid #f24c00;
        }

        .tab:hover {
            color: #f24c00;
        }

        .tab-contents {
            padding: 20px;
            background-color: #ffffff;
            max-width: 900px;
            margin: 20px auto;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .bracket-image {
            max-width: 100%; /* 이미지의 최대 너비를 부모 요소에 맞춤 */
            height: auto; /* 비율 유지 */
            display: block; /* 중앙 정렬을 위한 블록 요소 */
            margin: 20px auto; /* 위아래 여백과 중앙 정렬 */
            border: 1px solid #ddd; /* 테두리 추가 */
            border-radius: 10px; /* 모서리를 둥글게 */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 그림자 효과 */
        }

        .join-btn {
            display: block;
            margin: 20px auto;
            background-color: #e1fa42;
            color: black;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .join-btn:hover {
            background-color: #d9e838;
        }
        
    </style>
</head>
<body>
    <div class="game-container">
        <div class="overlay">
            <div class="overlay-bg"></div> <!-- 배경 이미지 -->
            <img src="img/로고/롤 로고.png" alt="로고">
            <button onclick="location.href='participant.php'">대회 참가하기</button>
        </div>
    </div>

    <!-- 탭 섹션 -->
    <div class="tabs">
        <button class="tab" data-tab="info" onclick="location.hash='info'; showTab('info')">대회정보</button>
        <button class="tab" data-tab="date" onclick="location.hash='date'; showTab('date')">대회일정</button>
        <button class="tab" data-tab="rule" onclick="location.hash='rule'; showTab('rule')">대회규정</button>
        <button class="tab" data-tab="bracket" onclick="location.hash='bracket'; showTab('bracket')">대진표</button>
        <button class="tab" data-tab="prizes" onclick="location.hash='prizes'; showTab('prizes')">상품/결과</button>
    </div>

    <?php
    $tabs = [
        "info" => "대회정보 내용",
        "date" => "대회일정",
        "rule" => "대회규정 & 진행방식",
        "bracket" => "대진표",
        "prizes" => "상품 및 결과"
    ];
    ?>

    <div class="tab-contents">
        <div class="tab-content" id="info">
            <div style="text-align: left; margin-bottom: 20px;">
                <h1 style="font-size: 24px; font-weight: bold;">대회안내</h1>
            </div>
            <img src="img/롤/롤 대회정보.jpg" alt="대회안내" class="bracket-image">
            <div style="text-align: center; margin-bottom: 20px;">
                <h1 style="font-size: 24px; font-weight: bold;">예선 진행방식</h1>
            </div>
            <img src="img/롤/롤 대회정보2.jpg" alt="대회예선진행" class="bracket-image">
            <div style="text-align: center; margin-bottom: 20px;">
                <h1 style="font-size: 24px; font-weight: bold;">경매</h1>
            </div>
            <img src="img/롤/롤 대회정보3.jpg" alt="대회정보" class="bracket-image"> 
        </div>
        <div class="tab-content" id="date">
            <div style="text-align: center; margin-bottom: 20px;">
                <h2 style="font-size: 24px; font-weight: bold;">대회일정</h2>
            </div>
            <img src="img/롤/롤 일정.png" alt="일정" class="bracket-image">
            <img src="img/롤/롤 일정2.png" alt="일정2" class="bracket-image">
        </div>
        <div class="tab-content" id="rule">
            <p>대회규정 & 진행방식</p>
        </div>
        <div class="tab-content" id="bracket">
            <img src="img/롤/롤 대진표.png" alt="대진표" class="bracket-image">
        </div>
        <div class="tab-content" id="prizes">
            <p>상품 및 결과</p>
        </div>
    </div>

    <?php include 'Donate.php'; ?>

    <script>
        function showTab(tabId) {
            const contents = document.querySelectorAll(".tab-content");
            contents.forEach(content => {
                content.style.display = "none";
            });

            const activeContent = document.getElementById(tabId);
            if (activeContent) {
                activeContent.style.display = "block";
            }

            const tabs = document.querySelectorAll(".tab");
            tabs.forEach(tab => {
                tab.classList.remove("active");
            });

            const activeTab = document.querySelector(`.tab[data-tab="${tabId}"]`);
            if (activeTab) {
                activeTab.classList.add("active");
            }
        }
        // URL 해시값에 따라 초기 활성화 탭 설정
        function activateTabFromHash() {
            const hash = window.location.hash.substring(1); // # 제거
            if (hash) {
                showTab(hash);
            } else {
                showTab('info'); // 기본 탭
            }
        }

        // 페이지 로드 시 해시값으로 탭 활성화
        window.onload = activateTabFromHash;

        // URL 해시값 변경 시 이벤트 리스너
        window.onhashchange = activateTabFromHash;

        /*// URL 해시값에 따라 초기 활성화 탭 설정
        const hash = window.location.hash.substring(1); // # 제거
        if (hash) {
            showTab(hash);
        } else {
            showTab('info'); // 기본 탭
        }*/
    </script>
</body>
</html>