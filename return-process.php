<?php    
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:sell.php");
}
include("db-config.php"); 
$p_company = $_POST['p_comp'];
$p_type = $_POST['p_type'];
$p_date = $_POST['p_date'];
$p_name = $_POST['p_name'];
$p_qty = $_POST['p_qty'];
$p_packing = $_POST['p_pck'];
$p_batch = $_POST['p_batch'];
$p_expiry = ($_POST['p_exp'] == "") ? NULL : $_POST['p_exp'];
$p_retail = $_POST['p_rp'];
$p_tp = $_POST['p_tp'];
$p_up = $_POST['p_up'];
$fl_p_discount = 0;
$fl_p_up = floatval($p_up);
$discount = $fl_p_up * ($fl_p_discount)/100;
$discount_price = $fl_p_up - $discount;

// $select = "SELECT discount FROM products WHERE p_name = '$p_name'";
// $s_result = $conn->query($select);

// if ($s_result->num_rows > 0) {
//   $s_row = $s_result->fetch_assoc();
//   $fl_p_discount = floatval($s_row["discount"]);
//   $fl_p_up = floatval($p_up);
//   $discount = $fl_p_up * ($fl_p_discount)/100;
//   $discount_price = $fl_p_up - $discount;
// } else {
//     exit("Error: Product not found");
// }

$n_qty = $p_qty * -1;
$pr_sql = "INSERT INTO profit (p_name,p_company,p_type,p_date,p_quantity,r_price,t_price,packing,discount)
VALUES ('$p_name','$p_company','$p_type', '$p_date', $n_qty, $p_retail, $p_tp, $p_packing, $fl_p_discount)";
if ($conn->query($pr_sql) === TRUE) {
} else {
    echo "Error: " . $pr_sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO stock (p_name, company, p_type, p_date, invoice_no, p_batch, p_expiry, r_price, t_price, u_price, packing, quantity, total_stock, returned)
VALUES ('$p_name','$p_company','$p_type', '$p_date', 'n/a', '$p_batch', '$p_expiry', '$p_retail', '$p_tp', '$p_up', '$p_packing', 1, $p_qty, 1)";
if ($conn->query($sql) === TRUE) {
  $conn->close();
  $amount_return = $discount_price * $p_qty;
  header("Location:return-product.php?return=$amount_return");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>