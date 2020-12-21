<?php
include("db-config.php"); 
$s_sql = "SELECT stock.company, products.company FROM stock LEFT JOIN products ON stock.p_name = products.p_name
";
$s_result = $conn->query($s_sql);
if ($s_result->num_rows > 0){
    while($s_row = $s_result->fetch_assoc()){
        
    }
}
exit();
$s_sql = "SELECT * FROM stock";
$s_result = $conn->query($s_sql);
if ($s_result->num_rows > 0){
    while($s_row = $s_result->fetch_assoc()){
        $p_name = $s_row['p_name'];
        $sql = "SELECT company FROM products WHERE p_name = '$p_name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo $c_name = $row['company'];
                sleep(1);    
            }
        }
    }
}
$sql = "SELECT * FROM companies";
$result = $conn->query($sql);
$selected = "";
if ($result->num_rows > 0) {
    echo "<pre>";
    while($row = $result->fetch_assoc()){
        echo $row['comp_name']. " - ". $s_row['company'];
        echo "</br>"; 
        if($row['comp_name'] == $s_row['company']){
            echo "Match";
            echo "</br>"; 
            echo "</br>"; 
        }
        else{
            echo "No Match";
            echo "</br>"; 
            echo "</br>"; 
        }
    }
    echo "</pre>"; 
}
?>