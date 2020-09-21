    <?php  
    include("header.php");
    include("db-config.php");
    
    if(isset($_POST['from-date'])){
      $from_date = $_POST['from-date']." 00:00:00";
      $to_date   = $_POST['to-date']." 23:59:00";
      $fr_val = $_POST['from-date'];
      $to_val = $_POST['to-date'];
    }
    else{      
      $from_date = date("Y-m-d")." 00:00:00";
      $to_date   = date("Y-m-d")." 23:59:00";
      $fr_val  = date("Y-m-d");
      $to_val   = date("Y-m-d");
    }

    $total_amount = 0;
    $count = 0;
    $sql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date'";
    $result = $conn->query($sql);
    $sales_today = "1";
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $total_amount = $total_amount+$row['total_bill'];
        $count++;
      }
    }
    else {
        $sales_today = 'No sales found today.';
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
    if(isset($_POST['p-name'])){
      $p_name = $_POST['p-name'];
    }
    else {
      $p_name = "0";
    }
    ?>
    <div class="container bg-light">
      <div class="row">
        <div class="col-sm-12">
          <img src="img/logo.png" class="mt-4" alt="logo" width="80px">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow  mt-4">
            <div class="card-header text-white bg-info">Stock Count</div>
            <div class="card-body">
              <form method="POST">
                <input type="text" class="form-control" id="p-name-mobile" name="p-name">
                <br>
                <button class="btn btn-default btn-dark btn-block" type="submit">Search</button>
              </form>
              <br>
              <?php
              if ($p_name != "0") {
                $p_sql = "SELECT * FROM stock WHERE p_name LIKE '$p_name' AND total_stock > 0";
                $p_result = $conn->query($p_sql);
                if ($p_result->num_rows > 0) {
                  echo "<h5>".$p_name."</h5>";
                  while($p_row = $p_result->fetch_assoc()){                    
                    echo "<p>Batch: ".$p_row['p_batch']." <br> Expiry: ".$p_row['p_expiry']." <br> Stock: ".$p_row['total_stock']." <p/> <hr>" ;
                  }
                }
                else{
                  echo "<h5>No stock found.</h5>";
                }
              }
              else {
                //echo "<h5>No sales found.</h5>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow  mt-4">
            <div class="card-header text-white bg-success">Sales</div>
            <div class="card-body">
              <form method="POST">
                <input type="text" class="form-control" id="from-datepicker" name="from-date">
                <br>
                <input type="text" class="form-control" id="to-datepicker" name="to-date">
                <br>
                <button class="btn btn-default btn-dark btn-block" type="submit">Search</button>
              </form>
              <br>
              <?php 
              if ($sales_today == "1") {
                echo "<p>Sales from ".$fr_val." to ".$to_val." </p>";
                echo '<h5>Rs: '.number_format($total_amount+$rt_total_amount).'</h5>';
              }
              else {
                echo "<h5>No sales found.</h5>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    
    <?php
    $from_date = "2020-".date("m")."-01 00:00:00";
    $to_date   = "2020-".date("m")."-31 23:59:00";
    $total_amount_m = 0;
    $count = 0;
    $sql_m = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date'";
    $result_m = $conn->query($sql_m);
    $sales_m = "1";
    if ($result_m->num_rows > 0) {
      while($row_m = $result_m->fetch_assoc()){
        $total_amount_m = $total_amount_m+$row_m['total_bill'];
        $count++;
      }
    }
    else {
        $sales_m = 'No sales found this month.';
    } 
    $rt_sql_m = "SELECT p_quantity, u_price, discount FROM profit WHERE p_quantity < 0 AND p_date >= '$from_date' AND p_date < '$to_date'";
    $rt_result_m = $conn->query($rt_sql_m);
    $rt_total_amount_m = 0;
    $rt_subtotal_m = 0;
    if ($rt_result_m->num_rows > 0) {
      while($rt_row_m = $rt_result_m->fetch_assoc()){
        $rt_subtotal_m = $rt_row_m['p_quantity']*$rt_row_m['u_price'];
        $rt_discount_m = ($rt_subtotal_m * $rt_row_m['discount'])/100;
        $rt_subtotal_m = $rt_subtotal_m - $rt_discount_m;
        $rt_total_amount_m = $rt_total_amount_m+$rt_subtotal_m;
      }
    }
    ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow  mt-4">
          <div class="card-header text-white bg-danger">Sales in <?php echo date("F Y"); ?></div>
          <div class="card-body">
            <?php 
            if ($sales_m == "1") {
              echo '<h5>Rs: '.number_format($total_amount_m+$rt_total_amount_m).'</h5>';   
            }
            else {
              echo "<h5>No sales found this month.</h5>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
      
      <?php
      $tsm_sql = "SELECT SUM(u_price*total_stock) AS total_stock_value_rt, SUM((t_price/packing)*total_stock) AS total_stock_value_tp FROM stock WHERE p_type='medicine' AND total_stock > 0 ";
      $tsm_result = $conn->query($tsm_sql);
      $tsm_row = $tsm_result->fetch_assoc();
      $total_stock_value_rt = $tsm_row['total_stock_value_rt'];
      $total_stock_value_tp = $tsm_row['total_stock_value_tp']
      ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow  mt-4">
            <div class="card-header text-white bg-primary">Total Stock Value Medicine</div>
            <div class="card-body">
              <?php 
              echo '<h5>Retail: '.number_format($total_stock_value_rt).'</h5>';
              echo '<h5>TP: '.number_format($total_stock_value_tp).'</h5>';

              ?>
            </div>
          </div>
        </div>
      </div>

      <?php
      $tsc_sql = "SELECT SUM(u_price*total_stock) AS total_stock_value_rt, SUM((t_price/packing)*total_stock) AS total_stock_value_tp FROM stock WHERE p_type='cosmetics' AND total_stock > 0 ";
      $tsc_result = $conn->query($tsc_sql);
      $tsc_row = $tsc_result->fetch_assoc();
      $total_stock_value_rt_c = $tsc_row['total_stock_value_rt'];
      $total_stock_value_tp_c = $tsc_row['total_stock_value_tp']
      ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow  mt-4">
            <div class="card-header text-white bg-warning">Total Stock Value Cosmetics</div>
            <div class="card-body">
              <?php 
              echo '<h5>Retail: '.number_format($total_stock_value_rt_c).'</h5>';
              echo '<h5>TP: '.number_format($total_stock_value_tp_c).'</h5>';

              ?>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- 
      Today Sales
      Monthly Sales
      Monthly Profit minus Discount
      Med Stock value
      Cos stock value
      Total stock value
    -->
    <?php 
    $conn->close(); 
    include("footer.php");
    ?>
