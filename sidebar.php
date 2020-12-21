<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link" href="sell.php">
            <span data-feather="home"></span>
            Sell
        </a>
        </li>
        <?php
        if($_SESSION["user_type"] == 'admin_user'):; 
        ?>
        <li class="nav-item">
        <a class="nav-link" href="add-purchase-order.php">
            <span data-feather="shopping-cart"></span>
            Purchase Order
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-dist.php">
            <span data-feather="shopping-cart"></span>
            Add Distribution
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-comp.php">
            <span data-feather="shopping-cart"></span>
            Add Company
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add-prod.php">
            <span data-feather="shopping-cart"></span>
            Add Product
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view-stock.php">
            <span data-feather="bar-chart-2"></span>
            View Stock
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="view-sales.php">
            <span data-feather="bar-chart-2"></span>
           Sale Report
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="stock-report-print.php">
            <span data-feather="bar-chart-2"></span>
           Print Stock Report
        </a>
        </li>
        <?php
        endif;
        ?>
    </ul>
    </div>
</nav>