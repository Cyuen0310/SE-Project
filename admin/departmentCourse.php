<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    include "../db_conn.php";
    include "../navbar.php";

    $message = isset($_GET['message']) ? $_GET['message'] : '';
    $editCourseDetails = null;

    if (isset($_POST['update_course'])) {
        $courseIdToUpdate = mysqli_real_escape_string($conn, $_POST['course_id']);
        $courseName = mysqli_real_escape_string($conn, $_POST['course_name']);
        $courseCredit = mysqli_real_escape_string($conn, $_POST['course_credit']);
        $courseType = mysqli_real_escape_string($conn, $_POST['course_type']);
        $lecturer = strtolower(mysqli_real_escape_string($conn, $_POST['lecturer']));

        $updateSql = "UPDATE Course SET course_name = '$courseName', credit = '$courseCredit', course_type = '$courseType', lecturer = '$lecturer' WHERE course_id = '$courseIdToUpdate'";
        if (mysqli_query($conn, $updateSql)) {
            header("Location: departmentCourse.php?message=Course updated successfully");
            exit();
        } else {
            header("Location: departmentCourse.php?message=Error updating course: $error");
            exit();

        }
    } else if (isset($_POST['edit_course_id'])) {
        $editCourseId = mysqli_real_escape_string($conn, $_POST['edit_course_id']);
        $editSql = "SELECT * FROM Course WHERE course_id = '$editCourseId'";
        $editResult = mysqli_query($conn, $editSql);
        if ($editResult && mysqli_num_rows($editResult) > 0) {
            $editCourseDetails = mysqli_fetch_assoc($editResult);
        }
    }

    $sql = "SELECT * FROM Department";
    $Result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Courses</title>
    <link rel="stylesheet" href="../css/globle-style.css" />

</head>
<body>
    <div class="container">

        <?php if ($editCourseDetails): ?>
                <!-- Corrected form for editing course -->
                <form action="" method="post">

                <div>
                    <label for="course_id">Course ID: <?php echo htmlspecialchars($editCourseDetails['course_id']); ?> </label>
                    <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($editCourseDetails['course_id']); ?>">
                </div>
                <div>
                    <label for="course_name">Course Name:</label>
                    <input type="text" name="course_name" value="<?php echo htmlspecialchars($editCourseDetails['course_name']); ?>">
                </div>
                <div>
                    <label for="course_credit">Credit:</label>
                    <input type="text" name="course_credit" value="<?php echo htmlspecialchars($editCourseDetails['credit']); ?>">
                </div>
                <div>
                    <label for="course_type">Category:</label>
                    <input type="text" name="course_type" value="<?php echo htmlspecialchars($editCourseDetails['course_type']); ?>">
                </div>
                <div>
                    <label for="lecturer">Lecturer:</label>
                    <input type="text" name="lecturer" value="<?php echo htmlspecialchars($editCourseDetails['lecturer']); ?>">
                </div>
                <div>
                    <input type="submit" name="update_course" value="Update Course">
                </form>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($Result)): ?>
                <h2><?php echo htmlspecialchars($row['DepartmentName']); ?></h2>
                <?php
                    $dep = $row['Department'];
                    $courseSql = "SELECT * FROM Course c, Staff s WHERE c.department = '$dep' AND s.userid = c.lecturer";
                    $courseResult = mysqli_query($conn, $courseSql);
                ?>
                <table>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Credit</th>
                        <th>Category</th>
                        <th>Lecturer</th>
                        <th>Edit</th>
                    </tr>
                    <?php while ($courseRow = mysqli_fetch_assoc($courseResult)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($courseRow['course_id']); ?></td>
                            <td><?php echo htmlspecialchars($courseRow['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($courseRow['credit']); ?></td>
                            <td><?php echo htmlspecialchars($courseRow['course_type']); ?></td>
                            <td><?php echo "Dr " . strtoupper(htmlspecialchars($courseRow['name'])); ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="edit_course_id" value="<?php echo $courseRow['course_id']; ?>">
                                    <input type="submit" value="Edit" class="edit-button">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php endwhile; ?>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="../Teacher/homepage.php" class="button">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
