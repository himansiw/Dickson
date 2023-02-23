<html>
<head>
    <title>Dicksons</title>
    <?php
    include '../includes/css_includes_dashboard.php';
    include '../model/module_model.php';
    $moduleObj = new Module();
    $moduleResult = $moduleObj->getAllModules();
    include '../model/user_model.php'; //active & deactive user object
    $userObj = new User();
    include '../model/product_model.php';
    $productObj = new Product();
    $productResult = $productObj->getProductCountByCategory();//Get the product by category variation
    include '../model/stock_model.php';
    $stockObj = new Stock();
    $expireResult = $stockObj->getExpireList();//Get the expire products
    $reResult = $stockObj->getReorderList();//Get reorder products
    include '../model/sale_model.php';
    $saleObj= new Sale();
    include '../model/purchase_model.php';
    $purchaseObj = new Purchase();


    ?>
    <!--include the goggle chart js-->
    <script type="text/javascript" src="../js/googlecharts.js"></script>
    <!--pie chart-->
    <script type="text/javascript">
        google.charts.load( 'current', {'packages': ['corechart']} );
        google.charts.setOnLoadCallback( drawChart );

        function drawChart() {
            var data = google.visualization.arrayToDataTable( [
                ['Category Name', 'Count'],
                <?php
                while($cat_row = $productResult->fetch_assoc())
                {
                ?>
                ['<?php echo $cat_row["cat_name"];  ?>',<?php echo $cat_row["countp"]  ?>],
                <?php
                }
                ?>
            ] );
            var options = {
                title: 'PRODUCT DISTRIBUTION BY',
                slices: {
                    0: {color: '#00cc66'},
                    1: {color: '#cceeff'},
                    2: {color: '#ffeecc'}
                },
                is3D: true,

            };
            var chart = new google.visualization.PieChart( document.getElementById( 'productChart' ) );
            chart.draw( data, options );
        }
    </script>
    <!--Finish pie chart js-->

</head>
<body>
<div id="wrapper">

    <?php
    include_once 'header.php';
    ?>
    <?php
    include_once 'navigation.php';
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> &nbsp;</div>
            </div>

            <div class="row">
                <!--activate users-->
                <div class="col-lg-3 col-md-3">
                    <a href="view-user.php">
                        <div class="panel" style="background-color:#4db8ff;color:#d9edf7">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>
                                            <h3 class="color-white">
                                                <?php
                                                echo $userObj->getActiveUserCount();//Get active user count
                                                ?>
                                            </h3>
                                        </div>
                                        <div><b>ACTIVE USERS</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--Available products total-->
                <div class="col-lg-3 col-md-3">
                    <a href="view-product.php">
                        <div class="panel" style="background-color:#85e085 ;color:#ebfaeb">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cubes fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>
                                            <h3 class="color-white">
                                                <?php
                                                echo $productObj->getActiveProductCount();
                                                ?>
                                            </h3>
                                        </div>
                                        <div><b>TOTAL PRODUCTS</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!--Today purchase order-->
                <div class="col-lg-3 col-md-6">
                    <a href="view-purchaseOrder.php">
                        <div class="panel" style="background-color:#ff5050;color: #f2dede">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cart-plus fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>
                                            <h3 class="color-white">
                                                <?php
                                                echo $purchaseObj->getTodayPurchaseCount();
                                                ?>
                                            </h3>
                                        </div>
                                        <div><b>TODAY PURCHASE</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!--Today total sale-->
                <div class="col-lg-3 col-md-3">
                    <a href="view-saleOrder.php">
                        <div class="panel" style="background-color:#faebcc ;color:#b92c28">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>
                                            <h3 class="color-white">
                                                <?php
                                                echo 'Rs.'. $saleObj->getTodaySaleTotal();
                                                ?>

                                            </h3>
                                        </div>
                                        <div><b>TODAY SALES</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12"> &nbsp;</div>
            </div>

            <div class="row">
                <!-- product category chart -->
                <div class="col-md-4">
                    <div class="panel panel-default" style="width:530px;height:300px">
                        <div class="panel-body">
                            <div id="productChart" style="width:510px;height:280px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">&nbsp;</div>
                <!--Display Expired products list-->
                <div class="col-md-6">
                    <div class="panel-danger">
                        <div class="panel-heading">
                            Expired Products
                        </div>
                        <div class="panel" style="background-color:#F5EAEA;color: #f5eaea;">
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <ul class="list-group">
                                        <?php
                                        if (mysqli_num_rows($expireResult) > 0) {
                                            while ($ex = $expireResult->fetch_assoc()) {
                                                $st_id = $ex["st_id"];
                                                $st_id = base64_encode($st_id);
                                                ?>
                                                <li class="list-group-item lg-danger text-danger">
                                                    <?php echo $ex['product_name'] ?>
                                                    <sup><?php echo $ex['pcode'] ?></sup>
                                                    <a href="../view/view-expire.php?st_id=<?php echo $st_id; ?>"
                                                       class="btn badge badge-primary float-right">Confirm Now</a>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <li class="list-group-item lg-danger text-danger">Product Not Found</li>
                                            <?php
                                        }

                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Low stock products-->
                    <div class="panel-warning">
                        <div class="panel-heading">
                            Low stock Products
                        </div>
                        <div class="panel" style="background-color:#faebcc;color:#8a6d3b;">
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <ul class="list-group">
                                        <?php
                                        if (mysqli_num_rows($reResult) > 0) {
                                            while ($ro = $reResult->fetch_assoc()) {
                                                $st_id = $ro["st_id"];
                                                $st_id = base64_encode($st_id);
                                                ?>
                                                <li class="list-group-item lg-danger text-warning">
                                                    <?php echo $ro['product_name'] ?>
                                                    <sup><?php echo $ro['pcode'] ?></sup>
                                                    <a href="../view/view-lowstock.php?st_id=<?php echo $st_id; ?>"
                                                       class="btn badge badge-primary float-right">Confirm Now</a>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <li class="list-group-item lg-danger text-danger">Product Not Found</li>
                                            <?php
                                        }

                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> &nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12"> &nbsp;</div>
            </div>

        </div>
    </div>
</div>
<?php
include_once 'footer.php';
include '../includes/script_includes_dashboard.php';
?>
</body>
</html>
