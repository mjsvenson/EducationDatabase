<?php
// Start the session
session_start();
$name = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Admin Homepage</h2>
    <?php echo "Hello $name";?>
    <p></p>
    <a href="CreateCourse.php"><button> Create new Course </button></a>
    <p></p>
    <a href="AddAdvisor.php"><button> Appoint an Advisor </button></a>
    <p></p>
    <a href="AssignTAtoSection.php"><button> Assign TA to section </button></a>

    <p></p>
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