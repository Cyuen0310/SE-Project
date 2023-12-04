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
    <link rel="stylesheet" href="../css/homepage.css" />
  </head>
  <body>
    <div class="container">
      <?php include_once('../navbar.php') ?>
      <div class="row">


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
              <a href="../Student/searchCourse.php">Course information</a>
          <?php else: ?>
              <a href="searchCourse.php">Course information</a>
          <?php endif; ?>
        </div>


      </div>
    </div>
  </body>
</html>


