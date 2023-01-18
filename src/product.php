<?php
    include_once 'header.php';
?>

<div class="container">
  <div class="row mt-5 gy-4">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Filter by Category</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action py-3" data-page="all">
                        <a href="product.php?category=all" class="nav-link">All</a>
                    </li>                    
                    <li class="list-group-item list-group-item-action py-3" data-page="shirts">
                        <a href="?category=shirts" class="nav-link">Shirts</a>
                    </li>
                    <li class="list-group-item list-group-item-action py-3" data-page="t-shirt">
                        <a href="product.php?category=t-shirt" class="nav-link">T-Shirt</a>
                    </li>
                    <li class="list-group-item list-group-item-action py-3" data-page="pants">
                        <a href="product.php?category=pants" class="nav-link">Pants</a>
                    </li>
                    <li class="list-group-item list-group-item-action py-3" data-page="shorts">
                        <a href="product.php?category=shorts" class="nav-link">Short</a>
                    </li>
                    <li class="list-group-item list-group-item-action py-3" data-page="jeans">
                        <a href="product.php?category=jeans" class="nav-link">Jeans</a>
                    </li>
                    <li class="list-group-item list-group-item-action py-3" data-page="jacket">
                        <a href="product.php?category=jacket" class="nav-link">Jacket</a>
                    </li>
                </ul>
            </div>
        </div>

    
    <div class="col-xl-9">
    <div class="row gy-4">
    <?php

    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    // Retrieve data
    if (isset($_GET["category"])){
        if ($_GET["category"] == "all"){
            $products = displayProducts($conn);
        }
        else{
            $products = displayProductsByCategory($conn, $_GET["category"]);
        }
    }
    else{
        $products = displayProducts($conn);
    }
    foreach($products as $product) {
    ?>
    <div class="col-md-4 col-lg-4 col-xl-4">
      <div class="card border-0 shadow text-center">
        <div class="inner">
            <a href="product_detail.php?productID=<?php echo $product['product_id']; ?>"><img src="Assets/<?php echo ($product['product_image']); ?>" class="card-img-top object-fit-cover border rounded"></a>
        </div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $product['product_name']; ?></h4>
            <div class="card-subtitle lead">Category: <strong><?php echo $product['product_category']; ?></strong></div>
            <div class="card-text lead">Price: RM <strong><?php echo $product['product_price']; ?></strong></div>
            <div class="grid gap-5 text-center mt-4">
                <button type="button" class="btn btn-outline-dark rounded-pill">S</button>
                <button type="button" class="btn btn-outline-dark rounded-pill">M</button>
                <button type="button" class="btn btn-outline-dark rounded-pill">L</button>
                <button type="button" class="btn btn-outline-dark rounded-pill">XL</button>
            </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
  </div>
  </div>
  </div>
</div>

<script src="scripts.js"></script>

<?php
    include_once 'footer.php';
?>