<?php
session_start();

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// 자유게시판의 POST_ID
$post_id = "1"; // 자유게시판 고유 post_id

// 게시글 가져오기
$write_sql = "
    SELECT LPAD(ROWNUM, 3, '0') AS NUM,
           WRITE_ID, CONTENT_NAME, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
    FROM (
        SELECT WRITE_ID, CONTENT_NAME, USER_ID, CREATED_AT
        FROM WRITE
        WHERE POST_ID = :post_id
        ORDER BY WRITE_ID DESC -- 최신순
    )";
$write_stmt = oci_parse($conn, $write_sql);
oci_bind_by_name($write_stmt, ":post_id", $post_id);
oci_execute($write_stmt);

// 게시글 배열 생성
$posts = [];
while ($row = oci_fetch_assoc($write_stmt)) {
    $posts[] = $row;
}

oci_free_statement($write_stmt);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'navbar.php'; ?>
    <title>자유게시판</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        .header { text-align: center; padding: 20px 0; margin-top: 30px; }
        .header h1 { font-size: 36px; margin: 0; }
        .table-container { width: 80%; margin: 40px auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; }
        th { background-color: #f7f7f7; font-weight: bold; }
        tr:hover { background-color: #f1f1f1; }
        .write-btn { display: block; width: 100px; margin: 20px auto; text-align: center; padding: 10px 15px; background-color: orange; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .write-btn:hover { background-color: darkorange; }
    </style>
</head>
<body>
    <div class="header">
        <h1>자유게시판</h1>
    </div>

    <div class="table-container">
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
                if (empty($posts)) {
                    echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                } else {
                    foreach ($posts as $post) {
                        echo "<tr>
                            <td>{$post['NUM']}</td>
                            <td>" . htmlspecialchars($post['CONTENT_NAME']) . "</td>
                            <td>" . htmlspecialchars($post['USER_ID']) . "</td>
                            <td>" . htmlspecialchars($post['CREATED_AT']) . "</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="write-btn-container">
        <a class="write-btn" href="write.php">글쓰기</a>
    </div>
</body>
</html>
