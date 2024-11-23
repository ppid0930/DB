<?php
session_start();

// 로그인 확인 (로그인 필요 시 리다이렉트)
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>커뮤니티 글쓰기</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            box-sizing: border-box;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 200px;
            resize: vertical;
        }

        button {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        button:hover {
            background-color: #0056b3;
        }

        .toolbar {
            margin-bottom: 10px;
            display: flex;
            gap: 10px;
        }

        .toolbar button {
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .toolbar button:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <div class="container">
        <h1>자유게시판 글쓰기</h1>
        <form action="write_process.php" method="post">
            <!-- 제목 -->
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" placeholder="제목을 입력하세요." required>

            <!-- 내용 -->
            <div class="form-group">
                <label for="content">내용</label>
                <div class="toolbar">
                    <button type="button" onclick="formatText('bold')"><b>굵게</b></button>
                    <button type="button" onclick="formatText('italic')"><i>기울임</i></button>
                    <button type="button" onclick="formatText('underline')"><u>밑줄</u></button>
                </div>
                <textarea id="content" name="content" placeholder="내용을 입력하세요." required></textarea>
            </div>

            <!-- 제출 버튼 -->
            <button type="submit">작성 완료</button>
        </form>
    </div>

    <script>
        // 텍스트 포맷팅 함수
        function formatText(command) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);

            if (!selectedText) {
                alert("텍스트를 선택하세요!");
                return;
            }

            let formattedText = '';
            switch (command) {
                case 'bold':
                    formattedText = `**${selectedText}**`; // Markdown 스타일로 굵게
                    break;
                case 'italic':
                    formattedText = `*${selectedText}*`; // Markdown 스타일로 기울임
                    break;
                case 'underline':
                    formattedText = `<u>${selectedText}</u>`; // HTML 스타일로 밑줄
                    break;
            }

            // 텍스트 업데이트
            textarea.value =
                textarea.value.substring(0, start) +
                formattedText +
                textarea.value.substring(end);

            // 선택 영역 초기화
            textarea.setSelectionRange(start, start + formattedText.length);
        }
    </script>
</body>
</html>