<?php
// MySQL 서버 연결 설정
$servername = "localhost"; // MySQL 호스트 이름
$username = "root"; // MySQL 사용자 이름
$password = "dbgml652@"; // MySQL 사용자 비밀번호
$dbname = "qwer"; // 사용할 데이터베이스 이름

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 로그인 양식으로부터 정보 가져오기
$username = $_POST['username'];
$password = $_POST['password'];

// 입력한 비밀번호를 해싱하여 데이터베이스와 비교
$password = md5($password); // 또는 다른 안전한 해싱 알고리즘 사용

// SQL 쿼리 작성하여 사용자 확인
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // 사용자가 존재하면 홈 화면으로 리디렉션
    header("Location: home.html");
    exit;
} else {
    // 사용자가 존재하지 않으면 로그인 실패 메시지 출력
    echo "아이디 또는 비밀번호가 올바르지 않습니다.";
}

// MySQL 연결 종료
$conn->close();
?>
