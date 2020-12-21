<?php
include("db-config.php");
$searchTerm = $_GET['term']; 
$sql ="SELECT * FROM products WHERE p_name like '".$searchTerm."%' ORDER BY p_name ASC";
$result = $conn->query($sql);
$p_data = [];
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $label = $row['p_name'];
        $p_data[] = array("label"=>$label);
    }
} 
echo json_encode($p_data); 
?>