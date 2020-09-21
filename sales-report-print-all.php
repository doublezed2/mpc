<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Print monthly profit report</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
  @page { size: A4 }
  body{
    font-size:11px;
    font-family:"Cou11ier New", Courier, monospace; 
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
  .xlarge{
    width: 450px;
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
    <?php
      $date = '2020-06-03';
    ?>
    <h1>MPC - Sales Report - <?php echo $date; ?></h1> 
    <table>
        <tr>
            <th class="date">Date</th>
            <th class="small">Inv</th>
            <th class="xlarge">Items Sold</th>
            <th class="med">Total Bill</th>
        </tr>
        <?php
        include("db-config.php");
        $from_date = $date.' 00:00:00.000000';
        $to_date = $date.' 23:59:59.000000';
      
        $md_sql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date' ORDER BY date_created ASC ";
        $md_result = $conn->query($md_sql);
        if ($md_result->num_rows > 0) {
          $total_sales = 0;
          while($md_row = $md_result->fetch_assoc()){
            $current_date = $md_row['date_created'];
            echo "<tr>";
            echo "<td>".$md_row['date_created']."</td> ";
            echo "<td>".$md_row['invoice_num']."</td> ";
            echo "<td>";
            $item_arr = explode("--",$md_row['items_purchased']); 
            foreach ($item_arr as $s_item) {
              if (strlen($s_item) < 3) {
                continue;
              }
              $s_item_arr = explode("|",$s_item);
              $tot = floatval($s_item_arr[1])*floatval($s_item_arr[2]);
              $d_tot = $tot - floatval($s_item_arr[3]);
              echo "<small>".$s_item_arr[0]."-".$s_item_arr[1]." x ".$s_item_arr[2]."= ".$tot." (".$s_item_arr[3].") -><strong>".$d_tot."</strong></small></br>";
            }
            echo "</td>";
            echo "<td>".$md_row['total_bill']."</td> ";
            echo "<tr>";
            $total_sales = $total_sales + $md_row['total_bill'];
          }
        }
        $rt_sql = "SELECT p_quantity, u_price, discount FROM profit WHERE p_quantity < 0 AND p_date >= '$from_date' AND p_date < '$to_date'";
        $rt_result = $conn->query($rt_sql);
        $rt_total_amount = 0;
        $rt_subtotal = 0;
        if ($rt_result->num_rows > 0) {
          while($rt_row = $rt_result->fetch_assoc()){
            $rt_subtotal = $rt_row['p_quantity']*$rt_row['u_price'];
            $rt_discount = ($rt_subtotal * $rt_row['discount'])/100;
            $rt_subtotal = $rt_subtotal - $rt_discount; 
            $rt_total_amount = $rt_total_amount+$rt_subtotal;
          }
        } 
        ?>
        <tr>
          <td></td>
          <td></td>
          <td style="text-align:right">Total Sales</td>
          <td><strong><?php echo $total_sales; ?><strong></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td style="text-align:right">G.R</td>
          <td><strong><?php echo $rt_total_amount; ?><strong></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td style="text-align:right">Net Sales</td>
          <td><strong><?php echo $total_sales + $rt_total_amount; ?><strong></td>
        </tr>
        
      </table>
  </section>
</body>
</html>