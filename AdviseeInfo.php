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

$sql = "SELECT * FROM advise NATURAL JOIN student WHERE instructor_id = '$id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <body>
    <h1>University Website</h1>
    <h2>Advisee Information</h2>
    <form method="post">
    <select name="Student">
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row["student_id"];?>">
            <?php echo $row["name"];?>
        </option>
        <?php }?>
    </select>
    <input type="submit" value="View Info">
    </form>

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

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST["Student"];
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
    $sql = "SELECT * FROM take WHERE student_id = '$s_id'";

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
        echo "<tr>";
        echo "0 results";
        echo "</tr>";
    }

//close connection
$conn->close();
}
?>

</body>
</html>