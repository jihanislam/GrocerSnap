<?php require_once('inc/header.php'); ?>

<!-- our product section -->

<!--our product  section -->
<section class="products" id="products" style="padding: 10rem 9%">
    <h1 class="heading">our <span> products</span></h1>
    <div class="product-container">
        <!-- First row of 3 products -->
        <!-- <div class="product-row">
            <div class="box">
                <img src="assets/image/product-1.png">
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
            <div class="box">
                <img src="image/product-2.png">
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
                <img src="image/product-3.png">
                <h1>Fresh Red Meat</h1>
                <div class="price">850Tk/Kg</div>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </div>
                <a href="#" class="btn">Add to Cart</a>
            </div>
        </div> -->

        <!-- Second row of 3 products -->
        <!-- <div class="product-row">
            <div class="box">
                <img src="image/product-4.png">
                <h1>Fresh Cabbage</h1>
                <div class="price">250Tk/Kg</div>
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
                <img src="image/product-5.png">
                <h1>Fresh Potato</h1>
                <div class="price">180Tk/Kg</div>
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
                <img src="image/product-6.png">
                <h1>Fresh Avocado</h1>
                <div class="price">100Tk/Kg</div>
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </div>
                <a href="#" class="btn">Add to Cart</a>
            </div>
        </div> -->



        <?php
        // Check if 'category' or 'search' parameter exists in the URL
        $category = isset($_GET['category']) ? intval($_GET['category']) : null;
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;

        // Build the query
        if ($category) {
            // Filter by categoryId
            $query = "SELECT p.*, c.name AS category_name 
                    FROM products p
                    JOIN category c ON p.categoryId = c.id
                    WHERE p.categoryId = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $category); // Bind category as an integer
            $stmt->execute();
            $result = $stmt->get_result();
        } elseif ($search) {
            // Filter by product name or description
            $query = "SELECT p.*, c.name AS category_name 
                    FROM products p
                    JOIN category c ON p.categoryId = c.id
                    WHERE p.name LIKE ? OR p.des LIKE ?";
            $stmt = $conn->prepare($query);
            $searchTerm = '%' . $search . '%'; // Add wildcards for partial matching
            $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind search term twice as string
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            // Display all products
            $query = "SELECT p.*, c.name AS category_name 
                    FROM products p
                    JOIN category c ON p.categoryId = c.id";
            $result = $conn->query($query);
        }
        // Assuming you have fetched data into $result from your database query
        $counter = 0; // Initialize counter

        echo '<div class="product-row">'; // Start the first row

        while ($row = $result->fetch_assoc()) {
            // Display the product box
            echo '
                <div class="box">
                    <img src="admin/uploads/' . $row['imgLink'] . '">
                    <h1>' . $row['name'] . '</h1>
                    <p>'.$row['des'].'</p>
                    <div class="price">' . $row['price'] . 'Tk/Kg</div>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                    </div>
                    <button class="btn add-to-cart" data-id='.$row['id'].'" data-name="'.$row['name'].'" data-price="'.$row['price'].'">Add to Cart</button>
                </div>
            ';

            $counter++; // Increment the counter

            // If 3 items are displayed, close the row and start a new one
            if ($counter % 3 == 0) {
                echo '</div><div class="product-row">'; // Close the current row and start a new one
            }
        }

        // Close the last row if it's not completely filled
        if ($counter % 3 != 0) {
            echo '</div>'; // Close the last row
        }
        ?>

    </div>
</section>


<!-- our product section -->



<?php require_once('inc/footer.php'); ?>