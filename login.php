<?php

// database connection 
include "db_conn.php";
include "utils.php";
session_start();

  
  if (isset($_POST['Userid']) && isset($_POST['Password'])){
    $Userid = strtolower(validate($_POST['Userid']));
    $Password = password_hash(validate($_POST['Password']),PASSWORD_DEFAULT); 
    $Usertype = $_POST["userType"];


    if($Usertype == "Teacher")
    {
      $sql = "SELECT * FROM Staff WHERE userid='$Userid' ";

    }
    else if ($Usertype == "Student")
    {
      $sql = "SELECT * FROM Student WHERE userid='$Userid' ";
    }

      
    

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_assoc($result);                                                                              
      if($row['userid'] == $Userid && password_verify($row['password'],$Password )){

        $_SESSION['Userid'] = $row['userid'];
        $_SESSION['Name'] = $row['name'];
        $_SESSION['Birth'] = $row['birth'];
        $_SESSION['Gender'] = $row['gender'];
        $_SESSION['Address'] = $row['address'];
        $_SESSION['Email'] = $row['email'];
        $_SESSION['Personal phone no.'] = $row['phoneNum'];
        $_SESSION['Nationality'] = $row['nationality'];
        $_SESSION['Admission Year'] = date('Y',strtotime($row['Admission_Date']));
        $_SESSION['UserType'] = $_POST["userType"];
        

        if(isset($_POST['rememberMe']))
        {
          setcookie('Userid', $Userid, time() + (86400 * 30));
          setcookie('Password', $_POST['Password'], time() + (86400 * 30));
          setcookie('Usertype', $Usertype, time() + (86400 * 30)); // 30 days
        }
        else{
          setcookie("Userid", "", time() - 3600);
          setcookie("Password", "", time() - 3600);
          setcookie("Usertype", "", time() - 3600);
        }
        
        $redirectUrl = $Usertype == "Student" ? "Student/homepage.php" : "Teacher/homepage.php";
        header("Location: $redirectUrl");
        exit();
      }
      else{
        header("Location: index.php?error=Incorrect User id or password");
        exit();
      }
    }
    else{
      header("Location: index.php?error=Incorrect User id or password");
      exit();
      }
    
  } 
  else{
      header("Location: index.php?error=cannot receive User id or password");
      exit();
  }

?>
