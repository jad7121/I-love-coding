<?php
session_name('customer_session');
session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('nav.php'); ?>
    <title>Register</title>
</head>
<body>
    <hr>
    <h3>CUSTOMER INFORMATION</h3>
<?php
// Check if the user is already logged in
if (isset($_SESSION['customer_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $username = $_POST['username'];
    // Hash the password
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    // Address details
    $address = $_POST['address'];
    $region_id = $_POST['region_id'];
    $city = $_POST['city'];
    $digital_address_code = $_POST['digital_address_code'];

    // Check if the username, phone or email already exists
    $query = "SELECT id FROM customers WHERE username = ? OR email = ? OR phone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $phone);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "You already have an account, Try logging in";
        //TODO
        //You will be redirected in 5 seconds to the login page
    } else {
        // Insert customer into customers table
            $query = "INSERT INTO customers (first_name, last_name, username, password, phone, email, sex, date_registered) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssss", $first_name, $last_name, $username, $password, $phone, $email, $sex);
                if ($stmt->execute()) {
                    $customer_id = $stmt->insert_id;

                    // Insert address into customer_addresses table
                    $query = "INSERT INTO customer_addresses (customer_id, address, city, region_id, digital_code) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("issss", $customer_id, $address, $city, $region_id, $digital_address_code);
                    $stmt->execute();

                    echo "Registration successful!";
                } else {
                    echo "Error: " . $stmt->error;
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

    <hr>
    <form method="post" action="register.php">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="sex">Sex:</label>
        <select id="sex" name="sex" required>
            <option value="">----- Select Sex ----</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <hr>
        <h3>ADRESS INFORMATION</h3>
        <hr>
        <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>
    <label for="region_id">Region:</label>
        <select id="region_id" name="region_id" required>
        <option value="">-----Select Region--------</option>
        <?php while ($row = $result->fetch_assoc()){ ?>
        <option value="<?php echo $row['id']; ?>">
            <?php echo $row['name']; ?>
        </option>
        <?php } ?>
        </select><br>
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required><br>
    <label for="digital_address_code">Digital Address Code:</label>
    <input type="text" id="digital_address_code" name="digital_address_code" required><br>
<br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
