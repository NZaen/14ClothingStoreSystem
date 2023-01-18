<?php

function check_login() {
    if (!isset($_SESSION['userID'])) {
        header("location: ../login.php?error=f");
        exit();
    }
}

function emptyInputSignup($username, $name, $email, $pwd, $pwdRepeat) {
    $result;
    if (empty($username) || empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUID($username) {
    $result;
    if (preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = false;
    }
    else {
        $result = true;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = false;
    }
    else {
        $result = true;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if ($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function check_word_contains($word, $substring) {
    return (stristr($word, $substring) !== false);
}

function isAdmin(){
    if (!isset($_SESSION['admin'])) {
        header("location: ../login.php?error=f");
        exit();
    }
}

function loginAdmin($conn, $username, $pwd){
    $sql = "SELECT * FROM admin WHERE username = ? AND admin_password = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $pwd);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($admin = mysqli_fetch_assoc($resultData)){
        session_start();
        $_SESSION['admin'] = $admin['username'];
        return true;
    }
    return false;
    mysqli_stmt_close($stmt);
}

function uidExist($conn, $username, $email){
    $sql = "SELECT * FROM customer WHERE customerUsername = ? OR customerEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $name, $email, $pwd){
    $sql = "INSERT INTO customer (customerUsername, customerName, customerEmail, customerPassword) VALUES(?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $username, $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password){
    $uidExist = uidExist($conn, $username, $username);

    if ($uidExist === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }

    $pwdHashed = $uidExist['customerPassword'];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../login.php?error=wrongPassword");
        exit();
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["userID"] = $uidExist["customerID"];
        $_SESSION["userUID"] = $uidExist["customerUsername"];
        $_SESSION["userName"] = $uidExist["customerName"];
        $_SESSION["userEmail"] = $uidExist["customerEmail"];
        $_SESSION["userPhone"] = $uidExist["phone_number"];
        $_SESSION["userAddress"] = $uidExist["home_address"];
        header("location: ../product.php?success=loginSuccessful");
        exit();
    }
}

function updateCustomerData($conn, $customerID, $customerName, $customerEmail, $customerPhone, $customerAddress){
    $sql = "UPDATE customer SET customerName = ?, customerEmail = ?, phone_number = ?, home_address = ? WHERE customerID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../profile.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssi", $customerName, $customerEmail, $customerPhone, $customerAddress, $customerID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    session_start();
    $_SESSION["userPhone"] = $customerPhone;
    $_SESSION["userAddress"] = $customerAddress;
    $_SESSION["userName"] = $customerName;
    $_SESSION["userEmail"] = $customerEmail;
}

// function to check product image file type
function validate_image_type($image) {
    // Allowed image types
    $allowed_types = array("image/jpeg", "image/png", "image/jpg");
    // Get the image type
    $image_type = $image["type"];
    // Check if the image type is in the allowed types
    if (!in_array($image_type, $allowed_types)) {
        return false;
    }
    return true;
}


// function to check image size
function validate_image_size($image, $max_size) {
    // Get the image size
    $image_size = $image["size"];
    // Check if the image size is less than the maximum size
    if ($image_size > $max_size) {
        return false;
    }
    return true;
}


function insertProduct($conn, $name, $category, $description, $price, $image){
    $sql = "INSERT INTO products (product_name, product_category, product_description, product_price, product_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../products.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssds", $name, $category, $description, $price, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../productList.php?error=none");
    exit();
}

function updateProduct($conn, $id, $name, $category, $description, $price, $image){
    $sql = "UPDATE products SET product_name = ?, product_category = ?, product_description = ?, product_price = ?, product_image = ? WHERE product_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../updateProduct.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssdsi", $name, $category, $description, $price, $image, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../productList.php?update=success");
    exit();
}

function deleteProduct($conn, $id){
    $sql = "SELECT product_image FROM products WHERE product_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../productList.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $product_image);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // To delete image file in the Assets (server)
    $imgPath = ".." . DIRECTORY_SEPARATOR . "Assets" . DIRECTORY_SEPARATOR . $product_image;
    if (file_exists($imgPath)){
        unlink($imgPath);
    }

    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../productList.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../productList.php?productDeleted");
    exit();
}

function displayProducts($conn){
    $sql = "SELECT * FROM products";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function getProduct($conn, $id){
    $sql = "SELECT * FROM products WHERE product_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../productList.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        header("location: ../productList.php?error=productDoesNotExist");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function createOrder($conn, $customer, $order_status, $amount){
    $sql = "INSERT INTO orders (customer_id, order_status, amount) VALUES (?, ?, ?) ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "isd", $customer, $order_status, $amount);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function newOrder($conn, $customer){
    $sql = "SELECT * FROM orders WHERE customer_id = ? AND order_status = 'To Pay'";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $customer);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return false;
    }
    else{
        return true;
    }
    mysqli_stmt_close($stmt);
}

function updateOrder($conn, $order, $product, $quantity, $total_price, $size){
    $sql = "UPDATE order_items SET quantity = ?, total_price = ?, size = ? WHERE order_id = ? AND product_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "idiis", $quantity, $total_price, $order, $product, $size);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getOrderID($conn, $customer){
    $sql = "SELECT * FROM orders WHERE customer_id = ? AND order_status = 'To Pay'";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $customer);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($order = mysqli_fetch_assoc($resultData)){
        return $order["id"];
    }
    mysqli_stmt_close($stmt);
}

function displayOrder($conn, $customer){
    $sql = "SELECT * FROM orders WHERE customer_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $customer);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function add_item_to_order($conn, $order, $product, $quantity, $total_price, $size){
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, total_price, size) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iiids", $order, $product, $quantity, $total_price, $size);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../product.php?success=itemAddedToCart");
    exit();
}

