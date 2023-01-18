<?php
    include_once 'header.php';
    check_login();
?>

<div class="px-4 px-lg-0">
  <div class="container py-5 text-center">
    <h1 class="display-4">14Store shopping cart</h1>
    <p class="lead mb-0">Your confirmation items below.</p>
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
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once 'includes/dbh.inc.php';
                require_once 'includes/functions.inc.php';

                $order = getOrderID($conn, $_SESSION['userID']);
                $items = displayItemsCart($conn, $order);
                $totalAmount = totalAmount($conn, $order);
                
                foreach($items as $item) {
                  if (count($items) <= 0){
                    break;
                  }
                    $productDetail = getProduct($conn, $item['product_id']);
                ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="Assets/<?php echo ($productDetail['product_image']); ?>" alt="" width="90" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle ms-2">
                        <h5 class="mb-1"> <a href="product_detail.php?productID= <?php echo $productDetail['product_id'] ?>" class="text-dark d-inline-block align-middle"><?php echo $productDetail['product_name'] ?></a>
                        </h5><span class="text-muted font-weight-normal font-italic d-block">Category: <?php echo $productDetail['product_category'] ?></span>
                        </h5><span class="text-muted font-weight-normal font-italic d-block">Size: <?php echo $item['size'] ?></span>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle text-center"><strong>RM <?php echo $productDetail['product_price'] ?></strong></td>
                  <td class="border-0 align-middle text-center"><strong><?php echo $item['quantity'] ?></strong></td>
                  <td class="border-0 align-middle text-center"><a href="includes/remove_item.php?productID= <?php echo $productDetail['product_id']; ?>&orderID= <?php echo $order ?>" class="text-dark"><i class="fa fa-trash"></i></a></td>
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
        
      <form id="form" class="needs-validation" method="post" action="includes/checkout.inc.php" novalidate>
      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-6">
            <input type="hidden" name="order_id" value="<?php echo $order; ?>">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold text-center">Address</div>
          <div class="p-4">
          <div class="form-floating">
                <input type="text" class="form-control" min="0" step="1" placeholder="Leave Address Here" name="customer_phone" value="<?php if (isset($_SESSION["userPhone"])){echo $_SESSION["userPhone"];} ?>" required></input>
                <label for="address">Phone Number</label>
                <div class="invalid-feedback">Please Provide Us Your Phone Number</div>
            </div>
            <p class="font-italic mb-4">Please enter your address below for shipping and checkout:</p>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave Address Here" name="customer_address" style="height: 200px" required><?php
                if (isset($_SESSION["userAddress"])){
                  echo $_SESSION["userAddress"];
                }
                ?></textarea>
                <label for="address">Address</label>
                <div class="invalid-feedback">Please Provide Us Your Address</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold text-center">Order summary </div>
          <div class="p-4">
            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>RM <?php if (isset($totalAmount)){echo $totalAmount;} ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>RM <?php if (isset($shipping)){echo $shipping;}  ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">RM <?php if (isset($totalAmount) && isset($shipping)){echo number_format($totalAmount+$shipping,'2','.');} ?></h5>
              </li>
            </ul>
            <button type="submit" name="submit" class="btn btn-dark rounded-pill py-2 btn-block">Proceed to Checkout</button>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<script>
    const form = document.querySelector("form");

    form.addEventListener('submit', e =>{
        if (!form.checkValidity()){
            e.preventDefault();
        }
        form.classList.add('was-validated');
    })
</script>

<?php
    include_once 'footer.php';
?>