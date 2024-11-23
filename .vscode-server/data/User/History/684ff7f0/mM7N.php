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

// GET으로 전달된 WRITE_ID 확인
$write_id = isset($_GET['write_id']) ? $_GET['write_id'] : null;

if (!$write_id) {
    echo "<script>
        alert('잘못된 접근입니다.');
        window.location.href = 'board.php';
    </script>";
    exit;
}

// 게시글 정보 가져오기
$post_sql = "
    SELECT CONTENT_NAME, CONTENT, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
    FROM WRITE WHERE WRITE_ID = :write_id
";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":write_id", $write_id);
oci_execute($post_stmt);
$post_info = oci_fetch_assoc($post_stmt);

if (!$post_info) {
    echo "<script>
        alert('존재하지 않는 게시글입니다.');
        window.location.href = 'board.php';
    </script>";
    exit;
}

// 댓글 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment_content = trim($_POST['comment']);
    $user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

    // COMMENT_ID 생성 (시퀀스 또는 증가값)
    $get_comment_id_sql = "SELECT NVL(MAX(TO_NUMBER(COMMENT_ID)), 0) + 1 AS NEXT_ID FROM COMMENT_T";
    $comment_id_stmt = oci_parse($conn, $get_comment_id_sql);
    oci_execute($comment_id_stmt);
    $comment_row = oci_fetch_assoc($comment_id_stmt);
    $next_comment_id = str_pad($comment_row['NEXT_ID'], 3, '0', STR_PAD_LEFT);

    // 댓글 삽입
    $insert_comment_sql = "
        INSERT INTO COMMENT_T (COMMENT_ID, WRITE_ID, USER_ID, COMMENT_CONTENT)
        VALUES (:comment_id, :write_id, :user_id, :comment_content)
    ";
    $comment_stmt = oci_parse($conn, $insert_comment_sql);
    oci_bind_by_name($comment_stmt, ":comment_id", $next_comment_id);
    oci_bind_by_name($comment_stmt, ":write_id", $write_id);
    oci_bind_by_name($comment_stmt, ":user_id", $user_id);
    oci_bind_by_name($comment_stmt, ":comment_content", $comment_content);

    if (oci_execute($comment_stmt)) {
        echo "<script>
            alert('댓글이 작성되었습니다.');
            window.location.href = 'board_write.php?write_id=$write_id';
        </script>";
    } else {
        $error = oci_error($comment_stmt);
        echo "<script>
            alert('댓글 작성 실패: " . htmlspecialchars($error['message']) . "');
        </script>";
    }
}

// 댓글 조회
$comments_sql = "
    SELECT COMMENT_ID, USER_ID, COMMENT_CONTENT, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
    FROM COMMENT_T WHERE WRITE_ID = :write_id
    ORDER BY CREATED_AT ASC
";
$comments_stmt = oci_parse($conn, $comments_sql);
oci_bind_by_name($comments_stmt, ":write_id", $write_id);
oci_execute($comments_stmt);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post_info['CONTENT_NAME']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; }
        h1 { text-align: center; }
        .post-content { margin-bottom: 20px; }
        .comments { margin-top: 30px; }
        .comment { border-top: 1px solid #ddd; padding: 10px 0; }
        .comment strong { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($post_info['CONTENT_NAME']); ?></h1>
        <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($post_info['CONTENT'])); ?></p>
            <small>작성자: <?php echo htmlspecialchars($post_info['USER_ID']); ?> | 작성일: <?php echo $post_info['CREATED_AT']; ?></small>
        </div>
        <hr>
        <div class="comments">
            <h2>댓글</h2>
            <?php while ($comment = oci_fetch_assoc($comments_stmt)) { ?>
                <div class="comment">
                    <strong><?php echo htmlspecialchars($comment['USER_ID']); ?></strong>
                    (<?php echo $comment['CREATED_AT']; ?>)
                    <p><?php echo htmlspecialchars($comment['COMMENT_CONTENT']); ?></p>
                </div>
            <?php } ?>
            <form method="post" action="">
                <textarea name="comment" rows="4" placeholder="댓글을 작성하세요." required></textarea>
                <button type="submit">댓글 작성</button>
            </form>
        </div>
    </div>
</body>
</html>
