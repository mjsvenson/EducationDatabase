<!DOCTYPE html>
<html>
    <h1>University Website</h1>
    <h2>Appoint an Advisor</h2>
    <form method="post">
        <label for="Student">PhD Student ID:</label><br>
        <input type="text" id="Student" name="Student" required><br>
        <label for="Advisor">Instructor ID:</label><br>
        <input type="text" id="Advisor" name="Advisor" required><br>
        <label for="Start">Start Date:</label><br>
        <input type="date" id="Start" name="Start" required><br>
        <label for="End">End Date (optional):</label><br>
        <input type="date" id="End" name="End"><br><br>
        <input type="submit" value="Appoint">
    </form>
    <p></p>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST['Student'];
    $i_id = $_POST['Advisor'];
    $s_date = $_POST['Start'];
    $e_date = $_POST['End'];

    //enter server info
    $servername = "localhost";
    $dbname = "db2";

    //establish connection using info
    $conn = new mysqli($servername, 'root', '', $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //validate student
    $sql = "SELECT * FROM PhD NATURAL LEFT OUTER JOIN advise WHERE student_id = '$s_id' GROUP BY student_id HAVING COUNT(*) < 2";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
        echo "$s_id cannot be appointed an advisor";
        $conn->close();
        exit;
    }

    //prepare student insert statement
    if (empty($e_date)) {
        $stmt = $conn->prepare("INSERT INTO advise (instructor_id, student_id, start_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $i_id, $s_id, $s_date);
    } else {
        $stmt = $conn->prepare("INSERT INTO advise (instructor_id, student_id, start_date, end_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $i_id, $s_id, $s_date, $e_date);
    }

    if ($stmt->execute()) {
        echo "Advisor appointed!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>