<?php 
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$prod_name = $_POST['prod_name'];
$prod_id = $_POST['prod_id'];
$company = $_POST['company'];
$discount = $_POST['discount'];
echo $sql = "UPDATE products SET p_name='$prod_name', company='$company', discount='$discount' WHERE id=$prod_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-prod.php?id=$prod_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>