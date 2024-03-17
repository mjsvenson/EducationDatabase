<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Admin Create Course</h2>
    <?php echo "Hello $name";?>
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