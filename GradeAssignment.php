<?php
// Start the session
session_start();
$id = $_SESSION['ID'];

//enter server info
$servername = "localhost";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', '', $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//label as undergrad or master grader
$grader_table = "undergraduateGrader";
$sql = "SELECT * FROM master WHERE student_id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $grader_table = "masterGrader";
}

$_SESSION['Grader_Table'] = $grader_table;

$sql = "SELECT * FROM $grader_table WHERE student_id = '$id'";
$result = $conn->query($sql);

//close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
    <body>
    <h1>University Website</h1>
    <h2>Grade Assignemnts</h2>
    <?php
    $sql_course = "SELECT * FROM $grader_table WHERE student_id = '$id'";
    $result_course = $conn->query($sql_course);

    while ($row_course = $result_course->fetch_assoc()) {

        echo "<h3>" . $row_course["course_id"] . "</h3>";

        $c_id = $row_course["course_id"];
        $s_id = $row_course["section_id"];
        $semester = $row_course["semester"];
        $year = $row_course["year"];

        $sql_assignment = "SELECT * FROM assignment WHERE course_id = '$c_id' AND section_id = '$s_id' AND semester = '$semester' AND year = '$year'";
        $result_assignment = $conn->query($sql_assignment);

        while ($row_assignment = $result_assignment->fetch_assoc()) {

            echo "<h4>" . $row_assignment["assign_id"] . "</h4>";

            $a_id = $row_assignment["assign_id"];

            $sql_student = "SELECT * FROM assignmentgrade WHERE course_id = '$c_id' AND section_id = '$s_id' AND semester = '$semester' AND year = '$year' AND assign_id = '$a_id'";
            $result_student = $conn->query($sql_student);

            while ($row_student = $result_student->fetch_assoc()) {
                echo "<p>" . $row_student["student_id"] . ", " . $row_student["grade"]. "</p>";
            }
        }
    }
    ?>
</body>
</html>