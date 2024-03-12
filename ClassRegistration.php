<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input and sanitize it
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];
    $section_id = $_POST["section_id"];
    $semester = $_POST["semester"];
    $year = $_POST["year"];
    
    // Connect to database
    $servername = "localhost";
    $dbname = "db2";
    $username = "root";
    $password = "";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL statement to insert into take table
    $sql = "INSERT INTO take (student_id, course_id, section_id, semester, year) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $student_id, $course_id, $section_id, $semester, $year);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $stmt->close();
    $conn->close();
}
?>