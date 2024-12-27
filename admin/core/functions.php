<?php
include 'connection.php';
if($_REQUEST['req_type'] == 'cardChecked'){

    // Redirect if the user is not logged in
    if (!isset($_COOKIE['userAuth'])) {
        header("Location: ../../login.php?error=Please Login First");
        exit();
    }
    
    // Retrieve data from POST request
    $product_ids = $_POST['id'] ?? [];
    $product_quantities = $_POST['quentity'] ?? [];
    
    // Calculate total cost
    $totalCost = 0;
    foreach ($product_ids as $key => $product_id) {
        $quantity = $product_quantities[$key];
        // Fetch product price from database
        $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();
    
        $totalCost += $price * $quantity;
    }
    
    // Insert order into the "orders" table
    $user_id = $_COOKIE['userAuth'];
    $orderStatus = 'pending';
    
    $stmt = $conn->prepare("INSERT INTO orders (totalCost, orderStatus, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("dsi", $totalCost, $orderStatus, $user_id);
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Get the last inserted order ID
        $stmt->close();
    
        // Insert order items into the "order_items" table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_quantity) VALUES (?, ?, ?)");
    
        foreach ($product_ids as $key => $product_id) {
            $quantity = $product_quantities[$key];
            $stmt->bind_param("iii", $order_id, $product_id, $quantity);
            $stmt->execute();
        }
        $stmt->close();
    
        // Clear the cart by resetting localStorage via JavaScript
        echo '<script>
                localStorage.removeItem("cart");
                window.location.href = "../../cart.php?success=Order placed successfully!";
              </script>';
    } else {
        echo '<script>
                window.location.href = "../../cart.php?error=Failed to place order. Please try again.";
              </script>';
    }
}