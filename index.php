<?php require_once('inc/header.php'); ?>
<?php 
    $query = "SELECT p.id, p.name, p.des, p.price, p.imgLink, c.name AS category_name 
    FROM products p
    JOIN category c ON p.categoryId = c.id LIMIT 3";
    $result = $conn->query($query);
    $cQuery = "SELECT * FROM category";
    $cResult = $conn->query($cQuery);
?>

<!--banner section -->

<section class="home"  id="home">
    <div class="content">
    <h3>Fresh and <span>Organic</span> Products for you</h3>
    <p>Grocersnap provides convenient online grocery shopping with home delivery, offering fresh produce, pantry staples, household essentials, and a user-friendly experience.</p>

    <a href="products.php" class="btn">shop now</a>
    

    </div>
</section>

<!--banner section -->


<!--our feature section -->
<!-- our feature section -->
<section class="features" id="features">
    <h1 class="heading">Our <span>Features</span></h1>
    <div class="features-container">
        <div class="box">
            <img src="assets/image/feature-img-1.png" alt="Fresh and Organic">
            <h3>Fresh and Organic</h3>
            <p>Sourced from local farms to ensure peak freshness and quality.</p>
            <a href="#" class="btn">Read more</a>
        </div>

        <div class="box">
            <img src="assets/image/feature-img-2.png" alt="Free Delivery">
            <h3>Free Delivery</h3>
            <p>Shop hassle-free with free delivery on all orders, ensuring your groceries arrive at your doorstep without any extra cost.</p>
            <a href="#" class="btn">Read more</a>
        </div>

        <div class="box">
            <img src="assets/image/feature-img-3.png" alt="Easy Payment">
            <h3>Easy Payment</h3>
            <p>A variety of easy payment options, including credit/debit cards, mobile payments, and digital wallets, to make checkout seamless and convenient.</p>
            <a href="#" class="btn">Read more</a>
        </div>
    </div>
</section>
<!-- our feature section -->



<!--our feature section -->






<!--our product  section -->
<section class="products" id="products">
    <h1 class="heading">Our <span>products</span></h1>
    <div class="product-container">
        <?php if ($result->num_rows > 0) { ?>        
            <div class="product-row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="box">
                    <!-- Display product image -->
                    <img src="admin/uploads/<?php echo $row['imgLink'] ?>" alt="">

                    <!-- Display product name -->
                    <h1>
                        <?php echo $row['name'] ?>
                    </h1>
                    <p>
                        <?php echo $row['des'] ?>
                    </p>

                    <!-- Display product price -->
                    <div class="price">
                        <?php echo $row['price'] ?>
                    </div>

                    <!-- Display rating stars -->
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>       
                    </div>            
                    <button class="add-to-cart btn" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                        Add to Cart
                    </button>

                </div>
            <?php } ?>
            </div>
        <?php } ?>
        <a href="products.php" class="btn">View All Products</a>
    </section>

<!-- our product section -->


<!--our categories section  -->
<!-- Categories Section -->
<?php if ($result->num_rows > 0) { ?>  
    <section class="categories" id="categories">
        <h1 class="heading">Our <span>Categories</span></h1>

        <div class="categories-container">
            <?php while ($cRow = $cResult->fetch_assoc()) { ?>
                <div class="category-box">
                    <img src="assets/image/category.jpg" alt="Vegetables">
                    <h3><?php echo $cRow['name']; ?></h3>
                    <a href="products.php?category=<?php echo $cRow['id']; ?>" class="btn">Visit Now</a>
                </div>            
            <?php } ?>
        </div>
    </section>

<?php } ?>


<!--our categories section  -->



<!--    Review Section   -->

<section class="review" id="review">
    <h1 class="heading" >Customer's <span>Review</span></h1>
    <div class="swiper review-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <img src="assets/image/joba.jpg">
                <p>"Amazing experience! The groceries arrived fresh and on time. Will definitely order again."</p>
                <h3>Jobayer Ahmed</h3>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                    
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="assets/image/pic-4.png">
                <p>User-friendly app and quick delivery. Love how easy it is to shop for my essentials.</p>
                <h3>Jennifer</h3>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="assets/image/rasha.jpg">
                <p>Great service! The products were top-quality, and I got free delivery. Highly recommend</p>
                <h3>Jareen Rasha</h3>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </div>
            </div>            
            <div class="swiper-slide box">
                <img src="assets/image/takib-pic.jpg">
                <p>Easy to navigate, and the prices are really competitive. My go-to grocery app now</p>
                <h3>Takib Abdullah</h3>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </div>
            </div>     
        </div>
    </div>
</section>
 


<!--    Review Section   -->


<!--    Blog Section   -->

<!-- Our Blogs Section -->
<section class="blogs" id="blogs">
    <h1 class="heading">Our <span>Blogs</span></h1>
    
    <div class="blogs-container">
        <div class="blog-box">
            <img src="assets/image/blog-1.png" alt="Blog 1">
            <h3>Fresh and Healthy Recipes</h3>
            <p>Learn how to make healthy meals with fresh ingredients. Simple and nutritious recipes for your daily meals!</p>
            <a href="#" class="btn">Read More</a>
        </div>
        <div class="blog-box">
            <img src="assets/image/blog-2.jpg" alt="Blog 2">
            <h3>Why Organic Products Matter</h3>
            <p>Explore the benefits of choosing organic products for a healthier lifestyle and better nutrition.</p>
            <a href="#" class="btn">Read More</a>
        </div>
        <div class="blog-box">
            <img src="assets/image/blog-3.jpg" alt="Blog 3">
            <h3>Shopping Tips for Busy People</h3>
            <p>Find out how you can save time while shopping for groceries with these easy tips and tricks!</p>
            <a href="#" class="btn">Read More</a>
        </div>
    </div>
</section>



<!--    Blog Section   -->


<?php require_once('inc/footer.php');?>