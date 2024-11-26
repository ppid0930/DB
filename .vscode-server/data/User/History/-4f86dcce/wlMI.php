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
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hongik Esports Competition</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden; /* 좌우 스크롤 제거 */
        }

        .slideshow-container {
            width: 100%;
            height: 600px;
            position: relative;
            overflow: hidden;
        }

        .slides {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .active {
            display: block;
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
            background: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            text-align: center;
            z-index: 1;
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

        .content {
            text-align: center;
            padding: 20px;
            background-color: #e0e0e0;
            color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0; /* 좌우 여백 제거 */
            width: 100%; /* 화면 전체 너비 사용 */
        }

        .tournament-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .tournament-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: calc(33.33% - 20px); /* 3개 균등 배치 */
            min-width: 250px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tournament-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .tournament-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .tournament-item .details h3 {
            margin: 10px 0 5px;
            font-size: 16px;
        }

        .tournament-item .details p {
            margin: 0;
            font-size: 14px;
            color: #666666;
        }

        .activity-section {
            position: relative;
            margin: 50px 0;
            padding: 30px;
            background-color: #e0e0e0;
        }

        .activity-section h2 {
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .more-link {
            position: absolute;
            top: 5px;
            right: 20px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .more-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .activity-container {
            display: flex;
            gap: 20px;
        }

        .activity-large {
            flex: 2;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .activity-large img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .activity-large .activity-details {
            padding: 15px;
        }

        .activity-large h3 {
            font-size: 18px;
            margin: 0 0 10px;
            font-weight: bold;
            color: #333;
        }

        .activity-large p {
            margin: 0 0 5px;
            color: #666;
            font-size: 14px;
        }

        .activity-large span {
            font-size: 12px;
            color: #999;
        }

        .activity-small-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-small {
            display: flex;
            gap: 10px;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            overflow: hidden;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .activity-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .activity-small img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .activity-small .activity-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .activity-small h4 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .activity-small span {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }



        .activity-section .more-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #4caf50;
            text-decoration: none;
            transition: color 0.3s;
        }

        .activity-section .more-link:hover {
            color: #66bb6a;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- 네비게이션 -->
    <div class="slideshow-container">
        <div class="overlay">
            <img src="img/로고/VOX.png" alt="로고">
            <button onclick="location.href='participant.php'">대회 참가하기</button>
        </div>
        <?php
            $imageDir = "img/메인화면배경/";
            $images = glob($imageDir . "*.{jpeg,png,jpg}", GLOB_BRACE);

            // 원하는 파일명 리스트를 작성
            $desiredImages = ["리그오브레전드.jpg", "배틀그라운드.jpg","FIFA.jpg","bg.jpeg","esport 대회.jpg"];
            
            // 조건에 따라 필터링하여 슬라이드 출력
            foreach ($images as $image) {
                if (in_array(basename($image), $desiredImages)) {
                    echo "<img class='slides' src='$image' alt='슬라이드 이미지'>";
                }
            }
            ?>
    </div>
    <div class="content">
        <h2>Hongik Esports Competition</h2>
        <p>2025년 개최할 HEC 대회 많이 참여해주세요!!</p>
    </div>
    <div class="tournament-list">
        <?php
        $tournaments = [
            ["image" => "img/홍보/롤 홍보.png", "title" => "HEC 2025 League Of Legend 대회", "location" => "과학기술대학", "date" => "신청기한: 2025-08-09 ~ 08-20"],
            ["image" => "img/홍보/배그 홍보.png", "title" => "HEC 2025 BattleGround 대회", "location" => "과학기술대학", "date" => "신청기한: 2025-08-10 ~ 08-25"],
            ["image" => "img/홍보/피파 홍보.png", "title" => "HEC 2025 FIFA Online4 대회", "location" => "과학기술대학", "date" => "신청기한: 2025-08-10 ~ 08-20"]
        ];

        foreach ($tournaments as $tournament) {
            echo "
            <div class='tournament-item'>
                <img src='{$tournament["image"]}' alt='대회 이미지'>
                <div class='details'>
                    <h3>{$tournament["title"]}</h3>
                    <p>{$tournament["location"]}</p>
                    <p>{$tournament["date"]}</p>
                </div>
            </div>";
        }
        ?>
    </div>

    <div class="activity-section">
    <h2>활동 내역</h2>
    <a href="activity-page.php" class="more-link">더보기 ></a>
    <div class="activity-container">
            <!-- 좌측 큰 이미지 -->
            <div class="activity-large">
                <img src="img/활동/청주샵PC방.jpg" alt="청주 샵PC방">
                <div class="activity-details">
                    <h3>청주 샵PC방 가경동 | 우수 이스포츠 시설 소개</h3>
                    <p>2024 이스포츠 동호인 대회</p>
                    <span>2024-11-26</span>
                </div>
            </div>
            <!-- 우측 작은 이미지 3개 -->
            <div class="activity-small-list">
                <div class="activity-small">
                    <img src="img/활동/안양모던PC방.jpg" alt="안양 모던PC방">
                    <div class="activity-details">
                        <h4>안양 모던PC방 | 우수 이스포츠 시설 소개</h4>
                        <span>2024-10-28</span>
                    </div>
                </div>
                <div class="activity-small">
                    <img src="img/활동/뉴빈스.jpg" alt="뉴빈스">
                    <div class="activity-details">
                        <h4>뉴빈스가 간다 EP.3 | 2024 이스포츠 동호인 대회</h4>
                        <span>2024-11-20</span>
                    </div>
                </div>
                <div class="activity-small">
                    <img src="img/활동/현장스케치.jpg" alt="현장 스케치">
                    <div class="activity-details">
                        <h4>현장 스케치 | 참여형 실습과정</h4>
                        <span>2024-10-18</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'Donate.php'; ?>

    <script>
        let slideIndex = 0;
        const slides = document.getElementsByClassName("slides");

        function showSlides() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1; }
            slides[slideIndex - 1].classList.add("active");
            setTimeout(showSlides, 3000); // 3초마다 이미지 전환
        }
        showSlides();

            
        document.querySelector('.activity-section').scrollIntoView({
            behavior: 'smooth'
        });


    </script>
</body>
</html>