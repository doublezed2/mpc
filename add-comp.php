<?php 
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("header.php") 
?>
  <body>
  <?php include("top-nav.php");?>

    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Add New Company</h4>
          <form class="needs-validation" novalidate="" method="POST" action="add-comp-process.php">
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="cc-name">Name</label>
                <input type="text" class="form-control" name="comp_name">
              </div>
              <div class="col-md-4 mb-3">
                <label for="cc-name">Distribution</label>
                <input type="text" class="form-control" name="dist_name">
              </div>
              <div class="col-md-4 mb-3">
                <label for="cc-name">Sale Discount</label>
                <input type="text" class="form-control" name="discount">
              </div>
              <div class="col-md-4 mb-2">
                <label for="cc-name">Add</label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Add</button>
              </div>
            </div>
            <hr class="mb-4">
            <h4 class="mb-3">List of Companies</h4>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Distribution</th>
                  <th scope="col">Sale Discount</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php
              include("db-config.php");
              $sql = "SELECT * FROM companies ORDER BY id DESC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                $count=1;
                while($row = $result->fetch_assoc()):
                $comp_id = $row['id'];
                ?>
                <tr>
                  <th scope="row"><?php echo $count; ?></th>
                  <td><?php echo $row['comp_name']; ?></td>
                  <td><?php echo $row['dist_name']; ?></td>
                  <td><?php echo $row['discount']; ?></td>
                  <td>
                    <a href="update-comp.php?id=<?php echo $comp_id;?>" class="btn btn-warning">Edit</a>
                    <a href="del-comp.php?id=<?php echo $comp_id;?>" class="btn btn-danger">Delete</a>
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