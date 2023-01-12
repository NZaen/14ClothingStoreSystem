<?php
    if(isset($_POST['submit']))
    {
        $cname = $_POST['cname'];
        $tel_no = $_POST['tel_no'];
        $email = $_POST['email'];
        $comments = $_POST['comments'];
    }

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "14store";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "INSERT INTO contact (cname, tel_no, email, comments) VALUES ('$cname', '$tel_no','$email','$comments')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);

    $m = "Thank you for your feedback";

    if($rs)
    {
        header('Location: mainpage.html');
    }
  
    // close connection
    mysqli_close($con);

?>