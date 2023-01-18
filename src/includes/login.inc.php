<?php

if (isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyInput");
        exit();
    }
    if (loginAdmin($conn, $username, $pwd) !== false){
        header("location: ../admin_home.php");
        exit();
    }

    loginUser($conn, $username, $pwd);

}
else {
    header("location: ../login.php");
}