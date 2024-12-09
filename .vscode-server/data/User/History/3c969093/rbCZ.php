<?php
session_start();

// 로그인 요청 처리
if (isset($_POST['action']) && $_POST['action'] == 'login_user') {
    // Oracle 데이터베이스 연결
    $db = '(DESCRIPTION =
    (ADDRESS_LIST=
    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
    )
    (CONNECT_DATA = (SID = orcl)
    )
    )';
    $username = "DB502_PROJ_G2"; // 사용자명
    $password = "6969"; // 비밀번호

    // 연결
    $connect = oci_connect($username, $password, $db, 'AL32UTF8');

    if (!$connect) {
        $response = ['status' => 'error', 'message' => '데이터베이스 연결 실패'];
        echo json_encode($response);
        exit;
    }

    // 로그인 폼 데이터 가져오기
    $user_id = $_POST['student_id'];
    $password_input = $_POST['password'];  // 사용자가 입력한 비밀번호

    // 사용자 정보 가져오기
    $login_sql = "SELECT USER_ID, PW, NAME FROM USER_T WHERE USER_ID = :user_id";
    $login_stid = oci_parse($connect, $login_sql);
    oci_bind_by_name($login_stid, ":user_id", $user_id);
    oci_execute($login_stid);

    // 사용자 정보 확인
    $user = oci_fetch_array($login_stid, OCI_ASSOC + OCI_RETURN_NULLS);

    if ($user) {
        // 비밀번호 비교 (데이터베이스에 해시된 비밀번호 저장 시 `password_verify` 사용)
        if (password_verify($password_input, $user['PW'])) { // 또는 password_verify($password_input, $user['PW'])
            // 로그인 성공
            $_SESSION['user_id'] = $user['USER_ID']; // 세션에 사용자 ID 저장
            $_SESSION['user_name'] = $user['NAME']; // 세션에 사용자 이름 저장
            
            $redirect_url = $_POST['redirect_url'] ?? 'mainpage.php';
            if (strpos($redirect_url, 'membership.php') !== false) {
                $redirect_url = 'mainpage.php'; // 회원가입 후 로그인 시 메인 페이지로 이동
            }
            $response = ['status' => 'success', 'redirect_url' => $redirect_url];
        } else {
            // 비밀번호 불일치
            $response = ['status' => 'error', 'message' => '비밀번호가 일치하지 않습니다.'];
        }
    } else {
        // 사용자 없음
        $response = ['status' => 'error', 'message' => '사용자를 찾을 수 없습니다.'];
    }

    // 리소스 해제
    oci_free_statement($login_stid);
    oci_close($connect);

    // 응답 반환
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
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
        color: #fff; /* 배경과 잘 어우러지도록 글자 색을 흰색으로 변경 */
    }
    .logotop-container {
        position: absolute;
        top: 10px;
        left: 10px;
    }

    .logotop-container img {
        width: 180px;
        height : 80px;
        cursor: pointer;
    }

    .logo-container {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    .logo-container img {
        width: 90px;
        cursor: pointer;
    }

    .login-container {
        background: rgba(15, 23, 42, 0.95); /* 반투명한 어두운 배경으로 변경 */
        padding: 20px 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        width: 320px;
        height: 420px;
        text-align: center;
        position: relative;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #e5e7eb; /* 연한 흰색 텍스트로 변경 */
        margin-top: 10px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 90%;
        padding: 10px;
        margin: 15px 0;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        margin-left: 5px;
    }

    .login-container input[type="text"]::placeholder,
    .login-container input[type="password"]::placeholder {
        color: rgba(255, 255, 255, 0.7); /* 흰색 계열의 placeholder */
    }

    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
        outline: none;
        border: 1px solid #60a5fa; /* 파란색 테두리 강조 */
        background: rgba(255, 255, 255, 0.3);
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #3b82f6;
        color: white;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .login-container button:hover {
        background-color: #2563eb;
    }

    .signup-link {
        margin-top: 20px;
        font-size: 12px;
    }

    .signup-link a {
        color: #93c5fd;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        font-size: 10px;
        display: none;
    }
    </style>

</head>
<body>
    <div class="logotop-container">
        <a href="mainpage.php">
             <img src="img/로고/홍익대학교.png" alt="로고" class = "logotop-container img">
        </a>
    </div>
    <div class="login-container">
        <h2>로그인</h2>
        <form method="POST" id="loginForm" action="mainpage.php">
            <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'mainpage.php'); ?>">
            <input type="text" name="student_id" placeholder="학번을 입력하세요" required>
            <input type="password" name="password" placeholder="비밀번호를 입력하세요" required>
            <button type="submit">로그인</button>
        </form> 
        <div id="error-message" class="error-message">아직 정보가 없습니다. 회원가입 하세요.</div>
        <div class="signup-link">
            아직 계정이 없으신가요? <a href="membership.php">회원가입</a>
        </div>
        <!-- 로고 이미지 -->
        <div class="logo-container">
            <a href="mainpage.php">
                <img src="img/로고/VOX.png" alt="로고"class = "logo-container img"> <!-- 로고 이미지 파일 경로 -->
            </a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // 기본 폼 제출 방지

            var formData = new FormData(this);
            formData.append('action', 'login_user'); // 액션 값 추가

            // AJAX 요청
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // 로그인 성공: 페이지 리다이렉트
                    alert('환영합니다! ');
                    window.location.href = data.redirect_url;
                } else {
                    // 로그인 실패: 에러 메시지 표시
                    var errorMessage = document.getElementById('error-message');
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>