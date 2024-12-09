<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Oracle DB 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("DB 연결 실패: " . $e['message']);
}

// 현재 로그인된 사용자 ID
$user_id = $_SESSION['user_id'];

// 사용자 정보 가져오기
$sql_profile = "SELECT NAME, DEPT, E_MAIL, TEL 
                FROM USER_T 
                WHERE USER_ID = :user_id";
$stmt_profile = oci_parse($conn, $sql_profile);

if (!$stmt_profile) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_profile, ':user_id', $user_id);

if (!oci_execute($stmt_profile)) {
    $e = oci_error($stmt_profile);
    die("쿼리 실행 실패: " . $e['message']);
}

$profile = oci_fetch_assoc($stmt_profile);

if (!$profile) {
    die("사용자 정보를 찾을 수 없습니다. user_id: " . htmlspecialchars($user_id));
}

oci_free_statement($stmt_profile);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로필 수정</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            width: 30%;
            background-color: #f4f4f4;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button-group {
            margin-top: 20px;
            text-align: center;
            display: flex; /* 버튼들을 가로로 배치 */
            justify-content: center; /* 가운데 정렬 */
            gap: 10px; /* 버튼 간 간격 추가 (옵션) */
        }
        .btn {
            flex: 1; /* 부모의 가로 공간을 균등하게 나눔 */
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center; /* 텍스트 가운데 정렬 */
        }
        .btn-save {
            background-color: #28a745;
            color: white;
        }
        .btn-save:hover {
            background-color: #218838;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: white;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>프로필 수정</h1>
        <form action="save_profile.php" method="post">
            <table>
                <tr>
                    <th>이름</th>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($profile['NAME']); ?>" required></td>
                </tr>
                <tr>
                    <th>학과</th>
                    <td><input type="text" name="dept" value="<?php echo htmlspecialchars($profile['DEPT']); ?>" required></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="email" name="email" value="<?php echo htmlspecialchars($profile['E_MAIL']); ?>" required></td>
                </tr>
                <tr>
                    <th>전화번호</th>
                    <td><input type="tel" name="tel" value="<?php echo htmlspecialchars($profile['TEL']); ?>" required></td>
                </tr>
            </table>
            <div class="button-group">
                <button type="submit" class="btn btn-save" >저장하기</button>
                <button type="button" class="btn btn-cancel" onclick="window.location.href='mypage.php'">취소</button>
            </div>
        </form>
    </div>
</body>
</html>