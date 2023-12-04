<?php
    session_start();
    $Userid = $_SESSION['Userid'];
    $UserType = $_SESSION['UserType'];
    $name = $_SESSION['Name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <title>Home page</title>
    <link rel="stylesheet" href="../homepage.css" />
  </head>
  <body>
    <div class="container">
      <div class="navbar">
        <div class="welcome">
          <h1>Welcome,</h1>
          <h1 id="UserId"><?php echo $name; ?></h1>
        </div>

        <nav>
          <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="../index.php">LOGOUT</a></li>
          </ul>
        </nav>
        
      </div>
      <div class="row">
        <div class="datetime">
          <div class="date">
            <span id="month">Month</span>
            <span id="daynum">00</span>
            <span id="year">Year</span>
            <br />
            <span id="dayname">Day</span>
          </div>

          <div class="time">
            <span id="hour">00</span>
            <a>:</a>
            <span id="minutes">00</span>
            <a>:</a>
            <span id="seconds">00</span>
            <span id="period">AM</span>
          </div>
        </div>

        <div id="personalData" class="content-section">
          <!-- Personal Data content here -->
          <?php if ($Userid === 'admin'): ?>
              <a href="../admin/informationpage.php">Personal information</a>
          <?php else: ?>
              <a href="informationpage.php">Personal information</a>
          <?php endif; ?>

        </div>

        <div id="enrolledCourses" class="content-section">
          <!-- Enrolled Courses content here -->
          <?php if ($Userid === 'admin'): ?>
              <a href="../admin/CourseEnrollment.php">Enrolment Statement</a>
          <?php else: ?>
              <a href="CourseEnrollment.php">Enrolment Statement</a>
          <?php endif; ?>
        </div>

          <div id="academic result" class="content-section">
          <!-- Enrolled Courses content here -->
          <?php if ($Userid === 'admin'): ?>
              <a href="../admin/CourseEnrollment.php">Academic Result</a>
          <?php else: ?>
              <a href="viewresult.php">Academic Result</a>
          <?php endif; ?>
        </div>



        <div id="searchCourses" class="content-section">
          <!-- Course information here -->
          <?php if ($Userid === 'admin'): ?>
              <a href="../admin/searchCourse.php">Course information</a>
          <?php else: ?>
              <a href="searchCourse.php">Course information</a>
          <?php endif; ?>
        </div>


      </div>
    </div>


    <script src="../realtime.js"></script>
  </body>
</html>


