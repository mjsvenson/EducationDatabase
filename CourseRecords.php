<?php
// Start the session
session_start();
$email = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
    <body>
    <h1>University Website</h1>
    <h2>Instructor Records</h2>

    <p> Past Courses Taught </p>
<table>
    <tr>
        <th>Course ID</th>
        <th>Section ID</th>
        <th>Semester</th>
        <th>Year</th>
        <th>Classroom ID</th>
        <th>Time Slot ID</th>
    </tr>

    <?php
    // Connect to database
    $servername = "localhost";
    $dbname = "db2";
    $student = "student";

    $conn = new mysqli($servername, 'root', '', $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query
    $sql = "SELECT * FROM section WHERE instructor_id IN (SELECT instructor_id FROM instructor WHERE email = '$email')";

    // Execute query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["course_id"] . "</td>";
            echo "<td>" . $row["section_id"] . "</td>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td>" . $row["classroom_id"] . "</td>";
            echo "<td>" . $row["time_slot_id"] . "</td>";
            echo "<td><a href='ClassRegistration.php?section_id=" . $row["section_id"] . "'>Register</a></td>"; // Registration button with section_id as parameter
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
?>
</table>

<p> All students in every course section </p>
<table>
    <tr>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Section ID</th>
        <th>Semester</th>
        <th>Year</th>
        <th>Grade</th>    
    </tr>

    <?php
    // Connect to database
    $servername = "localhost";
    $dbname = "db2";
    $student = "student";

    $conn = new mysqli($servername, 'root', '', $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query
    $sql = "SELECT * FROM take WHERE section_id IN (SELECT section_id FROM section WHERE instructor_id IN (SELECT instructor_id FROM instructor WHERE email = '$email'))";

    // Execute query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["course_id"] . "</td>";
            echo "<td>" . $row["section_id"] . "</td>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td>" . $row["grade"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
?>
</table>

</body>
</html>