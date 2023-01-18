<?php
    include_once 'admin_nav.php';
    require_once 'includes/functions.inc.php';
    isAdmin();
?>

  <div class="pb-5">
    <div class="container">
    <h1 class="border border-2 border-dark text-dark-emphasis text-center mt-5 mb-4">Customer List</h1>
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
                  <th scope="col" class="border-0 bg-light pe-5">
                    <div class="py-2 text-uppercase text-center">Sale</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Customer</div>
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

                $orderList = customerOrderList($conn);
                
                foreach($orderList as $order) {
                  if (count($order) <= 0){
                    break;
                  }
                  $items = displayItemsCart($conn, $order['id']);
                  $customerData = getCustomerDetailFromOrder($conn, $order['customer_id']);
                ?>
                <tr class="border-bottom border-end border-start border-2">
                  <td class="border-0 align-middle ps-5"><strong><?php echo $order['id']; ?></strong></td>
                  <td class="border-0 align-middle">
                    <div class="row">
                        <?php
                        foreach($items as $item){
                            $productDetail = getProduct($conn, $item['product_id']);
                            $i = 1;
                        ?>
                        <div class="col-sm-4">
                        <img src="Assets/<?php echo ($productDetail['product_image']); ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                        <p class="mt-1 text-muted fs-6">Size: <?php echo $item['size']; ?>, Qty: <?php echo $item['quantity']; ?></p>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                  </td>
                  <td class="border-0 align-middle text-center"><strong class="pe-4">RM<?php echo $order['amount']; ?></strong></td>
                  <td class="border-0 align-middle text-center">
                    <div class="d-grid">
                        <p class="text-muted">Name: <strong><?php echo $customerData['customerName']; ?></strong></p>
                        <p class="text-muted">Email: <strong><?php echo $customerData['customerEmail']; ?></strong></p>
                        <p class="text-muted">Phone Number: <strong><?php echo $customerData['phone_number']; ?></strong></p>
                        <p class="text-muted">Address: <strong><?php echo $customerData['home_address']; ?></strong></p>
                    </div>
                  </td>
                  <td class="border-0 align-middle text-center">
                    <div class="d-grid justify-content-center">
                    <p class="lead fs-6">Change order status:</p>
                    <div class="dropdown">
                        <button class="btn btn-info rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $order['order_status']; ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="includes/ship_to_customer.inc.php?orderID=<?php echo $order['id'];?>">Ship</a></li>
                            <li><a class="dropdown-item" href="includes/cancel_order.inc.php?orderID=<?php echo $order['id'];?>">Cancel</a></li>
                        </ul>
                    </div>
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