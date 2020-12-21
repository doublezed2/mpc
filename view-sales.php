<?php  
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("header.php");
include("db-config.php");                 
?>
  <body>
  <?php include("top-nav.php");?>

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
                <label for="cc-name">From Date</label>
                <input type="text" class="form-control" id="from-datepicker" name="from-date">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">To Date</label>
                <input type="text" class="form-control" id="to-datepicker" name="to-date">
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
                  <th scope="col">Items purchased</th>
                  <th scope="col">Total Bill</th>
                  <th scope="col">Date/Time</th>
                  <th scope="col">Account</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
              if(isset($_POST['to-date'])){
                $from_date = $_POST['from-date']." 00:00:00";
                $to_date = $_POST['to-date']." 23:59:00";
                $total_amount = 0;
                $sql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date' ORDER BY date_created DESC "; //
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
                    <td><?php echo $row['items_purchased']; ?></td>
                    <td><?php echo $row['total_bill']; ?></td>
                    <td><?php echo $row['date_created']; ?></td>
                    <td><?php echo $row['account_name']; ?></td>
                    <td><a class="btn btn-danger btn-lg btn-block" href="del-sales.php?id=<?php echo $row['id']; ?>"> Delete</a></td>
                  </tr>
                  <?php
                  $count++;
                  endwhile;
                } else {
                    echo "0 results";
                }
                
              }
              ?>
              </tbody>
            </table>
            <?php
            if(isset($_POST['to-date'])):?>
            <h4 class="mb-3">Total</h4>
            <table class="table table-bordered table-striped total-table">
              <thead>
                <tr>
                  <th scope="col">Total Invoices</th>
                  <th scope="col">Amount</th>
                </tr>
                <tr>
                  <td scope="col"><?php echo $count-1; ?></td>
                  <td scope="col"><?php echo $total_amount; ?></td>
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