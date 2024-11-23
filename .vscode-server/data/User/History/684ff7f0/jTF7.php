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

// GET으로 전달된 write_id 확인
if (!isset($_GET['write_id'])) {
    die("유효한 게시글 ID가 전달되지 않았습니다.");
}
$write_id = $_GET['write_id'];

// 게시글 정보 가져오기
$post_sql = "SELECT CONTENT_NAME, CONTENT, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
             FROM WRITE
             WHERE WRITE_ID = :write_id";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":write_id", $write_id);
oci_execute($post_stmt);

$post = oci_fetch_assoc($post_stmt);
if (!$post) {
    die("해당 게시글을 찾을 수 없습니다.");
}

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment_text = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];

    if (empty($comment_text)) {
        echo "<script>alert('댓글 내용을 입력해주세요.'); history.back();</script>";
        exit;
    }

    // 댓글 삽입
    $comment_sql = "INSERT INTO COMMENTS (COMMENT_ID, WRITE_ID, USER_ID, CONTENT, CREATED_AT)
                    VALUES (COMMENTS_SEQ.NEXTVAL, :write_id, :user_id, :content, SYSDATE)";
    $comment_stmt = oci_parse($conn, $comment_sql);
    oci_bind_by_name($comment_stmt, ":write_id", $write_id);
    oci_bind_by_name($comment_stmt, ":user_id", $user_id);
    oci_bind_by_name($comment_stmt, ":content", $comment_text);

    if (oci_execute($comment_stmt)) {
        echo "<script>alert('댓글이 등록되었습니다.'); location.href='board_write.php?write_id={$write_id}';</script>";
    } else {
        $error = oci_error($comment_stmt);
        echo "<script>alert('댓글 작성 실패: {$error['message']}'); history.back();</script>";
    }
    exit;
}

// 댓글 삭제 처리
if (isset($_GET['delete_comment_id'])) {
    $comment_id = $_GET['delete_comment_id'];
    $user_id = $_SESSION['user_id'];

    $delete_sql = "DELETE FROM COMMENTS WHERE COMMENT_ID = :comment_id AND USER_ID = :user_id";
    $delete_stmt = oci_parse($conn, $delete_sql);
    oci_bind_by_name($delete_stmt, ":comment_id", $comment_id);
    oci_bind_by_name($delete_stmt, ":user_id", $user_id);

    if (oci_execute($delete_stmt)) {
        echo "<script>alert('댓글이 삭제되었습니다.'); location.href='board_write.php?write_id={$write_id}';</script>";
    } else {
        $error = oci_error($delete_stmt);
        echo "<script>alert('댓글 삭제 실패: {$error['message']}'); history.back();</script>";
    }
    exit;
}

// 댓글 조회
$comments_sql = "SELECT COMMENT_ID, USER_ID, CONTENT, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
                 FROM COMMENTS
                 WHERE WRITE_ID = :write_id
                 ORDER BY CREATED_AT ASC";
$comments_stmt = oci_parse($conn, $comments_sql);
oci_bind_by_name($comments_stmt, ":write_id", $write_id);
oci_execute($comments_stmt);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['CONTENT_NAME']); ?></title>
    <style>
        /* 게시글 스타일 */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .container { max-width: 800px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; }
        .post-title { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .post-meta { color: #888; font-size: 14px; margin-bottom: 20px; }
        .post-content { line-height: 1.6; font-size: 16px; }
        .comments { margin-top: 40px; }
        .comments h2 { font-size: 20px; margin-bottom: 20px; }
        .comment { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .comment .meta { color: #666; font-size: 12px; margin-bottom: 5px; }
        .comment-form textarea { width: 100%; padding: 10px; margin-top: 10px; font-size: 14px; }
        .comment-form button { padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <div class="post-title"><?php echo htmlspecialchars($post['CONTENT_NAME']); ?></div>
        <div class="post-meta">
            작성자: <?php echo htmlspecialchars($post['USER_ID']); ?> | 작성일: <?php echo $post['CREATED_AT']; ?>
        </div>
        <div class="post-content"><?php echo nl2br(htmlspecialchars($post['CONTENT'])); ?></div>
        <div class="comments">
            <h2>댓글</h2>
            <?php while ($comment = oci_fetch_assoc($comments_stmt)) { ?>
                <div class="comment">
                    <div class="meta"><?php echo htmlspecialchars($comment['USER_ID']); ?> | <?php echo $comment['CREATED_AT']; ?></div>
                    <div class="text"><?php echo nl2br(htmlspecialchars($comment['CONTENT'])); ?></div>
                    <?php if ($comment['USER_ID'] === $_SESSION['user_id']) { ?>
                        <a href="?write_id=<?php echo $write_id; ?>&delete_comment_id=<?php echo $comment['COMMENT_ID']; ?>">삭제</a>
                    <?php } ?>
                </div>
            <?php } ?>
            <form method="post" class="comment-form">
                <textarea name="comment" placeholder="댓글을 입력하세요." required></textarea>
                <button type="submit">댓글 작성</button>
            </form>
        </div>
    </div>
</body>
</html>
