<?php
// Database connection
include 'connection.php';

if (isset($_GET['order_id'])) {
    $orderId = intval($_GET['order_id']);

    // Fetch order details
    $query = "
        SELECT 
            o.id as order_id, 
            u.name as user_name, 
            u.address, 
            u.phone, 
            o.totalCost as total_price, 
            o.orderStatus, 
            oi.product_id, 
            p.name as product_name, 
            oi.product_quantity, 
            p.price as product_price
        FROM orders o
        JOIN users u ON o.user_id = u.id
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.id = $orderId
    ";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<p>Order ID: ' . $row['order_id'] . '</p>';
        echo '<p>Customer: ' . htmlspecialchars($row['user_name']) . '</p>';
        echo '<p>Address: ' . htmlspecialchars($row['address']) . '</p>';
        echo '<p>Phone: ' . htmlspecialchars($row['phone']) . '</p>';
        echo '<p>Status: ' . ucfirst($row['orderStatus']) . '</p>';
        echo '<p>Total Cost: Tk ' . number_format($row['total_price'], 2) . '</p>';
        echo '<h5>Order Items</h5>';
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr></thead><tbody>';
        
        do {
            $subtotal = $row['product_quantity'] * $row['product_price'];
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
            echo '<td>' . $row['product_quantity'] . '</td>';
            echo '<td>Tk ' . number_format($row['product_price'], 2) . '</td>';
            echo '<td>Tk ' . number_format($subtotal, 2) . '</td>';
            echo '</tr>';
        } while ($row = $result->fetch_assoc());

        echo '</tbody></table>';
    } else {
        echo '<p>No order details found.</p>';
    }
}
?>
