<?php
session_start();

// Oracle 데이터베이스 연결 설정
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// 게시글 ID 받아오기
if (!isset($_GET['write_id'])) {
    die("게시글 ID가 전달되지 않았습니다.");
}
$write_id = $_GET['write_id'];

// 조회수 업데이트
$update_views_sql = "UPDATE WRITE SET VIEWS = NVL(VIEWS, 0) + 1 WHERE WRITE_ID = :write_id";
$update_stmt = oci_parse($conn, $update_views_sql);
oci_bind_by_name($update_stmt, ":write_id", $write_id);
oci_execute($update_stmt);

// 게시글 상세 정보 가져오기
$post_sql = "SELECT CONTENT_NAME, CONTENT, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT, NVL(VIEWS, 0) AS VIEWS 
             FROM WRITE WHERE WRITE_ID = :write_id";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":write_id", $write_id);
oci_execute($post_stmt);

$post = oci_fetch_assoc($post_stmt);
if (!$post) {
    die("게시글을 찾을 수 없습니다.");
}

// 댓글 조회
$comments_sql = "SELECT comment_id, content, user_id, TO_CHAR(created_at, 'YYYY-MM-DD HH24:MI') AS created_at 
                 FROM COMMENT_T WHERE WRITE_ID = :write_id ORDER BY created_at ASC";
$comments_stmt = oci_parse($conn, $comments_sql);
oci_bind_by_name($comments_stmt, ":write_id", $write_id);
oci_execute($comments_stmt);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세</title>
    <style>
        /* 기본 스타일 */
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
        .comment-input textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }
        .comment-input button {
            margin-top: 10px;
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
    <div class="container">
        <!-- 게시글 영역 -->
        <h1><?php echo htmlspecialchars($post['CONTENT_NAME']); ?></h1>
        <div class="post-section">
            <div class="post-meta">
                <span>작성자: <?php echo htmlspecialchars($post['USER_ID']); ?></span> |
                <span>작성일: <?php echo $post['CREATED_AT']; ?></span> |
                <span>조회수: <?php echo $post['VIEWS']; ?></span>
            </div>
            <div class="post-content">
                <?php echo nl2br(htmlspecialchars($post['CONTENT'])); ?>
            </div>
        </div>

        <!-- 댓글 영역 -->
        <div class="comment-section">
            <h2>댓글</h2>
            <?php while ($comment = oci_fetch_assoc($comments_stmt)) { ?>
                <div class="comment">
                    <div class="content">
                        <strong><?php echo htmlspecialchars($comment['USER_ID']); ?></strong>
                        (<?php echo $comment['CREATED_AT']; ?>)<br>
                        <?php echo htmlspecialchars($comment['CONTENT']); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="comment-input">
                <form method="post" action="">
                    <textarea name="comment" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">댓글 등록</button>
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
