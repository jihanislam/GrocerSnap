<?php require_once('inc/header.php'); ?>
<?php

include 'core/connection.php'; // Include database connection file

// Check if the confirm action is set
if (isset($_GET['confirm'])) {
    $orderId = intval($_GET['confirm']); // Sanitize input to prevent SQL injection

    // Update the orderStatus in the database
    $updateQuery = "UPDATE orders SET orderStatus = 'confirm' WHERE id = ?";
    $status = $conn->prepare($updateQuery);

    if ($status) {
        $status->bind_param("i", $orderId); // Bind the order ID
        if ($status->execute()) {
            // Redirect with success message
            echo "<script>
                window.location.href = 'order.php?success=Order confirmed successfully';
            </script>";
            exit();
        } else {
            // Redirect with error message
            echo "<script>
                window.location.href = 'order.php?success=Failed to confirm Order';
            </script>";
            exit();
        }
    } else {
        // Handle errors in preparing the statement
        echo "<script>
                window.location.href = 'order.php?Database error';
            </script>";
        exit();
    }
}

?>

<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
    <thead>
        <tr>
            <th>id</th>
            <th>User</th>
            <th>Address</th>
            <th>total Qty</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        // Fetch high-level orders data
        $query = "
            SELECT 
                o.id as order_id, 
                u.name as user_name, 
                u.address, 
                u.phone, 
                o.totalCost as total_price, 
                o.orderStatus 
            FROM orders o
            JOIN users u ON o.user_id = u.id
        ";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row['orderStatus'] == 'confirm'){
                    continue;
                }
                echo '<tr>';
                echo '<td>' . $row['order_id'] . '</td>';
                echo '<td>' . htmlspecialchars($row['user_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                echo '<td> Tk ' . number_format($row['total_price'], 2) . '</td>';
                echo '<td>' . ucfirst($row['orderStatus']) . '</td>';
                echo '<td>
                        <button class="btn btn-info view-details" data-id="' . $row['order_id'] . '">View</button>
                        <form action="order.php" method="GET" style="display:inline;">
                            <input type="hidden" name="confirm" value="'.$row['order_id'].'">
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </form>
                    </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="7">No orders found.</td></tr>';
        }
    ?>
</tbody>

<!-- Modal for Viewing Order Details -->
<div id="orderDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 p-0">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="order-details">
                <!-- Details will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add Bootstrap JS for modal support -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $(".view-details").on("click", function() {
        const orderId = $(this).data("id");
        
        $.ajax({
            url: "core/orderDetails.php", // PHP script to fetch order details
            type: "GET",
            data: { order_id: orderId },
            success: function(response) {
                $("#order-details").html(response); // Load response into modal
                $("#orderDetailsModal").modal("show"); // Show modal
            },
            error: function() {
                alert("Failed to fetch order details.");
            }
        });
    });
});
</script>
<?php require_once('inc/footer.php');?>