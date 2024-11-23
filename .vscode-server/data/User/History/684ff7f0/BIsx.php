<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* 게시글 영역 스타일 */
        .post-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .post-header p {
            margin: 10px 0 20px;
            color: #888;
            font-size: 14px;
        }

        .post-content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .post-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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

        /* 댓글 영역 스타일 */
        .comment-section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
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

        .comment-user {
            font-weight: bold;
            color: #333;
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
    <?php include 'navbar.php'; ?>
    <!-- 게시글 영역 -->
    <div class="post-container">
        <div class="post-header">
            <h1>팀원구해요</h1>
            <p>조회수 32 · 2024.09.11 20:49:55</p>
        </div>
        <div class="post-content">
            <p>같이 안양 모던피씨방 대회 나가실 일턴분이나 미드분 구해요</p>
        </div>
        <div class="post-actions">
            <button>목록</button>
            <button>스크랩</button>
            <button>글쓰기</button>
        </div>
    </div>

    <!-- 댓글 영역 -->
    <div class="comment-section">
        <h2>댓글</h2>
        <div class="comment">
            <p class="comment-user">동꾸땁꾸</p>
            <p>cc</p>
        </div>
        <div class="comment-input">
            <textarea placeholder="댓글을 입력해주세요."></textarea>
            <button>등록</button>
        </div>
    </div>
    <?php include 'Donate.php'; ?>
</body>
</html>
