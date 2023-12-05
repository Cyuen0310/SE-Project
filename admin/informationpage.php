<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Information</title>
    <link rel="stylesheet" href="../css/globle-style.css" />
</head>
<body>
    <div class="container">
        <?php 
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            session_start();
            include "../db_conn.php"; 
            include "../navbar.php";
        
        ?>
        <form action="" method="post">
            <h2>Edit Student Information</h2>
            <input type="text" name="search_id" placeholder="Enter Student ID">
            <input type="submit" name="search" value="Search">
        </form>
 

        <?php
            if (isset($_POST['search'])) {
                $searchId = mysqli_real_escape_string($conn, $_POST['search_id']);

                $sql = "SELECT * FROM Student WHERE userid = '$searchId'";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Edit Form Appears After Successful Search
                    echo "<h2>Student ID: " . htmlspecialchars($row['userid']) . "</h2>";
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="userid" value="' . htmlspecialchars($row['userid']) . '">';
                    echo '<div class="form-group">Name: <input type="text" name="name" value="' . strtoupper(htmlspecialchars($row['name'])) . '" class="form-control"></div>';
                    echo '<div class="form-group">Gender: <select name="gender" class="form-control">';
                    echo '<option value="M"' . ($row['gender'] == 'M' ? ' selected' : '') . '>Male</option>';
                    echo '<option value="F"' . ($row['gender'] == 'F' ? ' selected' : '') . '>Female</option>';
                    echo '</select></div>';
                    echo '<div class="form-group">Birth: <input type="date" name="birth" value="' . htmlspecialchars($row['birth']) . '" class="form-control"></div>';
                    echo '<div class="form-group">Admission Date: <input type="date" name="admission_date" value="' . htmlspecialchars($row['Admission_Date']) . '" class="form-control"></div>';
                    echo '<div class="form-group">Address: <input type="text" name="address" value="' . htmlspecialchars($row['address']) . '" class="form-control"></div>';
                    echo '<div class="form-group">Personal Phone No.: <input type="text" name="phone" pattern="\d{8}" title="Please enter exactly 8 digits" maxlength="8" minlength="8" value="' . htmlspecialchars($row['phoneNum']) . '" class="form-control"></div>';
                    echo '<div class="form-group">Personal Email: <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" value="' . htmlspecialchars($row['email']) . '" class="form-control"></div>';
                    echo '<div class="form-group"><input type="submit" name="update" value="Update" class="btn"></div>';
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
                } else {
                    echo "Error updating information: " . mysqli_error($conn);
                }
            }
        ?>


        <a href="../Student/homepage.php" class="button">Cancel</a>

 

        
    </div>
</body>
</html>
