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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
</head>
<body>
    <h2>Course Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="student_id">Student ID:</label><br>
        <input type="text" id="student_id" name="student_id"><br>
        <label for="course_id">Course ID:</label><br>
        <input type="text" id="course_id" name="course_id"><br>
        <label for="section_id">Section ID:</label><br>
        <input type="text" id="section_id" name="section_id"><br>
        <label for="semester">Semester:</label><br>
        <input type="text" id="semester" name="semester"><br>
        <label for="year">Year:</label><br>
        <input type="text" id="year" name="year"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>