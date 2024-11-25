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

// 참가 신청한 대회 정보 가져오기
$sql_games = "SELECT GAME_ID, NVL(TEAM_NAME, '개인') AS TEAM_NAME
              FROM PARTICIPANT
              WHERE USER_ID = :user_id";
$stmt_games = oci_parse($conn, $sql_games);

if (!$stmt_games) {
    $e = oci_error($conn);
    die("SQL 준비 실패: " . $e['message']);
}

oci_bind_by_name($stmt_games, ':user_id', $user_id);

if (!oci_execute($stmt_games)) {
    $e = oci_error($stmt_games);
    die("쿼리 실행 실패: " . $e['message']);
}

$games = [];
while ($row = oci_fetch_assoc($stmt_games)) {
    $games[] = [
        'game_id' => $row['GAME_ID'],
        'team_name' => $row['TEAM_NAME'], // NVL로 처리된 팀명 가져오기
        'status' => '참가신청 완료'
    ];
}

oci_free_statement($stmt_games);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'navbar.php'; ?>
    <title>마이페이지</title>
    <style>
        /* 스타일 동일 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 style="margin-bottom: 50px;">마이페이지</h1>

    <!-- 신청한 대회 -->
    <h2>
    신청한 대회
        <span style="font-size: 14px; color: #dc3545; margin-left: 10px;">
        * 수정사항이 있으면 취소하고 다시 신청해주세요!
        </span>
    </h2>
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th>대회 이름</th>
                <th>팀명(개인)</th>
                <th>상태</th>
                <th>취소</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 대회 ID와 대회 이름 매핑
            $game_names = [
                1 => "League of Legend",
                2 => "BattleGround",
                3 => "FIFA Online 4"
            ];

            if (count($games) > 0):
                foreach ($games as $game):
                    $game_name = isset($game_names[$game['game_id']]) ? $game_names[$game['game_id']] : "Unknown";
                    $team_name = !empty($game['team_name']) ? $game['team_name'] : "개인"; // 빈 값 처리 추가
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($game_name); ?></td>
                        <td><?php echo htmlspecialchars($team_name); ?></td>
                        <td><?php echo htmlspecialchars($game['status']); ?></td>
                        <td>
                            <form action="cancel_participation.php" method="post" style="margin:0;">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($game['game_id']); ?>">
                                <button type="submit" class="btn btn-delete">취소하기</button>
                            </form>
                        </td>
                    </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="4">신청한 대회가 없습니다.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

     <!-- 내가 쓴 게시글 -->
    <h2 style="margin-top: 50px;">내가 쓴 게시글</h2>
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th>제목</th>
                <th>작성일</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($posts) > 0): // 작성한 게시글이 있는 경우
                foreach ($posts as $post):
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                        <td>
                            <form action="delete_post.php" method="post" style="margin:0;">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                                <button type="submit" class="btn btn-delete">삭제하기</button>
                            </form>
                        </td>
                    </tr>
            <?php
                endforeach;
            else: // 게시글이 없는 경우
            ?>
                <tr>
                    <td colspan="3">작성한 게시글이 없습니다.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- 프로필 정보 -->
    <h2>프로필 정보</h2>
    <table style="margin-top: 20px;">
        <tr>
            <th>이름</th>
            <td><input type="text" value="<?php echo htmlspecialchars($profile['NAME']); ?>" readonly></td>
        </tr>
        <tr>
            <th>학과</th>
            <td><input type="text" value="<?php echo htmlspecialchars($profile['DEPT']); ?>" readonly></td>
        </tr>
        <tr>
            <th>이메일</th>
            <td><input type="text" value="<?php echo htmlspecialchars($profile['E_MAIL']); ?>" readonly></td>
        </tr>
        <tr>
            <th>전화번호</th>
            <td><input type="text" value="<?php echo htmlspecialchars($profile['TEL']); ?>" readonly></td>
        </tr>
    </table>

        <!-- 수정하기 및 탈퇴하기 버튼 -->
        <div class="button-group">
            <button class="btn btn-edit" onclick="window.location.href='edit_profile.php'">수정하기</button>
            <button class="btn btn-delete" onclick="if(confirm('정말 탈퇴하시겠습니까?')) window.location.href='deleteprocess.php'">탈퇴하기</button>
        </div>
    </div>
    </body>
</html>