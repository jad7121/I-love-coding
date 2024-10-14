<?php
session_name('admin_session');
session_start();
include('../conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('nav.php'); ?>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
<?php

// Check if the admin is already logged in
if (isset($_SESSION['admin_id'])) {
    switch ($_SESSION['role']) {
        case 'kitchen':
            header("Location: kitchen_dashboard.php");
            break;
        case 'rider':
            header("Location: rider_dashboard.php");
            break;
        case 'management':
            header("Location: management_dashboard.php");
            break;
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query
    $query = "SELECT id, password, region_id, role FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the admin exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $region_id, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {

            //set sessions
            $_SESSION['admin_id'] = $id;
            $_SESSION['region_id'] = $region_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            //redirect admin user based on role
            switch ($role) {
                case 'kitchen':
                    header("Location: kitchen_dashboard.php");
                    break;
                case 'rider':
                    header("Location: rider_dashboard.php");
                    break;
                case 'management':
                    header("Location: management_dashboard.php");
                    break;
            }
            exit();
        }
    } else {
        echo "Invalid username or password.";
    }

//close connection
    $stmt->close();
    $conn->close();
}
?>
    <form method="post" action="admin_login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
