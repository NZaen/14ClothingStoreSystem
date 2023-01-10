<?php
ini_set("diplay errors", "1");
error_reporting(E_ALL);

echo "this is not working";
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $Uname = $_POST['Uname'];
        $cname = $_POST['cname'];
        $tel_no = $_POST['tel_no'];
        $email = $_POST['email'];
        $pw = $_POST['pw'];
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
    $sql = "INSERT INTO registration (id, Uname, cname, tel_no, email, pw) VALUES ('0', '$Uname', '$cname', '$tel_no','$email','$pw')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Entries added!";
        header('Location: login.html');
    }
  
    // close connection
    mysqli_close($con);

?>