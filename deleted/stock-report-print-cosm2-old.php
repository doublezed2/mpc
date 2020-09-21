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
    font-size:10px;
    font-family:"Courier New", Courier, monospace; 
  }
  /* .sheet{
    height:auto !important;
  } */
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
    width: 80px;
  }
  .med{
    width: 60px;
  }
  .large{
    width: 120px;
  }
  .xlarge{
    width: 250px;
  }
  h1{
    margin: 0px 0px 10px 0px;
  }
  .tsv{
    margin-top:20px;
    font-size: 12px;
  }
  .pg-num{
    position: absolute;
    top: 10px;
    right: 56px;
  }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <h2>Madani Pharmacies Chain - Medicine Stock Report - As of <?php echo date("d-M-Y"); ?></h2>
    <h3>RT Value: 3,433,181 ----- TP Value: 2,953,329</h3>
    <table>
        <tr>
            <th class="small">S.No.</th>
            <th class="xlarge">Name</th>
            <th class="med">Tot-Stk</th>
            <th class="date">Exp</th>
            <th class="med">TP</th>
            <th class="med">Stk-Val</th>
            <th class="med">Remarks</th>
        </tr>
        <?php
        include("db-config.php");
        $sql = "SELECT * FROM stock WHERE total_stock > 0 AND p_type = 'medicine' ORDER BY p_name" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $count=1;
          $page = 0;
          while($row = $result->fetch_assoc()):
          $st_id = $row['id'];
          ?>
          <tr>
            <td class="small"><?php echo $count; ?></td>
            <td class="xlarge"><?php echo $row['p_name']; ?></td>
            <td class="small"><?php echo $row['total_stock']; ?></td>
            <td class="date"><?php echo $row['p_expiry']; ?></td>
            <td class="med"><?php echo $row['t_price']; ?></td>
            <td class="med"><?php echo $row['total_stock'] * $row['u_price']; ?></td>
            <td class="med"></td>
          </tr>
          <?php
          $count++;
          if($count > 1 && $count%55 == 0):
          $page++;
          ?>
          <tbody>
          </table>
          </br>
          <?php echo "Page:".$page;?>
          </section>
          <section class="sheet padding-10mm">
          <table>
          <tr>
              <th class="small">S.No.</th>
              <th class="xlarge">Name</th>
              <th class="med">Tot-Stk</th>
              <th class="date">Exp</th>
              <th class="med">TP</th>
              <th class="med">Stk-Val</th>
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