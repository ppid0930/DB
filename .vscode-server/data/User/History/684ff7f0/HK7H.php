<?php
session_start();

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host,'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}
/*
// GET 파라미터로 전달된 post_id 가져오기
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : null;


if (!$post_id) {
    echo "<script>alert('post_id 값이 전달되지 않았습니다. 메인 페이지로 이동합니다.');</script>";
    header("Location: mainpage.php");
    exit;
}*/

/*
// 게시판 정보 가져오기
$post_sql = "SELECT POST_NAME FROM POST WHERE POST_ID = :post_id";
$post_stmt = oci_parse($conn, $post_sql);
oci_bind_by_name($post_stmt, ":post_id", $post_id);
oci_execute($post_stmt);
$post_info = oci_fetch_assoc($post_stmt);

if (!$post_info) {
    die("해당 게시판이 존재하지 않습니다.");
}

// 게시글 가져오기
$write_sql = "SELECT WRITE_ID, CONTENT_NAME, USER_ID, TO_CHAR(CREATED_AT, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_AT
              FROM WRITE
              WHERE POST_ID = :post_id
              ORDER BY WRITE_ID DESC
              OFFSET :start_row ROWS FETCH NEXT :limit ROWS ONLY";;
$write_stmt = oci_parse($conn, $write_sql);
oci_bind_by_name($write_stmt, ":post_id", $post_id);
oci_bind_by_name($write_stmt, ":start_row", $start_row);
oci_bind_by_name($write_stmt, ":limit", $limit);
oci_execute($write_stmt);
*/
/*
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
    <title><?php echo htmlspecialchars($post['content_name']); ?></title>
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
    <?php include "navbar.php" ?>
    <div class="container">
        <!-- 게시글 영역 -->
        <h1>자유게시판</h1>
        <div class="post-section">
            <!-- 게시글 메타 정보 -->
            <div class="post-meta">
                <!-- 데이터베이스 관련 부분 주석 처리 -->
                <!--
                <span>작성자: <?php //echo htmlspecialchars($post['post_id']); ?></span> |
                <span><?php //echo $post['created_at']; ?></span> |
                <span>조회수: <?php //echo $post['views']; ?></span>
                -->
                
                <!-- 직접 작성한 내용 -->
                <span>작성자: 홍길동</span> | 
                <span>작성일: 2024-11-23</span> | 
                <span>조회수: 123</span>
            </div>
            
            <!-- 게시글 본문 -->
            <div class="post-content">
                <!-- 데이터베이스 관련 부분 주석 처리 -->
                <!-- <?php //echo nl2br(htmlspecialchars($post['content'])); ?> -->
                
                <!-- 직접 작성한 내용 -->
                <p>
                    안녕하세요. 오늘은 PHP 게시판 디자인 테스트 중입니다.<br>
                    데이터베이스 없이 내용을 직접 작성해 UI를 확인하고 있습니다.
                </p>
                
                <!-- 데이터베이스에서 이미지 URL 불러오는 부분 주석 처리 -->
                <!-- <?php //if (!empty($post['image'])): ?> -->
                <!-- <img src="<?php //echo htmlspecialchars($post['image']); ?>" alt="첨부 이미지" class="post-image"> -->
                <!-- <?php //endif; ?> -->
                
                <!-- 직접 삽입한 이미지 -->
                <img src="img/롤/롤 대회.png" alt="테스트 이미지" class="post-image">
            </div>
        </div>

        <!-- 댓글 영역 -->
        <div class="comment-section">
            <!-- 데이터베이스 관련 부분 주석 처리 -->
            <!-- <h2>댓글 <?php //echo $comments_result->num_rows; ?></h2> -->
            
            <!-- 직접 작성한 댓글 개수 -->
            <h2>댓글 2</h2>

            <!-- 데이터베이스에서 댓글 불러오는 부분 주석 처리 -->
            <!-- <?php //while ($comment = $comments_result->fetch_assoc()) { ?> -->
            <!-- <div class="comment">
                <p><?php //echo htmlspecialchars($comment['content']); ?></p>
            </div>
            <?php //} ?> -->

            <!-- 직접 작성한 댓글 -->
            <div class="comment">
                <p>첫 번째 댓글입니다. 디자인 테스트 중이에요!</p>
            </div>
            <div class="comment">
                <p>두 번째 댓글입니다. 정말 잘 만들어졌네요 :)</p>
            </div>

            <!-- 댓글 입력 -->
            <div class="comment-input">
                <form method="post" action="">
                    <textarea name="comment" placeholder="댓글을 입력해주세요." required></textarea>
                    <button type="submit">등록</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "Donate.php"?>
</body>
</html>
<?php //$conn->close(); ?>
