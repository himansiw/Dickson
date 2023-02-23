<html>
<head>
    <title>Dicksons</title>

    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/stock_model.php';
    $stockObj = new Stock();
    $st_id = $_REQUEST["st_id"];
    $st_id = base64_decode($st_id);
    $stockResult = $stockObj->viewLowProduct($st_id);
    $loRow = $stockResult->fetch_assoc();
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
            <center> <h2 class="page-header"><b>View Low stock product</h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Inventory & Stock</a></li>
        <li class="breadcrumb-item active">View Low stock product</li>
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
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!--form-->
    <form id="addProduct" enctype="multipart/form-data" method="post" action="../controller/stockcontroller.php?status=add_low">
        <input type="hidden" class="form-control" name="pid" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["product_id"];?>"/>
        <input type="hidden" class="form-control" name="st_id" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["st_id"];?>"/>
        <!--form_row-1-->
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
                <label class="control-label">Product Name</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="lname" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["product_name"];?>"/>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
                <label class="control-label">Current qty</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="lqty" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["current_qty"];?>"/>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
                <label class="control-label">Minimum qty</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="mqty" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["current_qty"];?>"/>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
                <label class="control-label">SKU</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="lpcode" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["pcode"];?>"/>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
                <label class="control-label">Barcode</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" readonly="readonly" style="background-color: white"  value="<?php echo $loRow["pbarcode"];?>"/>
            </div>
            <div class="col-md-1">&nbsp;</div>
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
        <div class="row">
            <div class="col-md-5">&nbsp;</div>
            <!--button-->
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>&nbsp;  Save
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp;  Reset
                </button>
            </div>
        </div>
    </form>
</div>
<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
?>
</body>
</html>