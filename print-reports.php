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
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Print Medicine Low Stock Report</h4>
            <form target="_blank" class="needs-validation" action="stock-short-med.php" method="POST">
              <div class="row">
                <div class="col-md-4 mb-2">
                  <button class="btn btn-danger btn-lg btn-block" type="submit">Print</button>
                </div>
              </div>
            </form>
          </div>        
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Print Cosmetics Low Stock Report</h4>
            <form target="_blank" class="needs-validation" action="stock-short-cos.php" method="POST">
              <div class="row">
                <div class="col-md-4 mb-2">
                  <button class="btn btn-danger btn-lg btn-block" type="submit">Print</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <hr class="mb-4">
        <div class="row">
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Print Medicine Stock Report</h4>
            <form target="_blank" class="needs-validation" action="stock-report-print-med.php" method="POST">
              <div class="row">
                <div class="col-md-4 mb-2">
                  <button class="btn btn-primary btn-lg btn-block" type="submit">Print</button>
                </div>
              </div>
            </form>
          </div>        
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Print Cosmetics Stock Report</h4>
            <form target="_blank" class="needs-validation" action="stock-report-print-cosm.php" method="POST">
              <div class="row">
                <div class="col-md-4 mb-2">
                  <button class="btn btn-primary btn-lg btn-block" type="submit">Print</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <hr class="mb-4">
        <div class="row">
        <div class="col-md-4 order-md-1">
          <h4 class="mb-3">Print Medicine Expiry Report</h4>
          <form target="_blank" class="needs-validation" action="stock-report-print-med-exp.php" method="POST">
            <div class="row">
              <div class="col-md-4 mb-2">
                <button class="btn btn-warning btn-lg btn-block" type="submit">Print</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4 order-md-1">
          <h4 class="mb-3">Print Cosmetics Expiry Report</h4>
          <form target="_blank" class="needs-validation" action="stock-report-print-cosm-exp.php" method="POST">
            <div class="row">
              <div class="col-md-4 mb-2">
                <button class="btn btn-warning btn-lg btn-block" type="submit">Print</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <hr class="mb-4">
      <div class="row">
        <div class="col-md-4 order-md-1">
          <h4 class="mb-3">Print return to company</h4>
          <form target="_blank" class="needs-validation" action="print-return-company.php" method="POST">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Invoice No.</label>
              <input type="text" class="form-control" name="inv">
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-warning btn-lg btn-block" type="submit">Print</button>
            </div>
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