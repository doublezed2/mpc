<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$comp_name = $_POST['comp_name'];
$comp_id = $_POST['comp_id'];
echo $sql = "DELETE FROM companies WHERE id = $comp_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-comp.php?id=$comp_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>