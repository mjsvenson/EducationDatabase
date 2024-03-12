<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>User Registration</h2>
    <form action="Registration.php" method="post">
        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Register">
    </form>
</html>

<?php
//validate data
if (!isset($_POST['Email']) || !isset($_POST['password'])) {
    echo "Username and password are required.";
    exit;
}

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

$SignIn_page = "SignIn.html";

//execute and check
if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: $SignIn_page");

} else {
    echo "Error: " . $stmt->error;
}

//close connection
$stmt->close();
$conn->close();

 
?>