<?php  
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("header.php");
include("db-config.php");                 
?>
  <body>
    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Sales Report</h4>
          <form class="needs-validation" novalidate="" method="POST">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-3 mb-3">
                <label>From Date</label>
                <input type="text" class="form-control" id="from-datepicker" name="from-date">
              </div>
              <div class="col-md-3 mb-3">
                <label>To Date</label>
                <input type="text" class="form-control" id="to-datepicker" name="to-date">
              </div>
              <div class="col-md-2 mb-3">
                <label>User</label>
                <select class="custom-select d-block w-100" name="sell_user">
                  <option value="all">All</option>
                  <?php
                  $sql = "SELECT * FROM users ORDER BY username";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()):
                        $username = $row['username'];
                      ?>
                      <option value="<?php echo $username; ?>"><?php echo $username; ?></option>
                      <?php
                      endwhile;
                  } 
                  ?> 
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <label for="cc-name">Search</label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Search</button>
              </div>
            </div>
            <hr class="mb-4">
            <h4 class="mb-3">Sales</h4>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Invoice</th>
                  <th scope="col">Items sold</th>
                  <th scope="col">Total Bill</th>
                  <th scope="col">Date/Time</th>
                  <th scope="col">Account</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
              if(isset($_POST['to-date'])){
                $from_date = $_POST['from-date']." 00:00:00";
                $to_date = $_POST['to-date']." 23:59:00";
                $total_amount = 0;
                if($_POST['sell_user'] == 'all'){
                  $user_query = "";
                }
                else{
                  $user_query = " AND account_name = '".$_POST['sell_user']."'";
                }

                $sql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date' ".$user_query." ORDER BY date_created DESC ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $count=1;
                  while($row = $result->fetch_assoc()):
                  $prod_id = $row['id'];
                  $total_amount = $total_amount+$row['total_bill'];
                  ?>
                  <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $row['invoice_num']; ?></td>
                    <td>
                    <?php
                    $item_arr = explode("--",$row['items_purchased']); 
                    foreach ($item_arr as $s_item) {
                      if (strlen($s_item) < 3) {
                        continue;
                      }
                      $s_item_arr = explode("|",$s_item);
                      $tot = floatval($s_item_arr[1])*floatval($s_item_arr[2]);
                      $d_tot = $tot - floatval($s_item_arr[3]);
                      echo "<small>".$s_item_arr[0]."-".$s_item_arr[1]." x ".$s_item_arr[2]."= ".$tot." (".$s_item_arr[3].") -><strong>".$d_tot."</strong></small></br>";
                    }
                    ?>
                    </td>
                    <td><?php echo $row['total_bill']; ?></td>
                    <td><?php echo $row['date_created']; ?></td>
                    <td><?php echo $row['account_name']; ?></td>
                  </tr>
                  <?php
                  $count++;
                  endwhile;
                } else {
                    $count = 1;
                    echo '<h4 class="mb-3">No records found.</h4>';
                }
                
              }
              ?>
              </tbody>
            </table>
            <?php
            if(isset($_POST['to-date'])):
              $rt_sql = "SELECT p_quantity, r_price, packing, discount FROM profit WHERE p_quantity < 0 AND p_date >= '$from_date' AND p_date < '$to_date'";
              $rt_result = $conn->query($rt_sql);
              $rt_total_amount = 0;
              $rt_subtotal = 0;
              if ($rt_result->num_rows > 0) {
                while($rt_row = $rt_result->fetch_assoc()){
                  $u_price = $rt_row['r_price']/$rt_row['packing'];
                  $rt_subtotal = $rt_row['p_quantity']*$u_price;
                  $rt_discount = ($rt_subtotal * $rt_row['discount'])/100;
                  $rt_subtotal = $rt_subtotal - $rt_discount; 
                  $rt_total_amount = $rt_total_amount+$rt_subtotal;
                }
              } 
            ?>
            <h4 class="mb-3">Total</h4>
            <table class="table table-bordered table-striped total-table">
              <thead>
                <tr>
                  <th scope="col">Total Invoices</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Returned products</th>
                  <th scope="col">Final Amount</th>
                </tr>
                <tr>
                  <td scope="col"><?php echo $count-1; ?></td>
                  <td scope="col"><?php echo number_format($total_amount); ?></td>
                  <td scope="col"><?php echo number_format($rt_total_amount); ?></td>
                  <td scope="col"><?php echo number_format($total_amount+$rt_total_amount); ?></td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <?php endif; ?>
          </form>
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php
     $conn->close();
     include("footer.php"); 
     ?>    