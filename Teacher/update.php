<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include "../db_conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grades']) && isset($_POST['course_id'])) {
        $courseId = mysqli_real_escape_string($conn, $_POST['course_id']);
        $grades = $_POST['grades'];

        // Start a transaction
        mysqli_begin_transaction($conn);

        try {
            foreach ($grades as $studentId => $grade) {
                $studentId = mysqli_real_escape_string($conn, $studentId);
                $grade = mysqli_real_escape_string($conn, $grade);

                $sql = "UPDATE EnrolledCourse SET grade = '$grade' WHERE student_id = '$studentId' AND course_id = '$courseId'";
                if (!mysqli_query($conn, $sql)) {
                    throw new Exception("Error updating record: " . mysqli_error($conn));
                }
            }

            // Commit the transaction
            mysqli_commit($conn);

            // Optionally, redirect back to a specific page
            header("Location: homepage.php");
            exit();


        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            mysqli_rollback($conn);
            echo "An error occurred: " . $e->getMessage();
        }
    } else {
        header("Location: homepage.php");
        exit();


    }
?>
