<html>
<head>
    <title>Dicksons</title>
    style use in
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
    include '../model/supplier_model.php';
    include '../model/product_model.php';
    include '../model/module_model.php';
    include '../model/purchase_model.php';
    $supplierObj = new Supplier();
    $supplierResult = $supplierObj->getAllSuppliers();
    $productObj = new Product();
    $productResult = $productObj->getAllProducts();
    $moduleObj = new Module();
    $moduleResult = $moduleObj->getAllModules();
    $purchaseObj = new Purchase();
    $id = $_REQUEST["purchase_id"];
    $id = base64_decode($id);
    //Get the specific purchase order information.
    $purchaseResult = $purchaseObj->getPurchase($id);
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
            <center> <h2 class="page-header"><b>New Purchase Order</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Purchase</a></li>
        <li class="breadcrumb-item active"><a href="view-purchaseOrder.php">View Purchase Oders</a></li>
        <li class="breadcrumb-item active">New Purchase Order</li>
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
        <!--Receiving information-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Reference No.</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="purchaseref_no" name="purchaseref_no" class="form-control" autocomplete="off" value="<?php echo $purRow["purchaseref_no"];  ?>"/>
            </div>
            <div class="col-md-3">
                <label class="control-label">Supplier</label>
            </div>
            <div class="col-md-3">
                <input type="hidden" class="form-control" id="sup_id" name="sup_id" value="">
                <input type="text"  class="form-control" autocomplete="off" id="pusup_id" name="pusup_id"  value="<?php echo $purRow["pusup_id"];  ?>"  />
                <div id="suppliersList"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label"> Supplier Email</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="supplier_email" autocomplete="off" id="psupplier_email" value="<?php echo $purRow["supplier_email"];  ?>"/>
            </div>
            <div class="col-md-3">
                <label class="control-label"> Purchase Order Date</label>
            </div>
            <div class="col-md-3">
                <input type="datetime" class="form-control" name="purchase_date" id="purchase_date"
                       value="<?php date_default_timezone_set("Asia/Colombo");
                       echo date("Y-m-d   g:i:s a"); ?>"/>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="message">Message</label>
            </div>
            <div class="col-md-3">
                <textarea name="message" id="message" rows="4" class="form-control"  required="required"><?php echo $purRow["message"];  ?></textarea>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--product related form-->
        <div class="row">
            <table class="table table-responsive" id="detail">
                <thead>
                <tr>
                    <th class="text-center">Product</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Purchase Unit Price</th>
                    <th class="text-center">Purchase Price </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="text"  class="form-control text-left"  id="purproduct_id" name="purproduct_id" placeholder="Enter Product Name" autocomplete="off" value="" />
                        <div id="productList"></div>
                    </td>
                    <td>
                        <input type="number" class="form-control text-right"  name="pqty" id="pqty" >
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                            <input type="number" class="form-control text-right" onfocus="this.value=''" name="purchaseorder_price" step="any" id="purchaseorder_price" value="" >
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                                <span class="input-group-addon">
                                    Rs
                                </span>
                            <input type="number" class="form-control text-right" onfocus="this.value=''" name="ppurchase_price_amount" step="any" id="ppurchase_price_amount" readonly="readonly" style="background-color: white" value="">
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-block btn-md btn-success" type="button" id="add_plist"><b><i class="fa fa-plus"></i></b></button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <table class="table table-bordered table-responsive" id="plist">
                <thead>
                <tr>
                    <th class="text-center">Product</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Purchase Unit Price</th>
                    <th class="text-center"> Sub Total</th>
                    <th class="text-center"><i class="fa fa-trash"></i></th>
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
                    <td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='<?php echo $iRow["purproduct_id"]; ?>' name='purproduct_id[]'/></td>
                    <td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='<?php echo $iRow["pqty"]; ?>' name='pqty[]'/></td>
                    <td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='<?php echo $iRow["purchaseorder_price"]; ?>' name='purchaseorder_price[]'/></td>
                    <td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='<?php echo $iRow["ppurchase_price_amount"]; ?>' name='ppurchase_price_amount[]'/></td>
                    <td><button href='javascript:void(0)' style='background-color: white; border: none;outline: none'><span class='text-danger remove' arial-hidden='true'> &cross;</span></button></td>
                </tr>
                </tbody>
                    <?php
                }
                ?>
                </tbody>
                <tbody id="purchaseItem"></tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total</th>
                    <th> <input id="ptotal" type="text" class="form-control-plaintext" name="ptotal" value="<?php echo $purRow["ptotal"]; ?>" readonly="readonly"/></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                &nbsp;
            </div>
            <div class="col-md-3">
                <button type="submit" id="submit" class="btn btn-primary">
                    <i class="fa fa-send-o"></i>&nbsp;  Send
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp;  Reset
                </button>
            </div>
            <div class="col-md-4">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>

    </form>

    <!--Form Finish-->

    <div class="row">
        <div class="col-md-12">
            &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            &nbsp
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
<script type="text/javascript" src="../js/purchaseO.js"></script>
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
