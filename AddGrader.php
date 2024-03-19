<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Assign Grader</h2>
    <form method="post">
        <label for="Student">Student ID:</label><br>
        <input type="text" id="Student" name="Student" required>
        <select id="Degree" name="Degree">
            <option value="Undergraduate">Undergraduate</option>
            <option value="Master">Master</option>
        </select><br>
        <label for="Course">Course ID:</label><br>
        <input type="text" id="Course" name="Course" required><br>
        <label for="Section">Section ID:</label><br>
        <input type="text" id="Section" name="Section" required><br>
        <label for="Semester">Semester:</label><br>
        <select id="Semester" name="Semester">
            <option value="Fall">Fall</option>
            <option value="Winter">Winter</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
        </select><br>
        <label for="Year">Year:</label><br>
        <input type="number" id="Year" name="Year" required><br>
        <input type="submit" value="Assign Grader">
    </form>
    <p></p>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $st_id = $_POST['Student'];
    $degree = $_POST['Degree'];
    $c_id = $_POST['Course'];
    $s_id = $_POST['Section'];
    $semester = $_POST['Semester'];
    $year = $_POST['Year'];

    //choose grader table based on degree
    $grader_table = "";
    if ($degree == "Undergraduate")
        $grader_table = "undergraduateGrader";
    else if ($degree == "Master")
        $grader_table = "masterGrader";

    //enter server info
    $servername = "localhost";
    $dbname = "db2";

    //establish connection using info
    $conn = new mysqli($servername, 'root', '', $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //validate student grade
    $sql = "SELECT * FROM take WHERE student_id = '$st_id' AND course_id = '$c_id' AND grade in ('A+', 'A', 'A-')";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
        echo "$st_id cannot be a grader for $c_id:$s_id";
        $conn->close();
        exit;
    }

    //validate enough students in section
    $sql = "SELECT * FROM take WHERE course_id = '$c_id' AND section_id = '$s_id' AND semester = '$semester' AND year = '$year'";
    $result = $conn->query($sql);
    if ($result->num_rows < 4 || $result->num_rows > 10) {
        echo "$c_id:$s_id cannot have a grader";
        $conn->close();
        exit;
    }

    //section not in grader
    $sql = "SELECT * FROM undergraduateGrader WHERE course_id = '$c_id' AND section_id = '$s_id' AND semester = '$semester' AND year = '$year'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "$c_id:$s_id already has a grader";
        $conn->close();
        exit;
    }
    $sql = "SELECT * FROM masterGrader WHERE course_id = '$c_id' AND section_id = '$s_id' AND semester = '$semester' AND year = '$year'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "$c_id:$s_id already has a grader";
        $conn->close();
        exit;
    }

    //prepare student insert statement
    $stmt = $conn->prepare("INSERT INTO '$grader_table' (student_id, course_id, section_id, semester, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $st_id, $c_id, $s_id, $semester, $year);


    if ($stmt->execute()) {
        echo "Grader assigned!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>