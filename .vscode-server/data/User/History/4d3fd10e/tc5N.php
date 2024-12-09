<!DOCTYPE html>
<html lang="ko">
<head>
    <style>
        .sponsors-section {
            padding: 20px 0px;
            background-color: #ffffff;
            text-align: center;
            width: 100%; /* 전체 너비 */
            margin: 0 auto;

        }

        .sponsors-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .sponsor-list {
            display: flex;
            justify-content: center; /* 중앙 정렬 */
            flex-wrap: wrap; /* 여러 줄로 표시 */
            gap:30px; /* 로고 간격 */
            padding: 0; /* 여백 제거 */
        }

        .sponsor-item img {
            max-width: 200px; /* 로고 크기 제한 */
            height: 100px;
            object-fit: cover; /* 비율을 유지하면서 이미지가 영역에 맞게 조정됨 */
            transition: transform 0.3s;
            border-radius: 5px; /* 이미지를 둥글게 만듦 */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 약간의 그림자 추가 */
        }

        .sponsor-item span {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            font-size: 14px;
        }

       
    </style>
</head>
<body>
    <div class="sponsors-section">
        <h2>후원 기업</h2>
        <div class="sponsor-list">
            <?php
            // 후원사 배열
            $sponsors = [
                ["logo" => "img/로고/후원 1.png", "name" => "LG 유플러스"],
                ["logo" => "img/로고/의료재단 (1).png", "name" => "의료재단"],
                ["logo" => "img/로고/후원 2.png", "name" => "유버스"],
                ["logo" => "img/로고/후원 3.png", "name" => "KOG"],
                ["logo" => "img/로고/후원 4.png", "name" => "홍익대학교"],
                ["logo" => "img/로고/소융.png", "name" => "소프트웨어융합학과"]
            ];

            // 후원사 출력
            foreach ($sponsors as $sponsor) {
                echo "
                <div class='sponsor-item'>
                    <img src='{$sponsor["logo"]}' alt='{$sponsor["name"]}'>
                </div>";
            }
            ?>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        © 2025 HEC 과학기술대학. 정종인 김동식 정현욱 고성운.
    </div>
</body>
</html>
