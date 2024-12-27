<?php require_once('inc/header.php'); ?>
<?php 
if(isset($_COOKIE['adminAuth'])){
    header('location:admin/index.php?success=You Are Already Loggin');
}elseif (isset($_COOKIE['userAuth'])) {
    $userId = intval($_COOKIE['userAuth']);

    // Build the query
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId); // Bind the sanitized userId as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user data if available
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Use $user data as needed
    }
}

?>

<!-- Login Section -->
<!-- Login Section -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <?php if(!isset($_COOKIE['userAuth'])){ ?>
        <h2 class="form-weight-bold"> Login</h2>
        <?php }else{ ?>
            <a href="admin/core/logout.php"><h2 class="form-weight-bold"> Logout</h2></a>
        <?php } ?>
        <hr class="mx-auto">
    </div>
    <?php if(!isset($_COOKIE['userAuth'])){ ?>
        <div class="mx-auto container">
            <form method="POST" action="admin/core/userHandle.php" id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="user" placeholder="Enter Username" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="pass" placeholder="Enter Valied Password" required />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn" id="login-btn" name="req_type" value="login">Login</button>
                </div>

                <div class="form-group">
                    <p>Don't have an account? <a id="register-url" href="singup.php">Register</a></p>
                </div>
            </form>
        </div>
    <?php }else{?>
        <div class="mx-auto container">
            <form method="POST" action="admin/core/userHandle.php" id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="user" placeholder="Enter Username" required readonly value="<?php echo $user['user'];?>"/>
                </div>
                <div class="form-group">
                    <label for="oldpassword">Old Password</label>
                    <input type="text" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter Valied Password" />
                </div>
                <div class="form-group">
                    <label for="oldpassword">New Password</label>
                    <input type="text" class="form-control" id="oldpassword" name="pass" placeholder="Enter Valied Password" />
                </div>
                <div class="form-group">
                    <label for="address">Adderss</label>
                    <textarea name="address" id="address"><?php echo $user['address'];?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn" id="login-btn" name="req_type" value="chnagePassword">Update</button>
                </div>
            </form>
        </div>
    <?php } ?>
</section>





<?php require_once('inc/footer.php');?>