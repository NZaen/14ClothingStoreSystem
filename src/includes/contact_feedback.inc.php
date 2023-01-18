<?php

if (isset($_POST["submit"])){
    
    $name = $_POST["customer_name"];
    $email = $_POST["customer_email"];
    $comment = $_POST["customer_comment"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    sendFeedback($conn, $name, $email, $comment);
    header("location: ../contact.php?error=none");
    exit();

}
else {
    header("location: ../contact.php?error=f");
}