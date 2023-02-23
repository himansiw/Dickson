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
    include '../model/purchase_model.php';
    $purchaseObj = new Purchase();
    $id = $_REQUEST["purchase_id"];
    $id = base64_decode($id);
    //Get the specific purchase order information.
    $purchaseResult =$purchaseObj->getPurchase($id);
    //Convert to associative array.
    $purRow = $purchaseResult->fetch_assoc();



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
            <center> <h2 class="page-header"><b>Display Purchase Order</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Purchase</a></li>
        <li class="breadcrumb-item active"><a href="view-purchaseOrder.php">View Purchase Oders</a></li>
        <li class="breadcrumb-item active">Display Purchase Order</li>
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
    <!--Form Start-->
    <form  id="purchaseForm" enctype="multipart/form-data" method="post" action="../controller/purchasecontroller.php?status=add_email">

        <div class="row">
            <div class="col-md-5">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active" style="color: black">Order Details</li>
                </ol>
                <div class="table-responsive">
                    <table class="table" style="background-color: #EEEEEE; font-size: 14px">
                        <tbody><tr>
                            <th>Reference No. </th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $purRow["purchaseref_no"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Purchase Order Date</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $purRow["purchase_date"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td></td>
                            <td><span class=" pull-right">Rs. <?php echo $purRow["ptotal"]; ?></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td></td>
                        <td><span class=" pull-right">
                            <?php
                            if ($purRow["purchase_status"] == "1") {
                                echo "Pending order";
                            } else {
                                echo "Received order";
                            }
                            ?>
                            </span>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-5">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active" style="color: black">Vendor Details</li>
                </ol>
                <div class="table-responsive">
                    <table class="table" style="background-color: #EEEEEE; font-size: 14px">
                        <tbody>
                        <tr>
                            <th>Name </th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $purRow["pusup_id"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Land number</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $purRow["sup_con"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td></td>
                            <td><span class=" pull-right"><?php echo $purRow["sup_mob"]; ?></span></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $purRow["supplier_email"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Adress</th>
                            <td></td>
                            <td><span class=" pull-right"><?php echo $purRow["sup_house_no"]; ?>,<?php echo $purRow["sup_street"]; ?>,<?php echo $purRow["sup_city"]; ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--product related table-->
        <div class="row">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" style="color: black">Product Details</li>
            </ol>
            <table class="table table-bordered table-responsive" style="background-color: #EEEEEE; font-size: 14px">
                <thead>
                <tr>
                    <th class="text-center">Product</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Purchase Unit Price</th>
                    <th class="text-center"> Sub Total</th>
                </tr>
                </thead>
                <?php
                $piid = $_REQUEST["purchase_id"];
                $piid = base64_decode($piid);
                //Get the specific purchase order items information.
                $itemResult =$purchaseObj->getPurchaseItem($piid);
                //Convert to associative array.
                while ($iRow = $itemResult->fetch_assoc())
                {
                $piid = $iRow["purchase_id"];
                $piid = base64_encode($piid);

                ?>
                <tbody>
                <tr>
                    <td><?php echo $iRow["purproduct_id"]; ?></td>
                    <td><div class="pull-right"><?php echo $iRow["pqty"]; ?></div></td>
                    <td><div class="pull-right">Rs. <?php echo $iRow["purchaseorder_price"]; ?></div></td>
                    <td><div class="pull-right">Rs. <?php echo $iRow["ppurchase_price_amount"]; ?></div></td>
                </tr>
                </tbody>
                    <?php
                }
                ?>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total</th>
                    <th><div class="pull-right">Rs. <?php echo $purRow["ptotal"]; ?></div></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>

    </form>


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
