<!DOCTYPE html>
<html>
<head>
    <title>Update Student Grades</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
    <div class="container">
        <?php 
            session_start();
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include "../db_conn.php"; 
            include "../navbar.php";

            // Function to update grade
            function update($conn, $studentId, $courseId, $newGrade) {
                $updateSql = "UPDATE EnrolledCourse SET grade = ? WHERE student_id = ? AND course_id = ?";
                $stmt = mysqli_prepare($conn, $updateSql);
                mysqli_stmt_bind_param($stmt, "sss", $newGrade, $studentId, $courseId);
                mysqli_stmt_execute($stmt);
            }

            // Handling grade update request
            if (isset($_POST['update_grade'])) {
                $studentId = mysqli_real_escape_string($conn, $_POST['student_id']);
                $courseId = mysqli_real_escape_string($conn, $_POST['course_id']);
                $newGrade = mysqli_real_escape_string($conn, $_POST['grade']);

                update($conn, $studentId, $courseId, $newGrade);
                header("Location: ../Teacher/homepage.php?=Grade updated successfully");
            }

            // Handling course search
            if (isset($_POST['search'])) {
                $courseId = mysqli_real_escape_string($conn, $_POST['course_id']);
                $sql = "SELECT e.student_id, s.name, e.grade, e.Semester 
                        FROM EnrolledCourse e 
                        JOIN Student s ON e.student_id = s.userid 
                        WHERE e.course_id = '$courseId' 
                        ORDER BY e.Semester";

                $result = mysqli_query($conn, $sql);
                $currentSemester = null;
            }
        ?>
        <script type="text/javascript">
            function UpdateGrade() {
                return confirm('Are you sure you want to update the grade?');
            }
        </script>

        <!-- Search Form -->
        <form action="" method="post">
            <input type="text" name="course_id" placeholder="Enter Course ID">
            <input type="submit" name="search" value="Search">
        </form>

        <?php 
        if (isset($_POST['search']) && mysqli_num_rows($result) > 0) {
    
            echo "<h3>Course code: " . htmlspecialchars($courseId) . "</h3>";

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['Semester'] != $currentSemester) {
                    if ($currentSemester != null) {
                        echo "</table><br>";
                    }
                    $currentSemester = $row['Semester'];
                    echo "<h3>Semester: " . htmlspecialchars($currentSemester) . "</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>Student ID</th><th>Student Name</th><th>Grade</th><th>Action</th></tr>";
                }

                echo "<tr>";
                echo "<form method='post'onsubmit='return UpdateGrade()'>";
                echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>";
                echo "<select name='grade'>";
                $grades = ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'F'];
                foreach ($grades as $grade) {
                    $selected = $grade == $row['grade'] ? 'selected' : '';
                    echo "<option value='$grade' $selected>$grade</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<input type='hidden' name='student_id' value='" . htmlspecialchars($row['student_id']) . "'>";
                echo "<input type='hidden' name='course_id' value='" . htmlspecialchars($courseId) . "'>";
                echo "<input type='submit' name='update_grade' value='Update Grade'>";
                echo "</td>";
                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
        } elseif (isset($_POST['search'])) {
            echo "<p>No students found for this course.</p>";
        }
        ?>

        <div style="margin-top: 20px;">
            <a href="../Teacher/homepage.php" class="button">Back to Homepage</a>
        </div>

    </div>
</body>
</html>
