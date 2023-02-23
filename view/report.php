<html>
<head>
    <title>Dicksons</title>
    <style>
        .list-unstyled{
            background-color:#eeeeee;
            cursor:pointer;
        }
        .color{
            padding:12px;
        }
        .tit{
            background-color: #0f0f0f;
            color: #ffffff;
        }
    </style>

    <?php
    include '../includes/bootstrap_includes_css.php';

    ?>
</head>
<body>
<div class="container">
    <!--header_1-->
    <?php
    include_once 'header.php';
    ?>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <!--page header-->
    <div class="row">
        <div class="col-lg-12">
            <center> <h2 class="page-header"><b>View Reports</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Report Management</a></li>
        <li class="breadcrumb-item active">View Reports</a></li>
    </ol>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- alert message-->
    <div class="row">
        <?php
        if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
            ?>
            <div class="col-md-12">
                <?php
                if (isset($_REQUEST["msg"])) {
                    ?>
                    <div class="alert alert-success" id="msg">
                        <?php echo base64_decode($_REQUEST["msg"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger" id="error">
                        <?php echo base64_decode($_REQUEST["error"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="col-md-12">
            <div id="alertDiv"></div>
        </div>
    </div>


    <div class="panel">
        <div class="panel-body">
            <div class="list-group parent-list">
                <a href="#" class="list-group-item" id="saved"><i class="icon ti-heart" style="color: #fb5d5d"></i> Favorites</a>
                <a href="#" class="list-group-item" id="appointments"><i class="icon ti-calendar"></i> Appointments</a>
                <a href="#" class="list-group-item" id="categories"><i class="icon ti-layout-grid3"></i> Categories</a>
                <a href="#" class="list-group-item" id="closeout"><i class="icon ti-close"></i> Closeout</a>
                <a href="#" class="list-group-item" id="custom-report">
                    <i class="icon ti-search"></i> Custom Report </a>
                <a href="#" class="list-group-item" id="commissions"><i class="icon ti-money"></i> Commission</a>
                <a href="#" class="list-group-item" id="customers"><i class="icon ti-user"></i> Customers</a>
                <a href="#" class="list-group-item" id="deleted-sales"><i class="icon ti-trash"></i> Deleted Sales</a>
                <a href="#" class="list-group-item" id="deliveries"><i class="icon ti-truck"></i> Deliveries</a>
                <a href="#" class="list-group-item" id="discounts"><i class="icon ti-wand"></i> Discounts</a>
                <a href="#" class="list-group-item" id="employees"><i class="icon ti-id-badge"></i> Employees</a>
                <a href="#" class="list-group-item" id="expenses"><i class="icon ti-money"></i> Expenses</a>
                <a href="#" class="list-group-item" id="giftcards"><i class="icon ti-credit-card"></i> Giftcards</a>
                <a href="#" class="list-group-item" id="inventory"><i class="icon ti-bar-chart"></i> Inventory Reports</a>
                <a href="#" class="list-group-item" id="item-kits"><i class="icon ti-harddrives"></i> Item Kits</a>
                <a href="#" class="list-group-item" id="items"><i class="icon ti-harddrive"></i> Items</a>
                <a href="#" class="list-group-item" id="manufacturers"><i class="icon ti-layout-grid3"></i> Manufacturers</a>
                <a href="#" class="list-group-item" id="payments"><i class="icon ti-money"></i> Payments</a>
                <a href="#" class="list-group-item" id="price_rules"><i class="icon ti-harddrive"></i> Price Rules</a>
                <a href="#" class="list-group-item" id="profit-and-loss"><i class="icon ti-shopping-cart-full"></i> Profit and Loss</a>
                <a href="#" class="list-group-item" id="receivings"><i class="icon ti-cloud-down"></i> Receiving</a>
                <a href="#" class="list-group-item" id="register-log"><i class="icon ti-search"></i> Register Logs</a>
                <a href="#" class="list-group-item" id="registers"><i class="icon ti-search"></i> Registers</a>
                <a href="#" class="list-group-item" id="sales"><i class="icon ti-shopping-cart"></i> Sales</a>
                <a href="#" class="list-group-item" id="store-accounts"><i class="icon ti-credit-card"></i> Store Accounts</a>
                <a href="#" class="list-group-item" id="suppliers"><i class="icon ti-download"></i> Suppliers</a>
                <a href="#" class="list-group-item" id="suspended_sales"><i class="icon ti-download"></i> Suspended Sales</a>
                <a href="#" class="list-group-item" id="tags"><i class="icon ti-layout-grid3"></i> Tags</a>
                <a href="#" class="list-group-item" id="taxes"><i class="icon ti-agenda"></i> Taxes</a>
                <a href="#" class="list-group-item" id="tiers"><i class="icon ti-stats-up"></i> Tiers</a>
            </div>
        </div>
    </div>


</div>
<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';
?>
</body>
<script type="text/javascript" src="../js/sup_js.js"></script>
<script type="text/javascript" src="../js/purchase_search.js"></script>
<script type="text/javascript" src="../js/purchase_order.js"></script>
<script>
    $(function() {
        $("#msg").show();
        setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 6000);
    });
</script>
<script>
    $(function() {
        $("#error").show();
        setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 6000);
    });
</script>
</html>