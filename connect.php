<?php
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "clusternamnoi";
    
    $con = mysqli_connect($serverName,$userName,$userPassword,$dbName);
    if (!$con) {
        echo $con->connect_error;
        exit();
    }
    mysqli_set_charset($con, 'utf8');
?>