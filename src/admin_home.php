<?php
    include_once 'admin_nav.php';
    require_once 'includes/functions.inc.php';
    require_once 'includes/dbh.inc.php';
    isAdmin();

    $numOfUsers = countNumOfUsers($conn);
    $numOfProducts = countNumOfProducts($conn);
    $pendingOrders = countNumOfOrders($conn, "To Ship");
    $completeOrders = countNumOfOrders($conn, "Completed");
    $numOfFeedback = countNumOfFeedback($conn);
?>

    <div class="container">
        <div class="row mt-5 justify-content-center gap-3">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="card bg-warning border-0 shadow text-center text-dark">
                    <div class="card-header">
                        <h5 class="lead">Amount of User</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $numOfUsers; ?></h5>
                        <div class="card-subtitle">customer currently in active</div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="card bg-primary border-0 shadow text-center text-light">
                    <div class="card-header">
                        <h5 class="lead">Amount of Products</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $numOfProducts; ?></h5>
                        <div class="card-subtitle">products currently store in server</div>
                    </div>
                    <div class="card-footer">
                        <a href="productList.php" class="link-light">Click here to view products list</a>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="card bg-danger border-0 shadow text-center text-light">
                    <div class="card-header">
                        <h5 class="lead">Order Pending</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pendingOrders; ?></h5>
                        <div class="card-subtitle">Order need to be ship</div>
                    </div>
                    <div class="card-footer">
                        <a href="customer_list.php" class="link-light">Click here to view order list</a>
                    </div>
                </div>
            </div>            

            <div class="col-md-5 col-lg-4 col-xl-4">
                <div class="card bg-info border-0 shadow text-center text-dark">
                    <div class="card-header">
                        <h5 class="lead">Amount of Feedback</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $numOfFeedback; ?></h5>
                        <div class="card-subtitle">There is amount of feedback from the customer</div>
                    </div>
                    <div class="card-footer">
                        <a href="admin_feedback.php" class="link-dark">Click here to view feedback</a>
                    </div>
                </div>
            </div>                        

            <div class="col-md-5 col-lg-4 col-xl-4">
                <div class="card bg-success border-0 shadow text-center text-light">
                    <div class="card-header">
                        <h5 class="lead">Order Completed</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $completeOrders; ?></h5>
                        <div class="card-subtitle">order has completed</div>
                    </div>
                    <div class="card-footer">
                        <a href="customer_list.php" class="link-light">Click here to view order list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php'
?>