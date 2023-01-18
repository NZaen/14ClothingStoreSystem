<?php

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if (!isset($_GET["orderID"])){

    header ("location: ../trackOrder.php?error=orderDoesNotExist");
    exit();
}

else{

    $change_order_status = "Completed";    
    $order_id = $_GET["orderID"];

    updateOrderStatus($conn, $order_id, $change_order_status);
    sleep(1);
    header("location: ../trackOrder.php?orderReceive");
    exit();
}