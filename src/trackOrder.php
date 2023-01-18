<?php
    include_once 'header.php';
    check_login();
?>

<div class="px-4 px-lg-0">
  <div class="container py-5 text-center">
    <h1 class="display-3">Order History</h1>
    <p class="lead mb-0">Track your order progress below.</p>
  </div>
  <!-- End -->

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Order ID:</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Products</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Amount</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Status</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Action</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once 'includes/dbh.inc.php';
                require_once 'includes/functions.inc.php';

                $orders = displayOrder($conn, $_SESSION['userID']);
                
                foreach($orders as $order) {
                  if (count($order) <= 0){
                    break;
                  }
                  $items = displayItemsCart($conn, $order['id']);
                ?>
                <tr class="border-bottom border-2">
                  <td class="border-0 align-middle ps-5"><strong><?php echo $order['id']; ?></strong></td>
                  <td class="border-0 align-middle">
                    <div class="row">
                        <?php
                        foreach($items as $item){
                            $productDetail = getProduct($conn, $item['product_id']);
                        ?>
                        <div class="col-sm-3">
                        <img src="Assets/<?php echo ($productDetail['product_image']); ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                        <p class="mt-1 text-muted fs-6">Size: <?php echo $item['size']; ?>, Qty: <?php echo $item['quantity']; ?></p>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                  </td>
                  <td class="border-0 align-middle text-center"><strong>RM<?php echo $order['amount']; ?></strong></td>
                  <td class="border-0 align-middle text-center">
                    <button class="btn btn-warning rounded-pill"><?php echo $order['order_status']; ?></button>
                  </td>
                  <td class="border-0 align-middle text-center">
                    <a href="includes/customer_receive.inc.php?orderID=<?php echo $order['id']; ?>" class="btn btn-outline-danger">Order Receive</a>
                  </td>
                </tr>
                <?php
                $shipping = number_format(10.00,'2','.');
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>

<?php
    include_once 'footer.php';
?>