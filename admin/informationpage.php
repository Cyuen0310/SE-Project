<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {background-color: #f5f5f5;}
        input[type="text"], input[type="email"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-button {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #ddd;
            color: black;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../Student/homepage.php" class="back-button">Go Back</a> <!-- Replace 'previous_page.php' with the actual previous page URL -->
        <form action="" method="post">
            <input type="text" name="search_id" placeholder="Enter Student ID">
            <input type="submit" name="search" value="Search">
        </form>

        <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        include "../db_conn.php"; // Ensure the path is correct

        session_start();

        if (isset($_POST['search'])) {
            $searchId = mysqli_real_escape_string($conn, $_POST['search_id']);

            $sql = "SELECT * FROM Student WHERE userid = '$searchId'";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                echo "<h2>Editing Information for Student ID: " . htmlspecialchars($row['userid']) . "</h2>"; // Displaying Student ID
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="userid" value="' . htmlspecialchars($row['userid']) . '">';
                echo 'Name: <input type="text" name="name" value="' . htmlspecialchars($row['name']) . '"><br>';
                echo 'Gender: <input type="text" name="gender" value="' . htmlspecialchars($row['gender']) . '"><br>';
                echo 'Birth: <input type="date" name="birth" value="' . htmlspecialchars($row['birth']) . '"><br>';
                echo 'Admission Date: <input type="date" name="admission_date" value="' . htmlspecialchars($row['Admission_Date']) . '"><br>';
                echo 'Address: <input type="text" name="address" value="' . htmlspecialchars($row['address']) . '"><br>';
                echo 'Personal Phone No.: <input type="text" name="phone" value="' . htmlspecialchars($row['phoneNum']) . '"><br>';
                echo 'Personal Email: <input type="email" name="email" value="' . htmlspecialchars($row['email']) . '"><br>';
                echo '<input type="submit" name="update" value="Update">';
                echo '</form>';
            } else {
                echo "No student found with ID: " . htmlspecialchars($searchId);
            }
        }

        if (isset($_POST['update'])) {
            $userid = mysqli_real_escape_string($conn, $_POST['userid']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $birth = mysqli_real_escape_string($conn, $_POST['birth']);
            $admission_date = mysqli_real_escape_string($conn, $_POST['admission_date']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $updateSql = "UPDATE Student SET name = '$name', gender = '$gender', birth = '$birth', Admission_Date = '$admission_date', address = '$address', phoneNum = '$phone', email = '$email' WHERE userid = '$userid'";
            if (mysqli_query($conn, $updateSql)) {
                header("Location:../Student/homepage.php?success=Information updated successfully");
            }
            else {
                echo "Error updating information: " . mysqli_error($conn);
            }
        }
        ?>
    </div>
</body>
</html>
