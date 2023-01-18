<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])){

    $change_order_status = "To Ship";
    $customer_order_address = $_POST["customer_address"];
    $order_id = $_POST["order_id"];

    updateOrderStatus($conn, $order_id, $change_order_status);
    sleep(3);
    header("location: ../checkout.php");
    exit();
}

else{
    header("location: ../cart.php");
}