<?php
session_name('admin_session');
session_start();
include('../conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('nav.php'); ?>
    <title>Add Admin User | WowFoods</title>
</head>

<body>
    <h2>Add User</h2>
<?php


// Check if the any admin user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if logged in user is having "management" role
if ($_SESSION['role'] != 'management') {
    switch ($_SESSION['role']) {
        case 'kitchen':
            header("Location: kitchen_dashboard.php");
            break;
        case 'rider':
            header("Location: rider_dashboard.php");
            break;
    }
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $region_id = $_POST['region_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if the username already exists
    $query = "SELECT id FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already taken";
        //TODO
        //You will be redirected in 5 seconds to the login page
    } else {
        // Insert new admin user into the database
        $query = "INSERT INTO admins (username, region_id, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $username, $region_id, $password, $role);

            if ($stmt->execute()) {
                echo "Admin registration successful.";
                } else {
                    echo "Admin registration failed.";
                }
            }


    

    $stmt->close();
}


// Fetch regions
$query = "SELECT * FROM regions";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
    <form method="post" action="admin_register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="region_id">Region:</label>
        <select id="region_id" name="region_id" required>
        <option value="">-----Select Region--------</option>
        <?php while ($row = $result->fetch_assoc()){ ?>
        <option value="<?php echo $row['id']; ?>">
            <?php echo $row['name']; ?>
        </option>
        <?php } ?>
        </select><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="kitchen">Kitchen</option>
            <option value="rider">Rider</option>
            <option value="management">Management</option>
        </select><br>

        <input type="submit" value="ADD">
    </form>
</body>
</html>
