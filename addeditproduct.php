<?php
if(isset($_POST['submit']))
{
    $Pname = $_POST['Pname'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    //$files = $_POST['file'];

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "14store";

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "INSERT INTO product (Pid, Pname, price, category,fileExt) VALUES ('0', '$Pname', '$price', '$category', '$fileActualExt')";

    mysqli_query($con, $sql);

    $sql = "SELECT Pid FROM product ORDER BY Pid DESC LIMIT 1";
    $result = mysqli_query($con, $sql);

    $allowed = array('jpg', 'jpeg', 'png');

    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $Pid = $row['Pid'];
            $sqlImg = "INSERT INTO productimg (Pid, status, fileExt) VALUES ('$Pid', 1, '$fileActualExt')";
            mysqli_query($con, $sqlImg);
        }
    } 

    if(in_array($fileActualExt, $allowed))
    {
        if($fileError === 0)
        {
            if($fileSize < 10000000)
            {
                $fileNameNew = "Product".$Pid.".".$fileActualExt;
                $fileDestination = 'imguploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                $sql = "UPDATE productimg SET status=0 WHERE Pid='$Pid';";
                $result = mysqli_query($con, $sql);
                header("Location: addeditproduct.html?uploadsuccess");
            }else
            {
                echo "Your file is too big";
            }
        }else
        {
            echo "There was an error uploading your file";
        }
    }else
    {
        echo "You cannot uplaod files of this type";
    }
}
?>