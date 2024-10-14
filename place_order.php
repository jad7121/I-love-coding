<?php
session_name("customer_session");
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    echo "You need to be logged in to place an order.";
    
    exit();
}

//session 
$customer_id = $_SESSION['customer_id'];

// Retrieve cart items from session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit();
}

// Prepare to place the order
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Insert order into the orders table
$query = "INSERT INTO orders (customer_id, total_price, kitchen_status, order_date) VALUES (?, ?, 'pending', NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("id", $customer_id, $total);
if ($stmt->execute()) {
    $order_id = $stmt->insert_id;

    // Insert order items
    $query = "INSERT INTO order_items (order_id, food_item_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    foreach ($_SESSION['cart'] as $item) {
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Clear cart
    unset($_SESSION['cart']);
    echo "Order placed successfully.";
} else {
    echo "Failed to place order. Please try again.";
}

$stmt->close();
$conn->close();
?>
