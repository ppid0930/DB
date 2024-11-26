<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>미디어 콘텐츠 페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        h1 {
            margin-top: 100px; /* 네비게이션 바의 높이만큼 간격 추가 */
            margin-bottom: 40px;
            font-size: 28px;
            text-align: center;
            color: #333;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
            padding-bottom: 40px;
        }
        .item {
            width: 250px;
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .item img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .item-title {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #444;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <h1>미디어 콘텐츠</h1>
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
