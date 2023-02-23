<?php
include '../commons/session.php';
?>
<html>
<head>



    <?php
    include '../includes/bootstrap_includes_css.php';

    include '../model/product_model.php';

    $productObj = new Product();
    $productResult=$productObj->getAllProducts();
    include '../model/stock_model.php';

    $stockObj = new Stock();
    $groupedResult=$stockObj->getSumStockGrouped();


    include '../model/module_model.php';
    include '../model/user_model.php';
    $moduleObj = new Module();
    $moduleResult=$moduleObj->getAllModules();

    $userObj= new User();



    ?>
    <script type="text/javascript" src="../js/googlecharts.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);


        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Category Name', 'Count'],
                <?php
                while($cat_row=$groupedResult->fetch_assoc())
                {
                ?>

                ['<?php echo $cat_row["product_name"];  ?>',<?php echo $cat_row["total"]  ?>],
                <?php
                }

                ?>

            ]);

            var options = {
                title: 'Product Distribution by '
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('productChart'));

            chart.draw(data, options);
        }
    </script>

</head>

<body >
<div class="container">
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">


    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 align="center">Inventory Analysis</h3>
        </div>
    </div>
    <div class="row">
        <?php
        if(isset($_GET["msg"]))
        {
            $msg=  base64_decode($_GET["msg"])
            ?>
            <div class="col-md-12">
                <div class="alert alert-success">
                    <?php  echo $msg;  ?>
                </div>
            </div>
            <?php

        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div id="productChart" style="width:700px;height: 800px">

                </div>


            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-3">&nbsp;</div>
    </div>
</div>







</body>
<?php

include_once '../includes/bootstrap_script_includes.php';

?>

</html>
