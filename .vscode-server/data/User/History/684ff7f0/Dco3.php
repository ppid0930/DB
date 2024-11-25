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

// 게시글 ID 가져오기
if (!isset($_GET['write_id'])) {
    die("잘못된 접근입니다.");
}
$write_id = $_GET['write_id'];

// 게시글 정보 가져오기
$post_sql = "SELECT CONTENT_NAME, CONTENT, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT 
             FROM WRITE WHERE WRITE_ID = :write_id";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":write_id", $write_id);
oci_execute($post_stmt);
$post = oci_fetch_assoc($post_stmt);

if (!$post) {
    die("게시글을 찾을 수 없습니다.");
}

// 댓글 가져오기
$comments_sql = "SELECT COMMENT_ID, USER_ID, COMMENT_CONTENT, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI') AS CREATED_AT 
                 FROM COMMENT_T WHERE WRITE_ID = :write_id ORDER BY CREATED_AT ASC";
$comments_stmt = oci_parse($conn, $comments_sql);
oci_bind_by_name($comments_stmt, ":write_id", $write_id);
oci_execute($comments_stmt);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 보기</title>
    <style>
        /* 기존 디자인 유지 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .post-section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f7f7f7;
        }
        .post-meta {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }
        .post-content {
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }
        .post-image {
            max-width: 100%;
            margin-top: 15px;
            border-radius: 5px;
        }
        .comment-section {
            margin-top: 20px;
            padding: 20px;
            border-top: 2px solid #333;
        }
        .comment-section h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }
        .comment {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .comment .content {
            font-size: 14px;
            color: #555;
        }
        .comment-input {
            margin-top: 20px;
        }
        .comment-input textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
            margin-bottom: 10px;
        }
        .comment-input button {
            float: right;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .comment-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <!-- 게시글 내용 -->
        <h1><?php echo htmlspecialchars($post['CONTENT_NAME']); ?></h1>
        <p><strong>작성자:</strong> <?php echo htmlspecialchars($post['USER_ID']); ?> | 
           <strong>작성일:</strong> <?php echo htmlspecialchars($post['CREATED_AT']); ?></p>
        <div><?php echo nl2br(htmlspecialchars($post['CONTENT'])); ?></div>

        <!-- 댓글 섹션 -->
        <div class="comment-section">
            <h2>댓글</h2>
            <?php while ($row = oci_fetch_assoc($comments_stmt)) { ?>
                <div class="comment">
                    <div class="content">
                        <strong><?php echo htmlspecialchars($row['USER_ID']); ?></strong>
                        (<?php echo $row['CREATED_AT']; ?>)<br>
                        <?php echo htmlspecialchars($row['COMMENT_CONTENT']); ?>
                    </div>
                </div>
            <?php } ?>

            <!-- 댓글 입력 -->
            <div class="comment-input">
                <form action="add_comment.php" method="post">
                    <input type="hidden" name="write_id" value="<?php echo $write_id; ?>">
                    <textarea name="comment_content" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">댓글 작성</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
oci_free_statement($post_stmt);
oci_free_statement($comments_stmt);
oci_close($conn);
?>
