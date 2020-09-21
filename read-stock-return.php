<?php
include("db-config.php");
$searchTerm = $_GET['term'];
$sql ="SELECT id, p_name, company, packing, p_batch, p_expiry, r_price, t_price, bonus_perc, total_stock FROM stock WHERE p_name like '$searchTerm%' AND total_stock >= packing ORDER BY p_name ASC";
$result = $conn->query($sql);
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $total_packs = floor($row['total_stock']/$row['packing']);
        $label = $row['p_name']." (".$total_packs.")";
        $str_arr = $row['id']."|".$total_packs."|".$row['p_expiry']."|".$row['bonus_perc']."|".$row['p_batch']."|".$row['r_price']."|".$row['t_price']."|".$row['company'];
        $value = $str_arr;
        $p_data[] = array("label"=>$label, "value"=>$value);
    }
    echo json_encode($p_data);
}
?>