<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('nav.php'); ?>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    <?php
session_name('customer_session');
session_start(); 

// Database connection
include('conn.php');

// Check if the user is already logged in
if (isset($_SESSION['customer_id'])) {
     // Redirect to dashboard if logged in
    header("Location: dashboard.php");
    
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query 
    $query = "SELECT id, first_name, last_name, password FROM customers WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $last_name, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['customer_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
