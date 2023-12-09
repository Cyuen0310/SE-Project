
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
            echo "<td><a href='updateCourseResult.php?course_id=" . $row['course_id'] . "' class = button>Update/view result</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No courses found.";
    }
?>
<div style="margin-top: 20px;">
    <a href="homepage.php" class = "button">Back to Homepage</a>
</div>
</body>
</html>
