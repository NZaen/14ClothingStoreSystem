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
    <header class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
        <nav class="container">
            <a href="admin_home.php" class="navbar-brand">14Store</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="admin_home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="productList.php" class="nav-link">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="customer_list.php" class="nav-link">Customer</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_feedback.php" class="nav-link">Feedback</a>
                    </li>
                </ul>
                <div class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['admin'])){
                        echo '<a href="includes/logout.inc.php" class="btn btn-secondary">Logout</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

<script src="scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
