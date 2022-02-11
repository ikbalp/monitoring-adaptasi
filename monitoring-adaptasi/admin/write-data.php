<?php

    //Variabel database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbmonitoring";

    $conn = mysqli_connect("$servername", "$username", "$password","$dbname");

    // Prepare the SQL statement
    
    $result = mysqli_query ($conn,"INSERT INTO datasuhu (data) VALUES ('".$_GET["data"]."')");    
    
    if (!$result) 
        {
            die ('Invalid query: '.mysqli_error($conn));
        }  
?>


// reset index :::: alter table datasuhu auto_increment=0;