<?php
    session_start();
    $Userid = $_SESSION['Userid'];
    $UserType = $_SESSION['UserType'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <title>Home page</title>
    <link rel="stylesheet" href="../homepage.css" />
    <link rel="stylesheet" href="../css/globle-style.css" />
  </head>
  <body>
    <div class="container">
      <?php include_once('C:\hkmu\web workspace\final\Project\navbar.php') ?>
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



          <!-- Taught Courses content here -->   
            <?php if ($Userid === 'admin'): ?>
            <?php else: ?>
            <div id="taughtCourses" class="content-section">
              <a href="taughtCourse.php">Courses</a> 
            </div>
            <?php endif; ?>
      



        <div id="DepartmentCourses" class="content-section">
            <?php if ($Userid === 'admin'): ?>
              <a href="../admin/departmentCourse.php">View department Courses</a>
            <?php else: ?>
              <a href="departmentCourse.php">View department Courses</a>
            <?php endif; ?>
        </div>

        <div id="SearchStudent" class="content-section">
          <!-- Taught Courses content here -->
          <a href="searchStudent.php">Search student information</a>    
        </div>


        <div id="SearchCourse" class="content-section">
          <!-- Taught Courses content here -->
          <a href="searchCourse.php">Search course information</a>    
        </div>

      </div>
    </div>


    <script src="../realtime.js"></script>
  </body>
</html>
