<?php 
    require_once('admin/core/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GrocerSnap</title>


        <!-- Code for font awesome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="admin/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="admin/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        
        <link href="admin/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Code for linking css file -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
    <!-- header section -->
    <header class="header">
        <a href="index.php" class="logo"> <i class="fa-solid fa-bag-shopping"></i> GrocerSnap</a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="index.php#features">features</a>
            <a href="products.php">products</a>
            <a href="index.php#categories">categories</a>
            <a href="index.php#review">review</a>
            <a href="index.php#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div class="fa fa-bars" id="menu-btn"></div>
            <div class="fa fa-search" id="fa-search"></div>
            <a href="cart.php" class="fas fa-shopping-cart" id="cart-btn"></a>
            <a href="<?php if(isset($_COOKIE['adminAuth'])){ echo 'admin/index.php';}else{echo 'login.php';}?>" class="fa fa-user"></a>
        </div>

        <form action="products.php" method="GET" class="search-form">
            <input type="search" name="search" id="search-box" placeholder="Search Here.....">
            <label for="search-box" class="fa fa-search"></label>
        </form>
    </header>

