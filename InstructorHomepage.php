<?php
// Start the session
session_start();
$name = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Instructor Homepage</h2>
    <?php echo "Hello $name";?>
    <p></p>
    <a href="AddAdvisor.php"><button> Appoint an Advisor </button></a>
    <p></p>
    <a href="AdviseeInfo.php"><button> View Advisees </button></a>
    <p></p>
    <a href="CourseRecords.php"><button> View Course Records </button></a>
</html>

<?php


//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//close connection
$conn->close();

 
?>