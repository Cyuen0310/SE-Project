<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
<div class="container">
<?php 
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once('../navbar.php');

    include "../db_conn.php"; // Ensure the path is correct

    if (isset($_GET['userid'])) {
        $userId = mysqli_real_escape_string($conn, $_GET['userid']);
        $courseId = mysqli_real_escape_string($conn, $_GET['course_id']);

        $sql = "SELECT * FROM Student WHERE userid = '$userId'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h1>Student Personal Information</h1>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Student ID</th>";
            echo "<th>Name</th>";
            echo "<th>Address</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Email</th>";
            echo "<th>Nationality</th>";
            echo "<th>Admission Date</th>";
            echo "<th>Gender</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['userid']) . "</td>";
            echo "<td>" . strtoupper(htmlspecialchars($row['name'])) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phoneNum']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nationality']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Admission_Date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "User not found.";
        }
    } else {
        echo "No User ID provided.";
    }
?>
<a href="viewCourse.php?course_id=<?php echo htmlspecialchars($courseId); ?>" class="button">Back to list</a>
</div>
</body>
</html>
