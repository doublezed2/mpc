<?php
$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username && $password )){
    header("Location:index.php?empty=0");

} ///end if
else{
include("db-config.php"); 
session_start();
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
    header("Location:index.php?empty=0");
}
} /// Else
?>