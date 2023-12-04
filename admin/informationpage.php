<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
    

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
        include "../navbar.php";

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
                echo 'Personal Phone No.: <input type="text" name="phone"  pattern="\d{8}" title="Please enter exactly 8 digits" maxlength="8" minlength="8" value="' . htmlspecialchars($row['phoneNum']) . '"><br>';
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
