<?php
session_start();
if($_SESSION["user_type"] == 'admin_user' || $_SESSION["user_type"] == 'sell_user'){}
else{
  header("Location:index.php");
}
include("db-config.php"); 

date_default_timezone_set("Asia/Karachi");
$from_date = date("Y-m-d")." 00:00:00"; 
$to_date = date("Y-m-d H:i:s"); 
$qsql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date'";
$qresult = $conn->query($qsql);  
$inv_count = $qresult->num_rows + 1;

$c_cartStock = $_POST['c_cartStock'];
//$c_cartStock = '|<a class="remove-item-btn" href="#">X</a>|D-Enzyme forte Tab|16.50|1|16.5|1.65|';
$bill_invoice = $inv_count;
$total_bill = $_POST['c_final_bill'];
//$total_bill="14.85";
$cur_date = date("Y-m-d H:i:s");

$p_items_arr = explode("|",$c_cartStock);
$p_counter =2;
$cart_str = "";
while($p_counter<count($p_items_arr)){
    $pr_name = $p_items_arr[$p_counter];
    $pr_qty = $p_items_arr[$p_counter+2];
    $cart_str = $cart_str . " -- " . $pr_name ." x ".$pr_qty;
    $p_counter+=6;
}
$account_name = $_SESSION['user_name'];
$sql = "INSERT INTO sales (invoice_num, items_purchased, total_bill, date_created, account_name) VALUES ('$bill_invoice', '$cart_str', '$total_bill', '$cur_date', '$account_name')";
if ($conn->query($sql) === TRUE) {
   // echo "Bill added to DB successfully!";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

$cart_arr = explode("|","$c_cartStock");
$counter =2;
while($counter<count($cart_arr)){
    $p_name = $cart_arr[$counter];
    $p_qty = $cart_arr[$counter+2];
    $sql = "UPDATE stock SET total_stock = total_stock - $p_qty WHERE p_name = '$p_name'";
    if ($conn->query($sql) === TRUE) {
       // echo "product minus successfull!";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $counter+=6;
}

$stock_arr = explode("|",$c_cartStock);
$stock_counter =2;
while($stock_counter<count($stock_arr)){
    $stock_p_name = $stock_arr[$stock_counter];
    $stock_p_qty = $stock_arr[$stock_counter+2];
    $stock_sql = "INSERT INTO profit (p_name, p_company, p_type, p_date, p_quantity, r_price, t_price, u_price, discount)
    SELECT '$stock_p_name', stock.company, stock.p_type, '$cur_date', '$stock_p_qty', stock.r_price, stock.t_price, stock.u_price, companies.discount FROM stock INNER JOIN companies ON stock.company=companies.comp_name WHERE stock.p_name like '$stock_p_name' AND stock.total_stock > 0";
    //echo $stock_sql;
    if ($conn->query($stock_sql) === TRUE) {
       // echo "product minus successfull!";
    } 
    $stock_counter+=6;
}

echo $inv_count;

$conn->close();


?>