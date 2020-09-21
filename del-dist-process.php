<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}

include("db-config.php"); 
$dist_name = $_POST['dist_name'];
$dist_id = $_POST['dist_id'];
echo $sql = "DELETE FROM distributions WHERE id = $dist_id";
if ($conn->query($sql) === TRUE) {
    header("Location:add-dist.php?id=$dist_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>