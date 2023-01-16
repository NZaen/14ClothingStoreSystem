<?php 
session_start();

    include("connection.php");
    $Pid = $_GET['subject'];
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>14Store Admin Products Page</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul class="navigation">
          <div class="logo">
            <li><h1>14Store</h1></li>
          </div>
          <div class="page">
            <li><a href="custmain.html">Home</a></li>
            <li><a href="custproducts.php">Products</a></li>
            <li><a href="custcontacts.html">Contacts</a></li>
            <li><a href="custabout.html">About</a></li>
          </div>
          <div class="profile">
            <li><a href="logout.php">Sign out</a></li>
            <li>
              <a><img src="" alt="Profile Photo" /></a>
            </li>
          </div>
        </ul>
      </nav>
    </header>

    <main>
        <form method="POST" class="categories">
            <h3><?php echo $Pname ?></h3>
            <img src="imguploads/<?php echo $filename?>" style="width: 30vw; min-width: 100px;">
            <a>RM <?php echo $price ?></a><br>
            <a>pieces available: <?php echo $amount?></a>
            <input type="number" name="bamount" placeholder="Quantity" required>
            

            <p>
            <label for="" class="label">Payment Method</label>
            <label for="shirts">COD</label>
            <input type="radio" name="category" value="COD" id="COD" required/>
            <label for="pants">E-Wallet</label>
            <input type="radio" name="category" value="E-Wallet" id="E-Wallet" required/>
            </p><br>
            <button type="submit" name="buy">Buy</button>
            <button><a href="custproducts.php">Cancel</a></button>

        </form>
        
        <?php
            if(isset($_POST['buy']))
            {

            $payment = $_POST['category'];

            $bamount = $_POST['bamount'];
            $totalprice = $price * $bamount;
            echo "<div class=","categories","><a>Total Price is RM $totalprice</a><br>
            <a>Payment Method $payment</a>
            <form>
                <button><a href=","confirmbuy.php?subject=",$Pid,"&subject2=",$bamount,">Confirm Buy</a></button>
                <button><a href=","custproducts.php",">Cancel</a></button>
                </form>
            </div><br>";

            }
            
        ?>


    </main>
  </body>
</html>
