<?php 
include("db-config.php"); 
$p_name = $_POST['p_name'];
$supplier = $_POST['supplier'];
$quantity = $_POST['quantity'];
$p_id = $_POST['p_id'];
$sql = "UPDATE products SET p_name='$p_name', supplier='$supplier', quantity='$quantity' WHERE id=$p_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-products.php?id=$p_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>