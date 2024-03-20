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
    
    // Mapping from letter grades to numerical values
    $grade_mapping = array(
        "A" => 4.0,
        "A-" => 3.7,
        "B+" => 3.3,
        "B" => 3.0,
        "B-" => 2.7,
        "C+" => 2.3,
        "C" => 2.0,
        "C-" => 1.7,
        "D+" => 1.3,
        "D" => 1.0,
        "D-" => 0.7,
        "F" => 0.0
    );

        //establish connection using info
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement
        $sql = "SELECT course_id, section_id, semester, year, grade, credits
                FROM take NATURAL JOIN course
                WHERE student_id = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':student_id', $id, PDO::PARAM_STR);
        $stmt->execute();
        
        //fetch all courses
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Display courses in a table
        echo "<h2>Courses taken by Student ID: $id</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Course ID</th><th>Section ID</th><th>Semester</th><th>Year</th><th>Grade</th><th>Credits</th></tr>";
        $total_credits = 0;
        $weighted_sum = 0;
        foreach ($courses as $course) {
            echo "<tr>";
            echo "<td>".$course['course_id']."</td>";
            echo "<td>".$course['section_id']."</td>";
            echo "<td>".$course['semester']."</td>";
            echo "<td>".$course['year']."</td>";
            echo "<td>".$course['grade']."</td>";
            echo "<td>".$course['credits']."</td>";
            echo "</tr>";
            $total_credits += intval($course['credits']); // Ensure 'credits' is cast to an integer
            $grade_value = isset($grade_mapping[$course['grade']]) ? $grade_mapping[$course['grade']] : 0; // Map letter grade to numerical value
            $weighted_sum += $grade_value * intval($course['credits']); // Ensure 'grade' and 'credits' are cast to appropriate numeric types
        }
        echo "</table>";

        // Calculate GPA
        $gpa = $weighted_sum / $total_credits;
        echo "<p>Total Credits: $total_credits</p>";
        echo "<p>GPA: ".round($gpa, 2)."</p>";

    //close connection
    $conn = null;
    ?>
</body>
</html>
