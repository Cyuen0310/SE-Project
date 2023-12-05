
<!DOCTYPE html>
<html>
<head>
    <title>View Student Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
    <div class="container">
        <?php 
            session_start();
            include_once('../navbar.php');

            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include "../db_conn.php";
        ?>
        <div class="search-form">
            <form action="" method="post">
                <input type="text" name="search_query" placeholder="Enter Student Name or ID">
                <input type="submit" name="search" value="Search">
            </form>
        </div>
        <?php

            if (isset($_POST['search'])) {
                $searchQuery = mysqli_real_escape_string($conn, $_POST['search_query']);

                // Adjusted SQL to search by name or ID
                $sql = "SELECT * FROM Student WHERE (userid = '$searchQuery' OR name LIKE '%$searchQuery%') AND userid != 'admin'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<h2>Student Personal Information</h2>";
                    echo "<table>";
                    echo "<tr><th>Student ID</th><th>Name</th><th>Gender</th><th>Birth</th><th>Admission Date</th><th>Address</th><th>Personal Phone No.</th><th>Personal Email</th></tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['userid']) . "</td>";
                        echo "<td>" . strtoupper(htmlspecialchars($row['name'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['birth']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Admission_Date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phoneNum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No student found with the provided information.";
                }
            }
        ?>
        

        <a href="../Teacher/homepage.php" class="button">Go Back</a>
    </div>
</body>
</html>
