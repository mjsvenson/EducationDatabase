<?php
//take email and password
$username = $_POST['Email'];
$password = $_POST['password'];

//enter server info
$servername = "localhost";
$email = "your_email";
$password = "your_password";
$dbname = "your_database_name";

//establish connection using info
$conn = new mysqli($servername, $email, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepare insert statement
$stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);

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