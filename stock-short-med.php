<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Short Stock Medicine</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
  @page { size: A4 }
  body{
    font-size:8px;
    font-family:"Courier New", Courier, monospace; 
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
  .med{
    width: 50px;
  }
  .large{
    width: 120px;
  }
  .xlarge{
    width: 180px;
  }
  h1{
    margin: 0px 0px 10px 0px;
  }
  .tsv{
    margin-top:20px;
    font-size: 12px;
  }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <h1>Madani Pharmacies Chain - Low stock in medicine</h1> 
    <table>
        <tr>
            <th class="small">S.No.</th>
            <th class="xlarge">Name</th>
            <th class="xlarge">Company</th>
            <th class="med">Btch</th>
            <th class="med">Exp</th>
            <th class="small">Stock</th>
            <th class="large">Remarks</th>
        </tr>
        <?php
        include("db-config.php");
        $sql = "SELECT id, p_name, company, p_batch, p_expiry, SUM(total_stock) AS available_stock FROM stock WHERE p_type='medicine' GROUP BY p_name HAVING available_stock BETWEEN 1 AND 15 ORDER BY `available_stock` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $count=1;
          while($row = $result->fetch_assoc()):
          $st_id = $row['id'];
          ?>
          <tr>
            <td class="small"><?php echo $count; ?></td>
            <td class="xlarge"><?php echo $row['p_name']; ?></td>
            <td class="xlarge"><?php echo $row['company']; ?></td>
            <td class="med"><?php echo $row['p_batch']; ?></td>
            <td class="med"><?php echo $row['p_expiry']; ?></td>
            <td class="small"><?php echo $row['available_stock']; ?></td>
            <td class="large"></td>
          </tr>
          <?php
          $count++;
          if($count > 1 && $count%55 == 0):?>
          <tbody>
          </table>
          </section>
          <section class="sheet padding-10mm">
          <table>
          <tr>
            <th class="small">S.No.</th>
            <th class="xlarge">Name</th>
            <th class="xlarge">Company</th>
            <th class="med">Btch</th>
            <th class="med">Exp</th>
            <th class="small">Stock</th>
            <th class="large">Remarks</th>
          </tr>
            
        <?php
          endif;
          endwhile;
        }     
        ?>
  </section>
</body>
</html>