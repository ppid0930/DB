<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 오라클 데이터베이스 연결
    $db = '(DESCRIPTION =
        (ADDRESS_LIST =
        (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA = (SID = orcl)
        )
    )';
    $username = "DB502_PROJ_G2";
    $password = "6969";

    $connect = oci_connect($username, $password, $db, 'AL32UTF8');
    if (!$connect) {
        die("Oracle 데이터베이스 연결 실패: " . oci_error());
    }

    // 폼 데이터 가져오기
    $student_id = $_POST['student_id'];
    $competition = $_POST['competition'];
    $team_name = $_POST['name'];
    $nickname = $_POST['phone'];
    $rank = $_POST['lank'];
    $introduction = $_POST['introduce'];
    $redirect_url = $_POST['redirect_url'] ?? 'mainpage.php'; // 기본값으로 메인페이지 설정

    // PARTICIPANT 테이블에 데이터 삽입
    $query = "INSERT INTO PARTICIPANT (USER_ID, GAME_ID, TEAM_NAME, NICKNAME, RANK, SELF_INTRO) 
              VALUES (:student_id, :competition, :team_name, :nickname, :rank, :introduction)";
    $stmt = oci_parse($connect, $query);

    // 바인드 변수 설정
    oci_bind_by_name($stmt, ':student_id', $student_id);
    oci_bind_by_name($stmt, ':competition', $competition);
    oci_bind_by_name($stmt, ':team_name', $team_name);
    oci_bind_by_name($stmt, ':nickname', $nickname);
    oci_bind_by_name($stmt, ':rank', $rank);
    oci_bind_by_name($stmt, ':introduction', $introduction);

    // 쿼리 실행
    if (oci_execute($stmt)) {
        echo "<script>
            alert('대회 신청이 성공적으로 완료되었습니다!');
            window.location.href = '$redirect_url';
        </script>";
    } else {
        $error = oci_error($stmt);
        echo "<script>
            alert('신청 중 오류가 발생했습니다: " . htmlspecialchars($error['message']) . "');
            window.location.href = '$redirect_url';
        </script>";
    }

    // 리소스 해제 및 연결 종료
    oci_free_statement($stmt);
    oci_close($connect);
}
?>
