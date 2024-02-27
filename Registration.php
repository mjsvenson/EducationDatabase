<?php
//take email and password
$email = $_POST['Email'];
$password = $_POST['password'];

//enter server info
$servername = "localhost";
$dbname = "db2";
$student = "student";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepare insert statement
$stmt = $conn->prepare("INSERT INTO account (email, password, type) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $student);

//execute and check
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

//close connection
$stmt->close();
$conn->close();

 
?>