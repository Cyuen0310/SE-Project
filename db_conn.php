<?php
    $db_server = "0.0.0.0";
    $db_user = "root";
    $db_pass = "";
    $db_name = "ARS";
    $conn = "";


    try
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        
    }
    catch(mysqli_sql_exception)
    {
        echo "Unable to connect to MySQL. <br> ";
    }
    

?>