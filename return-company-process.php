<?php    
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php");

$r_invoice = $_POST['r-invoice'];
$r_date = $_POST['r-date'];

$i=1;

for ($i=1; $i <21 ; $i++) {
  $i_pid =  'p-id-'.$i;
  $i_qty =  'p-qty-'.$i;
  
  if(strlen($_POST[$i_pid])>0){
    $p_id = $_POST[$i_pid];
    $p_qty = $_POST[$i_qty];
    
    $sql = "INSERT INTO return_company(p_name, company, p_type, invoice_no, p_date, p_batch, p_expiry, r_price, t_price, packing, quantity, bonus_perc, return_date, return_invoice) SELECT p_name, company, p_type, invoice_no, p_date, p_batch, p_expiry, r_price, t_price, packing, $p_qty, bonus_perc, '$r_date', '$r_invoice' FROM stock WHERE id = $p_id";
    if ($conn->query($sql) === TRUE) {
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $sl_sql = "SELECT packing FROM stock WHERE id=$p_id ";
    $sl_result = $conn->query($sl_sql);
    $sl_row = $sl_result->fetch_assoc();
    $total_qty = $sl_row["packing"] * $p_qty;

    $usql = "UPDATE stock SET total_stock = total_stock - $total_qty  WHERE id = $p_id";
    if ($conn->query($usql) === TRUE) {
      header("Location:return-company.php?success=".$i);
    }
    else {
        echo "Error: " . $usql . "<br>" . $conn->error;
    }  
  }
}
$conn->close();
?>