<?php  
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:sell.php");
}
include("db-config.php");
include("header.php") ?>
  <body>
    <div class="container-fluid">
      <div class="row">
      <?php include("sidebar.php") ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
        <div class="col-md-12">
        <?php
          $rt_sql = "SELECT SUM(u_price*total_stock) AS total_stock_value_rt, SUM((t_price/packing)*total_stock) AS total_stock_value_tp FROM stock WHERE p_type='medicine' AND total_stock > 0 ";
          $rt_result = $conn->query($rt_sql);
          $rt_row = $rt_result->fetch_assoc();
          echo '<h4 class="mb-3">Retail Price Stock Value: '.number_format($rt_row['total_stock_value_rt']).' </h4>';
          echo '<h4 class="mb-3">Trade Price Stock Value: '.number_format($rt_row['total_stock_value_tp']).' </h4>';
        ?>
        <hr>
        </div>
        <div class="col-md-12 order-md-1">
           <h4 class="mb-3">Current Medicine Stock</h4>
            <table style="font-size:14px" class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Company</th>
                  <th scope="col">batch</th>
                  <th scope="col">Expiry</th>
                  <th scope="col">packing</th>
                  <th scope="col">Retail</th>
                  <th scope="col">TP</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Total Stock</th>
                  <th scope="col">RT Stock Value</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
              $sql = "SELECT * FROM stock WHERE p_type='medicine' AND total_stock > 0 ORDER BY p_name";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                $count=1;
                while($row = $result->fetch_assoc()):
                $st_id = $row['id'];
                ?>
                <tr>
                  <th scope="row"><?php echo $count; ?></th>
                  <td><?php echo $row['p_name']; ?></td>
                  <td><?php echo $row['company']; ?></td>
                  <td><?php echo $row['p_batch']; ?></td>
                  <td><?php echo $row['p_expiry']; ?></td>
                  <td><?php echo $row['packing']; ?></td>
                  <td><?php echo $row['r_price']; ?></td>
                  <td><?php echo $row['t_price']; ?></td>
                  <td><?php echo $row['u_price']; ?></td>
                  <td><?php echo $row['total_stock']; ?></td>
                  <td><?php echo $row['total_stock'] * $row['u_price']; ?></td>
                  <td>
                    <a href="update-stock.php?id=<?php echo $st_id;?>" class="btn btn-warning">Edit</a>
                  </td>
                </tr>
                <?php
                $count++;
                endwhile;
              } else {
                  echo "0 results";
              }
              
              ?>
              </tbody>
            </table>
            
        </div>
      </div>
        </main>
      </div>
    </div>
    <?php
      $conn->close();
      include("footer.php")
    ?>