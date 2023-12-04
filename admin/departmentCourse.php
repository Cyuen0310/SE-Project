<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../db_conn.php";

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1500px;
            background-color: white;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #e7e7e7;
        }

        .edit-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #45a049;
        }
        form {

        padding: 20px;
        border-radius: 8px;
        max-width: 500px;
        margin: 20px auto;
    }

    form input[type="text"],
    form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    form input[type="text"] {
        background-color: #f8f8f8;
    }

    form input[type="text"]:disabled {
        background-color: #e8e8e8;
    }

    form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        border: none;
    }

    form input[type="submit"]:hover {
        background-color: #45a049;
    }

    form br {
        display: none;
    }

    form label {
        font-weight: bold;
    }
    </style>
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
            <a href="../Teacher/homepage.php" class="back-button">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
