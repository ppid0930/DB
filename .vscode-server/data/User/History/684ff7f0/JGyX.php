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
        /* 스타일은 생략, 기존 스타일 활용 */
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
