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
          <h4 class="mb-3">Update Product</h4>
          <form class="needs-validation" novalidate="" method="POST" action="update-prod-process.php">
            <input type="hidden" name="prod_id" value="<?php echo $_GET['id'];?>">
            <hr class="mb-4">
            <div class="row">
            <?php
              $sql = "SELECT * FROM products WHERE ID =".$_GET['id'];
              $result = $conn->query($sql);
              if ($result->num_rows > 0):
              $row = $result->fetch_assoc()
            ?>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Name</label>
                <input type="text" class="form-control" name="prod_name" value="<?php echo $row['p_name']  ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Choose Company</label>
                <select class="custom-select d-block w-100" name="company">
                <option value="">Choose...</option>
                <?php
                $c_sql = "SELECT * FROM companies ORDER BY comp_name";
                $c_result = $conn->query($c_sql);
                if ($c_result->num_rows > 0) {
                    while($c_row = $c_result->fetch_assoc()):
                      $selected = ""; 
                      if($c_row['comp_name'] == $row['company'] ){
                        $selected = "selected";
                      }
                    ?>
                    <option value="<?php echo $c_row['comp_name']; ?>" <?php echo $selected; ?> > <?php echo $c_row['comp_name']; ?></option>
                    <?php
                    endwhile;
                } 
                ?> 
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Type</label>
                <select class="custom-select d-block" name="p_type">
                  <?php
                  if ($row['p_type']== "medicine") {
                    $med_select = "selected";
                    $cos_select = "";
                  }
                  else {
                    $cos_select = "selected";
                    $med_select = "";
                  }
                  ?>
                  <option value="medicine" <?php echo $med_select; ?>>Medicine</option>
                  <option value="cosmetics"<?php echo $cos_select; ?>>Cosmetics</option>
                </select>
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Packing</label>
                <input type="text" class="form-control" name="packing" value="<?php echo $row['packing']; ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Retail</label>
                <input type="text" class="form-control" name="r_price" value="<?php echo $row['r_price']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 mb-3">
                <label for="cc-name">TP</label>
                <input type="text" class="form-control" name="t_price" value="<?php echo $row['t_price']; ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="cc-name">Unit Price</label>
                <input type="text" class="form-control" name="u_price" value="<?php echo $row['u_price']; ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Discount</label>
                <input type="text" class="form-control" name="discount" value="<?php echo $row['discount']  ?>">
              </div>
              <div class="col-md-3 mb-2">
                <label for="cc-name">Update</label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
              </div>
              <?php
              endif;
              ?>
            </div>
            <hr class="mb-4">
            
          </form>
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php include("footer.php") ?>    