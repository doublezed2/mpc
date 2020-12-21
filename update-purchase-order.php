<?php 
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
          <h4 class="mb-3">Update Product</h4>
          <form class="needs-validation" novalidate="" method="POST" action="update-products-process.php">
          <input type="hidden" name="p_id" value="<?php echo $_GET['id']; ?>">
          <?php
            $sql = "SELECT * FROM products WHERE ID =".$_GET['id'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
            $row = $result->fetch_assoc()
          ?>
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="cc-name">Enter Product Name</label>
                <input type="text" class="form-control" name="p_name" value="<?php echo $row['p_name']; ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label for="cc-name">Choose Supplier</label>
                <select class="custom-select d-block w-100" name="supplier">
                <option value="">Choose...</option>
                <?php
                $sup_sql = "SELECT * FROM suppliers";
                $sup_result = $conn->query($sup_sql);
                if ($sup_result->num_rows > 0) {
                    while($sup_row = $sup_result->fetch_assoc()):
                      $selected = "";
                      if($sup_row['sup_name'] == $row['supplier'] ){
                      $selected = "selected";   
                    }
                    ?>
                    <option <?php echo $selected; ?> ><?php echo $sup_row['sup_name']; ?></option>
                    <?php
                    endwhile;
                } 
                ?> 
                </select>
              </div>
              <div class="col-md-2 mb-2">
                <label for="cc-name">Quantiy</label>
                <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity']; ?>">
              </div>
              <div class="col-md-2 mb-2">
                <label for="cc-name">Add</label>
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