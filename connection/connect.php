<?php

$con = new mysqli("localhost", "root", "");
if ($con->connect_error) {
    die("Connection Failed") . $con->error;
}

$sql = "create DATABASE IF NOT EXISTS Wanderlust";
$result = $con->query($sql);
$con->select_db("Wanderlust");
