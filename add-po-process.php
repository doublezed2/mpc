<?php   
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$p_name = $_POST['p_name'];
$p_company = $_POST['p_comp'];
$p_type = $_POST['p_type'];
$p_date = $_POST['p_date'];
$invoice_no = $_POST['p_inv'];
$p_batch = $_POST['p_batch'];
$p_expiry = $_POST['p_exp'];
$p_retail = $_POST['p_rp'];
$p_tp = $_POST['p_tp'];
$p_up = $_POST['p_up'];
$p_packing = $_POST['p_pck'];
$p_qty = $_POST['p_qty'];

$sql = "INSERT INTO stock (p_name, company, p_type, p_date, invoice_no, p_batch, p_expiry, r_price, t_price, u_price, packing)
VALUES ('$p_name','$p_company','$p_type', '$p_date', '$invoice_no', '$p_batch', '$p_expiry', '$p_retail', '$p_tp', '$p_up', '$p_packing')";

if ($conn->query($sql) === TRUE) {
    echo "Product added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>