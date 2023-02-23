<html>
<head>
    <title>Dicksons</title>
    <style>
        /*style use in list*/
        .list-unstyled {
            background-color: #eeeeee;
            cursor: pointer;
        }

        .color {
            padding: 12px;
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
    $payType = $purchaseObj->getAllPayType();
    $payMethod = $purchaseObj->getAllPayMethod();
    $cardType = $purchaseObj->getAllCardType();
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
            <center><h2 class="page-header"><b>Add Receiving</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Purchase</a></li>
        <li class="breadcrumb-item active">Add Receiving (GRN)</li>
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
    <!--alert finish-->

    <!--form start-->
    <form id="receiveId" enctype="multipart/form-data" method="post"
          action="../controller/purchasecontroller.php?status=add_receiving">
        <!--Receiving information start-->
        <!--Reference no.-->
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Reference No.</label>
            </div>
            <div class="col-md-3">
                        <span class="pseudo-tooltip-wrapper" style="font-size: 15px" data-title="REFxxxx">
                        <input type="text" id="reference_no" name="reference_no" class="form-control"
                               autocomplete="off"/>
                        </span>
            </div>
            <div class="col-md-2">&nbsp;</div>
            <!--Supplier-->
            <div class="col-md-2">
                <label class="control-label">Supplier</label>
            </div>
            <div class="col-md-3">
                <select id="rsup_id" name="sup_id" class="form-control">
                    <option value="">-- SELECT --</option>
                    <?php
                    while ($suprow = $supplierResult->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $suprow["sup_id"] ?>">
                            <?php echo $suprow["sup_fname"]; ?><?php echo $suprow["sup_lname"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--Stock Date-->
        <div class="row">
            <div class="col-md-2">
                <label class="control-label"> Stock Date</label>
            </div>
            <div class="col-md-3">
                <input type="datetime" class="form-control" name="stock_date" id="stock_date"
                       value="<?php date_default_timezone_set("Asia/Colombo");
                       echo date("Y-m-d   g:i:s a"); ?>"/>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--product related form start-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="border-width: 2px">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <!--Product name-->
                            <div class="col-md-3">
                                <label class="control-label">Product</label>
                                <input type="hidden" class="form-control" id="product_id" name="product_id" value="">
                                <input type="text" class="form-control text-left" id="rproduct_id" name="rproduct_id"
                                       placeholder="Enter Product Name" autocomplete="off" value=""/>
                                <div id="rproductList"></div>
                            </div>
                            <!--Qty-->
                            <div class="col-md-2">
                                <label class="control-label">Qty</label>
                                <input type="number" class="form-control text-right" name="rqty" id="rqty">
                            </div>
                            <!--Purchase Price(unit)-->
                            <div class="col-md-2">
                                <label class="control-label">Purchase Price(unit)</label>
                                <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                                    <input type="text" class="form-control text-right" onfocus="this.value=''"
                                           name="rpurchase_price" step="any" id="rpurchase_price" value="">
                                </div>
                            </div>
                            <!--Purchase price-->
                            <div class="col-md-2">
                                <label class="control-label">Purchase Price</label>
                                <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                                    <input type="number" class="form-control text-right" name="purchase_price_amount"
                                           step="any" id="purchase_price_amount" readonly="readonly"
                                           style="background-color: white">
                                </div>
                            </div>
                            <!--Profit Precentage-->
                            <div class="col-md-2">
                                <label class="control-label">Profit Percentage</label>
                                <div class="input-group">
                                    <input type="text" class="form-control text-right" name="rdis" id="rdis" value="">
                                    <span class="input-group-addon">
                                %
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <!--Regular Price(unit)-->
                            <div class="col-md-2">
                                <label class="control-label">Regular Price(unit)</label>
                                <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                                    <input type="number" class="form-control text-right" name="regullar_price"
                                           step="any" id="regullar_price" value="0.00">
                                </div>
                            </div>
                            <!--Manufactured Date-->
                            <div class="col-md-2">
                                <label class="control-label">Manufactured Date</label>
                                <input type="date" name="rm_date" class="form-control" id="rm_date"
                                       value="<?php echo date("Y-m-d"); ?>"/>
                            </div>
                            <!--Expiry Date-->
                            <div class="col-md-2">
                                <label class="control-label ">Expiry Date</label>
                                <input type="date" class="form-control text-right" name="rexp_date" id="rexp_date">
                            </div>
                            <div class="col-md-1">&nbsp;</div>
                            <!--Add to list button-->
                            <div class="col-md-2">
                                <label class="control-label">&nbsp</label>
                                <button class="btn btn-block btn-md btn-success" type="button" id="add_list"><i
                                            class="fa fa-plus"></i> <b>Add List</b></button>
                            </div>
                            <div class="col-md-3">&nbsp;</div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--product form finish-->

        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>

        <!--Product information table start-->
        <div class="row">
            <table class="table table-bordered table-responsive" style="width: 1180px" id="list">
                <thead>
                <tr>
                    <th class="text-center" style="width: 280px">Product</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Purchase Price(unit)</th>
                    <th class="text-center">Regular Price</th>
                    <th class="text-center">Manufactured Date</th>
                    <th class="text-center">Expiry Date</th>
                    <th class="text-center"> Sub Total</th>
                    <th class="text-center"><i class="fa fa-trash"></i</th>
                </tr>
                </thead>
                <tbody id="receive"></tbody>
                <!--Tfooter-->
                <tfoot>
                <tr>
                    <th class="text-right" colspan="6">Total</th>
                    <th><input id="total" type="text" class="form-control-plaintext" name="total" value="0.00"
                               readonly="readonly"></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!--Product information table finish-->
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>

        <!--payment detail-->
        <div class="well well-sm" style="background-color:#f9f9f9">
            <!--Payment details-->
            <div class="row">
                <!--Grand total-->
                <div class="col-md-3">
                    <label class="text-right">Grand Total</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <input id="gtotal" type="text" class="form-control" name="gtotal" value="0.00"
                               readonly="readonly" style="background-color: white">
                    </div>
                </div>

                <!-- Paid price amount-->
                <div class="col-md-3">
                    <label class="text-right"> Paid</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <input id="rpaid" type="text" class="form-control" name="rpaid" value="0.00">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>

            <!-- Change price-->
            <div class="row">
                <div class="col-md-3">
                    <label class="text-right">Balance</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <input id="rdue" type="text" class="form-control" autocomplete="off" name="rdue" value="0.00">
                    </div>
                </div>

                <!--Change status-->
                <div class="col-md-3">
                    <label class="text-right">Status</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i> </span>
                        <select id="status" name="pay_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                            while ($payrow = $payType->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $payrow["pay_id"] ?>">
                                    <?php echo $payrow["pay_status"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>

            <!--payment method-->
            <div class="row">
                <div class="col-md-3">
                    <label class="text-right"> Payment Method</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-credit-card"></i> </span>
                        <select id="rselectBox" name="payment_mid" onchange="changeMth();" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                            while ($mayrow = $payMethod->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $mayrow["payment_mid"] ?>">
                                    <?php echo $mayrow["payment_type"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>

            <!--Cheque form-->
            <div class="row">
                <div class="col-md-3">
                    <label class="text-right" id="cc" style="display: none"> Cheque No</label>
                </div>
                <div class="col-md-3">
                    <input name="ch_no" placeholder="Cheque no" class="form-control" type="text" style="display: none"
                           id="ch_no">
                </div>
            </div>

            <!--Card form-->
            <div class="row">
                <div class="col-md-4">
                    <input name="card_no" placeholder="Credit Card No" class="form-control" type="text"
                           style="display: none" id="card_no">
                </div>
                <div class="col-md-4">
                    <input name="holder_name" placeholder="Holder Name" class="form-control" type="text"
                           style="display: none" id="holder_name">
                </div>
                <div class="col-md-4">
                    <select id="card_type" style="display: none" name="card_tid" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        while ($cardrow = $cardType->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $cardrow["card_tid"] ?>">
                                <?php echo $cardrow["card_method"]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input name="month" placeholder="Month" class="form-control" type="text" style="display: none"
                           id="month">
                </div>
                <div class="col-md-4">
                    <input name="year" placeholder="Year" class="form-control" type="text" style="display: none"
                           id="year">
                </div>
                <div class="col-md-4">
                    <input name="pin" placeholder="CVV2" class="form-control" type="text" style="display: none"
                           id="pin">
                </div>
            </div>

        </div>
        <!--Payment method finish-->

        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-5">&nbsp;</div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>&nbsp; Save
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp; Reset
                </button>
            </div>
            <div class="col-md-5">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
    </form>
    <!--Receiving information finish-->
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
<script type="text/javascript" src="../js/receive_search.js"></script>
<script type="text/javascript" src="../js/receiveo.js"></script>
<script type="text/javascript">
    function changeMth() {
        var rselectBox = document.getElementById( "rselectBox" );
        var rselectedValue = rselectBox.options[rselectBox.selectedIndex].value;
        if (rselectedValue == "2") {
            $( '#cc' ).hide();
            $( '#ch_no' ).hide();
            $( '#card_no' ).show();
            $( '#holder_name' ).show();
            $( '#card_type' ).show();
            $( '#month' ).show();
            $( '#year' ).show();
            $( '#pin' ).show();

        } else if (rselectedValue == "3") {
            $( '#card_no' ).hide();
            $( '#holder_name' ).hide();
            $( '#card_type' ).hide();
            $( '#month' ).hide();
            $( '#year' ).hide();
            $( '#pin' ).hide();
            $( '#cc' ).show();
            $( '#ch_no' ).show();
        } else {
            $( '#card_no' ).hide();
            $( '#holder_name' ).hide();
            $( '#card_type' ).hide();
            $( '#month' ).hide();
            $( '#year' ).hide();
            $( '#pin' ).hide();
            $( '#cc' ).hide();
            $( '#ch_no' ).hide();
        }
    }
</script>
<script>
    $( document ).ready( function () {
        var url = window.location.href;//old url.
        var spliturl = url.split( '?' )[0];// Divide the old url on the question mark.
        var newSpliturl = spliturl.split( 'localhost' )[1];//Divide the new url on the localhost mark
        window.history.pushState( {}, document.title, "" + newSpliturl );
    } );
</script>
<script>
    $( function () {
        $( "#msg" ).show();
        setTimeout( function () {
            $( "#msg" ).slideUp( 500, function () {
                $( "#msg" ).hide();
            } );
        }, 8000 );
    } );
</script>
<script>
    $( function () {
        $( "#error" ).show();
        setTimeout( function () {
            $( "#error" ).slideUp( 500, function () {
                $( "#error" ).hide();
            } );
        }, 8000 );
    } );
</script>
</html>