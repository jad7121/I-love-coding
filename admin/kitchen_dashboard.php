<?php
session_name("admin_session");
session_start();
include('../conn.php');

// Check if the admin is logged in and is kitchen staff
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'kitchen') {
    header("Location: admin_login.php");
    exit();
}

 // Fetch user details from the session or database 
 $username = $_SESSION['username'];
 $region_id = $_SESSION['region_id'];

// Fetch pending orders
$query = "SELECT o.id, o.customer_id, o.total_price, c.first_name, c.last_name
          FROM orders o
          JOIN customers c ON o.customer_id = c.id
          JOIN customer_addresses a ON c.id = a.customer_id
          JOIN regions r ON a.region_id = r.id
          WHERE o.kitchen_status = 'pending' AND r.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $region_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('nav.php'); ?>
    <title>Kitchen Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .header {
            margin-top: 20px;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            margin: 0 15px;
            text-decoration: none;
            color: #007BFF;
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .content {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        </div>
        <div class="menu">
            <a href="orders.php">View Orders</a>
            <a href="account_settings.php">Account Settings</a>
        </div>
    </div>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td><button onclick="confirmOrder(<?php echo $row['id']; ?>)">Confirm</button></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        function confirmOrder(orderId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "confirm_order.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send("order_id=" + orderId);
        }
    </script>
</body>
</html>
