<?php
date_default_timezone_set("Asia/Karachi");
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$s_id = $_POST['s_id'];
$company = $_POST['p_comp'];
$p_type = $_POST['p_type'];
$p_date = $_POST['p_date'];
$p_name = $_POST['p_name'];
$quantity = $_POST['quantity'];
$packing = $_POST['packing'];
$p_batch = $_POST['p_batch'];
$p_expiry = $_POST['p_expiry'];
$r_price = $_POST['r_price'];
$t_price = $_POST['t_price'];
$u_price = $_POST['u_price'];
$total_stock = $_POST['total_stock'];

echo $sql = "UPDATE stock SET company='$company', p_type='$p_type', p_date='$p_date', p_name='$p_name', quantity='$quantity', packing='$packing', p_batch='$p_batch', p_expiry='$p_expiry', r_price='$r_price', t_price='$t_price', u_price='$u_price' , total_stock=$total_stock WHERE id=$s_id";
if ($conn->query($sql) === TRUE) {
  $date = date('Y-m-d H:i:s');
  file_put_contents("query.log",$date." - Update Stock - ".$sql."\n",FILE_APPEND);
  header("Location:view-stock.php?id=$s_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>