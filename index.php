
<?php 
  session_start();
  if(isset($_COOKIE['Userid']) && isset($_COOKIE['Password']) && isset($_COOKIE['Usertype']) )
  {
    $id = $_COOKIE['Userid'];
    $pass = $_COOKIE['Password'];
    $Usertype = $_COOKIE['Usertype'];

  }
  else
  {
    $id = "";
    $pass = "";
    $Usertype = "";

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
  <link rel="stylesheet" href="css/loginpage.css">
  
</head>

<body>
<form action="login.php" method="post">



  <header>
    <h2 class="logo">School of Science and Technology academic record</h2>
  </header>
          <?php if (isset($_GET['error'])) { ?>
     		  <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
  <div class="box">
      <div class="login form-box">

          

          <h2>Login</h2>
        
          <div class="input-box">
          <span class="icon"></span>
          <ion-icon name="mail-outline"></ion-icon>
          <input name="Userid" id="Userid"  type="text"   required value = <?php echo $id ?>>
          <label>User ID</label>
          </div>

          <div class="input-box"> 
            <span class="icon"></span>
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input name="Password" id="Password"  type="password" required value = <?php echo $pass ?> >
            <label>Password</label>    
          </div>

            <div class="rememberbox">
                <label><input type="checkbox" name="rememberMe" <?php echo isset($_COOKIE['Userid']) ? 'checked' : ''; ?>>Remember Me</label>
                <a href="#">Forgot password?</a>
            </div>
            <input type="radio" name="userType" value="Teacher" <?php echo $Usertype == 'Teacher' ? 'checked' : ''; ?>>
            <label for="staff">Staff</label>

            <input type="radio" name="userType" value="Student" <?php echo $Usertype == 'Student' ? 'checked' : ''; ?>>
            <label for="student">Student</label>

            <button id="submitbtn" type="submit">Login</button>

        </form>
      </div>
  </div>

  <!--<script src="loginscript.js"></script>-->
  <script src="pagechanger.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>