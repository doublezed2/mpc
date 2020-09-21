<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("header.php") ?>
  <body>
    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Add New Purchase Order</h4>
          <?php
          if (isset($_GET['success'])) {
            echo '<p class="text-success"> <strong> '.$_GET['success'].' items purchased successfully!</strong></p>';
          }
          ?>
          <form method="POST" action="add-purchase-order-process.php">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">Invoice #</label>
                <input type="text" class="form-control" name="p-invoice" required>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Purchase Date</label>
                <input type="text" class="form-control auto-date" name="p-date" required>
              </div>
              
            </div>
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Expiry</th>
                  <th scope="col">Bonus %</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Pck</th>
                  <th scope="col">Retail</th>
                  <th scope="col">TP</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">B-Item</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i=1; $i <21 ; $i++): 
                ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  
                  <td>
                  <input type="hidden" class="company" name="p-company-<?php echo $i; ?>">
                  <input type="hidden" class="ptype" name="p-type-<?php echo $i; ?>">  
                  <input type="text" class="form-control form-control-sm w-2hpx product-name-po" placeholder="Name" name="p-name-<?php echo $i; ?>" tabindex="<?php echo $i; ?>"></td>
                  <td><input type="number" class="form-control form-control-sm w-60px" placeholder="Qty" name="p-qty-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>" ></td>
                  <td><input type="text" class="form-control form-control-sm w-90px date-mask" placeholder="YYYY-MM-DD" name="p-exp-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm" value="0" placeholder="Bonus %" name="p-bp-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm" placeholder="Batch" name="p-batch-<?php echo $i; ?>" value="N/A" ></td>
                  <td><input type="number" class="form-control form-control-sm w-60px pck" placeholder="Pck" name="p-pck-<?php echo $i; ?>" readonly></td>
                  <td><input type="text" class="form-control form-control-sm rp" placeholder="Retail" name="p-rt-<?php echo $i; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm tp" placeholder="TP" name="p-tp-<?php echo $i; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm up" placeholder="Unit Price" name="p-up-<?php echo $i; ?>" readonly></td>
                  <td><input type="number" class="form-control form-control-sm" value="0" placeholder="Bonus Item" name="p-bi-<?php echo $i; ?>"></td>
                </tr>
                <?php
                  endfor;
                ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-2 mb-2">
                <button class="btn btn-primary btn-lg btn-block" >Add</button>
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