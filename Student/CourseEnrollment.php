

<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment Information</title>
    <link rel="stylesheet" href="../css/cEnroll-style.css" />
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
