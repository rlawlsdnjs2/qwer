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

// 회원가입 양식으로부터 정보 가져오기
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$student_id = $_POST['student_id'];
$major = $_POST['major'];

// 간단한 유효성 검사
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "유효하지 않은 이메일 주소입니다.";
    exit;
}

// 학번은 10자리 숫자로만 구성되어야 함
if (!preg_match("/^[0-9]{10}$/", $student_id)) {
    echo "학번은 10자리 숫자로 입력되어야 합니다.";
    exit;
}

// 비밀번호 해싱
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// SQL 쿼리 작성하여 데이터베이스에 사용자 정보 추가 (비밀번호 해싱된 값 사용)
$sql = "INSERT INTO users (username, password, email, student_id, major) VALUES ('$username', '$password_hashed', '$email', '$student_id', '$major')";

// 쿼리 실행
if ($conn->query($sql) === TRUE) {
    // 회원가입이 성공적으로 완료되면 홈 화면으로 리디렉션하고 메시지 표시
    echo "<script>alert('회원가입이 완료되었습니다.');</script>";
    echo "<script>window.location.href = 'index.html';</script>";
    exit;
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// MySQL 연결 종료
$conn->close();
?>
