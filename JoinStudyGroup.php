<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Join Study Group</h2>

    <form action="JoinStudyGroup.php" method="post">
        <label for="student_id">student_id</label><br>
        <input type="text" id="student_id" name="student_id"><br>
        <label for="studygroup_id">studygroup_id</label><br>
        <input type="text" id="studygroup_id" name="studygroup_id"><br>
        <input type="submit" value="Join Study Group">
    </form>
</html>

<?php
$student_id = $_POST['student_id'];
$studygroup_id = $_POST['studygroup_id'];

//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO studentinsg (studygroup_id, student)id) VALUES (?, ?)");
$stmt->bind_param("ss", $student_id, $studygroup_id);

if ($stmt->execute()) {
    echo "Study Group Join Successful!";
} else {
    echo "Error: " . $stmt->error;
}

//close connection
$stmt->close();
$conn->close();

 
?>