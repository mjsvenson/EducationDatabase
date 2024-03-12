
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
$sql = "SELECT * FROM account WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

$StudentHome_page = "StudentHomepage.html";

//execute and check
if ($result->num_rows > 0) {
    // Credentials found, do something
    echo "Credentials found!";
    header("Location: $StudentHome_page");
} else {
    // No match found for the given credentials
    echo "Invalid credentials!";
}

//close connection
$conn->close();

 
?>