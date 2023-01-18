<?php

if (isset($_POST["submit"])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $customerID = $_POST["customer_id"];
    $customerName = $_POST["customer_name"];
    $customerEmail = $_POST["customer_email"];
    $customerPhone = $_POST["customer_phone"];
    $customerAddress = $_POST["customer_address"];

    updateCustomerData($conn, $customerID, $customerName, $customerEmail, $customerPhone, $customerAddress);
    header("location: ../profile.php?profileUpdated");
}

else {
    header("location: ../profile.php?error=f");
}