<?php
//start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>User Sign In</h2>
    <form method="post">
        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Sign In">
    </form>
    <p></p>
    <a href="Registration.php"><button> Register </button></a>
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
$sql = "SELECT * FROM account WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

$Home_page = "StudentHomepage.php";

//execute and check
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $accountType = $row['type'];
    // Credentials found, do something
    echo "Credentials found!";
    $_SESSION['Email'] = $email;
    $_SESSION['password'] = $password;

    //set homepage based on account type
    if ($accountType == "admin") {

        $Home_page = "AdminHomepage.php";

    } elseif ($accountType == "instructor") {
        
        $Home_page = "InstructorHomepage.php";
        //get id
        $sql = "SELECT * FROM instructor WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['ID'] = $row['instructor_id'];

    } elseif ($accountType == "student") {

        $Home_page = "StudentHomepage.php";
        //get id
        $sql = "SELECT * FROM student WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['ID'] = $row['student_id'];

    } else {
        echo "Error: Account has bad type: $accountType";
        exit;
    }

    header("Location: $Home_page");

} else {
    // No match found for the given credentials
    echo "Invalid credentials!";
}

//close connection
$conn->close();

 
?>