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

// 홍보게시판의 POST_ID
$post_id = "2";

// 페이지 번호와 페이징 설정
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 10;
$start_row = ($page - 1) * $limit + 1; // 시작 ROW 계산 (1부터 시작)
$end_row = $page * $limit; // 끝 ROW 계산

// 게시판 정보 가져오기
$post_sql = "SELECT POST_NAME FROM POST WHERE POST_ID = :post_id";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":post_id", $post_id);
oci_execute($post_stmt);
$post_info = oci_fetch_assoc($post_stmt);

if (!$post_info) {
    die("해당 게시판이 존재하지 않습니다.");
}

// 게시글 가져오기 (번호는 001부터 시작, 오래된 게시물 기준으로 부여)
$write_sql = "
    SELECT *
    FROM (
        SELECT ROWNUM AS NUM,
               WRITE_ID, CONTENT_NAME, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
        FROM (
            SELECT WRITE_ID, CONTENT_NAME, USER_ID, CREATED_AT
            FROM WRITE
            WHERE POST_ID = :post_id
            ORDER BY CREATED_AT ASC -- 오래된 순으로 정렬
        ) WHERE ROWNUM <= :end_row
    ) WHERE NUM >= :start_row
    ORDER BY NUM DESC -- 최신 게시물이 위로 정렬되도록
";
$write_stmt = oci_parse($conn, $write_sql);
oci_bind_by_name($write_stmt, ":post_id", $post_id);
oci_execute($write_stmt);

// 전체 게시글 수 가져오기
$total_sql = "SELECT COUNT(*) AS total FROM WRITE WHERE POST_ID = :post_id";
$total_stmt = oci_parse($conn, $total_sql);
oci_bind_by_name($total_stmt, ":post_id", $post_id);
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

oci_free_statement($post_stmt);
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
    <title>홍보게시판</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h1>홍보게시판</h1>
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
                    // 번호 001부터 순서대로 출력
                    $number = $start_row;
                    foreach ($posts as $post) {
                        echo "<tr>
                            <td>" . str_pad($number++, 3, '0', STR_PAD_LEFT) . "</td>
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
        <a class="write-btn" href="promotion.php">글쓰기</a>
    </div>

    <div class="pagination">
        <?php
        // 이전 페이지
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "'>이전</a>";
        }

        // 페이지 번호
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $page) ? "class='active'" : "";
            echo "<a href='?page=$i' $class>$i</a>";
        }

        // 다음 페이지
        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page + 1) . "'>다음</a>";
        }
        ?>
    </div>
</body>
</html>
