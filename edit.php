<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Products name:</th>
						<th>Total Stock</th>
						<th>Action:</th>
					</tr>
				</thead>
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

$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>


				<tbody>
					
						<tr>
							
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['p_name'];?></td>
							<td><?php echo $row['total_stock'];?></td>

<td><a href="http://kanishkkunal.in" 
  target="popup" 
  onclick="window.open('add.php?p_id=<?php echo $row['id'];?>','popup','width=600,height=300,scrollbars=no,resizable=no'); return false;">
    Edit
</a></td>

							
						</tr>
				
				</tbody>


<?php

  }
} else {
  echo "0 results";
}
$conn->close();
?>





</body>
</html>