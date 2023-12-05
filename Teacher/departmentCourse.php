
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
<div class="container">

<?php 
    session_start();
    include_once('../navbar.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    include "../db_conn.php";
    $Userid =  $_SESSION['Userid'];

    $sql = "SELECT c.course_id , c.course_name, c.credit ,s.name ,s.userid ,d.DepartmentName FROM Course c, Department d , Staff s WHERE d.DepartmentHead = '$Userid' AND c.department = d.department AND s.userid = c.lecturer";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Department: " .(htmlspecialchars(mysqli_fetch_assoc($result)['DepartmentName']) );
        echo "<table border='1' style='width: 100%; margin-top: 20px;'>";
        echo "<tr><th>Course ID</th><th>Course Name</th><th>Credit</th><th>Lecturer (Lecturer ID)</th><th>Details</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['course_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['credit']) . "</td>";
            echo "<td>Dr. " . strtoupper(htmlspecialchars($row['name'])) . "  ( " . strtoupper(htmlspecialchars($row['userid'])) . " )</td>";

            
            // Edit button
            echo "<td><a href='viewCourse.php?course_id= " . $row['course_id'] ." ' class = button >View details</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No permission.";
    }
?>
<div style="margin-top: 20px;">
    <a href="homepage.php" class="button">Back to Homepage</a>
</div>
</div>
</body>
</html>
