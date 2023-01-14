<?php 
session_start();

    include("connection.php");  

    if (isset($_GET['delete'])){
        $Pid =$_GET['delete'];
        $con->query("DELETE FROM product WHERE Pid=$Pid")or die(!$con);
        header("Location: addeditproduct.html");
    }


?>