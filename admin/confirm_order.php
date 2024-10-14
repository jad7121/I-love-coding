<?php
session_name("admin_session");
session_start();
include('../conn.php');

// Check if the admin is logged in and is kitchen staff
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'kitchen') {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    // Update the order status
    $query = "UPDATE orders SET kitchen_status = 'confirmed', kitchen_confirmation_time = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        echo "Order confirmed successfully.";
    } else {
        echo "Failed to confirm the order.";
    }

    $stmt->close();
    $conn->close();
}
?>
