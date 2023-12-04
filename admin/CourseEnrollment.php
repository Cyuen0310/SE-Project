<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />


</head>
<body>
    <div class="container">
        <a href="../Student/homepage.php" class="back-button">Go Back</a>
        <form action="" method="post">
            <input type="text" name="search_id" placeholder="Enter Student ID">
            <input type="submit" name="search" value="Search">
        </form>

        <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        include "../db_conn.php";
        session_start();

        // Handling course drop request
        if (isset($_POST['drop_course'])) {
            $studentId = mysqli_real_escape_string($conn, $_POST['student_id']);
            $dropCourseId = mysqli_real_escape_string($conn, $_POST['drop_course_id']);

            $dropSql = "DELETE FROM EnrolledCourse WHERE student_id = '$studentId' AND course_id = '$dropCourseId'";
            if (mysqli_query($conn, $dropSql)) {
                echo "Course dropped successfully.";
            } else {
                echo "Error dropping course: " . mysqli_error($conn);
            }
        }

        // Handling search
        if (isset($_POST['search'])) {
            $searchId = mysqli_real_escape_string($conn, $_POST['search_id']);
            $sql = "SELECT c.course_name, c.course_id, c.course_type, c.credit, e.grade, e.Semester FROM EnrolledCourse e, Course c WHERE e.student_id = '$searchId' AND e.course_id = c.course_id ORDER BY e.Semester";

            $result = mysqli_query($conn, $sql);
            $currentSemester = null;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['Semester'] != $currentSemester) {
                        if ($currentSemester != null) {
                            echo "</table><br>";
                        }
                        $currentSemester = $row['Semester'];
                        echo "<h3>Semester: $currentSemester</h3>";
                        echo "<table border='1'>";
                        echo "<tr><th>Course code</th><th>Course Title</th><th>Category</th><th>Credit</th><th>Grade</th><th>Action</th></tr>";
                    }
                    echo "<tr>";
                    echo "<td>" . $row["course_id"] . "</td>";
                    echo "<td>" . $row["course_name"] . "</td>";
                    echo "<td>" . $row["course_type"] . "</td>";
                    echo "<td>" . $row["credit"] . "</td>";
                    echo "<td>" . $row["grade"] . "</td>";
                    echo "<td>";
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='drop_course_id' value='" . htmlspecialchars($row["course_id"]) . "'>";
                    echo "<input type='hidden' name='student_id' value='" . htmlspecialchars($searchId) . "'>";
                    echo "<input type='submit' name='drop_course' value='Drop'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        }
        ?>
    </div>
</body>
</html>
