<?php
session_start();
include 'db.php'; // DB 연결 파일

// 홍보게시판의 게시글만 불러오기
$query = "SELECT WRITE_ID, CONTENT_NAME, USER_ID, CONTENT, CREATED_AT FROM WRITE WHERE POST_ID = 2 ORDER BY CREATED_AT DESC";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

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
            <?php
            $rowCount = 0;
            while ($row = oci_fetch_assoc($stmt)):
                $rowCount++;
            ?>
                <tr>
                    <td><?php echo $rowCount; ?></td>
                    <td><a href="post_view.php?write_id=<?php echo $row['WRITE_ID']; ?>"><?php echo htmlspecialchars($row['CONTENT_NAME']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['USER_ID']); ?></td>
                    <td><?php echo $row['CREATED_AT']; ?></td>
                </tr>
            <?php endwhile; ?>
            <?php if ($rowCount === 0): ?>
                <tr>
                    <td colspan="4">게시글이 없습니다.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="write.php?post_id=2" class="write-btn">글쓰기</a>
</body>
</html>
