<?php
//take email and password
$username = $_POST['Email'];
$password = $_POST['password'];

//enter server info
$servername = "localhost";
$email = "your_email";
$password = "your_password";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', ' ');
or die ('Could not connect: ' . mysql_error());

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepare insert statement
$stmt = $conn->prepare("INSERT INTO student (email, password) VALUES (?, ?)");
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