
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h3 {
            color: #333;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a.back-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        a.back-button:hover {
            background-color: #45a049;
        }
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

    $sql = "SELECT c.course_id , c.course_name, c.credit ,s.name ,s.userid FROM Course c, Department d , Staff s WHERE d.DepartmentHead = '$Userid' AND c.department = d.department AND s.userid = c.lecturer";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' style='width: 100%; margin-top: 20px;'>";
        echo "<tr><th>Course ID</th><th>Course Name</th><th>Credit</th><th>Lecturer (Lecturer ID)</th><th>Details</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['course_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['credit']) . "</td>";
            echo "<td>Dr. " . strtoupper(htmlspecialchars($row['name'])) . "  ( " . strtoupper(htmlspecialchars($row['userid'])) . " )</td>";

            
            // Edit button
            echo "<td><a href='viewCourse.php?course_id=" . $row['course_id'] . "'>View details</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No permission.";
    }
?>
<div style="margin-top: 20px;">
    <a href="homepage.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back to Homepage</a>
</div>
</body>
</html>
