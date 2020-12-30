<?php
$prod_name = $_POST['prod_name'];
$company = $_POST['company'];
$discount = $_POST['discount'];
if(empty($prod_name && $company && $discount)){
 header("Location:add-prod.php?true=1");
 }
 else{
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$prod_name = $_POST['prod_name'];
$company = $_POST['company'];
$discount = $_POST['discount'];

$sql = "INSERT INTO products (p_name, company, discount)
VALUES ('$prod_name','$company','$discount' )";

if ($conn->query($sql) === TRUE) {
    header("Location:add-prod.php?true=2");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>