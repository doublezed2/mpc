<?php 
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$prod_id = $_POST['prod_id'];
$prod_name = $_POST['prod_name'];
$company = $_POST['company'];
$p_type = $_POST['p_type'];
$packing = $_POST['packing'];
$r_price = $_POST['r_price'];
$t_price = $_POST['t_price'];
$u_price = $_POST['u_price'];
$discount = $_POST['discount'];

$sql = "UPDATE products SET p_name='$prod_name', company='$company', p_type='$p_type', packing='$packing', r_price='$r_price', t_price='$t_price', u_price='$u_price', discount='$discount' WHERE id=$prod_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-prod.php?true=$prod_name");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>