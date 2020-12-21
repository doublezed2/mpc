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
          <h4 class="mb-3">Delete Invoice</h4>
          <form class="needs-validation" novalidate="" method="POST" action="del-sales-process.php">
            <input type="hidden" name="inv_id" value="<?php echo $_GET['id'];?>">
            <hr class="mb-4">
            <div class="row">
            <?php
              $sql = "SELECT * FROM sales WHERE id =".$_GET['id'];
              $result = $conn->query($sql);
              if ($result->num_rows > 0):
              $row = $result->fetch_assoc();
            ?>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Invoice Number</label>
                <input readonly type="text" class="form-control" value="<?php echo $row['invoice_num'];  ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Total Bill</label>
                <input readonly type="text" class="form-control" value="<?php echo $row['total_bill'];  ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Date/Time</label>
                <input readonly type="text" class="form-control" value="<?php echo $row['date_created'];  ?>">
              </div>
              <div class="col-md-3 mb-2">
                <label for="cc-name">Delete</label>
                <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
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