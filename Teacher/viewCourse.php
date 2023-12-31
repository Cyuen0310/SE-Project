<!DOCTYPE html>
<html>
<head>

    <title>Course Details</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
<div class="container">
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include_once('../navbar.php');

    include "../db_conn.php";


    if (isset($_GET['course_id'])) {
        $courseId = trim(mysqli_real_escape_string($conn, $_GET['course_id']));

        $sql = "SELECT s.name, s.userid, e.grade, e.Semester FROM Student s, EnrolledCourse e WHERE e.course_id = '$courseId' AND e.student_id = s.userid ORDER BY e.Semester";
        $result = mysqli_query($conn, $sql);

        $currentSemester = null;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the semester has changed
                if ($row['Semester'] != $currentSemester) {
                    if ($currentSemester !== null) {
                        echo "</table>";
                    }
                    $currentSemester = $row['Semester'];
                    echo "<h3>Semester: " . htmlspecialchars($currentSemester) . "</h3>";
                    echo "<table>";
                    echo "<tr><th>Student Name</th><th>Student ID</th><th>Result</th></tr>";
                }
                echo "<tr>";
                echo "<td>" . strtoupper(htmlspecialchars($row['name'])) . "</td>";
                echo "<td><a href='viewStudent.php?userid=" . htmlspecialchars($row['userid']) . "&course_id=" . htmlspecialchars($courseId) .  "'>" . htmlspecialchars($row['userid']) . "</a></td>";
                echo "<td>" . (isset($row['grade']) ? htmlspecialchars($row['grade']) : 'N/A') . "</td>";
                echo "</tr>";
            }
            // Close the last table
            echo "</table>";
        } else {
            echo "No students found for this course.";
        }
    } else {
        echo "Course ID not provided.";
    }
?>
<div style="margin-top: 20px;">
    <a href="departmentCourse.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back</a>
</div>
</div>
</body>
</html>
