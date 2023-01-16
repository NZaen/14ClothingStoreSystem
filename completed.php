<?php

session_start();
include("connection.php");

$Sid = $_GET['completed'];

$sql = "UPDATE shipment SET status='completed' WHERE Sid=$Sid";
mysqli_query($con, $sql);
header("Location: adminshipment.php");
    
?>