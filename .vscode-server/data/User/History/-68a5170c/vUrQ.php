<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홍보게시판</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: 0 auto 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .write-btn {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .write-btn:hover {
            background-color: #ff9800;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?> <!-- 네비게이션 바 -->
    <h2>홍보게시판</h2>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>홍보글 제목 예시</td>
                <td>홍길동</td>
                <td>2024-11-21</td>
            </tr>
            <tr>
                <td>2</td>
                <td>또 다른 홍보글 제목</td>
                <td>이순신</td>
                <td>2024-11-20</td>
            </tr>
            <!-- 필요하면 더 많은 예제 데이터 추가 -->
            <tr>
                <td colspan="4">더 많은 게시글은 나중에 추가될 예정입니다.</td>
            </tr>
        </tbody>
    </table>
    <a href="promotion.php" class="write-btn">글쓰기</a>
</body>
</html>
