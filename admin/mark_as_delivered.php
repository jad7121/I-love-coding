<?php
session_name("admin_session");
session_start();
include('../conn.php');

// Check if the admin is logged in and is a rider
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'rider') {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $admin_id = $_POST['admin_id'];

    // Update the order status
    $query = "UPDATE orders SET delivery_status = 'delivered', delivery_time = NOW(), delivered_by = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $admin_id, $order_id);
    if ($stmt->execute()) {
        echo "Delivery was successfully!";
    } else {
        echo "Failed to mark the order as delivered.";
    }

    $stmt->close();
    $conn->close();
}
?>
