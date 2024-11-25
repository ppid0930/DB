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
$post_id = "1";

// 검색어 처리
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// 페이지 번호와 페이징 설정
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 10;
$start_row = ($page - 1) * $limit;

// 게시글 가져오기
$write_sql = "
    SELECT NUM, WRITE_ID, CONTENT_NAME, USER_ID, CREATED_AT
    FROM (
        SELECT ROW_NUMBER() OVER (ORDER BY CREATED_AT DESC) AS NUM,
               WRITE_ID, CONTENT_NAME, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
        FROM WRITE
        WHERE POST_ID = :post_id
";

if (!empty($search)) {
    $write_sql .= " AND CONTENT_NAME LIKE '%' || :search || '%'"; // 검색 조건 추가
}

$write_sql .= "
    )
    WHERE NUM > :start_row AND NUM <= (:start_row + :limit)
";

$write_stmt = oci_parse($conn, $write_sql);
oci_bind_by_name($write_stmt, ":post_id", $post_id);
if (!empty($search)) {
    oci_bind_by_name($write_stmt, ":search", $search);
}
oci_bind_by_name($write_stmt, ":start_row", $start_row);
oci_bind_by_name($write_stmt, ":limit", $limit);
oci_execute($write_stmt);

// 전체 게시글 수 가져오기
$total_sql = "SELECT COUNT(*) AS total FROM WRITE WHERE POST_ID = :post_id";
if (!empty($search)) {
    $total_sql .= " AND CONTENT_NAME LIKE '%' || :search || '%'";
}

$total_stmt = oci_parse($conn, $total_sql);
oci_bind_by_name($total_stmt, ":post_id", $post_id);
if (!empty($search)) {
    oci_bind_by_name($total_stmt, ":search", $search);
}
oci_execute($total_stmt);
$total_row = oci_fetch_assoc($total_stmt);
$total_pages = ceil($total_row['TOTAL'] / $limit);
if ($total_pages <= 0) {
    $total_pages = 1;
}

// 게시글 배열 생성
$posts = [];
while ($row = oci_fetch_assoc($write_stmt)) {
    $posts[] = $row;
}

oci_free_statement($write_stmt);
oci_free_statement($total_stmt);
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
        .pagination { text-align: center; margin: 20px 0; }
        .pagination a { text-decoration: none; padding: 10px 15px; margin: 0 5px; background-color: #f7f7f7; color: #333; border: 1px solid #ddd; border-radius: 5px; }
        .pagination a.active { background-color: orange; color: white; border-color: orange; }
        .pagination a:hover { background-color: #ddd; }
        .write-btn { display: block; width: 100px; margin: 20px auto; text-align: center; padding: 10px 15px; background-color: orange; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .write-btn:hover { background-color: darkorange; }
        .search-container {
            text-align: center;
            margin: 20px 0;
        }
        .search-container input[type="text"] {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search-container button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            background-color: orange;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>자유게시판</h1>
    </div>

    <div class="search-container">
        <form action="board.php" method="get">
            <input type="text" name="search" placeholder="제목 검색" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">검색</button>
        </form>
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
                            <td><a href='board_write.php?write_id={$post['WRITE_ID']}'>" . htmlspecialchars($post['CONTENT_NAME']) . "</a></td>
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

    <div class="pagination">
        <?php
        // 이전 페이지
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "'>이전</a>";
        }

        // 페이지 번호
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $page) ? "class='active'" : "";
            echo "<a href='?page=$i&search=" . urlencode($search) . "' $class>$i</a>";
        }

        // 다음 페이지
        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "'>다음</a>";
        }
        ?>
    </div>
</body>
</html>
