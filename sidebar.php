<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
    <img class="main-logo" src="img/logo.png">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link" href="sell.php">
        <i class="fas fa-cart-plus"></i>
            Sell
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="return-product.php">
        <i class="fas fa-undo-alt"></i>
            Return Item
        </a>
        </li>
        <?php
        if(isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 'admin_user'): ?>
        <li class="nav-item">
        <a class="nav-link" href="add-purchase-order.php">
        <i class="fas fa-layer-group"></i>
            Purchase Order
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="return-company.php">
        <i class="fas fa-exchange-alt"></i>
            Return to Company
        </a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link" href="view-sales.php">
        <i class="far fa-chart-bar"></i>
           Sale Report
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="view-purchase.php">
        <i class="far fa-chart-bar"></i>
           Purchase Report
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="print-reports.php">
        <i class="fas fa-file-medical-alt"></i>
           Print Reports
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view-stock.php">
            <i class="fas fa-eye"></i>
                View All Stock
            </a>
            <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="view-stock-med.php"><i class="fab fa-medrt"></i>Medicine Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view-stock-cos.php"><i class="fas fa-box"></i>Cosmetics Stock</a>
            </li>
            </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-dist.php">
        <i class="fas fa-warehouse"></i>
            Add Distribution
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-comp.php">
        <i class="fas fa-copyright"></i>
            Add Company
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-prod.php">
        <i class="fas fa-capsules"></i>
            Add Product
        </a>
        </li>
        <?php
        endif;
        ?>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
            Sign out
        </a>
        </li>
    </ul>
    </div>
</nav>