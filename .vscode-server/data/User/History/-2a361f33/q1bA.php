<?php
session_start();

// 로그인 확인 (로그인이 필요한 경우)
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홍보 게시판</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
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
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .write-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: orange;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>홍보 게시판</h2>
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
            <!-- 샘플 데이터 -->
            <tr>
                <td>001</td>
                <td><a href="promotion_post.php?post_id=001">홍보글 제목 1</a></td>
                <td>user1</td>
                <td>2024-11-21</td>
            </tr>
            <tr>
                <td>002</td>
                <td><a href="promotion_post.php?post_id=002">홍보글 제목 2</a></td>
                <td>user2</td>
                <td>2024-11-22</td>
            </tr>
        </tbody>
    </table>
    <a href="promotion_write.php" class="write-btn">글쓰기</a>
</body>
</html>
