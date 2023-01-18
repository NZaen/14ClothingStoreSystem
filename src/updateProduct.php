<?php
    include_once 'admin_nav.php';
    require_once 'includes/functions.inc.php';
    isAdmin();
?>

    <?php
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';

        if (!isset($_GET["productID"])){
            header ("location: productList.php");
            exit();
        }
        else{
            $product_id = $_GET['productID'];
            $product = getProduct($conn, $product_id);
        }
    ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 bg-white rounded-top border-top border-3 border-secondary shadow">
                <form class="needs-validation" method="post" action="includes/update_product.inc.php" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <div class="form-group mt-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" class="form-control" name="product_name" value=<?php echo $product['product_name']; ?> required>
                        <div class="invalid-feedback">Please enter the product name</div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category">Category:</label>
                        <select class="form-control" name="product_category" required>
                            <option value="<?php echo $product['product_category']; ?>"><?php echo $product['product_category']; ?></option>
                            <option value="shorts">Shorts</option>
                            <option value="jeans">Jeans</option>
                            <option value="pants">Pants</option>
                            <option value="shirt">T-Shirt</option>
                        </select>
                        <div class="invalid-feedback">Please select a category</div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="product_description" rows="5" required><?php echo $product['product_description']; ?></textarea>
                        <div class="invalid-feedback">Please enter a description</div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="product_price" min="0" step="0.01" value="<?php echo $product['product_price']; ?>" required>
                        <div class="invalid-feedback">Please enter a valid price</div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" name="product_image">
                        <div class="invalid-feedback">Please select an image</div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-3 mt-3">Update</button>
                    <a href="productList.php" class="btn btn-outline-danger mt-3 mb-3 ms-2">Cancel</a>
                </form>
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