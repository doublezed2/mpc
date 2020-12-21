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
          <h4 class="mb-3">Update Stock</h4>
          <?php
            $s_sql = "SELECT * FROM stock WHERE stock.id=".$_GET['id'];
            $s_result = $conn->query($s_sql);
            if ($s_result->num_rows > 0){
              $s_row = $s_result->fetch_assoc();
            }
          ?>
          <form class="needs-validation" method="POST" action="update-stock-process.php">
            <input type="hidden" name="s_id" value="<?php echo $_GET['id']; ?>">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">Choose Company</label>
                <select class="custom-select d-block w-100" name="p_comp">
                <option value="">Choose...</option>
                <?php
                $sql = "SELECT * FROM companies";
                $result = $conn->query($sql);
                $selected = "";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()):
                      if($row['comp_name'] == $s_row['company']){
                        $selected = "selected";
                      }
                      else{
                        $selected = "";
                      }
                    ?>
                    <option value="<?php echo $row['comp_name'];?>" <?php echo $selected; ?> ><?php echo $row['comp_name']; ?></option>
                    <?php
                    endwhile;
                } 
                ?> 
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Product Type</label>
                <select class="custom-select d-block w-100" name="p_type" >
                  <?php
                    $m_selected = "";
                    $c_selected = "";
                    if('medicine' == $s_row['p_type']){
                      $m_selected = "selected";
                    }
                    else{
                      $c_selected = "selected";
                    }
                  ?>
                  <option value="">Choose...</option>
                  <option value="medicine" <?php echo $m_selected; ?>>Medicine</option>
                  <option value="costmetics" <?php echo $c_selected; ?>>Cosmetics</option>
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Invoice #</label>
                <input type="text" class="form-control" name="p_invoice" value="<?php echo $s_row['invoice_no'] ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Date</label>
                <input type="text" class="form-control" name="p_date" value="<?php echo $s_row['p_date'] ?>">
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-name">Enter Product Name</label>
                <input type="text" class="form-control" name="p_name" value="<?php echo $s_row['p_name'] ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Quantiy</label>
                <input type="text" class="form-control" name="quantity" value="<?php echo $s_row['quantity'] ?>">
              </div>
              <div class="col-md-1 mb-2">
                <label for="cc-name">Packing</label>
                <input type="text" class="form-control" name="packing" value="<?php echo $s_row['packing'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Batch</label>
                <input type="text" class="form-control" name="p_batch" value="<?php echo $s_row['p_batch'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Expiry</label>
                <input type="text" class="form-control" name="p_expiry" value="<?php echo $s_row['p_expiry'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Retail</label>
                <input type="text" class="form-control" name="r_price" value="<?php echo $s_row['r_price'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">TP</label>
                <input type="text" class="form-control" name="t_price" value="<?php echo $s_row['t_price'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Unit Price</label>
                <input type="text" class="form-control" name="u_price" value="<?php echo $s_row['u_price'] ?>">
              </div>
              <div class="col-md-2 mb-2 w10p">
                <label for="cc-name">Total Stock</label>
                <input type="text" class="form-control" name="total_stock" value="<?php echo $s_row['total_stock'] ?>">
              </div>
              <hr class="mb-8">
            </div>
            <div class="row">
              <div class="col-md-2 mb-2">
                <label for="cc-name"></label>
                <button class="btn btn-warning btn-lg btn-block">Update</button>
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