<?php
session_name("admin_session"); // Set the session name for admin
session_start(); // Start the admin session

// Clear the admin session data
session_unset();
session_destroy(); // Destroy the admin session

// Redirect to the admin login page
header("Location: admin_login.php");
exit();
?>
