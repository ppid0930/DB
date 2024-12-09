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

function translate_error_message($error_message) {
    if (strpos($error_message, 'ORA-00001') !== false) {
        // 고유 제약 조건 위반
        return "중복된 데이터가 입력되었습니다. 이미 등록된 사용자나 팀일 수 있습니다.";
    } elseif (strpos($error_message, 'ORA-02291') !== false) {
        // 참조 무결성 위반 (FK 문제)
        return "관련된 대회나 사용자가 존재하지 않습니다. 입력된 정보를 확인해주세요.";
    } elseif (strpos($error_message, 'ORA-01400') !== false) {
        // NOT NULL 제약 조건 위반
        return "필수 항목이 누락되었습니다. 모든 필드를 정확히 입력했는지 확인해주세요.";
    } elseif (strpos($error_message, 'ORA-00942') !== false) {
        // 테이블 또는 뷰가 존재하지 않음
        return "요청한 데이터베이스 테이블이 존재하지 않습니다. 관리자에게 문의하세요.";
    } else {
        // 기본 오류 메시지
        return "알 수 없는 오류가 발생했습니다. 관리자에게 문의하세요. (원본 오류: " . htmlspecialchars($error_message) . ")";
    }
}

// POST로 전달된 폼 데이터 가져오기
$user_id = isset($_POST['student_id']) ? trim($_POST['student_id']) : null;
$competition_name = isset($_POST['competition']) ? trim($_POST['competition']) : null;
$team_name = isset($_POST['name']) ? trim($_POST['name']) : null; // 팀명은 선택사항
$nickname = isset($_POST['phone']) ? trim($_POST['phone']) : null;
$rank = isset($_POST['lank']) ? trim($_POST['lank']) : null;
$self_intro = isset($_POST['introduce']) ? trim($_POST['introduce']) : null;

// 이전 URL 가져오기 (Referer 사용)
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'mainpage.php';

// 유효성 검사 (팀명 제외)
if (!$user_id || !$competition_name || !$nickname || !$rank || !$self_intro) {
    echo "<script>
        alert('모든 필드를 정확히 입력해주세요. (팀명은 선택사항입니다)');
        window.location.href = '$redirect_url';
    </script>";
    exit;
}

// `GAME` 테이블에서 선택된 `competition_name`에 해당하는 `GAME_ID` 가져오기
$game_id_query = "SELECT GAME_ID FROM GAME WHERE GAME_NAME = :competition_name";
$game_id_stmt = oci_parse($conn, $game_id_query);
oci_bind_by_name($game_id_stmt, ":competition_name", $competition_name);

if (!oci_execute($game_id_stmt)) {
    $error = oci_error($game_id_stmt);
    $friendly_message = translate_error_message($error['message']);
    echo "<script>
        alert('오류 발생: $friendly_message');
        window.location.href = '$redirect_url';
    </script>";
    exit;
}

$game_id_row = oci_fetch_assoc($game_id_stmt);

if (!$game_id_row || !isset($game_id_row['GAME_ID'])) {
    echo "<script>
        alert('유효하지 않은 대회 이름입니다.');
        window.location.href = '$redirect_url';
    </script>";
    exit;
}

$game_id = $game_id_row['GAME_ID'];

// `PARTICIPANT` 테이블에 데이터 삽입
$insert_query = "INSERT INTO PARTICIPANT (GAME_ID, USER_ID, TEAM_NAME, NICKNAME, RANK, SELF_INTRO)
                 VALUES (:game_id, :user_id, :team_name, :nickname, :rank, :self_intro)";
$insert_stmt = oci_parse($conn, $insert_query);

oci_bind_by_name($insert_stmt, ":game_id", $game_id);
oci_bind_by_name($insert_stmt, ":user_id", $user_id);

if ($team_name) {
    oci_bind_by_name($insert_stmt, ":team_name", $team_name);
} else {
    $null_value = null;
    oci_bind_by_name($insert_stmt, ":team_name", $null_value);
}

oci_bind_by_name($insert_stmt, ":nickname", $nickname);
oci_bind_by_name($insert_stmt, ":rank", $rank);
oci_bind_by_name($insert_stmt, ":self_intro", $self_intro);

// 실행 및 결과 처리
if (oci_execute($insert_stmt)) {
    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : 'mypage.php';
    echo "<script>
        alert('대회 참가 신청이 완료되었습니다.');
        window.location.href = '$redirect_url';
    </script>";
    exit;
} else {
    $error = oci_error($insert_stmt);
    $friendly_message = translate_error_message($error['message']);
    echo "<script>
        alert('오류 발생: $friendly_message');
        history.back();
    </script>";
    exit;
}

oci_free_statement($game_id_stmt);
oci_free_statement($insert_stmt);
oci_close($conn);
?>
