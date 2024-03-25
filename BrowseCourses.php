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
$id = $_SESSION['ID'];

// Fetching current semester and year
$current_semester = "Spring"; // Assuming current semester is Spring
$current_year = 2024; // Assuming current year is 2024

// Query to fetch courses offered in the current semester
$sql = "SELECT s.course_id, s.section_id, s.instructor_id, s.classroom_id, s.time_slot_id, COUNT(t.student_id) AS num_students
        FROM section s
        LEFT JOIN take t ON s.course_id = t.course_id AND s.section_id = t.section_id AND s.semester = t.semester AND s.year = t.year
        WHERE s.semester = '$current_semester' AND s.year = $current_year
        GROUP BY s.course_id, s.section_id, s.instructor_id, s.classroom_id, s.time_slot_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Course ID: " . $row["course_id"] . "<br>";
        echo "Section ID: " . $row["section_id"] . "<br>";
        echo "Instructor ID: " . $row["instructor_id"] . "<br>";
        echo "Classroom ID: " . $row["classroom_id"] . "<br>";
        echo "Time Slot ID: " . $row["time_slot_id"] . "<br>";
        echo "Number of Students Registered: " . $row["num_students"] . "<br>";
        
        // Check if registration is allowed (less than 15 students already registered)
        if ($row["num_students"] < 15) {
            echo "<form action='CourseRegistration.php' method='post'>";
            echo "<input type='hidden' name='course_id' value='" . $row["course_id"] . "'>";
            echo "<input type='hidden' name='section_id' value='" . $row["section_id"] . "'>";
            echo "<input type='submit' value='Register'>";
            echo "</form>";
        } else {
            echo "Registration closed. Maximum students reached.<br>";
        }
        
        echo "<br>";
    }
} else {
    echo "No courses offered in the current semester.";
}

$conn->close();
?>