function itemAdded($conn, $order, $product){
    $sql = "SELECT * FROM order_items WHERE order_id = ? AND product_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $order, $product);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($order = mysqli_fetch_assoc($resultData)){
        if ($order['product_id'] == $product){
            return true;
        }
    }
    else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function countItem($conn, $order){
    $sql = "SELECT COUNT(order_id) as item_order FROM order_items WHERE order_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $order);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($order = mysqli_fetch_assoc($result)){
        return $order['item_order'];
    }
    else{
        return 0;
    }
    mysqli_stmt_close($stmt);
}

function displayProductsByCategory($conn, $category){
    $sql = "SELECT * FROM products WHERE product_category = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $category);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function displayItemsCart($conn, $order){
    $sql = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $order);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function totalAmount($conn, $order){
    $sql = "UPDATE orders SET amount = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../product.php?error=stmtFailed");
        exit();
    }

    $amount = 0.00;

    $getItems = displayItemsCart($conn, $order);
    foreach($getItems as $item){
        $amount = $item['total_price'] + $amount;
    }

    mysqli_stmt_bind_param($stmt, "di", $amount, $order);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return number_format($amount,2,'.','');
}

function remove_item_from_order($conn, $order, $product){
    $sql = "DELETE FROM order_items WHERE order_id = ? AND product_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../cart.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $order, $product);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Function to update order status after customer checkout
function updateOrderStatus($conn, $orderID ,$order_status){
    $sql = "UPDATE orders SET order_status = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../cart.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $order_status, $orderID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getCustomerDetailFromOrder($conn, $customer_id){
    $sql = "SELECT * FROM customer WHERE customerID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../customer_list.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $customer_id);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    mysqli_stmt_close($stmt);
}

function customerOrderList($conn){
    $sql = "SELECT * FROM orders";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../customer_list.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function sendFeedback($conn, $name, $email, $comment){
    $sql = "INSERT INTO feedback (customer_name, customer_email, customer_comment) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../contact.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $comment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function displayFeedback($conn){
    $sql = "SELECT * FROM feedback";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_feedback.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $data;
    mysqli_stmt_close($stmt);
}

function countNumOfUsers($conn){
    $sql = "SELECT * FROM customer";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_home.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return count($data);
    mysqli_stmt_close($stmt);
}

function countNumOfProducts($conn){
    $sql = "SELECT * FROM products";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_home.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return count($data);
    mysqli_stmt_close($stmt);
}

function countNumOfOrders($conn, $order_status){
    $sql = "SELECT * FROM orders WHERE order_status = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_home.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $order_status);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return count($data);
    mysqli_stmt_close($stmt);
}

function countNumOfFeedback($conn){
    $sql = "SELECT * FROM feedback";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_home.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return count($data);
    mysqli_stmt_close($stmt);
}