
<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment Information</title>
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
    <div>
       <?php 
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            session_start();
            include "../db_conn.php";
            $Userid =  $_SESSION['Userid'];

            $sql = "SELECT c.course_name, c.course_id, c.course_type, c.credit , e.Semester , s.name , s.email FROM EnrolledCourse e, Course c, Staff s WHERE e.student_id = '$Userid' AND e.course_id = c.course_id AND c.lecturer = s.userid ORDER BY e.Semester desc";

            $result = mysqli_query($conn, $sql);

            $currentSemester = null;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Check if the semester has changed
                    if ($row['Semester'] != $currentSemester) {
                        // Close previous table, if any
                        if ($currentSemester != null) {
                            echo "</table><br>";
                        }
                        $currentSemester = $row['Semester'];
                        // Start a new table or a new section for this semester
                        echo "<h3>Semester: $currentSemester</h3>";
                        echo "<table border='1'>";
                        echo "<tr><th>Course code</th><th>Course Title</th><th>Category</th><th>Credit</th><th>Lecturer</th><th>Lecturer email</th></tr>";
                    }
                    // Print course information
                    echo "<tr>";
                    echo "<td>" . $row["course_id"] . "</td>";
                    echo "<td>" . $row["course_name"] . "</td>";
                    echo "<td>" . $row["course_type"] . "</td>";
                    echo "<td>" . $row["credit"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";

                    echo "</tr>";
                }
                // Close the last table
                echo "</table>";
            } else {
                echo "0 results";
            }
        ?>
        <div style="margin-top: 20px;">
            <a href="homepage.php" class="back-button">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
