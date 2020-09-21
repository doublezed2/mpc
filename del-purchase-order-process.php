<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$stock_id = $_POST['stock_id'];
echo $sql = "DELETE FROM stock WHERE id = $stock_id";
if ($conn->query($sql) === TRUE) {
    header("Location:view-stock.php?id=$stock_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>