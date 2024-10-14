<?php
session_name("customer_session");
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['customer_id'];
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Validate the order ID
if ($order_id <= 0) {
    echo "Invalid order ID.";
    exit();
}

// Query to fetch order details
$query = "SELECT * FROM orders WHERE id = ? AND customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows === 0) {
    echo "Order not found.";
    exit();
}

$order = $order_result->fetch_assoc();

// Query to fetch order items
$query_items = "SELECT oi.*, fi.name AS item_name, fi.price, fi.description 
    FROM order_items oi
    JOIN food_items fi ON oi.food_item_id = fi.id
    WHERE oi.order_id = ?";
$stmt_items = $conn->prepare($query_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
        <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p><strong>Total:</strong> GH₵ <?php echo htmlspecialchars($order['total_price']); ?></p>
        <p><strong>Status:</strong> <?php echo ('Processing'); ?></p>
        
        <h2>Order Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Food Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($items_result->num_rows > 0): ?>
                    <?php while ($item = $items_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>GH₵ <?php echo htmlspecialchars($item['price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No food order found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <br>
    <center><div>
                <a href="dashboard.php">Back</a>
            </div>
    </center>'
</body>
</html>

<?php
$stmt->close();
$stmt_items->close();
$conn->close();
?>
