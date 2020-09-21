<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Print Stock Report</title>
</head>
<body>
  
        <?php
        include("db-config.php");
        $sql = "SELECT p_name FROM stock GROUP BY p_name HAVING COUNT(p_name) > 1" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()):
            $p_name = $row['p_name'];
            $inner_sql = "SELECT p_name, total_stock FROM stock WHERE p_name = '$p_name'";
            //echo "<br>";
            $inner_result = $conn->query($inner_sql);
            if ($inner_result->num_rows > 0) {
              while($inner_row = $inner_result->fetch_assoc()){
                echo $inner_row['p_name']." -- ".$inner_row['total_stock'];
                echo "<br>";
              }
            }
          endwhile;
        }
        ?>
</body>
</html>