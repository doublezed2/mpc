<?php
include("db-config.php");
$searchTerm = $_GET['term']; 
$sql ="SELECT p_name, company, p_type, packing, r_price, t_price, u_price FROM products WHERE p_name like '".$searchTerm."%' ORDER BY p_name ASC";
$result = $conn->query($sql);
$p_data = [];
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $label = $row['p_name'];
        $str_arr = $row['company']."|".$row['p_type']."|".$row['packing']."|".$row['r_price']."|".$row['t_price']."|".$row['u_price'];
        $value = $str_arr;
        $p_data[] = array("label"=>$label, "value"=>$value);
    }
}
echo json_encode($p_data); 
?>