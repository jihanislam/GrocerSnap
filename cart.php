<?php

// session_start();
// if(isset($_POST['add_to_cart'])){

//     if(isset($_SESSION['cart'])){

//         //if this is the first product

//     }else{
        
//     }



// }else
//     header('location: index.php')

?>

<?php require_once('inc/header.php'); ?>


<section class="cart container my-5 py-5 ">
    <div class="container text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
        <form action="admin/core/functions.php" method="POST">
            <table class="mt-5" id="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td id="cart-total">Tk 0</td>
                    </tr>
                </tfoot>
            </table>
            <div class="checkout-container">
                <button name="req_type" value="cardChecked" class="checkout-btn">Proceed to Checkout</button>
            </div>
        </form>

        
        <!-- <table class="mt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;font-size:20px;">There is no product, <a href="products.php">click to add Product</a></td>
            </tr>
            <tr>
                <td>
                    <div class="product-info">
                        <p>Fresh Orange</p>
                        <small><span>tk</span> 200</small>
                        <br>
                        <a class="remove-button" href="#">Remove</a>
                    </div>
                </td>
                <td>
                    <input type="number" value="3" min="1" class="quantity-input" onchange="updateSubtotal(this)">
                    <a class="edit-btn" href="#">Edit</a>
                </td>
                <td>
                    <span>Tk</span>
                    <span class="product-price">600</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="product-info">
                        <p>Fresh Orange</p>
                        <small><span>tk</span> 200</small>
                        <br>
                        <a class="remove-button" href="#">Remove</a>
                    </div>
                </td>
                <td>
                    <input type="number" value="3" min="1" class="quantity-input" onchange="updateSubtotal(this)">
                    <a class="edit-btn" href="#">Edit</a>
                </td>
                <td>
                    <span>Tk</span>
                    <span class="product-price">600</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="product-info">
                        <p>Fresh Orange</p>
                        <small><span>tk</span> 200</small>
                        <br>
                        <a class="remove-button" href="#">Remove</a>
                    </div>
                </td>
                <td>
                    <input type="number" value="3" min="1" class="quantity-input" onchange="updateSubtotal(this)">
                    <a class="edit-btn" href="#">Edit</a>
                </td>
                <td>
                    <span>Tk</span>
                    <span class="product-price">600</span>
                </td>
            </tr>
        </table> -->

        <!-- Total Price Section (for all products) -->
        <!-- <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td><span>Tk</span><span class="total-price">1800</span></td>
                </tr>
            </table>
        </div> -->

        <!-- Checkout Button -->
        <!-- <div class="checkout-container">
            <button class="checkout-btn">Proceed to Checkout</button>
        </div> -->
    </div>
</section>



<?php require_once('inc/footer.php');?>