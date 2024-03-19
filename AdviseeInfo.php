<?php
// Start the session
session_start();
$id = $_SESSION['ID'];

//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM advise NATURAL JOIN student WHERE instructor_id = '$id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Advisee Information</h2>
    <form method="post">
    <select name="Student">
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row["student_id"];?>">
            <?php echo $row["name"];?>
        </option>
        <?php }?>
    </select>
    <input type="submit" value="View Info">
    </form>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST["Student"];
    echo "TODO: display course history for $s_id";
}


//close connection
$conn->close();

 
?>