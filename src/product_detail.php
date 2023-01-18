<?php
    include_once 'header.php';
?>

    <?php

        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';

        if (!isset($_GET['productID'])){
            header("location: product.php?error=productDoesNotExist");
            exit();
        }
        if (!isset($_SESSION['userID'])){
            header("location: login.php?error=pleaseLogin");
            exit();
        }

        $product_id = $_GET['productID'];
        $product = getProduct($conn, $product_id);
    ?>

    <div class="container">
        <div class="card mt-5">
            <div class="row g-0">
                <div class="col-md-4 border rounded d-flex">
                    <img src="Assets/<?php echo $product['product_image']; ?>" class="img-fluid rounded-start flex-fill" alt="...">
                </div>
                <div class="col-md-8 ps-5">
                    <div class="card-body d-flex flex-column justify-content-between gap-5">
                        <h1 class="card-title display-6">Product Name: <?php echo $product['product_name']; ?></h1>
                        <h2 class="card-subtitle lead">Category: <strong><?php echo $product['product_category']; ?></strong></h2>
                        <blockquote class="blockquote">
                            <p>Description: <?php echo $product['product_description']; ?></p>
                        </blockquote>
                        <p class="card-text text-muted fs-5">RM <?php echo $product['product_price']; ?></p>

                        <form action="includes/addToCart.inc.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['userID']; ?>">
                            <div class="btn-group mb-5 d-flex" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="product_size" id="btnradio1" autocomplete="off" value="S" checked>
                                <label class="btn btn-outline-primary fs-5" for="btnradio1">S</label>

                                <input type="radio" class="btn-check" name="product_size" id="btnradio2" autocomplete="off" value="M">
                                <label class="btn btn-outline-primary fs-5" for="btnradio2">M</label>

                                <input type="radio" class="btn-check" name="product_size" id="btnradio3" autocomplete="off" value="L">
                                <label class="btn btn-outline-primary fs-5" for="btnradio3">L</label>

                                <input type="radio" class="btn-check" name="product_size" id="btnradio4" autocomplete="off" value="XL">
                                <label class="btn btn-outline-primary fs-5" for="btnradio4">XL</label>
                            </div>
                            <div class="form-floating d-flex justify-content-start gap-3">
                                <div class="input-group w-25">
                                    <span class="input-group-text" id="basic-addon1">Qty:</span>
                                    <input type="number" class="form-control" name="quantity" min="1" max="10" step="1" value="1" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-info btn-lg w-75">Add to cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>