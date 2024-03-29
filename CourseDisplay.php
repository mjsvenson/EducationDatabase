<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Sections</title>
</head>
<body>

<h2>Course Sections</h2>

<table>
    <tr>
        <th>Course ID</th>
        <th>Section ID</th>
        <th>Semester</th>
        <th>Year</th>
        <th>Instructor ID</th>
        <th>Classroom ID</th>
        <th>Time Slot ID</th>
        <th>Action</th> <!-- New column for the registration button -->
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
    $sql = "SELECT * FROM section";

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
            echo "<td>" . $row["instructor_id"] . "</td>";
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

</body>
</html>
