<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../db_conn.php"; // Ensure the path is correct

    if (isset($_GET['userid'])) {
        $userId = mysqli_real_escape_string($conn, $_GET['userid']);
        $courseId = mysqli_real_escape_string($conn, $_GET['course_id']);

        $sql = "SELECT * FROM Student WHERE userid = '$userId'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h1>Student Personal Information</h1>";
            echo "<table>";
            echo "<tr><td>Student ID:</td><td>" . htmlspecialchars($row['userid']) . "</td></tr>";
            echo "<tr><td>Name:</td><td>" . strtoupper(htmlspecialchars($row['name'])) . "</td></tr>";
            echo "<tr><td>Address:</td><td>" . htmlspecialchars($row['address']) . "</td></tr>";
            echo "<tr><td>Phone Number:</td><td>" . htmlspecialchars($row['phoneNum']) . "</td></tr>";
            echo "<tr><td>Email:</td><td>" . htmlspecialchars($row['email']) . "</td></tr>";
            echo "<tr><td>Nationality:</td><td>" . htmlspecialchars($row['nationality']) . "</td></tr>";
            echo "<tr><td>Admission Date:</td><td>" . htmlspecialchars($row['Admission_Date']) . "</td></tr>";
            echo "<tr><td>Gender:</td><td>" . htmlspecialchars($row['gender']) . "</td></tr>";

            echo "</table>";
        } else {
            echo "User not found.";
        }
    } else {
        echo "No User ID provided.";
    }
?>
<a href="updateCourseResult.php?course_id=<?php echo htmlspecialchars($courseId); ?>">Back to list</a>

</body>
</html>
