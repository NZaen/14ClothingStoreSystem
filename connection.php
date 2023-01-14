<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "14store";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
    die("failed to connect");
}
?>