<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <div class="container">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include "../db_conn.php";
    include_once('../navbar.php');

    $Userid = $_SESSION['Userid'];
    $CurrentSem = "2023/24 Sem 1";

    if (isset($_GET['course_id'])) {
        $courseId = $_GET['course_id'];

        $sql = "SELECT s.userid, s.name, e.grade FROM Student s, EnrolledCourse e, Course c WHERE e.course_id = c.course_id AND e.student_id = s.userid AND e.Semester = '$CurrentSem' AND e.course_id = '$courseId' ORDER BY s.userid";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Course: $courseId </h3>";
            echo "<h3>Semester: $CurrentSem </h3>";
            echo "<form action=' update.php' method='post'>";
            echo "<input type='hidden' name='course_id' value='" . $courseId . "'>";
            echo "<table border='1' style='width: 100%; margin-top: 20px;'>";
            echo "<tr><th>Student ID</th><th>Student Name</th><th>Grade</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href='viewStudent.php?userid=" . htmlspecialchars($row['userid']) . "&course_id=" . htmlspecialchars($courseId) . "'>" . htmlspecialchars($row['userid']) . "</a></td>";
                echo "<td>" . strtoupper(htmlspecialchars($row['name'])) . "</td>";
                echo "<td>";
                echo "<select name='grades[" . $row['userid'] . "]'>";
                echo " <option value='' disabled selected>--Select--</option>";
                // Grade options
                $grades = ['A', 'A-', 'B+', 'B', 'B-' , 'C+','C','F'];
                foreach ($grades as $grade) {
                    echo "<option value='" . $grade . "'" . ($row['grade'] == $grade ? ' selected' : '') . ">" . $grade . "</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<button type='submit' style='margin-top: 10px;'>Update Grades</button>";
            echo "</form>";
        } else {
            echo "No students found.";
        }
    } else {
        echo "Course ID not provided.";
    }


    if (isset($_POST['submit'])){
        echo"update successful";

    }
?>
<div style="margin-top: 20px;">
    <a href="homepage.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back to Homepage</a>
</div>
</div>
    
</body>
</html>
