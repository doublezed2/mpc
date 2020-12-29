<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("header.php") ?>
  <body>
  <?php include("top-nav.php");?>

    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Add New Purchase Order</h4>
          <form class="needs-validation">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">Choose Company</label>
                <select class="custom-select d-block w-100" id="p-comp">
                <option value="">Choose...</option>
                <?php
                include("db-config.php");
                $sql = "SELECT * FROM companies ORDER BY comp_name";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()):
                      $c_name = $row['comp_name'];
                    ?>
                    <option value="<?php echo $c_name; ?>"><?php echo $c_name; ?></option>
                    <?php
                    endwhile;
                } 
                ?> 
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Product Type</label>
                <select class="custom-select d-block w-100" id="p-type" >
                  <option value="medicine">Medicine</option>
                  <option value="costmetics">Cosmetics</option>
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Invoice #</label>
                <input type="text" class="form-control" id="p-invoice">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Date</label>
                <input type="text" class="form-control" id="auto-date">
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-name">Enter Product Name</label>
                <input id="product-name-po" type="text" class="form-control">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Quantiy</label>
                <input type="text" class="form-control" id="p-qty">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Packing</label>
                <input type="text" class="form-control" id="packing">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Batch</label>
                <input type="text" class="form-control" id="p-batch">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Expiry</label>
                <input type="text" class="form-control" id="p-exp">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Retail</label>
                <input type="text" class="form-control" id="rp">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">TP</label>
                <input type="text" class="form-control" id="tp">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Unit Price</label>
                <input type="text" class="form-control" id="up">
              </div>
              <hr class="mb-8">
            </div>
            </form>
            <div class="row">
              <div class="col-md-2 mb-2">
                <label for="cc-name"></label>
                <button class="btn btn-primary btn-lg btn-block" id="add-po" name = "add">Add</button>
              </div>
            </div>
            <hr class="mb-4">
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php include("footer.php") ?>    