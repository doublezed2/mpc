<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$inv_id = $_POST['inv_id'];
$sql = "DELETE FROM sales WHERE id = $inv_id";
if ($conn->query($sql) === TRUE) {
    header("Location:view-sales.php?id=$inv_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>