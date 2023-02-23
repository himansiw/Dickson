<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/product_model.php';
        $productObj= new Product();
        $productResult=$productObj->getAllProducts();
        include '../model/stock_model.php';
        $stockObj = new Stock();
        ?>
    </head>
    <body>
         <?php
        include_once'header.php';
        ?>
        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                 <div class="col-md-1">&nbsp;</div>
                <div class="col-lg-10">
                    <center> <h2 class="page-header"><b>View Stock</b></h2></center>
                </div>
                  <div class="col-md-1">&nbsp;</div>
            </div>
              <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Inventory & Stock</li>
                <li class="breadcrumb-item active">View Stock</li>
                </ol>
                </div>
                <div class="col-md-1">&nbsp;</div>
              </div>
            <!-- alert message-->
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <?php
                if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
                    ?>
                    <div class="col-md-10">
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
                            <div class="alert alert-danger">
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
                <div class="col-md-10">
                    <div id="alertDiv"></div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>


            <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
            <div class="row">
                   <div class="col-md-1"> &nbsp;</div>
                   <div class="col-md-10"> 
                    <div class="page-body">
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                        <!--table-->
                           <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped" id="example" role="grid"  style="float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                                           <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                           <th  rowspan="1" colspan="1">
                                                Product name
                                            </th>
                                            <th   rowspan="1" colspan="1">
                                                Stock In
                                            </th>
                                            <th  rowspan="1" colspan="1">
                                                Stock Out
                                            </th>
                                            <th  rowspan="1" colspan="1">
                                               Barcode No.
                                            </th>
                                            <th  rowspan="1" colspan="1">
                                                Available Stock
                                            </th>
                                            <th rowspan="1" colspan="1">
                                                Status
                                            </th>
                                            <th  rowspan="1" colspan="1">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($prow = $productResult->fetch_assoc()) {
                                        $productId = $prow["product_id"];
                                        $productId = base64_encode($productId);
                                        $inn=$stockObj->getReceivingStock($prow["product_id"]);
                                        $current=$stockObj->getCurrentStock($prow["product_id"]);
                                        $out= $inn-$current;
                                        $outqty = number_format($out, 3);
                                    ?>
                                        <tr>
                                            <td><?php echo $prow["product_id"]; ?></td>
                                            <td><img src="../images/product_image/<?php echo $prow["product_image"]; ?>" width="70" height="60" /></td>
                                            <td><?php echo $prow["product_name"]; ?></td>
                                            <td><?php echo $inn; ?></td>
                                            <td><?php echo $out; ?></td></td>
                                            <td><?php echo $prow["pbarcode"]; ?></td>
                                            <td><?php echo $current; ?></td>
                                            <td>
                                                <?php
                                                if ($prow["product_status"] == "1") {
                                                    echo "Available";
                                                } else {
                                                    echo "Unavailable";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                &nbsp;
                                                <!--Active button-->
                                                <?php
                                                if ($prow["product_status"] == 0) {
                                                ?>
                                                <a href="../controller/productcontroller.php?status=activateProduct&product_id=<?php echo $productId; ?>" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Available</b>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <?php
                                                }
                                                ?>
                                                <!--Deactivate button-->
                                                <?php
                                                if ($prow["product_status"] == "1") {
                                                ?>
                                                <a href="../controller/productcontroller.php?status=deactivateProduct&product_id=<?php echo $productId; ?>" class="btn btn-sm btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Unavailable</b>
                                                </a>
                                                <?php
                                                }
                                                ?>
                                                &nbsp;
                                                <!-- view user button-->
                                                <a href="../view/add-stock.php?product_id=<?php echo $productId;  ?>"  class="btn btn-sm btn-info">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;<b>View Stock</b>
                                                </a>
<!--                                                 <a href="../view/add-stock.php?product_id=--><?php //echo $productId  ?><!--"class="btn btn-sm btn-info">-->
<!--                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;View Stock</a>-->
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                        </table>
                    </div>
                   
                </div>
            </div>
                   <div class="col-md-1"> &nbsp;</div>
                </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            </div>
            
<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
?>
    </body>


    <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
            var url = window.location.href;//old url.
            var spliturl = url.split('?')[0];// Divide the old url on the question mark.
            var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
            window.history.pushState({},document.title,""+ newSpliturl);
        });
    </script>
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
