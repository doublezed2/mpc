<?php   
  session_start();
  if(!isset($_SESSION["user_type"])){
    header("Location:index.php");
  }
  include("header.php");
  include("db-config.php");
?>
<div class="container-fluid">
  <div class="row">
  <?php include("sidebar.php") ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
    <div class="col-md-8">
      <h4 class="mb-3">Sell</h4>
        <hr class="mb-4">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="cc-name">Enter Product Name</label>
            <input type="text" class="form-control" id="product-name-sell">
            <input type="hidden" id="product_id">
          </div>
          <div class="col-md-2 mb-3">
            <label for="cc-name">Quantiy</label>
            <input type="number" value="1" min="1" class="form-control" id="product-quantity">
          </div>
          <div class="col-md-2 mb-3">
            <label for="cc-name">Retail</label>
            <input type="text" class="form-control" id="product-up" value="0">
          </div>
          <div class="col-md-2 mb-3">
            <label for="cc-name">Discount</label>
            <input type="text" class="form-control" id="discount_p" value="0">
          </div>
          <div class="col-md-2 mb-3">
            <label for="cc-name">Add to cart</label>
            <button class="btn btn-primary btn-lg btn-block" id="add-p-btn">Add</button>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p id="available-stock">Stock available: <span></span></p>           
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p id="expiry-date">Expiry Date: <span></span></p>           
          </div>
        </div>
        <hr class="mb-4">
        <div class="row">
          <div class="col-6">
            <?php
            $now_date = date('Y-m-d');
            $sql = "SELECT * FROM stock WHERE p_type = 'medicine' AND total_stock > 0 AND p_expiry < '$now_date'" ;
            $result = $conn->query($sql);
            $result->num_rows;
            echo '<p>'.$result->num_rows.' expired medicine products. <a href="stock-report-print-med-expired.php" target="_blank">Print list</a></>';
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <?php
            $now_date = date('Y-m-d');
            $expiry_date = date('Y-m-d', strtotime("+6 months", strtotime($now_date)));
            $sql = "SELECT * FROM stock WHERE p_type = 'medicine' AND total_stock > 0 AND p_expiry > '$now_date' AND p_expiry < '$expiry_date'" ;
            $result = $conn->query($sql);
            $result->num_rows;
            echo '<p>'.$result->num_rows.' near expiry medicine products. <a href="stock-report-print-med-exp.php" target="_blank">Print list</a></>';
            ?>
          </div>
        </div>
        
        
    </div>
    <div id="section-to-print" class="col-md-4 mb-4">
      <div><img class="print-logo d-none d-print-block" src="img/logo.png" width="100px"></div>  
      <div class="d-none d-print-block">
        <p><strong>Madani Pharmacies Chain, Larkana</strong></p>
        <p class="xs-ft">Near J. Shopping Mall, Station Road</p>
        <p class="xs-ft">NTN: 6522502-4</p>
        <p class="xs-ft">Phone# 074-4751448</p>
      </div>
      <div>
      <div class="date-inv">
      <p class="s-inv">Invoice# <span id="bill-invoice"></span></p>
      <p class="s-date">Date: <span id="auto-date-sell"></span></p>
      </div>
      <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th class="no-print" scope="col">X</th>
          <th scope="col">Item</th>
          <th scope="col">Price</th>
          <th scope="col">Qty</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody id="print-table"></tbody>
    </table>
    <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th scope="col">Amount Paid</th>
          <th scope="col">Amount Return</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><input type="text" class="form-control" id="amount-paid"></td>
        <td><input type="text" class="form-control" id="amount-return"></td>
      </tr>
      </tbody>
    </table>
      </div>
      
      <div class="input-group">
        <input type="hidden" id="total-bill" value="0">
        <input type="hidden" id="total-discount" value="0">
        <button id="print-bill" class="btn btn-danger btn-lg btn-block">Print</button>
      </div>
      
    </div>
  </div>
    </main>
  </div>
</div>
<?php include("footer.php") ?>    