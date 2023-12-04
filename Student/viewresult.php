<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    include "../db_conn.php";
    include "../utils.php"; // Ensure you have the function calculateGradePoint defined in this file

    $userId = $_SESSION['Userid'];
    $currentSemester = "2023/24 Sem 2";

    $sql = "SELECT e.Semester, c.course_id, c.course_name, c.credit, e.grade 
            FROM EnrolledCourse e 
            JOIN Course c ON e.course_id = c.course_id 
            WHERE e.student_id = '$userId' AND e.Semester != '$currentSemester' 
            ORDER BY e.Semester ";

    $result = mysqli_query($conn, $sql);

    $semesterResults = [];
    $totalOverallCredits = 0;
    $totalOverallPoints = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $semesterResults[$row['Semester']][] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Results</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
    <div class="container">
    <?php include_once('../navbar.php')?>
        <?php 
            $totalAccumulatedCredits = 0;
            $totalAccumulatedPoints = 0;

            foreach ($semesterResults as $semester => $courses) {
                $semesterCredits = 0;
                $semesterPoints = 0;

                foreach ($courses as $course) {
                    $gradePoint = calculateGradePoint($course['grade']);
                    $semesterCredits += $course['credit'];
                    $semesterPoints += ($gradePoint * $course['credit']);

                }

                $totalAccumulatedCredits += $semesterCredits;
                $totalAccumulatedPoints += $semesterPoints;
                // Recalculate CGPA after each semester
                $semesterGPA = $semesterCredits > 0 ? $semesterPoints/$semesterCredits : 0;
                $cumulativeCGPA = $totalAccumulatedCredits > 0 ? $totalAccumulatedPoints / $totalAccumulatedCredits : 0;
        ?>
            <h3><?php echo "Semester: " . htmlspecialchars($semester); ?></h3>
            <table>
                <tr>
                    <th>Course Code</th>
                    <th>Title</th>
                    <th>Credit</th>
                    <th>Grade</th>
                </tr>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                        <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($course['credit']); ?></td>
                        <td><?php echo htmlspecialchars($course['grade']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php
            echo "<p>GPA: " . round($semesterGPA, 2) . "</p>";
            echo "<p>CGPA: " . round($cumulativeCGPA, 2) . "</p>";
            echo "<hr>";
        }
        ?>
        <div style="margin-top: 20px;">
            <a href="homepage.php" class="back-button">Back to Homepage</a>
        </div>
    </div>
</body>
</html>