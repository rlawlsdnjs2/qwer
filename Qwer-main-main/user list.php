<?php
$servername = "localhost";
$username = "root";
$password = "dbgml652@";
$dbname = "qwer";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 사용자 목록 가져오기
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["username"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "사용자가 없습니다.";
}

$conn->close();
?>
