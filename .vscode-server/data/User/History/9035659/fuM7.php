<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>미디어 콘텐츠 페이지</title>
    <?php include('navbar.php');?>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .item {
            width: 300px;
            text-align: center;
        }
        .item img {
            width: 100%;
            cursor: pointer;
        }
        .item-title {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
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