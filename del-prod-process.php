<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$prod_id = $_POST['prod_id'];
echo $sql = "DELETE FROM products WHERE id = $prod_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-prod.php?id=$prod_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>