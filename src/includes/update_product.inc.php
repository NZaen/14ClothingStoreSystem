<?php

if (isset($_POST["submit"])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_category = $_POST["product_category"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];

    if (empty($_FILES["product_image"]["name"])){
        $product =  getProduct($conn,$product_id);
        $product_image_name = $product["product_image"];
    }
    else{
        $product_image = $_FILES["product_image"];
        $product_image_name = $product_image["name"];
        $image_tmp_name = $_FILES["product_image"]["tmp_name"];
    
        //Set the destination directory for the image
        $destination = "../Assets/";
        // Move the uploaded file to the destination directory
        move_uploaded_file($image_tmp_name, $destination.$product_image_name);

        if (!validate_image_type($product_image)) {
            header("location: ../updateProduct.php?productID=$product_id?error=invalidImageFile");
            exit();
        }    
        
        if (!validate_image_size($product_image, 1000000)) {
            header("location: ../updateProduct.php?productID=$product_id?error=invalidImageSize");
            exit();
        }
    }

    updateProduct($conn, $product_id, $product_name, $product_category, $product_description, $product_price, $product_image_name);
}

else {
    header("location: ../updateProduct.php?productID=$product_id?error=f");
}