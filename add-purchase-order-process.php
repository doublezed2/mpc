<?php    
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php");

$p_invoice = $_POST['p-invoice'];
$p_date = $_POST['p-date'];

$i=1;
for ($i=1; $i <21 ; $i++) {
  $i_pname =  'p-name-'.$i;
  $i_comp =   'p-company-'.$i;
  $i_type =   'p-type-'.$i;
  $i_qty =    'p-qty-'.$i;
  $i_batch =  'p-batch-'.$i;
  $i_exp =    'p-exp-'.$i;
  $i_pck =    'p-pck-'.$i;
  $i_rt =     'p-rt-'.$i;
  $i_tp =     'p-tp-'.$i;
  $i_up =     'p-up-'.$i;
  $i_bp =     'p-bp-'.$i;
  if(strlen($_POST[$i_pname])>0){
    $p_name = $_POST[$i_pname];
    $p_company = $_POST[$i_comp];
    $p_type = $_POST[$i_type];
    $p_qty = $_POST[$i_qty];
    $p_batch = $_POST[$i_batch];
    $p_expiry = $_POST[$i_exp];
    $p_packing = $_POST[$i_pck];
    $p_retail = $_POST[$i_rt];
    $p_tp = $_POST[$i_tp];
    $p_up = $_POST[$i_up];
    $b_perc = $_POST[$i_bp];
    $total_stock = $p_packing * $p_qty;
    $total_stock = $total_stock;

    $sql = "INSERT INTO stock (p_name, company, p_type, p_date, invoice_no, p_batch, p_expiry, r_price, t_price, u_price, packing, quantity, bonus_perc, total_stock)
    VALUES ('$p_name','$p_company','$p_type', '$p_date', '$p_invoice', '$p_batch', '$p_expiry', $p_retail, $p_tp, $p_up, $p_packing, $p_qty, $b_perc, $total_stock)";
    if ($conn->query($sql) === TRUE) {
      header("Location:add-purchase-order.php?success=".$i);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
  }
}


$conn->close();


?>