<?php
session_start();

// 로그인 확인 (로그인이 필요한 경우)
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('로그인이 필요합니다!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Oracle 데이터베이스 연결
$host = "203.249.87.57/orcl";
$user = "DB502_PROJ_G2";
$password = "6969";
$conn = oci_connect($user, $password, $host, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    die("Oracle 데이터베이스 연결 실패: " . $e['message']);
}

// POST 데이터 받기
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';
$user_id = $_SESSION['user_id']; // 로그인된 사용자 ID

// 자유게시판의 post_id 고정값
$post_id = "1"; // 자유게시판의 post_id는 항상 1로 설정

// 유효성 검사 - 제목과 내용 확인
if (empty($title) || empty($content)) {
    echo "<script>
        alert('제목과 내용을 모두 입력해주세요.');
        history.back();
    </script>";
    exit;
}

// `WRITE_ID` 계산
$get_max_id_sql = "SELECT NVL(MAX(TO_NUMBER(WRITE_ID)), 0) + 1 AS NEXT_ID FROM WRITE";
$max_id_stmt = oci_parse($conn, $get_max_id_sql);
oci_execute($max_id_stmt);
$row = oci_fetch_assoc($max_id_stmt);
$next_write_id = str_pad($row['NEXT_ID'], 3, '0', STR_PAD_LEFT); // 3자리 문자열로 포맷팅
oci_free_statement($max_id_stmt);

// 데이터 삽입
$insert_sql = "INSERT INTO WRITE (WRITE_ID, POST_ID, USER_ID, CONTENT_NAME, CONTENT) 
               VALUES (:write_id, :post_id, :user_id, :content_name, :content)";
$stmt = oci_parse($conn, $insert_sql);

// 바인딩 파라미터
oci_bind_by_name($stmt, ":write_id", $next_write_id);
oci_bind_by_name($stmt, ":post_id", $post_id);
oci_bind_by_name($stmt, ":user_id", $user_id);
oci_bind_by_name($stmt, ":content_name", $title);
oci_bind_by_name($stmt, ":content", $content);

// 실행
if (oci_execute($stmt)) {
    oci_free_statement($stmt);
    oci_close($conn);
    echo "<script>
        alert('게시글이 작성되었습니다.');
        window.location.href = 'board.php?post_id=$post_id';
    </script>";
    exit;
} else {
    $error = oci_error($stmt);
    oci_free_statement($stmt);
    oci_close($conn);
    die("게시글 작성 실패: " . $error['message']);
}
?>
