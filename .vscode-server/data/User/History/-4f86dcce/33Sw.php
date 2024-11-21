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
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- 네비게이션 -->
    <div class="slideshow-container">
        <div class="overlay">
            <img src="img/logo2.png" alt="로고">
            <button onclick="location.href='participant.php'">대회 참가하기</button>
        </div>
        <?php
            $imageDir = "img/메인화면 및 배경";
            $images = glob($imageDir . "*.{png,jpg}", GLOB_BRACE);

           /* // 원하는 파일명 리스트를 작성
            $desiredImages = ["banner1.png", "banner2.png","banner3.png","banner4.png","리그오브레전드.jpg", "배틀그라운드.jpg","FIFA.jpg"];
            */
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
        <p>2025년 11월 16일(토) 오전 11시 생중계<br>HEC 최종 우승자는 과연 누구일까?</p>
    </div>
    <div class="tournament-list">
        <?php
        $tournaments = [
            ["image" => "img/홍보/롤 홍보.png", "title" => "HEC 2025 League Of Legend 대회", "location" => "과학기술대학", "date" => "2025-11-23 11:00"],
            ["image" => "img/홍보/배그 홍보.png", "title" => "HEC 2025 BattleGround 대회", "location" => "과학기술대학", "date" => "2025-11-24 15:00"],
            ["image" => "img/홍보/롤 홍보.png", "title" => "HEC 2025 FIFA Online4 대회", "location" => "과학기술대학", "date" => "2025-11-29 19:00"]
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
    </script>
</body>
</html>
