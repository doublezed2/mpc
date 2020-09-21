<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$prod_name =  $_POST['prod_name'];
$company =    $_POST['company'];
$p_type =     $_POST['p_type'];
$packing =    $_POST['packing'];
$r_price =    $_POST['r_price'];
$t_price =    $_POST['t_price'];
$u_price =    $_POST['u_price'];
$discount =   $_POST['discount'];

$sql = "INSERT INTO products (p_name, p_type, company, packing, r_price, t_price, u_price, discount)
VALUES ('$prod_name','$p_type','$company',$packing,$r_price,$t_price,$u_price,'$discount')";

if ($conn->query($sql) === TRUE) {
    header("Location:add-prod.php?true=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>