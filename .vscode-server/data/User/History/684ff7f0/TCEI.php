<?php
/*// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "community";

$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 게시글 ID 받아오기 (GET 방식)
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// 게시글 가져오기
$post_sql = "SELECT * FROM posts WHERE id = $post_id";
$post_result = $conn->query($post_sql);
$post = $post_result->fetch_assoc();

// 댓글 가져오기
$comments_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
$comments_result = $conn->query($comments_sql);

// 댓글 저장
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_text = $_POST['comment'];
    if (!empty($comment_text)) {
        $insert_sql = "INSERT INTO comments (post_id, content) VALUES ($post_id, '$comment_text')";
        $conn->query($insert_sql);
        header("Location: post.php?id=$post_id");
        exit;
    }
}*/
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* 전체 컨테이너 */
        .board-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* 게시글 영역 */
        .post-details {
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .category {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 10px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .post-meta {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
        }

        .post-link a {
            color: #007bff;
            text-decoration: none;
        }

        .post-link a:hover {
            text-decoration: underline;
        }

        .post-content {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .post-image {
            max-width: 100%;
            border-radius: 4px;
            margin-top: 10px;
        }

        /* 하단 버튼 */
        .post-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .post-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .post-actions button:hover {
            background-color: #e0e0e0;
        }

        /* 댓글 영역 */
        .comment-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .comment-section h2 {
            margin: 0 0 20px;
            font-size: 20px;
            color: #333;
        }

        .comment {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .comment-input {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .comment-input textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
        }

        .comment-input button {
            align-self: flex-end;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .comment-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="board-container">
        <h1>자유게시판</h1>
        <div class="post-details">
            <div class="post-header">
                <div class="category">일반</div>
                <div class="title"><?php echo htmlspecialchars($post['title']); ?></div>
            </div>
            <div class="post-meta">
                <span>주식공</span>
                <span><?php echo $post['created_at']; ?></span>
                <span>조회수 <?php echo $post['views']; ?></span>
            </div>
            <div class="post-link">
                <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank"><?php echo htmlspecialchars($post['link']); ?></a></p>
            </div>
            <div class="post-content">
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <img src="example.jpg" alt="이미지" class="post-image">
            </div>
        </div>
        <div class="post-actions">
            <button onclick="window.location.href='list.php'">목록</button>
            <button>스크랩</button>
            <button onclick="window.location.href='write.php'">글쓰기</button>
        </div>
    </div>

    <div class="comment-section">
        <h2>댓글 <?php echo $comments_result->num_rows; ?></h2>
        <?php while ($comment = $comments_result->fetch_assoc()) { ?>
        <div class="comment">
            <p><?php echo htmlspecialchars($comment['content']); ?></p>
        </div>
        <?php } ?>
        <div class="comment-input">
            <form method="post" action="">
                <textarea name="comment" placeholder="댓글을 입력해주세요." required></textarea>
                <button type="submit">등록</button>
            </form>
        </div>
    </div>
</body>
</html>
/*
<?php
// $conn->close();
?>
