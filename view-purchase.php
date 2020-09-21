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
          <h4 class="mb-3">Purchase Report</h4>
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
              <div class="col-md-3 mb-2">
                <label for="cc-name">Search</label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Search</button>
              </div>
            </div>
            <hr class="mb-4">
            <h4 class="mb-3">Purchase Invoices</h4>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Invoice</th>
                  <th scope="col">Name</th>
                  <th scope="col">Company</th>
                  <th scope="col">Batch</th>
                  <th scope="col">TP</th>
                  <th scope="col">Quantity</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              
              if(isset($_POST['to-date'])){
                $from_date = $_POST['from-date']." 00:00:00";
                $to_date = $_POST['to-date']." 23:59:00";
                $total_amount = 0;
                $sql = "SELECT invoice_no, p_date, p_name, company, p_batch, t_price, quantity FROM stock WHERE p_date >= '$from_date' AND p_date < '$to_date' ORDER BY id DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $count=1;
                  while($row = $result->fetch_assoc()):
                  //$prod_id = $row['id'];
                  //$total_amount = $total_amount+$row['total_bill'];
                  ?>
                  <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $row['p_date']; ?></td>
                    <td><?php echo $row['invoice_no']; ?></td>
                    <td><?php echo $row['p_name']; ?></td>
                    <td><?php echo $row['company']; ?></td>
                    <td><?php echo $row['p_batch']; ?></td>
                    <td><?php echo $row['t_price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                  </tr>
                  <?php
                  $count++;
                  endwhile;
                } else {
                    $count = 1;
                    echo "0 results";
                }
                
              }
              ?>
              </tbody>
            </table>
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