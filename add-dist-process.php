<?php    
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$sql = "INSERT INTO distributions (dist_name)
VALUES ('$dist_name')";

if ($conn->query($sql) === TRUE) {
    header("Location:add-dist.php?true=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>