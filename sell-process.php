<?php
session_start();
if($_SESSION["user_type"] == 'admin_user' || $_SESSION["user_type"] == 'sell_user'){}
else{
  header("Location:index.php");
}
include("db-config.php"); 

// Generate an invoice number using date time.
date_default_timezone_set("Asia/Karachi");
$from_date = date("Y-m-d")." 00:00:00"; 
$to_date = date("Y-m-d H:i:s"); 
$qsql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date'";
$qresult = $conn->query($qsql);  
$inv_count = $qresult->num_rows + 1;

$c_cartStock = $_POST['c_cartStock'];
//$c_cartStock = '|<a class="remove-item-btn" href="#">X</a>|Anpra 0.5mg Tab|7.69|1|7.69|0|51|<a class="remove-item-btn" href="#">X</a>|Cabot-D3 Tab|22.5|1|22.5|2.25|180|<a class="remove-item-btn" href="#">X</a>|Baclin Tab|5.6|1|5.6|0.28|90|';
$bill_invoice = $inv_count;
$total_bill = $_POST['c_final_bill'];
//$total_bill="705.01";
$cur_date = date("Y-m-d H:i:s");
$p_items_arr = explode("|",$c_cartStock);
$p_counter =2;
$cart_str = "";
while($p_counter<count($p_items_arr)){
    $pr_name = $p_items_arr[$p_counter];
    $pr_price = $p_items_arr[$p_counter+1];
    $pr_qty = $p_items_arr[$p_counter+2];
    $pr_discount = $p_items_arr[$p_counter+4];
    $cart_str = $cart_str . " -- " . $pr_name ." | ".$pr_price." | ".$pr_qty." | ".$pr_discount;
    $p_counter+=7;
}
$account_name = $_SESSION['user_name'];
$sql = "INSERT INTO sales (invoice_num, items_purchased, total_bill, date_created, account_name) VALUES ($bill_invoice, '$cart_str', $total_bill, '$cur_date', '$account_name')";
if ($conn->query($sql) === TRUE) {
    // echo "Bill added to DB successfully!";
} else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
}
$stock_arr = explode("|",$c_cartStock);
$stock_counter =2;
while($stock_counter<count($stock_arr)){
    $stock_p_name = $stock_arr[$stock_counter];
    $stock_p_qty = $stock_arr[$stock_counter+2];
    $u_price = $stock_arr[$stock_counter+1];
    $stock_sql = "INSERT INTO profit (p_name, p_company, p_type, p_date, p_quantity, r_price, t_price, packing, discount, bonus_perc)
    SELECT '$stock_p_name', stock.company, stock.p_type, '$cur_date', '$stock_p_qty', stock.r_price, stock.t_price, stock.packing, stock.discount, stock.bonus_perc FROM stock WHERE stock.p_name like '$stock_p_name' AND FORMAT(stock.u_price,2) = FORMAT($u_price,2) LIMIT 1";
    if ($conn->query($stock_sql) === TRUE) {
    }
     else {
         //echo "Error: " . $stock_sql . "<br>" . $conn->error;
    }
    $stock_counter+=7;
}

$cart_arr = explode("|",$c_cartStock);
$counter =2;
while($counter<count($cart_arr)){
    $p_id = $cart_arr[$counter+5];
    $p_qty = $cart_arr[$counter+2];
    $sql = "UPDATE stock SET total_stock = total_stock - $p_qty WHERE id = $p_id";
    if ($conn->query($sql) === TRUE) {
        // $date = date('Y-m-d H:i:s');
        // file_put_contents("query.log",$date." - Sell - ".$sql."\n",FILE_APPEND);
    } else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $counter+=7;
}

echo $inv_count;

$conn->close();


?>