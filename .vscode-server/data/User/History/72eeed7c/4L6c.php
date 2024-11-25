<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            background-image: url('https://cdn.wallpapersafari.com/79/78/oUI5oJ.jpg'); /* LoL 관련 고화질 이미지 */
            background-size: contain; /* 이미지를 왜곡하지 않고 전체가 보이게 함 */
            background-repeat: no-repeat; /* 배경 이미지 반복 방지 */
            background-position: center top; /* 이미지를 화면 중앙 상단에 배치 */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background-color: #000; /* 빈 부분을 검정색으로 채움 */
        }

        .content {
            text-align: center;
            background: rgba(0, 0, 0, 0.7); /* 반투명 검정 배경 */
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Hongik E-sports Competition</h1>
        <p>아래 버튼을 눌러 메인 페이지로 이동하세요:</p>
        <a href="mainpage.php" class="btn">메인 페이지로 이동</a>
    </div>
</body>
</html>
