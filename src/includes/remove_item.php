<?php

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if (!isset($_GET["productID"])){

    header ("location: ../cart.php?error=productAlreadyRemove");
    exit();
}

else{

    $order = $_GET["orderID"];
    $product_id = $_GET["productID"];
    remove_item_from_order($conn, $order, $product_id);
    header("location: ../cart.php?itemRemove");
    exit();
}