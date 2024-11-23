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

// 예제 사용자 ID (로그인된 사용자)
$_SESSION['user_id'] = 'user123'; // 실제 로그인 시스템에서는 세션으로 설정됩니다.

// 게시글 ID와 댓글 ID (예제용)
$post_id = 1; // 특정 게시글 ID
$logged_in_user = $_SESSION['user_id']; // 현재 로그인한 사용자 ID

// 댓글 삭제 처리
if (isset($_GET['delete_comment_id'])) {
    $comment_id = $_GET['delete_comment_id'];
    $delete_sql = "DELETE FROM comments WHERE comment_id = :comment_id AND user_id = :user_id";
    $stmt = oci_parse($conn, $delete_sql);
    oci_bind_by_name($stmt, ":comment_id", $comment_id);
    oci_bind_by_name($stmt, ":user_id", $logged_in_user);
    oci_execute($stmt);
    header("Location: post.php");
    exit;
}

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment_text = $_POST['comment'];
    $insert_sql = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
    $stmt = oci_parse($conn, $insert_sql);
    oci_bind_by_name($stmt, ":post_id", $post_id);
    oci_bind_by_name($stmt, ":user_id", $logged_in_user);
    oci_bind_by_name($stmt, ":content", $comment_text);
    oci_execute($stmt);
    header("Location: post.php");
    exit;
}

// 댓글 조회
$comments_sql = "SELECT comment_id, content, user_id, TO_CHAR(created_at, 'YYYY-MM-DD HH24:MI') AS created_at 
                 FROM comments WHERE post_id = :post_id ORDER BY created_at ASC";
$stmt = oci_parse($conn, $comments_sql);
oci_bind_by_name($stmt, ":post_id", $post_id);
oci_execute($stmt);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유게시판</title>
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

        .post-image {
            max-width: 100%;
            margin-top: 15px;
            border-radius: 5px;
        }

        /* 댓글 섹션 */
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

        .comment .actions {
            display: flex;
            gap: 5px;
        }

        .comment .actions button {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .comment .actions .edit {
            background-color: #ffc107;
            color: #fff;
        }

        .comment .actions .delete {
            background-color: #dc3545;
            color: #fff;
        }

        .comment-input {
            margin-top: 20px;
            position: relative; /* 부모 요소를 기준으로 자식 요소 위치 조정 */
        }

        .comment-input textarea {
            width: 100%; /* 입력창이 부모 컨테이너의 전체 너비를 차지 */
            height: 100px; /* 입력창 높이 */
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        .comment-input button {
            position: absolute; /* 부모 요소를 기준으로 위치 지정 */
            bottom: 10px; /* 부모 요소의 하단에서 10px 위로 */
            right: 10px; /* 부모 요소의 오른쪽에서 10px 왼쪽으로 */
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
    <?php include "navbar.php" ?>
    <div class="container">
        <!-- 게시글 영역 -->
        <h1>자유게시판</h1>
        <div class="post-section">
            <div class="post-meta">
                <span>작성자: 홍길동</span> | 
                <span>작성일: 2024-11-23</span> | 
                <span>조회수: 123</span>
            </div>
            <div class="post-content">
                <p>안녕하세요. 게시판 댓글 수정/삭제 테스트입니다.</p>
                <img src="img/롤/롤 대진표.png" alt="테스트 이미지" class="post-image">
            </div>
        </div>

        <!-- 댓글 영역 -->
        <div class="comment-section">
            <h2>댓글</h2>
            <?php while ($row = oci_fetch_assoc($stmt)) { ?>
                <div class="comment">
                    <div class="content">
                        <strong><?php echo htmlspecialchars($row['user_id']); ?></strong>
                        (<?php echo $row['created_at']; ?>)<br>
                        <?php echo htmlspecialchars($row['content']); ?>
                    </div>
                    <?php if ($row['user_id'] === $logged_in_user) { ?>
                    <div class="actions">
                        <a href="edit_comment.php?comment_id=<?php echo $row['comment_id']; ?>" class="edit">수정</a>
                        <a href="?delete_comment_id=<?php echo $row['comment_id']; ?>" class="delete">삭제</a>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <!-- 댓글 입력 -->
            <div class="comment-input">
                <form method="post" action="">
                    <textarea name="comment" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">등록</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "Donate.php" ?>
</body>
</html>
