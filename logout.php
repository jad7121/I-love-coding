<?php
session_name("customer_session");
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
