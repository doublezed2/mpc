<?php
include("db-config.php");
$searchTerm = $_GET['term'];
//$sql ="SELECT stock.p_name, stock.u_price, stock.total_stock, products.discount, stock.p_expiry FROM stock INNER JOIN products ON stock.p_name=products.p_name WHERE stock.p_name like '$searchTerm%' AND stock.total_stock > 0 ORDER BY stock.p_name ASC";
$sql ="SELECT stock.id, stock.p_name, stock.u_price, stock.total_stock, stock.discount, stock.p_expiry FROM stock WHERE stock.p_name like '$searchTerm%' AND stock.total_stock > 0 ORDER BY stock.p_name ASC";

$result = $conn->query($sql);
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $label = $row['p_name'];
		$temp_disc = 0;
        $str_arr = $row['u_price']."|".$row['discount']."|".$row['total_stock']."|".$row['p_expiry']."|".$row['id'];
        $value = $str_arr;
        $p_data[] = array("label"=>$label, "value"=>$value);
    }
    echo json_encode($p_data); 
}
?>