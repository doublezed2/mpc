<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Print Stock Report</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
  @page { size: A4 }
  body{
    font-size:8px;
    font-family:"Courier New", Courier, monospace; 
  }
  .sheet{
    height:auto !important;
  }
  table {
    border-collapse: collapse;
  }
  table, th, td {
    border: 1px solid black;
    padding: 3px;
  }
  th,td{
    word-wrap: break-word;
  }
  .small{
    width: 25px;
  }
  .date{
    width: 50px;
  }
  .med{
    width: 40px;
  }
  .large{
    width: 120px;
  }


  h1{
    margin: 0px 0px 10px 0px;
  }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <h1>Stock Report</h1> 
    <table>
        <tr>
            <th class="small">No.</th>
            <th class="large">Name</th>
            <th class="large">Comp</th>
            <th class="med">Btch</th>
            <th class="date">Exp</th>
            <th class="med">Pck</th>
            <th class="med">Rtl</th>
            <th class="med">TP</th>
            <th class="med">UP</th>
            <th class="med">T-St</th>
            <th class="med">St-Val</th>
            <th>Short</th>
            <th>Exces</th>
        </tr>
        <?php
        include("db-config.php");
        $sql = "SELECT * FROM stock ORDER BY p_name";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $count=1;
          while($row = $result->fetch_assoc()):
          $st_id = $row['id'];
          ?>
          <tr>
            <td class="small"><?php echo $count; ?></td>
            <td class="large"><?php echo $row['p_name']; ?></td>
            <td class="large"><?php echo $row['company']; ?></td>
            <td class="med"><?php echo $row['p_batch']; ?></td>
            <td class="date"><?php echo $row['p_expiry']; ?></td>
            <td class="med"><?php echo $row['packing']; ?></td>
            <td class="med"><?php echo $row['r_price']; ?></td>
            <td class="med"><?php echo $row['t_price']; ?></td>
            <td class="med"><?php echo $row['u_price']; ?></td>
            <td class="med"><?php echo $row['total_stock']; ?></td>
            <td class="med"><?php echo $row['total_stock'] * $row['u_price']; ?></td>
            <td class="small"></td>
            <td class="small"></td>
          </tr>
          <?php
          $count++;
          endwhile;
        }     
        ?>
        <tbody>
    </table>
    <?php
      $t_sql = "SELECT SUM(total_stock*u_price) AS total_stock_value FROM stock";
      $t_result = $conn->query($t_sql);
      $t_row = $t_result->fetch_assoc();
      echo '<h4>Total Stock Value: '.number_format($t_row['total_stock_value']).' </h4>';
    ?>
  </section>
</body>
</html>