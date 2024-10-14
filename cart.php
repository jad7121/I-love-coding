<?php
session_name("customer_session");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   //include database file
    include('conn.php');

    if ($action == 'add') {
        $itemId = $data['itemId'];
        $query = "SELECT * FROM food_items WHERE id = $itemId";
        $result = $conn->query($query);
        $item = $result->fetch_assoc();

        if (!$item) {
            echo json_encode(['status' => 'error', 'message' => 'Item not found']);
            exit;
        }

        $itemExists = false;
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        } else {
            foreach ($_SESSION['cart'] as &$cartItem) {
                if ($cartItem['id'] == $itemId) {
                    $cartItem['quantity'] += 1;
                    $itemExists = true;
                    break;
                }
            }
        }

        if (!$itemExists) {
            $item['quantity'] = 1;
            $_SESSION['cart'][] = $item;
        }

        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
    } elseif ($action == 'clear') {
        $_SESSION['cart'] = [];
        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
    } elseif ($action == 'remove') {
        $index = $data['index'];
        if (isset($_SESSION['cart'][$index])) {
            array_splice($_SESSION['cart'], $index, 1);
            echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Item not found']);
        }
    }

    $conn->close();
}
?>
