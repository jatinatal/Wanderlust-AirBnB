<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "wanderlust";
    
    $conn = mysqli_connect($servername, $username, $password, $database);

    if($conn)
    {
        //echo("connection Ok");
    }
    else{
        die("connection failed".mysqli_connect_error());
    }
?>