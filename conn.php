<?php 
$conn = new mysqli('localhost', 'root', '', 'group_four_project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>