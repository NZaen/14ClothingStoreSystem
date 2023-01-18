<?php

if (isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($username, $name, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyInput");
        exit();
    }

    if (invalidUID($username) !== false) {
        header("location: ../signup.php?error=invalidUID");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordNotMatch");
        exit();
    }

    if (uidExist($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernameTaken");
        exit();
    }
    if (check_word_contains($username, "admin")){
        header("location: ../signup.php?error=f");
        exit();
    }

    createUser($conn, $username, $name, $email, $pwd);

}
else {
    header("location: ../signup.php");
}