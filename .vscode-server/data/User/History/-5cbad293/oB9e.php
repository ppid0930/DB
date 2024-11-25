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
             FROM WRITE WHERE WRITE_ID = :write_id AND POST_ID = 2";
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
    <title>홍보 게시글 보기</title>
    <style>
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
            border-bottom: 2px solid #333;
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
            font-size: 16px;
            color: #888;
            margin-bottom: 30px;
        }
        .post-content {
            font-size: 18px;
            color: #333;
            line-height: 1.8;
            word-break: break-word;
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
        .comment .edit-btn, .comment .delete-btn {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .comment .edit-btn {
            background-color: #ffc107;
            color: #fff;
            margin-right: 5px;
        }
        .comment .edit-btn:hover {
            background-color: #e0a800;
        }
        .comment .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .comment .delete-btn:hover {
            background-color: #c82333;
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
        <h1><?php echo htmlspecialchars($post['CONTENT_NAME']); ?></h1>
        <p class="post-meta">
            <strong>작성자:</strong> <?php echo htmlspecialchars($post['USER_ID']); ?> | 
            <strong>작성일:</strong> <?php echo htmlspecialchars($post['CREATED_AT']); ?>
        </p>

        <div class="post-section">
            <p class="post-content"><?php echo nl2br(htmlspecialchars($post['CONTENT'])); ?></p>
        </div>

        <div class="comment-section">
            <h2>댓글</h2>
            <?php while ($row = oci_fetch_assoc($comments_stmt)) { ?>
                <div class="comment" id="comment-<?php echo $row['COMMENT_ID']; ?>">
                    <div class="content" id="comment-content-<?php echo $row['COMMENT_ID']; ?>">
                        <strong><?php echo htmlspecialchars($row['USER_ID']); ?></strong>
                        (<?php echo $row['CREATED_AT']; ?>)<br>
                        <?php echo htmlspecialchars($row['COMMENT_CONTENT']); ?>
                    </div>
                    <div>
                        <?php if ($row['USER_ID'] === $_SESSION['user_id']) { ?>
                            <button class="edit-btn" onclick="enableEdit(<?php echo $row['COMMENT_ID']; ?>)">수정</button>
                            <button class="delete-btn" onclick="deleteComment(<?php echo $row['COMMENT_ID']; ?>, <?php echo $write_id; ?>)">삭제</button>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="comment-input">
                <form action="add_comment.php" method="post">
                    <input type="hidden" name="write_id" value="<?php echo $write_id; ?>">
                    <textarea name="comment_content" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">댓글 작성</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function enableEdit(commentId) {
        const contentDiv = document.getElementById(`comment-content-${commentId}`);
        const originalContent = contentDiv.textContent.trim();

        contentDiv.innerHTML = `
            <textarea id="edit-comment-${commentId}" style="width: 100%; height: 50px;">${originalContent}</textarea>
            <button onclick="updateComment(${commentId})">저장</button>
            <button onclick="cancelEdit(${commentId}, '${originalContent}')">취소</button>
        `;
    }

    function cancelEdit(commentId, originalContent) {
        const contentDiv = document.getElementById(`comment-content-${commentId}`);
        contentDiv.innerHTML = originalContent;
    }

    function updateComment(commentId) {
        const newContent = document.getElementById(`edit-comment-${commentId}`).value.trim();

        if (newContent === "") {
            alert("댓글 내용을 입력해주세요.");
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "promotion_update_comment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const contentDiv = document.getElementById(`comment-content-${commentId}`);
                    contentDiv.innerHTML = newContent;
                } else {
                    alert("댓글 수정 실패: " + response.error);
                }
            }
        };
        xhr.send(`comment_id=${commentId}&new_content=${encodeURIComponent(newContent)}`);
    }

    function deleteComment(commentId, writeId) {
        if (!confirm("댓글을 삭제하시겠습니까?")) return;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "promotion_delete_comment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById(`comment-${commentId}`).remove();
                } else {
                    alert("댓글 삭제 실패: " + response.error);
                }
            }
        };
        xhr.send(`comment_id=${commentId}&write_id=${writeId}`);
    }
    </script>
</body>
</html>
