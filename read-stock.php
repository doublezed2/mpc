<?php
include("db-config.php");
$searchTerm = $_GET['term']; 
$sql ="SELECT stock.p_name, stock.u_price, stock.total_stock, products.discount FROM stock INNER JOIN products ON stock.p_name=products.p_name WHERE stock.p_name like '$searchTerm%' AND stock.total_stock > 0 ORDER BY stock.p_name ASC";
$result = $conn->query($sql);
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $label = $row['p_name'];
        $str_arr = $row['u_price']."|".$row['discount']."|".$row['total_stock'];
        $value = $str_arr;
        $p_data[] = array("label"=>$label, "value"=>$value);
    }
    echo json_encode($p_data); 
}
?>