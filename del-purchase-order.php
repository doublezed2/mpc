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
          <h4 class="mb-3">Delete Purchase Order</h4>
          <?php
            $st_sql = "SELECT * FROM stock WHERE ID =".$_GET['id'];
            $st_result = $conn->query($st_sql);
            if ($st_result->num_rows > 0){
              $st_row = $st_result->fetch_assoc();
            }
            
          ?>
          <form class="needs-validation" method="POST" action="del-purchase-order-process.php">
            <input type="hidden" name="stock_id" value="<?php echo $st_row['id']; ?>">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">Invoice #</label>
                <input type="text" class="form-control" value="<?php echo $st_row['invoice_no']; ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Date</label>
                <input type="text" class="form-control" value="<?php echo $st_row['p_date']; ?>">
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-name">Enter Product Name</label>
                <input id="product-name-po" type="text" class="form-control" value="<?php echo $st_row['p_name']; ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Quantiy</label>
                <input type="text" class="form-control" value="<?php echo $st_row['quantity']; ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Packing</label>
                <input type="text" class="form-control" value="<?php echo $st_row['packing']; ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Batch</label>
                <input type="text" class="form-control" value="<?php echo $st_row['p_batch']; ?>">
              </div>
              <div class="col-md-2 mb-2">
                <label for="cc-name">Expiry</label>
                <input type="text" class="form-control" value="<?php echo $st_row['p_expiry']; ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Retail</label>
                <input type="text" class="form-control" value="<?php echo $st_row['r_price']; ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">TP</label>
                <input type="text" class="form-control" value="<?php echo $st_row['t_price']; ?>">
              </div>
              <div class="col-md-2 mb-2">
                <label for="cc-name">Unit Price</label>
                <input type="text" class="form-control" value="<?php echo $st_row['u_price']; ?>">
              </div>
              <hr class="mb-8">
            </div>
            <div class="row">
              <div class="col-md-2 mb-2">
                <label for="cc-name"></label>
                <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
              </div>
            </div>
            </form>
            
            <hr class="mb-4">
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php include("footer.php") ?>    