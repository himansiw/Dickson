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
    </style>

    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/customer_model.php';
    include '../model/product_model.php';
    include '../model/module_model.php';
    $customerObj = new Customer();
    $customerResult = $customerObj->getAllCustomer();
    $productObj = new Product();
    $productResult = $productObj->getAllProducts();
    $moduleObj = new Module();
    $moduleResult = $moduleObj->getAllModules();
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
            <center> <h2 class="page-header"><b>Add Sales Order</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Sales & Billing </a></li>
        <li class="breadcrumb-item active"><a href="view-receivingOrder
        .php">View Sales Oder</a></li>
        <li class="breadcrumb-item active">Add Sales Order</li>
    </ol>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <!-- alert message-->
    <div class="row">
        <?php
        if (isset($_GET["msg"])) {
            ?>
            <div class="col-md-12">
                <div class="alert alert-success" id="msg">
                    <?php
                    $msg = $_REQUEST["msg"];
                    $msg = base64_decode($msg);
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
            <div id="alertDiv"></div>
        </div>
    </div>
    <!--Form Start-->
    <form id="SaleId" enctype="multipart/form-data" method="post" action="../controller/salecontroller.php?status=add_pay">
        <!--Receiving information-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Invoice No.</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="invoice_no" name="invoice_no" autocomplete="off" class="form-control" />
            </div>
            <div class="col-md-3">
                <label class="control-label">Customer</label>
            </div>
            <div class="col-md-3">
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
                <input type="datetime" class="form-control" name="sales_sdate" id="sales_sdate" value="<?php date_default_timezone_set("Asia/Colombo");  echo date("Y-m-d   g:i:s a"); ?>"/>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--product related form-->
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
                                    <th class="text-center" style="width: 90px">Discount(%)</th>
                                    <th class="text-center" style="width: 200px">Regular Price(Rs.)</th>
                                    <th class="text-center" style="width: 200px"> Sub Total(Rs.)</th>
                                    <th class="text-center" style="width: 50px"><i class="fa fa-trash"></i></th>
                                </tr>
                                </thead>
                                <tbody id="sales"></tbody>
                                <tr>
                                    <td>
                                        <input type="text"  class="form-control text-light"  id="saleproduct_id" name="saleproduct_id" placeholder="Enter Product Name" value="" />
                                        <div id="sproductList"></div>

                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right"  name="sqty" id="sqty" >
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" class="form-control text-right" onfocus="this.value = ''" name="sdiscount" step="any" id="sdiscount" value="" >
                                            <span class="input-group-addon">
                                                        %
                                                    </span>
                                        </div>
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
                                            <input type="number" class="form-control text-right" onfocus="this.value = ''" name="subprice_amount" step="any" id="subprice_amount" readonly="readonly" style="background-color: white" value="">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <center style="padding:10px;">
                                <button class="btn btn-block btn-md btn-success"style="width:100px;" type="button" id="add_slist"><b><i class="fa fa-plus"></i> Add</b></button>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3"><label class="text-right">Total</label></div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon">Rs</span>
                    <input  id="stotal" type="text" class="form-control" name="stotal" value="0.00" readonly="readonly" style="background-color: white"/>
                </div>
            </div>
            <div class="col-md-3"><label class="text-right">Discount Entire Sale</label></div>
            <div class="col-md-3">
                <div class="input-group">
                    <input  id="distotal" type="text" class="form-control" name="distotal" value="0"/>
                    <span class="input-group-addon">%</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
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
                            <div class="col-md-3">
                                <label class="control-label">Card No</label>
                            </div>
                            <div class="col-md-3">
                                <input  id="sale_cardno" type="text" class="form-control" name="sale_cardno" readonly="readonly" value="" style="background-color: white">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Loyalty Point Amounts</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text"  class="form-control"  id="apoint" name="apoint" readonly="readonly" value="" style="background-color: white" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Loyalty Points</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="c_point" name="c_point" class="form-control" readonly="readonly" style="background-color: white" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Use Loyalty Points</label>
                            </div>
                            <div class="col-md-1"><input type="radio" id="yes" name="use" value="yes" onchange="enableText()"> <label for="yes">Yes</label></div>
                            <div class="col-md-1"><input type="radio" id="notuse" name="use" value="nope"> <label for="nope">No</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Redeem Points</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="r_point" name="r_point" autocomplete="off" class="form-control" readonly="readonly" />
                            </div>
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


                        <p>Content here. <a class="show-alert" href=#>Alert!</a></p>

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

        <!--Add Product Form Finish-->


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
                        <!--personal details-->
                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
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
                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-4">
                                <label class="text-right"> Due</label>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-save"></i> Save</button>
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
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';
?>
</body>
<!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>-->
<script src="../js/bootbox.min.js"></script>
<script src="../js/bootbox.locales.js"></script>
<script type="text/javascript" src="../js/sale_search.js"></script>
<script type="text/javascript" src="../js/cus_search.js"></script>
<script type="text/javascript" src="../js/sales_order.js"></script>
<script type="text/javascript" src="../js/sale_search.js"></script>
<!--    <script type="text/javascript">-->
        function sweet(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
<!--    </script>-->
<script type="text/javascript">
    function enableText() {
        var r_point = document.getElementById('r_point');
        r_point.readOnly = false;
        r_point.style.display = 'block';
    }
</script>
<script>
    // $(document).on("click", ".sweet", function(e) {
    //     bootbox.confirm("Are you sure?", function(result){
    //         /* your callback code */
    //     })
    // });
</script>
</html>
