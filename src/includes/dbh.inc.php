<?php

$serverName = "localhost";
$dbUsername = "root";

// For MAMP use this password
$dbPassword = "root";
// For xampp use this password
$dbPassword2 = "";

$dbName = "store14";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
}