<?php
$servername = "localhost";
$dbusername = "roots";
$dbpassword = "1234567890";
$dbname = "mpc_db";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!---update this file --->
