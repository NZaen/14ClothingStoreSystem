<?php 
session_start();

    include("connection.php");

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
            <li><a href="admin.html">Home</a></li>
            <li><a href="adminproducts.php">Products</a></li>
            <li><a href="admincustomer.html">Customers</a></li>
            <li><a href="admincontacts.html">Feedbacks</a></li>
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
      <form class="categories" method="POST">
        <ul>
          <li><input type="submit" name="shirts" class="catbtn" value="Shirts"></li>
          <li><input type="submit" name="pants" class="catbtn" value="Pants"></li>
          <li><input type="submit" name="hats" class="catbtn" value="Hats"></li>
          <li><input type="submit" name="watches" class="catbtn" value="Watches"></li>
          <li><input type="submit" name="glasses" class="catbtn" value="glasses"></li>
          <li><input type="submit" name="belts" class="catbtn" value="Belts"></li>
          <li><input type="submit" name="shoes" class="catbtn" value="Shoes"></li>
          <li><a href="addeditproduct.html">Add and Edit Product</a></li>
        </ul>
      </form>

      <div class="products">
      <?php
      if (!isset($_POST['shirts'])&&!isset($_POST['pants'])&&!isset($_POST['hats'])&&!isset($_POST['watches'])&&
      !isset($_POST['glasses'])&&!isset($_POST['belts'])&&!isset($_POST['shoes'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }

      if (isset($_POST['shirts'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'shirts'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['pants'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'pants'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['hats'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'hats'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['watches'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'watches'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['glasses'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'glasses'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['belts'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'belts'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      if (isset($_POST['shoes'])) {
        $sql = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE category = 'shoes'";
        $result = mysqli_query($con, $sql);
        while($row = $result->fetch_assoc())
        {
          //$Pname = $row['Pname'];
          $sessionid = $row['Pid'];
          $sessiontype = $row['fileExt'];
          $filename = "Product".$sessionid.".".$sessiontype;

          echo "<div class=","product","><h3>",$row['Pname'],"</h3><a><img src=","imguploads/",$filename," 
          width=","100","height=","100","><a>RM ",$row['price'],"<br><a>Quantity: ",$row['amount'],"</a></a></a></div>";

        } 
      }
      ?>
      </div>
    </main>
  </body>
</html>
