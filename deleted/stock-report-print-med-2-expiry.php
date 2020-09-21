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
    font-size:12px;
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
  .date{
    width: 80px;
  }
  .med{
    width: 40px;
  }
  .large{
    width: 120px;
  }
  .xlarge{
    width: 230px;
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
    <h2>MPC - Medicine Expiry Stock Report before 2021-05-01</h2> 
    <table>
        <tr>
            <th class="small">S.No.</th>
            <th class="xlarge">Name</th>
            <th class="med">Tot-Stk</th>
            <th class="date">Exp</th>
            <th class="med">TP</th>
            <!-- <th class="med">RT</th> -->
            <th class="small">Pck</th>
            <!-- <th class="med">St-RT</th> -->
            <th class="med">St-TP</th>
            <th class="small">ds%</th>
            <th class="med">TP-Ds</th>
            
        </tr>
        <?php
        include("db-config.php");
        $sql = "SELECT * FROM stock WHERE p_type = 'medicine' AND p_expiry > '2020-09-07' AND p_expiry < '2021-04-01' ORDER BY p_expiry" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $count=1;
          $page = 0;
          $gt_nd_tp = 0;
          $gt_tp = 0;
          $gt_bnum = 0;
          while($row = $result->fetch_assoc()):
          $st_id = $row['id'];
          ?>
          <tr>
            <td class="small"><?php echo $count; ?></td>
            <td class="xlarge"><?php echo $row['p_name']; ?></td>
            <td class="small"><?php echo $row['total_stock']; ?></td>
            <td class="date"><?php echo $row['p_expiry']; ?></td>
            <td class="med"><?php echo $row['t_price']; ?></td>
            <!-- <td class="med"><?php // echo $row['r_price'] ?></td> -->
            <td class="small"><?php echo $row['packing'] ?></td>
            <!-- <td class="med"><?php // echo ($row['r_price']/$row['packing'])*$row['total_stock'] ?></td> -->
            <td class="med"><?php echo round(($row['t_price']/$row['packing'])*$row['total_stock']) ?></td>
            <td class="small"><?php echo $row['bonus_perc'] ?></td>
            <?php

            $b_perc = $row['bonus_perc']/100;
            $st_tp = round(($row['t_price']/$row['packing'])*$row['total_stock']);
            $b_num = $st_tp*$b_perc;
            $final_dis = $st_tp - $b_num;

            $gt_bnum = $gt_bnum + $b_num;
            $gt_tp = $gt_tp + $final_dis;
            
            $gt_nd_tp = $gt_nd_tp + $st_tp;

            ?>
            <td class="med"><?php echo $final_dis; ?></td>
          </tr>
          <?php
          $count++;
          if($count > 1 && $count%45 == 0):
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
              <!-- <th class="med">RT</th> -->
              <th class="small">Pck</th>
              <!-- <th class="med">St-RT</th> -->
              <th class="med">St-TP</th>
              <th class="small">ds%</th>
              <th class="med">TP-Ds</th>
          </tr>            
        <?php
          endif;
          endwhile;
        }     
        ?>
        </table>
        <h2>Total Stock TP: <?php echo $gt_nd_tp." - ".$gt_bnum ." = ".$gt_tp; ?></h2>
  </section>
  </body>
</html>