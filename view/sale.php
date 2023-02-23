<html>
    <head>
        <title>Dicksons</title>
        <!--Unorder list & list style-->
        <style>
            .list-unstyled{
                background-color:#eeeeee;
                cursor:pointer;
            }
            .color{
                padding:12px;
            }
        </style>


        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../includes/bootstrap_script_includes.php';
        include '../model/customer_model.php';
        include '../model/product_model.php';
        include '../model/module_model.php';
        include '../model/sale_model.php';
        include '../model/purchase_model.php';

        //Creat the customer object.
        $customerObj = new Customer();
        $customerResult = $customerObj->getAllCustomer();
        //Create the product object.
        $productObj = new Product();
        $productResult = $productObj->getAllProducts();
        $moduleObj = new Module();
        $moduleResult = $moduleObj->getAllModules();
        $purchaseObj = new Purchase();
        $payType = $purchaseObj->getAllPayType();
        $payMethod = $purchaseObj->getAllPayMethod();
        $cardType = $purchaseObj->getAllCardType();

        //Creat the invoice no.
        $saleObj = new Sale();//create the sale object
        $invoiceno = $saleObj->getInvoiceNo();//call method to load last id
        if (mysqli_num_rows($invoiceno) > 0) {  //check result=0 or not
            if ($inrow = $invoiceno->fetch_assoc()) {//fetch last invoice no
                $lastid = $inrow['invoice_no'];
                $lastid = substr($lastid, 4, 9);//separating numeric part
                $lastid = $lastid + 1;//incrementing numeric part by 1
                $lastid = "INV-" . sprintf('%04s', $lastid);//concatenating incremented value
                $saleNo = $lastid;
            }
        }
        else { //if not make id
            $lastid = "INV-0001";
            $saleNo = $lastid;
        }
        ?>
    </head>
    <body>
        <div class="container">
            <!--Include the header-->
            <?php
            include_once 'header.php';
            ?>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <!--Page header name-->
            <div class="row">
                <div class="col-lg-12">
                    <center> <h2 class="page-header"><b>Add Sales Order</b></h2></center>
                </div>
            </div>
            <!--Create breadcrum-->
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="dashboard.php">Sales & Billing </a></li>
                <li class="breadcrumb-item active"><a href="view-sale.php">View Sales Oder</a></li>
                <li class="breadcrumb-item active">Add Sales Order</li>
            </ol>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <!--  alert message-->
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
                <div class="col-md-10">
                    <div id="alertDiv"></div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <!--alert finish-->
        <!--Form Start-->
            <form id="SaleId" enctype="multipart/form-data"  action="">
        <!--Sale information-->
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Invoice No.</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="invoice_no" name="invoice_no" autocomplete="off" class="form-control" value="<?php echo$saleNo ?>" />
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Customer</label>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" id="cusid" name="cusid" value="">
                        <input type="text"  class="form-control"  id="scus_id" name="scus_id" autocomplete="off" placeholder="Enter Customer Name"  />
                        <div id="customersList"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label"> Sales Order Date</label>
                    </div>
                    <div class="col-md-3">
                        <input type="datetime" class="form-control" name="sales_sdate" id="sales_sdate" value="<?php date_default_timezone_set("Asia/Colombo");
                        echo date("Y-m-d H:i:s"); ?>"/>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
            <!--product related Padding Start-->
                <div class="row">
                    <div class="col-md-12">&nbsp;
                        <div class="panel panel-default"  style="box-shadow:0 0 25px 0 lightgrey;">
                            <div class="panel-body">
                                <h3><b># Make a sales order list</b></h3>
                                <div class="row">
                                    <table class="table table-responsive" align="center" id="plist">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 250px;">Product</th>
                                                <th class="text-center" style="width: 100px">Qty</th>
                                                <th class="text-center" style="width: 90px">U/Price</th>
                                                <th class="text-center" style="width: 200px">O/Price</th>
                                                <th class="text-center" style="width: 200px">Sub Total(Rs.)</th>
                                                <th class="text-center" style="width: 50px"><i class="fa fa-trash"></i></th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                    <!-- Create product list-->
                                                <input type="hidden" class="form-control" id="productid" name="productid" value="">
                                                <input type="text"  class="form-control text-light"  id="saleproduct_id" name="saleproduct_id" placeholder="Enter Product Name" value="" />
                                                <div id="sproductList"></div>

                                            </td>
                                            <td>
                                                <input type="number" class="form-control text-right"  name="sqty" id="sqty" >
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        Rs
                                                    </span>
                                                    <input type="number" class="form-control text-right" onfocus="this.value = ''" name="sale_rprice" step="any" id="sale_rprice" value="" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                     <span class="input-group-addon">
                                                        Rs
                                                    </span>
                                                    <input type="number" class="form-control text-right" onfocus="this.value = ''" name="sdiscount" step="any" id="sdiscount" value="" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        Rs
                                                    </span>
                                                    <input type="number" class="form-control text-right" onfocus="this.value = ''" name="subprice_amount" step="any" id="subprice_amount" readonly="readonly" style="background-color: white" value="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tbody id="sale"></tbody>
                                    </table>
                                    <center style="padding:10px;">
                                        <button class="btn btn-block btn-md btn-success"style="width:100px;" type="button" id="add_slist"><b><i class="fa fa-plus"></i> Add</b></button>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--Product padding finish-->
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <!-- Total-->
                    <div class="col-md-3"><label class="text-right">Total</label></div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">Rs</span>
                            <input  id="stotal" type="text" class="form-control" name="stotal" value="0.00" readonly="readonly" style="background-color: white"/>
                        </div>
                    </div>
            <!--Discount enteir sale-->
                    <div class="col-md-3"><label class="text-right">Discount Entire Sale</label></div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input  id="distotal" type="text" class="form-control" name="distotal" value="0" autocomplete="off"/>
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
            <!--Net total-->
                <div class="row">
                    <div class="col-md-3">
                        <label class="text-right">Net Total</label>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">Rs</span>
                            <input  id="netotal" type="text" class="form-control" name="netotal" value="0.00" readonly="readonly" style="background-color: white">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
            <!--Loyalty point realted form start-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="font-weight: bold">
                                LOYALTY CARD DETAILS
                            </div>
                            <div class="panel-body" style="padding: 10px;">
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                            <!--Customer loyalty card number-->
                                    <div class="col-md-3">
                                        <label class="control-label">Card No</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input  id="sale_cardno" type="text" class="form-control" name="sale_cardno" readonly="readonly" value="DCF0000" style="background-color: white">
                                    </div>
                            <!--Total loyalty points in customer-->
                                    <div class="col-md-3">
                                        <label class="control-label">Loyalty Point Amounts</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  class="form-control"  id="apoint" name="apoint" readonly="readonly" value="0.00" style="background-color: white" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                            <!-- No of points coming to the current net price-->
                                    <div class="col-md-3">
                                        <label class="control-label">Loyalty Points</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="c_point" name="c_point" class="form-control" readonly="readonly" style="background-color: white" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Add Loyalty Points</label>
                                    </div>
                            <!-- If paid in points click on yes-->
                                    <div class="col-md-3">
                                         <span class="pseudo-tooltip-wrapper" style="font-size: 15px" data-title="Click the check box if you want to get the loyalty points amount">
                                        <input type="checkbox" id="yes" name="point_use" value="yes">
                                        <label for="yes"> Add points</label>
                                        <input type="hidden" value="0" id="loyalty_added">
                                         </span>
                                    </div>

                               <!--  <div class="col-md-1"><input type="radio" id="notuse" name="point_use" value="nope"> <label for="nope">No</label><input type="hidden" value="0" id="loyalty_nope"></div>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Redeem Points</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="r_point" name="r_point" autocomplete="off" class="form-control"  style="background-color: white"/>
                                    </div>
                            <!-- Redeem points price-->
                                    <div class="col-md-3">
                                        <label class="control-label">Redeem Value</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rs</span>
                                            <input type="text" id="r_value" name="r_value" value="0.00" class="form-control" readonly="readonly" style="background-color: white"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>

                            </div>
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
                    <div class="col-md-5">&nbsp;</div>
            <!--When click the pay button modal show-->
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" id="mod" data-toggle="modal" data-target="#pay_method">
                            <i class="fa fa-money"></i>&nbsp;  Pay
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
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
            <!--Add Items Form Finish-->


            <!--Add Pay Modal Start -->
                <div class="modal fade" id="pay_method" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title"><b>Add Pay Method</b></h3><br>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php
                                    if (isset($_GET["msg1"])) {
                                        ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                <?php
                                                $msg1 = $_REQUEST["msg1"];
                                                $msg1 = base64_decode($msg1);
                                                echo $msg;
                                                ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <div  id="alertDiv"></div>
                                    </div>
                                </div>
                            <!--Payment details-->
                                <div class="row">
                                    <div class="col-md-1">&nbsp;</div>
                            <!--Grand total-->
                                    <div class="col-md-4">
                                        <label class="text-right">Total Balance To Pay</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rs</span>
                                            <input  id="ntotal" type="text" class="form-control" name="ntotal" value="0.00" readonly="readonly" style="background-color: white">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                            <!-- Paid price amount-->
                                <div class="row">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-4">
                                        <label class="text-right"> Paid</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rs</span>
                                            <input  id="paid" type="text" class="form-control" name="paid" value="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                            <!-- Change price-->
                                <div class="row">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-4">
                                        <label class="text-right">Change</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rs</span>
                                            <input  id="due" type="text" class="form-control" autocomplete="off" name="due" value="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                            <!--payment method-->
                                <div class = "well well-sm">
                                    <div class="row">
                                        <div class="col-md-1">&nbsp;</div>
                                        <div class="col-md-4">
                                            <label class="text-right"> Payment Method</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i> </span>
                                                <select id="selectBox" onchange="changeFunc();" name="payment_mid" class="form-control">
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
                                        <div class="col-md-1">&nbsp;</div>
                                        <div class="col-md-4">
                                            <label class="text-right" id="cc" style="display: none"> Cheque No</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input name="ch_no" placeholder="Cheque no" class="form-control" type="text" style="display: none" id="ch_no">
                                        </div>
                                    </div>

                            <!--Card form-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input name="card_no" placeholder="Credit Card No" class="form-control" type="text" style="display: none" id="card_no">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="holder_name" placeholder="Holder Name" class="form-control" type="text" style="display: none" id="holder_name">
                                        </div>
                                        <div class="col-md-3">
                                            <select id="card_type" style="display: none" name="card_tid"  class="form-control">
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
                                        <div class="col-md-3">
                                            <input name="month" placeholder="Month" class="form-control" type="text" style="display: none" id="month">
                                        </div>
                                        <div class="col-md-1">&nbsp;</div>
                                        <div class="col-md-3">
                                            <input name="year" placeholder="Year" class="form-control" type="text" style="display: none" id="year">
                                        </div>
                                        <div class="col-md-1">&nbsp;</div>
                                        <div class="col-md-3">
                                            <input name="pin" placeholder="CVV2" class="form-control" type="text" style="display: none" id="pin">
                                        </div>
                                    </div>

                                    </div>
                            <!--Payment method finish-->

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    <button type="button" class="btn btn-primary" id="invoice"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Pay Modal Finish-->
            </form>
            <!--Form Finish-->
        </div>

        <?php
        include_once 'footer.php';
        ?>
    </body>
    <!--Customer Search-->
    <script type="text/javascript" src="../js/custom_search.js"></script>
    <!-- Item Search-->
    <script type="text/javascript" src="../js/sales_pserach.js"></script>
    <!--Validation-->
    <script type="text/javascript" src="../js/sales_order.js"></script>
    <script type="text/javascript" src="../js/sale_other.js"></script>
</html>
