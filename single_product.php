


<?php
include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare the SQL statement to fetch the product
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();
    $product = $stmt->get_result(); // Fetch the product details
} else {
    // Redirect to home if no product_id is provided
    header('location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrocerSnap - Product Details</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS File -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!-- Header Section -->
<header class="header">
    <a href="index.php" class="logo"> <i class="fa-solid fa-bag-shopping"></i> GrocerSnap</a>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="#features">Features</a>
        <a href="products.php">Products</a>
        <a href="#categories">Categories</a>
        <a href="#review">Review</a>
        <a href="#blogs">Blogs</a>
    </nav>

    <div class="icons">
        <div class="fa fa-bars" id="menu-btn"></div>
        <div class="fa fa-search" id="fa-search"></div>
        <a href="cart.php" class="fas fa-shopping-cart" id="cart-btn"></a>
        <a href="account.php" class="fa fa-user" id="login-btn"></a>
    </div>
</header>

<!-- Single Product Section -->
<section class="single-product">
    <div class="row">
        <?php while ($row = $product->fetch_assoc()) { ?>

        

       
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img id="main-product-img" class="img-fluid main-img w-100 pb-1" 
                 src="image/<?php echo $row['product_image']; ?>" 
                 alt="<?php echo $row['product_name']; ?>"/>

            <div class="small-img-group d-flex justify-content-between mt-2">
                <!-- Small Thumbnails -->
                <div class="small-img-col">
                    <img src="image/<?php echo $row['product_image']; ?>" 
                         class="small-img" 
                         alt="Thumbnail 1" 
                         width="100%" 
                         onclick="changeProductDetails(this.src, '<?php echo $row['product_price']; ?>')"/>
                </div>
                <div class="small-img-col">
                    <img src="image/<?php echo $row['product_image2']; ?>" 
                         class="small-img" 
                         alt="Thumbnail 2" 
                         width="100%" 
                         onclick="changeProductDetails(this.src, '<?php echo $row['product_price']; ?>')"/>
                </div>
                <div class="small-img-col">
                    <img src="image/<?php echo $row['product_image3']; ?>" 
                         class="small-img" 
                         alt="Thumbnail 3" 
                         width="100%" 
                         onclick="changeProductDetails(this.src, '<?php echo $row['product_price']; ?>')"/>
                </div>
                <div class="small-img-col">
                    <img src="image/<?php echo $row['product_image4']; ?>" 
                         class="small-img" 
                         alt="Thumbnail 4" 
                         width="100%" 
                         onclick="changeProductDetails(this.src, '<?php echo $row['product_price']; ?>')"/>
                </div>
            </div>
        </div>

        <!-- Product Details (Right Section) -->
        <div class="col-lg-7 col-md-6 col-sm-12">
            <h3 class="product-title"><?php echo $row['product_name']; ?></h3>
            <div id="product-price" class="price">$<?php echo $row['product_price']; ?></div>

            <!-- Product Details -->
            <div class="product-details">
                <h6>Product Details</h6>
                <span><?php echo $row['product_description']; ?></span>
            </div>

            <!-- Quantity Controls -->
            <div class="quantity-control">
                <button id="decrease" class="quantity-btn">-</button>
                <input type="number" id="product_quantity" class="quantity-input" value="1" min="1"/>
                <button id="increase" class="quantity-btn">+</button>
            </div>

            <!-- Add to Cart Button -->
            <a href="cart.php?product_id=<?php echo $row['product_id']; ?>" class="btn add-to-cart">Add to Cart</a>
        </div>
        <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
            <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>" />
            <input type="hidden" name="product_name" value="<?php echo $row['product_price'];?>" />

        </form>
        <?php } ?>
    </div>
</section>

<!-- JavaScript to Update Product Details -->
<script>
    function changeProductDetails(imageSrc, price) {
        document.getElementById("main-product-img").src = imageSrc;
        document.getElementById("product-price").textContent = "$" + price;
    }
</script>

</body>
</html>

<!-- Related Products Section -->
<section id="related-products">
    <h1 class="heading">Our <span>Related Products</span></h1>
    <hr class="mx-auto">
    <div class="product-container" style="border: 2px solid black; padding: 20px;">
        <!-- Product 1 -->
        <div class="box">
            <img src="image/product-1.png" alt="Fresh Orange">
            <h1>Fresh Orange</h1>
            <div class="price">200Tk/Kg</div>
            <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half"></i>
            </div>
            <a href="#" class="btn">Add to Cart</a>
        </div>
        <!-- Product 2 -->
        <div class="box">
            <img src="image/product-2.png" alt="Fresh Onion">
            <h1>Fresh Onion</h1>
            <div class="price">150Tk/Kg</div>
            <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half"></i>
            </div>
            <a href="#" class="btn">Add to Cart</a>
        </div>
        <div class="box">
            <img src="image/product-3.png" alt="Fresh Carrot">
            <h1>Fresh Meat</h1>
            <div class="price">720Tk/Kg</div>
            <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half"></i>
                <i class="fa fa-star-half"></i>
            </div>
            <a href="#" class="btn">Add to Cart</a>
        </div>
        <!-- Product 4 -->
        <div class="box">
            <img src="image/product-4.png" alt="Fresh Cabbage">
            <h1>Fresh Cabbage</h1>
            <div class="price">100Tk/Kg</div>
            <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half"></i>
                <i class="fa fa-star-half"></i>
            </div>
            <a href="#" class="btn">Add to Cart</a>
        </div>
    </div>

    </div>
</section>


            
           

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-logo">
        <a href="#" class="logo">GrocerSnap <i class="fa-solid fa-bag-shopping"></i></a>
    </div>
    <div class="footer-content">
        <div class="footer-column">
            <h3>Contact</h3>
            <ul>
                <li><a href="#">123 Mohakhali , Dhaka</a></li>
                <li><a href="#">Email: grocersnap@gmail.com</a></li>
                <li><a href="#">Phone: 01307527651</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Newsletter</h3>
            <form action="#" method="POST">
                <input type="email" placeholder="Enter your email" class="newsletter-input" required>
                <input type="submit" value="Subscribe" class="btn">
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-payment">
            <i class="fa fa-cc-visa"></i>
            <i class="fa fa-cc-mastercard"></i>
            <i class="fa fa-cc-amex"></i>
        </div>
        <p>&copy; 2024 GrocerSnap. All Rights Reserved.</p>
    </div>
</footer>




<!--    Footer Section   -->



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script src="js/script.js"></script>
</body>
</html>


