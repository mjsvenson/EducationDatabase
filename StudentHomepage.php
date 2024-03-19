<?php
// Start the session
session_start();
$id = $_SESSION['ID'];
$name = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Homepage</title>
</head>
<body>
    <h1>University Website</h1>
    <h2>Student Homepage</h2>
    <?php echo "Hello $name";?>
    <a href="ModifyInfo.php"><button>Modify Information</button></a>
    <p></p>

    <?php
    //enter server info
    $servername = "localhost";
    $dbname = "db2";
    $username = "root"; // Changed to appropriate username
    $password = ""; // Change to your password if any
    
    try {
        //establish connection using info
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement
        $sql = "SELECT course_id, section_id, semester, year, grade 
                FROM take 
                WHERE student_id = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':student_id', $id, PDO::PARAM_STR);
        $stmt->execute();
        
        //fetch all courses
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Display courses in a table
        echo "<h2>Courses taken by Student ID: $id</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Course ID</th><th>Section ID</th><th>Semester</th><th>Year</th><th>Grade</th></tr>";
        foreach ($courses as $course) {
            echo "<tr>";
            echo "<td>".$course['course_id']."</td>";
            echo "<td>".$course['section_id']."</td>";
            echo "<td>".$course['semester']."</td>";
            echo "<td>".$course['year']."</td>";
            echo "<td>".$course['grade']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    //close connection
    $conn = null;
    ?>
</body>
</html>