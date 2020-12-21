<!DOCTYPE html>
<html>
<head>
	<title> Add</title>
</head>
<body>
	<?php
$servername = "localhost";
$username = "zubanmeo_mpcapp";
$password = "ETLN12pp-sSjM";
$dbname = "zubanmeo_mpcapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$pname = $_GET['p_id'];
$sql = "SELECT * FROM stock WHERE id='$pname'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  	echo $row['p_name'];

  	?>
<form action="" method="POST">
	<input type="text" name="totalstock" placeholder="Totalstock">
	<input type="submit" name="save" value="Update New Data">
</form>


<?php

if(isset($_POST['save'])){



$servername = "localhost";
$username = "zubanmeo_mpcapp";
$password = "ETLN12pp-sSjM";
$dbname = "zubanmeo_mpcapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stockupdate =  $_POST['totalstock'];
$sql = "UPDATE stock SET total_stock='$stockupdate' WHERE id='$pname'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}







}
else{

}
?>



  	<?php
    
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>