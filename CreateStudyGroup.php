<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Create Study Group</h2>

    <form action="CreateStudyGroup.php" method="post">
        <label for="course_id">course_id</label><br>
        <input type="text" id="course_id" name="course_id"><br>
        <label for="section_id">section_id</label><br>
        <input type="text" id="section_id" name="section_id"><br>
        <label for="classroom_id">classroom_id</label><br>
        <input type="text" id="classroom_id" name="classroom_id"><br>
        <label for="time_slot_id">time_slot_id</label><br>
        <input type="text" id="time_slot_id" name="time_slot_id"><br>
        <label for="studygroup_id">studygroup_id</label><br>
        <input type="text" id="studygroup_id" name="studygroup_id"><br>
        <input type="submit" value="Create Study Group">
    </form>
</html>

<?php

$course_id = $_POST['course_id'];
$section_id = $_POST['section_id'];
$classroom_id = $_POST['classroom_id'];
$time_slot_id = $_POST['time_slot_id'];
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

$stmt = $conn->prepare("INSERT INTO studygroup (course_id, section_id, classroom_id, time_slot_id, studygroup_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $course_id, $section_id, $classroom_id, $time_slot_id, $studygroup_id);

if ($stmt->execute()) {
    echo "Study Group Creation Successful!";
} else {
    echo "Error: " . $stmt->error;
}

//close connection
$stmt->close();
$conn->close();

 
?>