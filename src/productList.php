<?php
    include_once 'admin_nav.php';
    require_once 'includes/functions.inc.php';
    isAdmin();
?>

<div class="container">
    <?php
            if (isset($_GET["error"])){
                if ($_GET["error"] == "none"){
                    echo "
                        <div id='alert' class='alert alert-success alert-dismissible fade show mt-3'>
                        <h5 class='text-center'>Product Added!</h5>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                        </div>
                    ";
                }
            }
            else if (isset($_GET["delete"])){
                if ($_GET["delete"] == "productDeleted"){
                    echo "
                        <div id='alert' class='alert alert-warning alert-dismissible fade show mt-3'>
                        <h5 class='text-center'>Product Deleted!</h5>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                        </div>
                    ";
                }
            }
        ?>
    <div class="row justify-content-center mt-5">
        <div class="col">
            <h2 class="border border-2 border-dark text-primary-emphasis text-center">Product List</h2>
            <a class="btn btn-primary mt-2" href="products.php">
            <i class="fa fa-plus fa-md me-2"></i>Add Product
            </a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-3">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php

                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';

                        // Retrieve data
                        $products = displayProducts($conn);
                        foreach($products as $product) {
                        ?>
                    <tr class="align-middle">
                        <th scope="row"><?php echo $product['product_id']; ?></th>
                        <td class="align-middle"><img src="Assets/<?php echo ($product['product_image']); ?>" width="75" class="img-thumbnail"></td>
                        <td class="text-center"><?php echo $product['product_name']; ?></td>
                        <td class="text-center"><?php echo $product['product_category']; ?></td>
                        <td><?php echo $product['product_description']; ?></td>
                        <td><?php echo $product['product_price']; ?></td>
                        <td class="d-grid gap-3">
                            <a href="updateProduct.php?productID=<?php echo $product['product_id']; ?>" class="btn btn-secondary">Edit</a>
                            <a href="includes/delete_product.inc.php?productID=<?php echo $product['product_id']; ?><" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    include_once 'footer.php'
?>