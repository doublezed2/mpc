<?php   
session_start();
if($_SESSION["user_type"] == 'admin_user' || $_SESSION["user_type"] == 'sell_user'){}
else{
  header("Location:index.php");
}

  include("header.php");
  include("db-config.php"); 
  $del_query = 'DELETE FROM `stock` WHERE total_stock < 1';
  $conn->query($del_query);
?>
  <?php include("top-nav.php");?>
    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div id="section-to-print" class="col-md-4 order-md-2 mb-4">
          <div><img class="print-logo" src="img/logo.jpg" width="100px" alt="logo"></div>  
          <div class="d-none d-print-block">
            <p><strong>Madani Pharmacies Chain, Larkana</strong></p>
            <p class="xs-ft">Near J. Shopping Mall, Station Road</p>
            <p class="xs-ft">NTN: 6522502-4</p>
            <p class="xs-ft">Phone# 074-4751448</p>
            <p class="xs-ft">Whatsapp# 03448280059</p>
            <p class="xs-ft">Mobile# 03233012406, 03163411463</p>
          </div>
          <div>
          <div class="date-inv">
          <p class="s-inv">Invoice# <span id="bill-invoice"></span></p>
          <p class="s-date">Date: <span id="auto-date-sell"></span></p>
          </div>
          <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col">X</th>
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
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Sell</h4>
          
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="cc-name">Enter Product Name</label>
                <input type="text" class="form-control" id="product-name-sell">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Quantiy</label>
                <input type="number" value="0" class="form-control" id="product-quantity">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Unit Price</label>
                <input type="text" class="form-control" id="product-up" readonly>
                <input type="hidden" id="discount_p">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Add to cart</label>
                <button class="btn btn-primary btn-lg btn-block" id="add-p-btn">Add</button>
              </div>
            </div>
            <div class="row">
              <div class="col-6"></div>
              <div class="col-6">
                <p id="available-stock">Stock available: <span></span></p>           
              </div>
              </div>
            <hr class="mb-4">
            
          
        </div>
      </div>
        </main>
      </div>
    </div>
<?php include("footer.php") ?>    