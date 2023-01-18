<?php

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if (!isset($_GET["productID"])){

    header ("location: ../productList.php?error=productDoesNotExist");
    exit();
}

else{

    $product_id = $_GET["productID"];
    deleteProduct($conn, $product_id);
    sleep(1);
    header("location: ../productList.php?delete=productDeleted");
    exit();
}