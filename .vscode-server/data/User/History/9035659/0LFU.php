<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'navbar.php'; ?>
    <title>미디어 콘텐츠 페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        h1 {
            margin-top: 50px; /* 콘텐츠 위 여백 */
            margin-bottom: 40px;
            font-size: 32px;
            text-align: center;
            color: #333;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px; /* 카드 간격 */
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
            padding-bottom: 40px;
        }
        .item {
            width: 30%; /* 한 줄에 3개 배치 */
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* 호버 효과 */
        }
        .item:hover {
            transform: scale(1.05); /* 호버 시 확대 효과 */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .item img {
            width: 100%;
            height: 200px; /* 이미지 높이를 고정 */
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .item-title {
            margin-top: 10px;
            font-size: 18px; /* 글자 크기 증가 */
            font-weight: bold;
            color: #444;
        }
        @media (max-width: 768px) {
            .item {
                width: 45%; /* 작은 화면에서는 한 줄에 2개 */
            }
        }
        @media (max-width: 480px) {
            .item {
                width: 100%; /* 모바일 화면에서는 한 줄에 1개 */
            }
        }
    </style>
</head>
<body>
    <h1>활동 내역</h1>
    <div class="container">
        <?php
        // 콘텐츠 배열 정의
        $contents = [
            [
                "title" => "뉴빈스가 간다 EP.4",
                "image" => "https://example.com/image1.jpg",
                "url" => "https://example.com/page1"
            ],
            [
                "title" => "청주 샵PC방 가경동",
                "image" => "https://example.com/image2.jpg",
                "url" => "https://example.com/page2"
            ],
            [
                "title" => "뉴빈스가 간다 EP.3",
                "image" => "https://example.com/image3.jpg",
                "url" => "https://example.com/page3"
            ],
            [
                "title" => "안양 모던PC방",
                "image" => "https://example.com/image4.jpg",
                "url" => "https://example.com/page4"
            ],
            [
                "title" => "현장 스케치 | 참여형 실습과정",
                "image" => "https://example.com/image5.jpg",
                "url" => "https://example.com/page5"
            ],
            [
                "title" => "현장 스케치 | 챔피언 플레이오프",
                "image" => "https://example.com/image6.jpg",
                "url" => "https://example.com/page6"
            ],
        ];

        // 콘텐츠 출력
        foreach ($contents as $content) {
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
    </div>
</body>
</html>
