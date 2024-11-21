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

// POST로 전달된 폼 데이터 가져오기
$user_id = isset($_POST['student_id']) ? trim($_POST['student_id']) : null;
$competition_name = isset($_POST['competition']) ? trim($_POST['competition']) : null;
$team_name = isset($_POST['name']) ? trim($_POST['name']) : null;
$nickname = isset($_POST['phone']) ? trim($_POST['phone']) : null;
$rank = isset($_POST['lank']) ? trim($_POST['lank']) : null;
$self_intro = isset($_POST['introduce']) ? trim($_POST['introduce']) : null;

// 이전 URL 가져오기 (hidden 필드로 전달된 값 사용)
$redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : 'mainpage.php';

// 유효성 검사
if (!$user_id || !$competition_name || !$team_name || !$nickname || !$rank || !$self_intro) {
    echo "<script>
        alert('모든 필드를 정확히 입력해주세요.');
        history.back();
    </script>";
    exit;
}

// `GAME` 테이블에서 선택된 `competition_name`에 해당하는 `GAME_ID` 가져오기
$game_id_query = "SELECT GAME_ID FROM GAME WHERE GAME_NAME = :competition_name";
$game_id_stmt = oci_parse($conn, $game_id_query);
oci_bind_by_name($game_id_stmt, ":competition_name", $competition_name);
oci_execute($game_id_stmt);
$game_id_row = oci_fetch_assoc($game_id_stmt);

// `GAME_ID` 확인
if (!$game_id_row || !isset($game_id_row['GAME_ID'])) {
    echo "<script>
        alert('유효하지 않은 대회 이름입니다.');
        history.back();
    </script>";
    exit;
}
$game_id = $game_id_row['GAME_ID'];

// `PARTICIPANT` 테이블에 데이터 삽입
$insert_query = "INSERT INTO PARTICIPANT (GAME_ID, USER_ID, TEAM_NAME, NICKNAME, RANK, SELF_INTRO)
                 VALUES (:game_id, :user_id, :team_name, :nickname, :rank, :self_intro)";
$insert_stmt = oci_parse($conn, $insert_query);

// 바인딩
oci_bind_by_name($insert_stmt, ":game_id", $game_id);
oci_bind_by_name($insert_stmt, ":user_id", $user_id);
oci_bind_by_name($insert_stmt, ":team_name", $team_name);
oci_bind_by_name($insert_stmt, ":nickname", $nickname);
oci_bind_by_name($insert_stmt, ":rank", $rank);
oci_bind_by_name($insert_stmt, ":self_intro", $self_intro);

// 실행 및 결과 처리
if (oci_execute($insert_stmt)) {
    echo "<script>
        alert('대회 참가 신청이 완료되었습니다.');
        window.location.href = '$redirect_url';
    </script>";
} else {
    $error = oci_error($insert_stmt);
    echo "<script>
        alert('오류 발생: " . htmlspecialchars($error['message']) . "');
        history.back();
    </script>";
}

// 리소스 해제 및 연결 종료
oci_free_statement($game_id_stmt);
oci_free_statement($insert_stmt);
oci_close($conn);
?>
