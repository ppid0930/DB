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
            <img src="img/로고/Hongvox2.png" alt="로고">
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
    
    <?php

        // 앞에서 3개의 콘텐츠만 가져오기
        $limitedContents = getMediaContents(3);

        foreach ($limitedContents as $content) {
            echo "
            <div class='item'>
                <a href='{$content['url']}' target='_blank'>
                    <img src='{$content['image']}' alt='{$content['title']}'>
                </a>
                <div class='item-title'>{$content['title']}</div>
            </div>
            ";
        }
    ?>
        <style>
        /* 실시간 인기 나눔인 컨테이너 */
        .popular-contetns {
            margin-top: 50px;
            text-align: center;
        }

        /* 실시간 인기 나눔인 제목 스타일 */
        .popular-contents h2 {
            font-size: 18px; /* 제목 크기 */
            color: #333; /* 제목 색상 */
            margin-bottom: 20px;
            text-align: center; /* 제목 중앙 정렬 */
            position: relative; /* 위치를 조정 가능하도록 설정 */
        }

        /* 실시간 인기 나눔인 슬라이더 컨테이너 */
        .content-slider-container {
            display: flex;
            justify-content: center; /* 슬라이더 중앙 정렬 */
            overflow: hidden;
            width: 65%; /* 전체 슬라이더 너비 */
            margin: 0 auto; /* 중앙 정렬 */
            position: relative;
            height: auto; /* 높이를 자동 조정 */
            padding-bottom: 20px; /* 하단 여백 추가 */
        }

        .content-slider {
            display: flex;
            gap: 10px; /* 이미지 사이의 간격 */
            transition: transform 0.5s ease-in-out;
            width: calc(100% * 5); /* 슬라이더가 5개의 이미지만 보이도록 설정 */
            max-width: 100%; /* 부모 크기를 넘지 않도록 제한 */
            height: auto; /* 높이를 자동 조정 */
        }

        /* 각 항목 스타일 */
        .content-item {
            position: relative; /* 책갈피 아이콘을 이미지 위에 배치하기 위해 설정 */
            overflow: hidden; /* 이미지 넘침 방지 */
            display: flex;
            flex-direction: column; /* 세로 정렬 */
            align-items: center;
            box-sizing: border-box;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 약간의 그림자 추가 */
            background-color: #fff; /* 배경색 추가 */
        }

        /* 책갈피 아이콘 */
        .content-item .bookmark-icon {
            position: absolute;
            top: 10px; /* 이미지 내부 상단 여백 */
            right: 10px; /* 이미지 내부 오른쪽 여백 */
            width: 24px; /* 아이콘 크기 */
            height: 24px;
            cursor: pointer;
            background-image: url('/2_team/2_team4/2_team4/image/bookmark_empty.png'); /* 기본 책갈피 */
            background-size: contain; /* 아이콘 크기를 유지하며 비율 조정 */
            background-repeat: no-repeat;
            z-index: 10; /* 이미지 위로 표시 */
            transition: background-image 0.3s ease;
        }

        /* 찜 상태의 책갈피 */
        .content-item .bookmark-icon.bookmarked {
            background-image: url('/2_team/2_team4/2_team4/image/bookmark_filled.png'); /* 찜 상태 책갈피 */
        }

        /* 항목 이미지 스타일 */
        .content-item img {
            width: 100%; /* 부모 크기에 맞춤 */
            height: 140px; /* 고정 높이로 설정 */
            object-fit: cover; /* 이미지가 박스 크기를 채우도록 설정 */
            border-radius: 10px; /* 둥근 모서리 */
        }

        /* 항목 번호 스타일 */
        .content-item .content-number {
            font-size: 20px;
            font-weight: bold;
            color: #0072B8;
            margin-top: 10px;
        }

        /* 항목 제목 스타일 */
        .content-item .content-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            line-height: 1.4;
            text-align: center; /* 텍스트 중앙 정렬 */
            margin-top: 5px;
            overflow: hidden; /* 텍스트 넘침 방지 */
            text-overflow: ellipsis; /* 넘치는 텍스트는 말줄임 표시 */
            white-space: nowrap; /* 한 줄로 표시 */
        }

        /* 항목 설명 스타일 */
        .content-item .content-description {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 5px;
            overflow: hidden; /* 텍스트 넘침 방지 */
            text-overflow: ellipsis; /* 넘치는 텍스트는 말줄임 표시 */
            white-space: nowrap; /* 한 줄로 표시 */
        }

        /* 슬라이더 버튼 스타일 */
        .slider-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .slider-button {
            padding: 10px 20px;
            background-color: #0072B8;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 10px;
        }

        .slider-button:hover {
            background-color: #005f8a;
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];

            // 초기화: 모든 talent-item에 대해 상태 설정
            document.querySelectorAll('.content-item').forEach(item => {
                const contentId = item.getAttribute('data-content-id');
                const bookmarkIcon = item.querySelector('.bookmark-icon');
                if (bookmarks.includes(String(contentId))) {
                    bookmarkIcon.classList.add('bookmarked');
                }
            });

            // 찜 버튼 클릭 이벤트
            window.toggleBookmark = function (talentId, type) {
                const item = document.querySelector(`.talent-item[data-content-id="${contentId}"]`);
                if (!item) {
                    console.error(`Element with talentId "${contentId}" not found.`);
                    return;
                }

                const bookmarkIcon = item.querySelector('.bookmark-icon');
                const isBookmarked = bookmarkIcon.classList.contains('bookmarked');
                const action = isBookmarked ? 'removeFavorite' : 'addFavorite';

                // 서버와 동기화
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        talentId,
                        type, // type: 'popular' or 'new'
                        [action]: true // 동적으로 addFavorite 또는 removeFavorite 설정
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        // UI 업데이트
                        bookmarkIcon.classList.toggle('bookmarked');
                        if (isBookmarked) {
                            // 로컬 스토리지에서 제거
                            const index = bookmarks.indexOf(String(contentId));
                            if (index > -1) bookmarks.splice(index, 1);
                        } else {
                            // 로컬 스토리지에 추가
                            if (!bookmarks.includes(String(contentId))) {
                                bookmarks.push(String(contentId));
                            }
                        }
                        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
                    } else {
                        console.error('Failed to update bookmark on the server.');
                    }
                })
                .catch(err => {
                    console.error('Error while syncing bookmark:', err);
                });
            };
        });


            // 인기 나눔인 슬라이더
            document.addEventListener('DOMContentLoaded', function () {
            const popularSlider = document.getElementById("popularTalentSlider"); // 슬라이더 컨테이너
            const popularItems = popularSlider.querySelectorAll(".content-item"); // 슬라이더 아이템들
            const popularPrevButton = document.getElementById("popularPrevButton"); // 이전 버튼
            const popularNextButton = document.getElementById("popularNextButton"); // 다음 버튼

            let currentPage = 0;
            const itemsPerPage = 5; // 한 페이지에 표시할 아이템 수
            const itemWidth = popularItems[0]?.offsetWidth + 10 || 0; // 아이템의 너비 + 간격 계산
            const totalPages = Math.ceil(popularItems.length / itemsPerPage); // 총 페이지 계산

            // 슬라이더 상태 업데이트 함수
            function updateSlider() {
                const offset = -currentPage * itemsPerPage * itemWidth; // 슬라이더 이동 거리 계산
                popularSlider.style.transform = `translateX(${offset}px)`; // 슬라이더 이동
            }

            // 이전 버튼 클릭 이벤트
            popularPrevButton.addEventListener("click", () => {
                currentPage = (currentPage - 1 + totalPages) % totalPages; // 이전 페이지로 이동
                updateSlider();
            });

            // 다음 버튼 클릭 이벤트
            popularNextButton.addEventListener("click", () => {
                currentPage = (currentPage + 1) % totalPages; // 다음 페이지로 이동
                updateSlider();
            });

            // 초기 슬라이더 상태 업데이트
            updateSlider();
        });


                // **자동 이동 기능 추가**
                let popularAutoSlideInterval = setInterval(() => {
                    popularCurrentPage = (popularCurrentPage + 1) % popularTotalPages; // 다음 페이지로 이동
                    updatePopularSlider();
                }, 30000); // 30초마다 자동 이동
        </script>
        ?>

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