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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        .info-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .info-container > div {
            margin-bottom: 10px;
        }
        .info-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .info-container span {
            padding: 8px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            display: block;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px 0;
            display: block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
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

    <form action="informationpage.php" method="POST">
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
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($Email, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div>
                <button name="save" type="submit">Save</button>
            </div>
        </div>
    </form>
</body>
</html>