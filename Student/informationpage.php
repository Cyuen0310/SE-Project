<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include "../db_conn.php";
    include "../utils.php";
    session_start();

    $Userid = $_SESSION['Userid'];
    $Name = strtoupper($_SESSION['Name']);
    $Birth = $_SESSION['Birth'];
    $Gender = $_SESSION['Gender'];
    $Address = $_SESSION['Address'];
    $Email = $_SESSION['Email'];
    $phoneNum = $_SESSION['Personal phone no.'];
    $Nationality = $_SESSION['Nationality'];
    $admissionYear = $_SESSION['Admission Year'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['save'])) 
        {
            $updateAddress = validate($_POST['address']);
            $updatePhone = validate($_POST['phoneNum']);
            $updateEmail = validateEmail($_POST['email']);
            
            if ($updateEmail == false) 
            {
                    header("Location:homepage.php?error=Error updating information: ");
                    exit();
            } 
            else 
            {
                $sql = "UPDATE Student SET address = '$updateAddress', email = '$updateEmail', phoneNum = '$updatePhone' WHERE userid = '$Userid'" ;
                if (mysqli_query($conn, $sql)) 
                {
                    $_SESSION['Address'] = $updateAddress;
                    $_SESSION['Personal phone no.'] = $updatePhone;
                    $_SESSION['Email'] = $updateEmail;
                    header("Location:homepage.php?success=Information updated successfully");
                    exit();
                } 
                else 
                {
                    header("Location:homepage.php?error=Error updating information: " . mysqli_error($conn));
                    exit();
                }
            }
        }
    }
    function validateEmail($email){
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; 
        }
        return $email;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/infopage-style.css" />

</head>
<body>
<div class="container">
<?php include_once('../navbar.php') ?>
    <div class="info-container">

        <div>
            <label for="name">Name:</label>
            <span><?php echo htmlspecialchars($Name, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div>
            <label for="student_id">Student ID:</label>
            <span><?php echo htmlspecialchars($Userid, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <span><?php echo htmlspecialchars($Gender, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div>
            <label for="birth">Birth:</label>
            <span><?php echo htmlspecialchars($Birth, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div>
            <label for="admission_year">Admission Year:</label>
            <span><?php echo htmlspecialchars($admissionYear, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
    </div>

    <form action="informationpage.php" method="POST" onsubmit='return confirmedit()'>
        <div class="info-container">
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($Address, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div>
                <label for="phoneNum">Personal Phone No.:</label>
                <input type="text" id="phoneNum" name="phoneNum" pattern="\d{8}" title="Please enter exactly 8 digits" maxlength="8" minlength="8" value="<?php echo htmlspecialchars($phoneNum, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div>
                <label for="email">Personal Email:</label>
                <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" value="<?php echo htmlspecialchars($Email, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div>
                <button name="save" type="submit">Save</button>
            </div>
        </div>
    </form>
            <script type="text/javascript">
            function confirmedit() {
                return confirm('Are you sure you want to save the changes?');
            }
        </script>
</div>
</body>
</html>