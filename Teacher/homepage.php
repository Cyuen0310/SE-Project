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

      <?php include_once('../navbar.php') ?>


      <div class = "row">
        <div id="taughtCourses" class="content-section">
          <!-- Taught Courses content here -->   
            <?php if ($Userid === 'admin'): ?>
              <a href="../admin/EditCourseResult.php">Edit Courses Result (All Semester)</a> 
            <?php else: ?>
              <a href="taughtCourse.php">Edit Courses Result (Current Semester)</a> 
            <?php endif; ?>
         </div>



        <div id="DepartmentCourses" class="content-section">
            <?php if ($Userid === 'admin'): ?>
              <a href="../admin/departmentCourse.php">Edit department Courses</a>
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
