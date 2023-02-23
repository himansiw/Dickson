<html>
<head>
    <title>Dicksons</title>

    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/supplier_model.php';
    include '../model/product_model.php';
    include '../model/module_model.php';
    $supplierObj = new Supplier();
    $supplierResult = $supplierObj->getAllSuppliers();
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
            <center> <h2 class="page-header"><b>Add Receiving</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Purchase</a></li>
        <li class="breadcrumb-item active"><a href="view-receiving.php">View Receiving</a></li>
        <li class="breadcrumb-item active">Add Receiving</li>
    </ol>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <!--  alert message-->
    <div class="row">
        <?php
        if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
            ?>
            <div class="col-md-12">
                <?php
                if (isset($_REQUEST["msg"])) {
                    ?>
                    <div class="alert alert-success">
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
        <div class="col-md-12">
            <div id="alertDiv"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-4">
            <label class="text-right"> Payment Method</label>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i> </span>
                <select id="selectBox" onchange="changeFunc();" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <!--Card form-->
    <div class="row">
        <div class="col-md-3">
            <input name="card_no" placeholder="Credit Card No" class="form-control" type="text" style="display: none" id="card_no">
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <input name="holder_name" placeholder="Holder name" class="form-control" type="text" style="display: none" id="holder_name">
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <select class="form-control" id="card_type" style="display: none">
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
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

    <script type="text/javascript">
        function changeFunc() {
            var selectBox = document.getElementById("selectBox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            if (selectedValue=="Card"){
                $('#cc').hide();
                $('#ch_no').hide();
                $('#card_no').show();
                $('#holder_name').show();
                $('#card_type').show();
                $('#month').show();
                $('#year').show();
                $('#pin').show();

            }
            else if (selectedValue=="Cheque"){
                $('#card_no').hide();
                $('#holder_name').hide();
                $('#card_type').hide();
                $('#month').hide();
                $('#year').hide();
                $('#pin').hide();
                $('#cc').show();
                $('#ch_no').show();
            }
            else {
                $('#card_no').hide();
                $('#holder_name').hide();
                $('#card_type').hide();
                $('#month').hide();
                $('#year').hide();
                $('#pin').hide();
                $('#cc').hide();
                $('#ch_no').hide();
            }
        }
    </script>

</div>
<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';
?>
</body>


</html>
