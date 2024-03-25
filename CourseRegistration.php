<?php
session_start();

// Establish connection to the database
$servername = "localhost";
$dbname = "db2";
$username = "root"; // Changed to appropriate username
$password = ""; // Change to your password if any

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching student ID from session
$student_id = $_SESSION['ID'];

// Fetching course ID and section ID from the form submission
$course_id = $_POST['course_id'];
$section_id = $_POST['section_id'];

// Fetching current semester and year
$current_semester = "Spring"; // Assuming current semester is Spring
$current_year = 2024; // Assuming current year is 2024

// Check if the student is already registered for this course section
$check_sql = "SELECT * FROM take WHERE student_id = '$student_id' AND course_id = '$course_id' AND section_id = '$section_id' AND semester = '$current_semester' AND year = $current_year";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "You are already registered for this course section.";
} else {
    // Inserting registration into the take table
    $insert_sql = "INSERT INTO take (student_id, course_id, section_id, semester, year) VALUES ('$student_id', '$course_id', '$section_id', '$current_semester', $current_year)";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Course registration successful.";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>