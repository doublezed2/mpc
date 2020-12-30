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
          <h4 class="mb-3">Add New Product</h4>
          <form class="needs-validation" novalidate="" method="POST" action="add-prod-process.php">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-name">Name</label>
                <input type="text" class="form-control" name="prod_name">
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-name">Choose Company</label>
                <select class="custom-select d-block w-100" name="company">
                <option value="">Choose...</option>
                <?php
                include("db-config.php");
                $sql = "SELECT * FROM companies";
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
              <div class="col-md-3 mb-3">
                <label for="cc-name">Discount</label>
                <input type="text" class="form-control" name="discount">
              </div>
              <div class="col-md-3 mb-2">
                <label for="cc-name">Add</label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Add</button>
                     <?php
           if(empty($_GET['true'])){}
           else{
           $error = $_GET['true'];
           switch ($error) {
           case "1":
           echo "<p style= 'color:red;'>Name field is required!</p><br>";
           break;
           case "2":
           echo "<p style ='color:green;'>Your record has been successfully added</p>";
           break;
           default:
            }
           }
           ?>
              </div>
            </div>
            <hr class="mb-4">
            <h4 class="mb-3">List of Products</h4>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Company</th>
                  <th scope="col">discount</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php
              include("db-config.php");
              $sql = "SELECT * FROM products ORDER BY id DESC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                $count=1;
                while($row = $result->fetch_assoc()):
                $prod_id = $row['id'];
                ?>
                <tr>
                  <th scope="row"><?php echo $count; ?></th>
                  <td><?php echo $row['p_name']; ?></td>
                  <td><?php echo $row['company']; ?></td>
                  <td><?php echo $row['discount']; ?></td>
                  <td>
                    <a href="update-prod.php?id=<?php echo $prod_id;?>" class="btn btn-warning">Edit</a>
                    <a href="del-prod.php?id=<?php echo $prod_id;?>" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                <?php
                $count++;
                endwhile;
              } else {
                  echo "0 results";
              }
              $conn->close();
              ?>
              </tbody>
            </table>
          </form>
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php include("footer.php") ?>    