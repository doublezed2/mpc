<?php
include("db-config.php"); 
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * from users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if($row['user_role'] == "admin"){
        $_SESSION['user_type'] = "admin_user";
        $_SESSION['user_name'] = "admin";
    }
    else{
        $_SESSION['user_type'] = "sell_user";
        $_SESSION['user_name'] = $row['username'];        
    }
    header("Location:sell.php");
}
else{
    header("Location:index.php");
}

?>