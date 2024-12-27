<?php require_once('inc/header.php'); ?>
<?php if(isset($_COOKIE['userAuth'])){
    header('location:login.php');
}?>

<!-- Login Section -->
<!-- Login Section -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <?php if(!isset($_COOKIE['userAuth'])){ ?>
        <h2 class="form-weight-bold"> SingUp</h2>
        <?php }else{ ?>
            <a href=""><h2 class="form-weight-bold"> Logout</h2></a>
        <?php } ?>
        <hr class="mx-auto">
    </div>
    <?php if(!isset($_COOKIE['userAuth'])){ ?>
        <div class="mx-auto container">
            <form method="POST" action="admin/core/userHandle.php" id="login-form">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required />
                </div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Enter Username" required />
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="text" class="form-control" id="Password" name="pass" placeholder="Enter Password" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" style="width:48%;"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn" id="login-btn" name="req_type" value="singup">SingUp</button>
                </div>

                <div class="form-group">
                    <p>Do you have an account? <a id="register-url" href="login.php">Login Now</a></p>
                </div>
            </form>
        </div>
    <?php } ?>
</section>





<?php require_once('inc/footer.php');?>