<?php
// MySQL 서버 연결 설정
$servername = "localhost"; // MySQL 호스트 이름
$username_db = "root"; // MySQL 사용자 이름
$password_db = "dbgml652@"; // MySQL 사용자 비밀번호
$dbname = "qwer"; // 사용할 데이터베이스 이름

// MySQL 연결 생성
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 로그인 양식으로부터 정보 가져오기
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL 쿼리 작성하여 사용자 확인
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // 사용자가 존재하는 경우
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // 입력한 비밀번호와 저장된 해시된 비밀번호를 비교
        if (password_verify($password, $hashed_password)) {
            // 비밀번호가 일치하는 경우, 로그인 성공
            header("Location: home.html");
            exit;
        } else {
            // 비밀번호가 일치하지 않는 경우
            echo "<script>alert('아이디 또는 비밀번호가 올바르지 않습니다.');</script>";
            echo "<script>window.location.href = 'index.html';</script>";
        }
    } else {
        // 사용자가 존재하지 않는 경우
        echo "<script>alert('아이디 또는 비밀번호가 올바르지 않습니다.');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }
} else {
    // 아이디나 비밀번호가 전송되지 않은 경우
    echo "<script>alert('아이디와 비밀번호를 입력해주세요.');</script>";
    echo "<script>window.location.href = 'index.html';</script>";
}

// MySQL 연결 종료
$conn->close();
?>
