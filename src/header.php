<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>14Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script defer src="cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <header class="navbar navbar-expand-lg bg-light navbar-light shadow">
        <nav class="container">
            <a href="homepage.php" class="navbar-brand">14Store</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="homepage.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="product.php" class="nav-link">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="homepage.php#about" class="nav-link">About</a>
                    </li>
                </ul>
                <div class="navbar-nav ms-auto">
                    <?php
                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';

                        if (isset($_SESSION["userUID"])){
                            $getOrder = getOrderID($conn, $_SESSION["userID"]);
                            $item_in_cart = countItem($conn, $getOrder);
                            if (!newOrder($conn, $_SESSION["userID"])){
                                echo '
                                <a href="cart.php" role="button" class="btn btn-secondary primary position-relative me-4">
                                <span>Cart <i class="fa fa-shopping-cart"></i></span>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">';
                                echo $item_in_cart;
                                echo '</span>
                                </a>';
                            }
                            else{
                                echo '                    
                                <a href="#" role="button" class="btn btn-secondary primary position-relative me-4">
                                    <span>Cart <i class="fa fa-shopping-cart"></i></span></a>';
                            }
                        }
                    ?>
                    <?php
                    if (isset($_SESSION["userUID"])){
                        echo '
                        <li class="nav-item dropdown me-5">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fa fa-user"></i>
                        ';
                        echo $_SESSION['userUID'];
                        echo '
                        </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="trackOrder.php">Order</a></li>
                            <li><a class="dropdown-item" href="includes/logout.inc.php">Logout</a></li>
                            </ul>
                        </li>              
                        ';
                    }
                    else{
                        echo '
                        <a href="login.php" role="button" class="btn btn-secondary me-5">Login</a>
                        ';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

<script src="scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
