<?php 
session_start();

    $id = $_SESSION['id'];

    include("connection.php");
    $Pid = $_GET['subject'];
    $bamount= $_GET['subject2'];
    $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE pid=$Pid";
    $result = mysqli_query($con, $sql);
    while($row = $result->fetch_assoc())
    {
        $Pid = $row['Pid'];
        $Pname = $row['Pname'];
        $price = $row['price'];
        $amount = $row['amount'];
        $category = $row['category'];
        $fileExt = $row['fileExt'];
        $filename = 'Product' . $Pid . '.' . $fileExt;
    }
    $available = $amount - $bamount;

    $query = "UPDATE product SET amount=$available  WHERE pid=$Pid";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO shipment (Sid, Pid, id, amount, status) VALUES ('0', '$Pid', '$id', '$bamount','shipping')";
    $result = mysqli_query($con, $query);

    header("Location: shipment.php");

?>