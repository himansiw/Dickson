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
    include '../model/sale_model.php';
    $saleObj = new sale();
    $id = $_REQUEST["id"];
    $id = base64_decode($id);
    //Get the specific sale order information.
    $saleResult =$saleObj->getSaleDetail($id);
    //Convert to associative array.
    $saleRow = $saleResult->fetch_assoc();
    $qtyResult=$saleObj->completeNoPieces($id);
    $saleResult1 =$saleObj->completeSale($id);
    //Convert to associative array.
    $sRow = $saleResult1->fetch_assoc();
    $item = $saleObj->countItems($id);


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
            <center> <h2 class="page-header"><b>Display Sale Order</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Sale</a></li>
        <li class="breadcrumb-item active"><a href="view-saleOrder.php">View Sale Orders</a></li>
        <li class="breadcrumb-item active">Display Sale Order</li>
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
    <form  id="saleForm" enctype="multipart/form-data" method="post" action="../controller/salecontroller.php?status=add_pay">

        <div class="row">
            <div class="col-md-5">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active" style="color: black">Sale Order Details</li>
                </ol>
                <div class="table-responsive">
                    <table class="table" style="background-color: #EEEEEE; font-size: 14px">
                        <tbody><tr>
                            <th>Invoice No. </th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $saleRow["invoice_no"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Sale Order Date</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $saleRow["sales_sdate"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $saleRow["invoice_no"]; ?></div</td>
                        </tr>
                        <tr>
                            <th>Total Balance</th>
                            <td></td>
                            <td><span class=" pull-right">Rs. <?php echo $saleRow["netotal"]; ?></span></td>
                        </tr>
                        <tr>
                            <th>No. of Products</th>
                            <td></td>
                            <td><span class=" pull-right"><?php echo $item; ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-5">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active" style="color: black">Customer Details</li>
                </ol>
                <div class="table-responsive">
                    <table class="table" style="background-color: #EEEEEE; font-size: 14px">
                        <tbody>
                        <tr>
                            <th>Name </th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $saleRow["scus_id"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Card No</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $sRow["sale_cardno"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Total Loyalty Points</th>
                            <td></td>
                            <td><span class=" pull-right"><?php echo $sRow["apoint"]; ?></span></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td></td>
                            <td><div class="pull-right"><?php echo $saleRow["cus_mob"]; ?></div></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td></td>
                            <td><span class=" pull-right"><?php echo $saleRow["cus_email"]; ?></span></td>
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
                    <th class="text-center">U/Price</th>
                    <th class="text-center">O/Price</th>
                    <th class="text-center"> Sub Total</th>
                </tr>
                </thead>
                <?php
                $id = $_REQUEST["id"];
                $id = base64_decode($id);
                //Get the specific purchase order items information.
                $itemResult =$saleObj->completeSaleItem($id);
                //Convert to associative array.
                while ($iRow = $itemResult->fetch_assoc())
                {
                    $id = $iRow["id"];
                    $id = base64_encode($id);

                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $iRow["saleproduct_id"]; ?></td>
                        <td><div class="pull-right"><?php echo $iRow["sqty"]; ?></div></td>
                        <td><div class="pull-right">Rs. <?php echo $iRow["sale_rprice"]; ?></div></td>
                        <td><div class="pull-right">Rs. <?php echo $iRow["sdiscount"]; ?></div></td>
                        <td><div class="pull-right">Rs. <?php echo $iRow["subprice_amount"]; ?></div></td>
                    </tr>
                    </tbody>
                    <?php
                }
                ?>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Total</th>
                    <th><div class="pull-right">Rs. <?php echo $saleRow["stotal"]; ?></div></th>
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
