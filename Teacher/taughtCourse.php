
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body>
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include "../db_conn.php";
    $Userid =  $_SESSION['Userid'];
    

    $sql = "SELECT course_id, course_name ,course_type FROM Course WHERE lecturer = '$Userid' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' style='width: 100%; margin-top: 20px;'>";
        echo "<tr><th>Course ID</th><th>Course Name</th><th>Category</th><th>Marking</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['course_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course_type']) . "</td>";
            
            // Edit button
            echo "<td><a href='updateCourseResult.php?course_id=" . $row['course_id'] . "'>Update/view result</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No courses found.";
    }
?>
<div style="margin-top: 20px;">
    <a href="homepage.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back to Homepage</a>
</div>
</body>
</html>
