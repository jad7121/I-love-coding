<?php
session_name('admin_session');
session_start();
include('../conn.php');

// Check if the admin is logged in and is part of management
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'management') {
    header("Location: admin_login.php");
    exit();
}


    // Fetch user details from the session or database 
    $username = $_SESSION['username'];
    

// Fetch all orders for review
$query = "SELECT orders.id, orders.customer_id, orders.total_price, orders.kitchen_status, orders.delivery_status, c.first_name, c.last_name
          FROM orders
          JOIN customers c ON orders.customer_id = c.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('nav.php');?>
    <title>Management Dashboard</title>
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

    
</body>
</html>
