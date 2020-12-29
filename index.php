<?php 
include("header.php") ;
?>
<div class="text-center">
  <form class="form-signin" method="POST" action="login-process.php">
    <div style="height:100px"></div>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" >
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy;Sandbox Technologies 2019</p>
  </form>
  <?php 
  if(isset($_GET['empty'])){
    echo "<p style='color:red;' >Password And Username Is Incorrect </p>";
  }

  ?>
</div>
<?php include("footer.php") ?>    
