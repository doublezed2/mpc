<?php  
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$comp_name = $_POST['comp_name'];
$dist_name = $_POST['dist_name'];
$discount = $_POST['discount'];

$sql = "INSERT INTO companies (comp_name, dist_name, discount)
VALUES ('$comp_name', '$dist_name', '$discount' )";

if ($conn->query($sql) === TRUE) {
    header("Location:add-comp.php?true=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>