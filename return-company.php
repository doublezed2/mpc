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
          <h4 class="mb-3">Return to Company</h4>
          <?php
          if (isset($_GET['success'])) {
            echo '<p class="text-success"> <strong> '.$_GET['success'].' items returned successfully!</strong></p>';
          }
          ?>
          <form method="POST" action="return-company-process.php">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">Return Invoice</label>
                <input type="text" class="form-control" name="r-invoice" required>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Return Date</label>
                <input type="text" class="form-control auto-date" name="r-date" required>
              </div>
              
            </div>
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Company</th>
                  <th scope="col">Packs</th>
                  <th scope="col">Expiry</th>
                  <th scope="col">Bonus %</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Retail</th>
                  <th scope="col">TP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i=1; $i <21 ; $i++): 
                ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  
                  <td>
                  <input type="hidden" class="p_id" name="p-id-<?php echo $i; ?>">
                  <input type="text" class="form-control form-control-sm w-2hpx p-name-ret-comp" placeholder="Name" name="p-name-<?php echo $i; ?>" tabindex="<?php echo $i; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm w-90px company" placeholder="Company" name="p-comp-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>"></td>
                  <td><input type="number" class="form-control form-control-sm w-60px qty" placeholder="Packs" name="p-qty-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>" ></td>
                  <td><input type="text" class="form-control form-control-sm w-90px date-mask" placeholder="YYYY-MM-DD" name="p-exp-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm bonus_p" value="0" placeholder="Bonus %" name="p-bp-<?php echo $i; ?>" tabindex="<?php echo $i+1; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm batch" placeholder="Batch" name="p-batch-<?php echo $i; ?>" value="" ></td>
                  <td><input type="text" class="form-control form-control-sm rp" placeholder="Retail" name="p-rt-<?php echo $i; ?>"></td>
                  <td><input type="text" class="form-control form-control-sm tp" placeholder="TP" name="p-tp-<?php echo $i; ?>"></td>
                </tr>
                <?php
                  endfor;
                ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-2 mb-2">
                <button class="btn btn-primary btn-lg btn-block" >Return</button>
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