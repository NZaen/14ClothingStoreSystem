<?php

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if (isset($_POST["submit"])){

    $customer_id = $_POST["customer_id"];
    $order_status = "To Pay";
    $amount = 0.00;

    $product_id = $_POST["product_id"];
    $product = getProduct($conn, $product_id);
    $size = $_POST["product_size"];
    $quantity = $_POST["quantity"];
    $total_price = ($product["product_price"]) * ($quantity);

    if ($customer_id == "none"){
        header("location: ../product.php?PleaseLoginFirst");
        exit();
    }

    else if (!newOrder($conn, $customer_id)){
        $order_id = getOrderID($conn, $customer_id);

        if (!itemAdded($conn, $order_id, $product_id)){
            add_item_to_order($conn, $order_id, $product_id, $quantity, $total_price, $size);
        }
        else{
            updateOrder($conn, $order_id, $product_id, $quantity, $total_price, $size);
            header("location: ../product.php?itemAdded");
            exit();
        }
        
    }
    else{
        createOrder($conn, $customer_id, $order_status, $amount);
        $order_id = getOrderID($conn, $customer_id);
        add_item_to_order($conn, $order_id, $product_id, $quantity, $total_price, $size);
    }
    
}

else{
    header("location: ../product.php?error=addOrder");
    exit();
}