<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>User Registration</h2>
    <form action="Registration.php" method="post">
        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
        <label for="name">name:</label><br>
        <input type="text" id="student_name" name="student_name"><br>
        <label for="dept_name">dept_name:</label><br>
        <select name="dept_name" id="dept_name">
            <option value="Miner School of Computer & Information Sciences">Miner School of Computer & Information Sciences</option>
        </select>
        <p></p>
        <label for="student_id">ID:</label><br>
        <input type="text" id="student_id" name="student_id"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <select name="degree" id="degree">
            <option value="undergraduate">Undergraduate</option>
            <option value="master">Master</option>
            <option value="phd">PhD</option>
        </select>
        <br>
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
$degree = $_POST['degree'];
$student_id = $_POST['student_id'];
$dept = $_POST['dept_name'];
$student_name = $_POST['student_name'];

echo $degree;

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

//prepare account insert statement
$stmt = $conn->prepare("INSERT INTO account (email, password, type) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $student);
$SignIn_page = "SignIn.php";

$freshman_test = "freshman";
$zero_test = 0;

//prepare student insert statement
$stmt_student = $conn->prepare("INSERT INTO student (student_id, name, email, dept_name) VALUES (?, ?, ?, ?)");
$stmt_student->bind_param("ssss", $student_id, $student_name, $email, $dept);

if ($stmt_student->execute()) {
    echo "Student registration successful!";
} else {
    echo "Error: " . $stmt_student->error;
}

//execute and check
if ($stmt->execute()) {
    echo "Account registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

switch ($degree) {
    case 'undergraduate':
        $stmt_degree = $conn->prepare("INSERT INTO undergraduate (student_id, total_credits, class_standing) VALUES (?, ?, ?)");
        $stmt_degree->bind_param("sis", $student_id, $zero_test, $freshman_test);
        echo "inserted into undergrad";
        break;
    case 'master':
        $stmt_degree = $conn->prepare("INSERT INTO master (student_id, total_credits) VALUES (?, ?)");
        $stmt_degree->bind_param("si", $student_id, $zero_test);
        echo "inserted into master";
        break;
    case 'phd':
        $stmt_degree = $conn->prepare("INSERT INTO PhD (student_id, qualifier, proposal_defence_date, dissertation_defence_date) VALUES (?, ?, ?, ?)");
        $stmt_degree->bind_param("ssss", $student_id, $zero_test, $zero_test, $zero_test);
        echo "inserted into phd";
        break;
}

// Execute degree statement
if ($stmt_degree->execute()) {
    echo "Degree details inserted successfully!";
} else {
    echo "Error: " . $stmt_degree->error;
}

//close connection
$stmt_degree->close();
$stmt->close();
$conn->close();

 
?>