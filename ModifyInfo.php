<?php
// Start the session
session_start();
$oldemail = $_SESSION['Email'];
$oldpassword = $_SESSION['password']
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Modify Information</h2>
    <form method="post">
        <label for="Email">New Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Change Info">
    </form>
    <p></p>
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
$conn->query("UPDATE account SET email='$email', password='$password', type='student' WHERE email='$oldemail' AND password='$oldpassword'");

$SignIn_page = "SignIn.html";
header("Location: $SignIn_page");

$conn->close();

 
?>