<?php
session_name('customer_session');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['customer_id'])) {
    echo "<script>
        sessionStorage.setItem('customer_id', '" . $_SESSION['customer_id'] . "');
        sessionStorage.setItem('username', '" . $_SESSION['username'] . "');
        sessionStorage.setItem('first_name', '" . $_SESSION['first_name'] . "');
        sessionStorage.setItem('last_name', '" . $_SESSION['last_name'] . "');
    </script>";
}
// Fetch user details from the session or database if needed
$username = $_SESSION['username'];
//$first_name = $_SESSION['first_name'];
//$last_name = $_SESSION['last_name'];
//$name = $first_name." ".$last_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('nav.php'); ?>
    <title>Dashboard</title>
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
            <a href="customer_orders.php">View Orders</a>
            <a href="index.php">Shop</a>
        </div>
        <div class="content">
        
        </div>
    </div>
</body>
</html>
