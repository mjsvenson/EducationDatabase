<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
</head>
<body>

<h2>Course Registration</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $servername = "localhost";
    $dbname = "db2";
    $student = "student";

    $conn = new mysqli($servername, 'root', '', $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $section_id = $_POST['section_id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO take (student_id, course_id, section_id, semester, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $student_id, $course_id, $section_id, $semester, $year);

    // Execute statement
    if ($stmt->execute() === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="student_id">Student ID:</label>
    <input type="text" id="student_id" name="student_id" required><br><br>

    <label for="course_id">Course ID:</label>
    <input type="text" id="course_id" name="course_id" required><br><br>

    <label for="section_id">Section ID:</label>
    <input type="text" id="section_id" name="section_id" required><br><br>

    <label for="semester">Semester:</label>
    <input type="text" id="semester" name="semester" required><br><br>

    <label for="year">Year:</label>
    <input type="number" id="year" name="year" required><br><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
