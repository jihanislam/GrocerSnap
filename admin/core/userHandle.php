<?php
include 'connection.php';

// Check if form is submitted
if ($_REQUEST['req_type'] == 'singup') {
    // Retrieve and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $user = $conn->real_escape_string($_POST['user']);
    $userType = 'user';
    $pass = $conn->real_escape_string($_POST['pass']);
    $address = $conn->real_escape_string($_POST['address']);

    // Check for duplicate username
    $checkQuery = "SELECT `id` FROM `users` WHERE `user` = ?";
    $checkStatus = $conn->prepare($checkQuery);
    $checkStatus->bind_param("s", $user);
    $checkStatus->execute();
    $checkStatus->store_result();

    if ($checkStatus->num_rows > 0) {
        echo "<script>
        window.location.href = '../../singup.php?error=Username Duplicate';
        </script>";
    }else{
        // Insert data into the `users` table
        $sql = "INSERT INTO `users` (`name`, `phone`, `user`, `pass`, `address`,`userType`) VALUES (?, ?, ?, ?, ?,?)";
        $status = $conn->prepare($sql);

        if ($status) {
            $status->bind_param("ssssss", $name, $phone, $user, $pass, $address,$userType);

            // Execute the query
            if ($status->execute()) {
                echo "<script>
                        window.location.href = '../../login.php?success=You Are Successfully singup, lets login now';
                    </script>";
            } else {
                echo "<script>
                        window.location.href = '../../singup.php?error=Singup Not Successfully, Please Try Again';
                    </script>";
            }
            $status->close();
        } else {
            die("Error: " . $conn->error);
        }
    }

    // Close the database connection
    $status->close();
}elseif($_REQUEST['req_type'] == 'login'){
    // Retrieve and sanitize input data
    $user = $conn->real_escape_string($_POST['user']);
    $pass = $conn->real_escape_string($_POST['pass']);

    // Query to check the username and password
    $query = "SELECT * FROM `users` WHERE `user` = ? AND `pass` = ?";
    $status = $conn->prepare($query);
    $status->bind_param("ss", $user, $pass);
    $status->execute();
    $result = $status->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $userType = $row['userType'];

        // Start Cookie and redirect
        if($userType == 'admin'){
            setcookie('adminAuth', $row['id'], time() + (86400 * 30 * 12), "/"); // 86400 = 1 day
            echo "<script>
            window.location.href = '../index.php?success=You are successfully Login';
            </script>";

        }else{
            setcookie('userAuth', $row['id'], time() + (86400 * 30 * 12), "/"); // 86400 = 1 day
            echo "<script>
                window.location.href = '../../index.php?success=You are successfully Login';
            </script>";
        }

    } else {
        // Username or password incorrect
        echo "<script>
            window.location.href = '../../login.php?error=Invalid username or password.'; // Redirect back to login
            </script>";
    }

    // Close statement and connection
    $status->close();
    $conn->close();
}elseif($_REQUEST['req_type'] == 'chnagePassword'){
    $userId = intval($_COOKIE['userAuth']); // Replace with your user authentication logic
    
    // Retrieve old and new passwords from form submission
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['pass'];
    $address = $_POST['address'];

    // Check if the old password matches
    $query = "SELECT pass FROM users WHERE id = ?";
    $status = $conn->prepare($query);
    $status->bind_param("i", $userId); // Bind the user ID
    $status->execute();
    $result = $status->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Compare old password with the database value (no hashing, since plaintext is used)
        if ($user['pass'] === $oldPassword) {
            // Update the password in the database
            $updateQuery = "UPDATE users SET pass = ?, address = ? WHERE id = ?";
            $updateStatus = $conn->prepare($updateQuery);
            $updateStatus->bind_param("ssi", $newPassword, $address, $userId); // Bind the new password and user ID
            if ($updateStatus->execute()) {
                header('location:../../login.php?success=Password updated successfully!');
            } else {
                header('location:../../login.php?error=Failed to update password.');
            }
        } else {
            header('location:../../login.php?error=Old password is incorrect.');
        }
    } else {
        header('location:../../login.php?error=User not found.');
    }
} else {
    header('location:../../singup.php?error=Something Went Wrong');
}
?>