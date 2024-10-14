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

// Query to fetch orders for the logged-in user
$query = "SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('nav.php'); ?>
    <title>My Orders</title>
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
        a {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Delivery</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <tr>
                            <td><a href="order_details.php?order_id=<?php echo htmlspecialchars($order['id']); ?>"><?php echo htmlspecialchars($order['id']); ?></a></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                            <td><?php echo htmlspecialchars($order['kitchen_status']); ?></td>
                            <td><?php echo htmlspecialchars($order['delivery_status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
        <center><div>
                    <a href="dashboard.php">Back</a>
                </div>
        </center>'
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
