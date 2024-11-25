<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('https://wallpaperaccess.com/full/1288276.jpg'); /* 게임 관련 고화질 이미지 */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* 반투명 검정 배경 */
            z-index: 1;
        }

        .button-container {
            text-align: center;
            position: relative;
            z-index: 2;
            color: white;
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
    <div class="overlay"></div>
    <div class="button-container">
        <h1>Hongik E-sports Competition</h1>
        <p>아래 버튼을 눌러 메인 페이지로 이동하세요:</p>
        <a href="mainpage.php" class="btn">메인 페이지로 이동</a>
    </div>
</body>
</html>
