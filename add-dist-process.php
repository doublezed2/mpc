<?php    
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php"); 
$dist_name = $_POST['dist_name'];
$sql = "INSERT INTO distributions (dist_name)
VALUES ('$dist_name')";

if ($conn->query($sql) === TRUE) {
    header("Location:add-dist.php?true=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>