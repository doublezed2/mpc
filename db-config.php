<?php
$servername = "localhost";
$username = "roots";
$password = "1234567890";
$dbname = "mpc_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
