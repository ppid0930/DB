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
                "number" => '1',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '2',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '3',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '4',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '5',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '6',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '7',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '8',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],
            [
                "number" => '9',
                "title" => "이제 우리가 판을 짠다…홍익대 과학기술대학 학생회, E-SPORTS 대회 개최",
                "image" => "img/홍보/news.png",
                "url" => "https://m.news.nate.com/view/20241118n14080?mid=m02"
            ],

        ];

        function getMediaContents($limit = null) {
            global $contents; // 전역 변수 $contents 사용
            if ($limit) {
                return array_slice($contents, 0, $limit); // 제한된 개수만 반환
            }
            return $contents; // 전체 콘텐츠 반환
        }

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
