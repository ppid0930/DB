<?php
session_start();

// Oracle DB 연결 설정
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    die("Oracle 데이터베이스 연결 실패: " . oci_error());
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>대회참가 신청서</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('img/메인화면배경/bg.jpeg') no-repeat center center;
            background-size: cover;
            color: #fff; /* 배경과 어울리도록 텍스트 색상 설정 */
        }

        .logo-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .logo-container img {
            width: 90px;
            cursor: pointer;
        }

        .signup-container {
            background: rgba(15, 23, 42, 0.97); /* 반투명한 어두운 배경 */
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: left;
        }

        .signup-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #f1f5f9; /* 밝은 텍스트 색상 */
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2); /* 모든 입력창 배경 동일하게 설정 */
            font-size: 14px;
            color: #fff; /* 텍스트 색상 */
            box-sizing: border-box;
        }

        .form-group input::placeholder,
        .form-group select option::placeholder  ,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.6); /* Placeholder 색상 조정 */
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border: 1px solid #60a5fa; /* 포커스 시 파란색 테두리 */
            background: rgba(255, 255, 255, 0.3); /* 포커스 시 배경 투명도 조정 */
            color: #fff; /* 포커스 상태에서도 텍스트 색상 유지 */
        }

        .form-group select option {
            color: #fff; /* 드롭다운 리스트 옵션 텍스트 검정색 */
            background: rgba(15, 23, 42, 0.97);
        }
        .form-group select option[disabled] {
            display: none; /* 선택했을 때 기본값 숨김 */
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2); /* 모든 입력창 배경 동일하게 설정 */
            font-size: 14px;
            color: #fff; /* 텍스트 색상 */
            box-sizing: border-box;
            resize: none; /* 사용자가 크기를 변경하지 못하도록 설정 */
            height: 100px; /* 텍스트 박스 기본 높이 */
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .submit-btn {
            background: linear-gradient(90deg, #3b82f6, #2563eb); /* 파란색 그라데이션 */
            color: white;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8); /* 호버 시 더 어두운 파란색 */
        }

        .cancel-btn {
            padding: 12px;
            background: #525354; /* 회색 버튼 */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            transition: background 0.3s ease;
        }

        .cancel-btn:hover {
            background: #333; /* 더 어두운 회색 */
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="logo-container">
            <a href="mainpage.php">
                <img src="img/로고/VOX.png" alt="로고" class = "logo-container img">
            </a>
        </div>
        <h2>대회참가 신청서</h2>
        <form id="signupForm" method="POST" action="participant_process.php">
            <div class="form-group">
                <input type="text" id="student_id" name="student_id" placeholder="아이디(학번)" required>
            </div>
            <div class="form-group">
                <select id="competition" name="competition" required>
                    <option value="" disabled selected>대회를 선택하세요</option>
                    <option value="League Of Legend">League Of Legend</option>
                    <option value="Battleground">Battleground</option>
                    <option value="FIFA Online 4">FIFA Online 4</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="팀 이름" required>
            </div>
            <div class="form-group">
                <input type="text" id="phone" name="phone" placeholder="닉네임" required>
            </div>
            <div class="form-group">
                <input type="text" id="lank" name="lank" placeholder="랭크 티어 (ex. 다이아 4)" required>
            </div>
            <div class="form-group">
                <textarea id="introduce" name="introduce" placeholder="자기소개를 작성해주세요." required></textarea>
            </div>
           
            <div class="button-group"> 
                <button type="submit" class="submit-btn">신청하기</button>
                <button type="button" class="cancel-btn" onclick="location.href='mainpage.php';">신청취소</button>
            </div>
        </form>
    </div>
</body>
</html>