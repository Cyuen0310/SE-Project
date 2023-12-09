

<?php 


    function validate($data)
     {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

function calculateGradePoint($grade) {
    $gradePoints = [
        'A' => 4.0,
        'A-' => 3.7,
        'B+' => 3.3,
        'B' => 3.0,
        'B-' => 2.7,
        'C+' => 2.3,
        'C' => 2.0,
        'F' => 0.0
    ];

    // Check if the grade exists in the array, return the corresponding grade point
    // If the grade is not found, return 0
    return isset($gradePoints[$grade]) ? $gradePoints[$grade] : 0;
}


function checkAccess($currentPage, $UserType) {
    $allowedRoles = [
        '/SE-Project/Student/homepage.php' => ['Student'],
        '/SE-Project/Teacher/homepage.php' => ['Teacher'],
        '/SE-Project/Student/searchCourse.php' => ['Student'],
        '/SE-Project/Teacher/searchCourse.php' => ['Teacher'],

    
    ];

    if (!in_array($UserType, $allowedRoles[$currentPage])) {
        // Redirect to an error page or homepage
        header("Location: ../index.php?no_access");
        exit();
    }
}



?>

