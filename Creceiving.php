<?php
session_start();
include("connection.php");

$Sid = $_GET['receiving']; 

$sql = "UPDATE shipment SET status='completed' WHERE Sid=$Sid";
mysqli_query($con, $sql);
header("Location: shipment.php");
?>