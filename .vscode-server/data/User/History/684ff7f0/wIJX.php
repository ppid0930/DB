<?php
/*session_start();

// Oracle 데이터베이스 연결 설정
$host = "203.249.87.57/orcl";  // Oracle DB 주소 (호스트/서비스명)
$user = "DB502_PROJ_G2";       // 사용자 이름
$password = "6969";            // 비밀번호

// Oracle DB 연결
$conn = oci_connect($user, $password, $host);

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// GET 방식으로 게시글 ID 받아오기
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// 게시글 데이터 조회
$post_sql = "SELECT * FROM posts WHERE id = $post_id";
$post_result = $conn->query($post_sql);
$post = $post_result->fetch_assoc();

// 댓글 데이터 조회
$comments_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at ASC";
$comments_result = $conn->query($comments_sql);

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_text = $_POST['comment']; // 입력된 댓글 내용 가져오기
    if (!empty($comment_text)) {
        $insert_sql = "INSERT INTO comments (post_id, content) VALUES ($post_id, '$comment_text')";
        $conn->query($insert_sql);
        header("Location: post.php?id=$post_id"); // 댓글 등록 후 페이지 새로고침
        exit;
    }
}*/
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php //echo htmlspecialchars($post['title']); ?></title>
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* 전체 컨테이너 */
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

        /* 게시글 영역 */
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

        /* 댓글 영역 */
        .comment-section {
            margin-top: 20px;
            padding: 20px;
            border-top: 2px solid #007bff;
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

        .comment p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        /* 댓글 입력 영역 */
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
    <div class="container">
        <!-- 게시글 영역 -->
        <h1>자유게시판</h1>
        <div class="post-section">
            <div class="post-meta">
                <span>작성자: <?php //echo htmlspecialchars($post['author']); ?></span> |
                <span><?php //echo $post['created_at']; ?></span> |
                <span>조회수: <?php //echo $post['views']; ?></span>
            </div>
            <div class="post-content">
                <?php // echo nl2br(htmlspecialchars($post['content'])); ?>
                <?php //if (!empty($post['image'])): ?>
                <img src="<?php //echo htmlspecialchars($post['image']); ?>" alt="첨부 이미지" class="post-image">
                <?php // endif; ?>
            </div>
        </div>

        <!-- 댓글 영역 -->
        <div class="comment-section">
            <h2>댓글 <?php //echo $comments_result->num_rows; ?></h2>
            <?php // while ($comment = $comments_result->fetch_assoc()) { ?>
                <div class="comment">
                    <p><?php //echo htmlspecialchars($comment['content']); ?></p>
                </div>
            <?php  ?>

            <!-- 댓글 입력 -->
            <div class="comment-input">
                <form method="post" action="">
                    <textarea name="comment" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">등록</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php //$conn->close(); ?>
