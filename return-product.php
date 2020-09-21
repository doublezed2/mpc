<?php     
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:sell.php");
}
include("header.php") ?>
  <body>
    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <form action="return-process.php" method="POST">
            <div class="row">
              <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Return Product</h4>
                <hr class="mb-4">
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="cc-name">Company</label>
                    <input type="text" class="form-control" id="p-comp" name="p_comp" >                
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="cc-name">Product Type</label>
                    <input type="text" class="form-control" id="p-type" name="p_type" >
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="cc-name">Date</label>
                    <input type="text" class="form-control" id="auto-date" name="p_date">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="cc-name">Enter Product Name</label>
                    <input type="text" id="product-name-po" class="form-control" tabindex="1" autofocus name="p_name">
                  </div>
                  <div class="col-md-1 mb-2">
                    <label for="cc-name">Quantiy</label>
                    <input type="number" class="form-control" id="p-qty" name="p_qty" tabindex="2" value="1">
                    <input type="text" class="form-control d-none" id="packing" name="p_pck">
                  </div>
                  <div class="col-md-2 mb-2 w10p">
                    <label for="cc-name">Batch</label>
                    <input type="text" class="form-control" id="p-batch" name="p_batch" tabindex="3">
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="cc-name">Expiry</label>
                    <input type="text" class="form-control" id="p-exp" name="p_exp" tabindex="4">
                  </div>
                  <div class="col-md-2 mb-2 w10p">
                    <label for="cc-name">Retail</label>
                    <input type="text" class="form-control" id="rp" name="p_rp">
                  </div>
                  <div class="col-md-2 mb-2 w10p">
                    <label for="cc-name">TP</label>
                    <input type="text" class="form-control" id="tp" name="p_tp">
                  </div>
                  <div class="col-md-2 mb-2 w10p">
                    <label for="cc-name">Unit Price</label>
                    <input type="text" class="form-control" id="up" name="p_up" readonly>
                  </div>
                  <hr class="mb-8">
                </div>
                <div class="row">
                  <div class="col-md-2 mb-2">
                    <label for="cc-name"></label>
                    <input type="submit" class="btn btn-danger btn-lg btn-block" value="Return" tabindex="5">
                  </div>
                </div>
                <?php
                if (isset($_GET['return'])):?>
                <div class="mb-4"></div>
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-success"><strong>Amount Return: <?php echo $_GET['return'];  ?></strong></p>
                  </div>
                </div>
                <?php
                endif;
                ?>
                <hr class="mb-4">
              </div>
            </div>
          </form>
        </main>
      </div>
    </div>
    <?php include("footer.php") ?>    