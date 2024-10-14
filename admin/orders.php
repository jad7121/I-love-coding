<?php
session_name('admin_session');
session_start();
include('../conn.php');

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
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

<?php

$user_id = $_SESSION['admin_id'];
$role = $_SESSION['role'];
$region_id = $_SESSION['region_id'];

switch ($_SESSION['role']) {
    case 'management':
          // Query to fetch orders for the logged-in user
$query = "SELECT o.id, o.customer_id, o.total_price AS price, o.kitchen_status AS kitchen_status, o.delivery_status AS delivery_status, o.delivered_by AS delivered_by, c.first_name AS c_fname, c.last_name AS c_lname, ad.first_name AS ad_fname, ad.last_name AS ad_lname, ad.middle_name AS ad_mname
FROM orders o
JOIN customers c ON o.customer_id = c.id
JOIN customer_addresses a ON c.id = a.customer_id
LEFT JOIN admins ad ON o.delivered_by = ad.id
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

echo'
<div class="container">
        <h1>Orders</h1>
        <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Kitchen Status</th>
            <th>Delivery Status</th>
            <th>Delivery by</th>
        </tr>';
        while ($row = $result->fetch_assoc()){
            echo'
            <tr>
            <td><a href="order_details.php?order_id='.$row["id"].'">'.$row["id"].'</a></td>
                <td>'.$row["c_fname"] . " " . $row["c_lname"].'</td>
                <td>'.$row["price"].'</td>
                <td>'.$row["kitchen_status"].'</td>
                <td>'.$row["delivery_status"].'</td>
                <td>'.$row["ad_fname"]." ". $row["ad_mname"]." ".$row["ad_lname"].'</td>
            </tr>';
        }
            echo '
    </table>
    </div>
    <br>
';
        break;
    default:
   // Query to fetch orders for the logged-in user
$query = "SELECT o.id, o.customer_id, o.total_price AS price, o.kitchen_status AS kitchen_status, o.delivery_status AS delivery_status, o.delivered_by AS delivered_by, c.first_name AS c_fname, c.last_name AS c_lname, ad.first_name AS ad_fname, ad.last_name AS ad_lname, ad.middle_name AS ad_mname
FROM orders o
JOIN customers c ON o.customer_id = c.id
JOIN customer_addresses a ON c.id = a.customer_id
LEFT JOIN admins ad ON o.delivered_by = ad.id
WHERE a.region_id = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $region_id);
$stmt->execute();
$result = $stmt->get_result();

echo'
<div class="container">
        <h1>Orders</h1>
        <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Kitchen Status</th>
            <th>Delivery Status</th>
            <th>Delivery by</th>
        </tr>';
        while ($row = $result->fetch_assoc()){
            echo'
            <tr>
            <td><a href="order_details.php?order_id='.$row["id"].'">'.$row["id"].'</a></td>
                <td>'.$row["c_fname"] . " " . $row["c_lname"].'</td>
                <td>'.$row["price"].'</td>
                <td>'.$row["kitchen_status"].'</td>
                <td>'.$row["delivery_status"].'</td>
                <td>'.$row["ad_fname"]." ". $row["ad_mname"]." ".$row["ad_lname"].'</td>
            </tr>';
        }
            echo '
    </table>
    </div>
    <br>
';
}



?>
    
            
          <?php  
          
          

            switch ($role) {
                case 'kitchen':
                    echo'<center><div>
                <a href="kitchen_dashboard.php">Back</a>
            </div></center>';
                    break;
                case 'rider':
                    echo'<center><div>
                    <a href="rider_dashboard.php">Back</a>
                </div></center>';
                    break;
                case 'management':
                    echo'<center><div>
                <a href="management_dashboard.php">Back</a>
            </div></center>';
                    break;
            }
            ?>
</body>
</html>


