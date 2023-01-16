<?php 
session_start();

    $id = $_SESSION['id'];

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
        <div class="product">
        <table>
        <tr>
          <th></th>
          <th>-------To Ship-------</th>
          <th>-------To Receive-------</th>
          <th>-------Completed-------</th>
        </tr>
        <?php
        $sql = "SELECT Sid, Pid, id, amount, status FROM shipment WHERE id=$id";
        $result = mysqli_query($con, $sql);

        while($row = $result->fetch_assoc()) 
        { 
            $Pid =  $row['Pid'];
            $bamount = $row['amount'];
            $status = $row['status'];
            $id = $row['id'];

            $query1 = "SELECT Pid, Pname, price, amount, category, fileExt FROM product WHERE pid=$Pid";
            $result1 = mysqli_query($con, $query1);
            $row1 = $result1->fetch_assoc();

            $price = $row1['price'];
            $pname = $row1['Pname'];
            $totalprice = $bamount * $price;
            $sessionid = $row1['Pid'];
            $sessiontype = $row1['fileExt'];
            $filename = "Product".$sessionid.".".$sessiontype;

            if($status == 'shipping')
            {
                echo "<tr>
                    <th></th>
                    <td>",$pname,"
                    <br>Total price RM ",$totalprice,"
                    <br>Total amount bought ",$bamount,"
                    <br><img src=","imguploads/",$filename," width=","100","height=","100",">",$filename,"<br>
                    </td>
                    <td></td>
                    <td></td>
                </tr>"; 

            }


            if($status == 'receiving')
            {
                echo "<tr>
                    <th></th>
                    <td></td>
                    <td>",$pname,"
                    <br>Total price RM ",$totalprice,"
                    <br>Total amount bought ",$bamount,"
                    <br><img src=","imguploads/",$filename," width=","100","height=","100",">",$filename,"<br>
                    </td>
                    <td></td>
                    <td><a href=Creceiving.php?receiving=",$row['Sid'],">Received</a></td>
                </tr>"; 

            }
            if($status == 'completed')
            {
                echo "<tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td>",$pname,"
                    <br>Total price RM ",$totalprice,"
                    <br>Total amount bought ",$bamount,"
                    <br><img src=","imguploads/",$filename," width=","100","height=","100",">",$filename,"<br>
                    </td>
                </tr>"; 
            }
        }
        ?>    


        </table>
        </div>
        
    
    </main>
  </body>
</html>
