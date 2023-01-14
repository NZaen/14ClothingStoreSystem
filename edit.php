<?php 
session_start();

    include("connection.php");

    if(isset($_GET['edit']))
    {
    $Pid = $Pid = $_GET['edit'];
    $query = "select * from product where Pid = $Pid";
    $result = mysqli_query($con, $query);
    $row = $result->fetch_array();
    $Pid = $row['Pid'];
    $Pname = $row['Pname'];
    $price = $row['price'];
    $amount = $row['amount'];
    $category = $row['category'];
    $fileExt = $row['fileExt'];
    $filename = 'Product' . $Pid . '.' . $fileExt;
    $tmpcategory = $category;
    $fileActualExttmp = $fileExt;
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form
    class="input-group-P"
    method="POST"
    enctype="multipart/form-data" 
    >
        <input type="hidden" name="Pid" value="<?php echo $Pid;?>" placeholder="Enter ID" required>
        <label>Name</label>
        <input type="text" name="Pname" value="<?php echo $Pname;?>" placeholder="Enter Product Name" required><br><br>
        <label>Price</label>
        <input type="text" name="price" value="<?php echo $price;?>" placeholder="Price" required><br><br>
        <label>Quantity</label>
        <input type="text" name="amount" value="<?php echo $amount;?>" placeholder="amount" required><br><br>
        <?php echo 'Current category is ', $category;?><br>
        
        <p>
          <label for="" class="label">Choose to edit category</label><br>
          <label for="shirts">Shirts</label>
          <input type="radio" name="category" value="shirts" id="shirts" />
          <label for="pants">Pants</label>
          <input type="radio" name="category" value="pants" id="pants" />
          <label for="hats">Hats</label>
          <input type="radio" name="category" value="hats" id="hats" />
          <label for="watches">Watches</label>
          <input type="radio" name="category" value="watches" id="watches" />
          <label for="glasses">Glasses</label>
          <input type="radio" name="category" value="glasses" id="glasses" />
          <label for="belts">Belts</label>
          <input type="radio" name="category" value="belts" id="belts" />
          <label for="shoes">Shoes</label>
          <input type="radio" name="category" value="shoes" id="shoes" />
        </p>
        <p>
            <?php echo 'Current product picture'?><br>
            <img src="imguploads/<?php echo $filename?>" style="width: 30vw; min-width: 100px;"><br>
            
            <input type="file" name="file" /><br>
            <label for="upload">UPLOAD PIC</label>
        </p>

        <button type="submit" name="save">Save</button>
        <button><a href="addeditproduct.html">Cancel</a></button>
    </form>   
</body>
</html>
<?php


if (isset($_POST['save'])) 
{

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (!in_array($fileActualExt, $allowed)) 
    {
        $fileActualExt = $fileActualExttmp;
    }


    $Pid = $_POST['Pid'];
    $Pname = $_POST['Pname'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];

    if(isset($_POST['category']))
    {
        $category = $_POST['category'];
    }

    $query = "UPDATE product SET Pname='$Pname', price='$price', amount='$amount', category='$category', fileExt='$fileActualExt' WHERE Pid=$Pid";
    $result = mysqli_query($con, $query);

    $sql = "SELECT Pid FROM product ORDER BY Pid DESC LIMIT 1";
    $result = mysqli_query($con, $sql);

    $fileActualExt = strtolower(end($fileExt));

    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $Pid = $row['Pid'];
            $sqlImg = "UPDATE productimg SET status='1', fileExt='$fileActualExt' WHERE Pid=$Pid";
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
        header("Location: addeditproduct.html?uploadsuccess");
    }
    

    
}
?>