<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Admin Create Course</h2>

    <form action="CreateCourse.php" method="post">
        <label for="course_id">course_id</label><br>
        <input type="text" id="course_id" name="course_id"><br>
        <label for="section_id">section_id</label><br>
        <input type="text" id="section_id" name="section_id"><br>
        <label for="course_name">course_name:</label><br>
        <input type="text" id="course_name" name="course_name"><br>
        <label for="credits">credits:</label><br>
        <input type="text" id="credits" name="credits"><br>
        <label for="instructor">instructor:</label><br>
        <input type="text" id="instructor_id" name="instructor"><br>
        <label for="semester">semester:</label><br>
        <input type="text" id="semester" name="semester"><br>
        <label for="year">year:</label><br>
        <input type="text" id="year (Constraint)" name="year"><br>
        <label for="classroom_id">classroom_id:</label><br>
        <input type="text" id="classroom_id" name="classroom_id"><br>
        <label for="time_slot_id">time_slot_id:</label><br>
        <input type="text" id="time_slot_id (Constraint)" name="time_slot_id"><br>
        <p></p>
        <input type="submit" value="CreateCourse">
    </form>

    <p></p>
</html>

<?php

$course_id = $_POST['course_id'];
$section_id = $_POST['section_id'];
$course_name = $_POST['course_name'];
$credits = $_POST['credits'];
$instructor = $_POST['instructor'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$classroom_id = $_POST['classroom_id'];
$time_slot_id = $_POST['time_slot_id'];


//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO course (course_id, course_name, credits) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $course_id, $course_name, $credits);

if ($stmt->execute()) {
    echo "Course Creation Successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt = $conn->prepare("INSERT INTO section (course_id, section_id, semester, year, instructor_id, classroom_id, time_slot_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $course_id, $section_id, $semester, $year, $instructor_id, $classroom_id, $time_slot_id );

if ($stmt->execute()) {
    echo "Course Creation Successful!";
} else {
    echo "Error: " . $stmt->error;
}

//close connection
$stmt->close();
$conn->close();

 
?>