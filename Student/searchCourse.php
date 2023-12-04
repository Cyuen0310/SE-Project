<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include "../db_conn.php";

    $searchResult = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $courseCode = mysqli_real_escape_string($conn, $_POST['course_code']);

        $sql = "SELECT c.course_name, c.course_id, c.course_type, c.credit, c.department , s.name as lecturer FROM Course c LEFT JOIN Staff s ON c.lecturer = s.userid WHERE c.course_id = '$courseCode'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $searchResult = mysqli_fetch_assoc($result);
        } else {
            $searchResult = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
    <link rel="stylesheet" href="../css/searchCourse-style.css" />
</head>
<body>
    <div class="container">
    <?php include_once('../navbar.php') ?>
        <h2>Search Course Information</h2>
        <form action="" method="post">
            <input type="text" name="course_code" placeholder="Enter Course Code" required>
            <input type="submit" name="search" value="Search">
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                if ($searchResult) {
                    echo "<h3>Course Details</h3>";
                    echo "<table>";
                    echo "<tr><th>Department</th><th>Course Code</th><th>Course Title</th><th>Category</th><th>Credit</th><th>Lecturer</th></tr>";
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($searchResult['department']) . "</td>";
                    echo "<td>" . htmlspecialchars($searchResult['course_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($searchResult['course_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($searchResult['course_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($searchResult['credit']) . "</td>";
                    echo "<td>" . htmlspecialchars($searchResult['lecturer']) . "</td>";

                    echo "</tr>";
                    echo "</table>";
                } elseif ($searchResult === false) {
                    echo "<p>No results found for the entered course code.</p>";
                }
            }
        ?>

            <div style="margin-top: 20px;">
        <a href="homepage.php" class="back-button">Back to Homepage</a>
    </div>


    </div>
    
</body>
</html>
