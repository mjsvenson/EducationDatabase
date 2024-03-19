<?php
// Start the session
session_start();
$name = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Assign TA to Section</h2>

    <form method="post">
        <label for="student_id">PhD Student ID:</label><br>
        <input type="text" id="student_id" name="student_id" required><br>
        <label for="course_id">Course ID:</label><br>
        <input type="text" id="course_id" name="course_id" required><br>
        <label for="section_id">Section ID:</label><br>
        <input type="date" id="section_id" name="section_id" required><br>
        <label for="semester">Semester:</label><br>
        <input type="date" id="semester" name="semester"><br><br>
        <label for="year">Year:</label><br>
        <input type="date" id="year" name="year"><br><br>
        <input type="submit" value="Assign TA to Section">
    </form>

    <p></p>
</html>

<?php

$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];
$section_id = $_POST['section_id'];
$semester = $_POST['semester'];
$year = $_POST['year'];

//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO ta (student_id, course_id, section_id, semester, year) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $student_id, $course_id, $section_id, $semester, $year);

    // Execute statement
    if ($stmt->execute() === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

//close connection
$stmt->close();
$conn->close();

 
?>