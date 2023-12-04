
<!DOCTYPE html>
<html>
<head>
    <title>View Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h3 {
            color: #333;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a.back-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        a.back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../Teacher/homepage.php" class="back-button">Go Back</a>
        <div class="search-form">
            <form action="" method="post">
                <input type="text" name="search_query" placeholder="Enter Student Name or ID">
                <input type="submit" name="search" value="Search">
            </form>
        </div>
        <?php 
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include "../db_conn.php";
            session_start();

            if (isset($_POST['search'])) {
                $searchQuery = mysqli_real_escape_string($conn, $_POST['search_query']);

                // Adjusted SQL to search by name or ID
                $sql = "SELECT * FROM Student WHERE userid = '$searchQuery' OR name LIKE '%$searchQuery%'";
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
    </div>
</body>
</html>
