<html>
    <head>
      <title>Dicksons</title>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/product_model.php';
        $productObj = new Product();
        $productResult = $productObj->getAllProducts();
        ?> 
    </head>

    <body>
        <?php
        include_once'header.php';
        ?>
        <!-- Page Content -->
        <div class="container">

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <center> <h2 class="page-header"><b>Print Barcode Label</b></h2></center>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">Print Barcode Label</li>
            </ol>
            <div class="row">
                <?php
                if (isset($_GET["msg"])) {
                    ?>       
                    <div class="col-md-12">
                        <div class="alert alert-success">
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
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
                 <div class="well" style="margin:auto;  width:90%;">
                <form class="form-horizontal" method="post" action="barcode.php">
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Product Name:</label>
                        <div class="col-md-10">
                            <select id="barcode_pid" name="product_id" class="form-control">
                                <option value="">-- SELECT --</option>
                                <?php
                                while ($prow = $productResult->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $prow["product_id"] ?>">
                                        <?php echo $prow["product_name"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
<!--                            <input autocomplete="OFF" type="text" class="form-control" id="product" name="product">-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Barcode Code:</label>
                        <div class="col-md-10">
                            <input autocomplete="OFF" type="text" class="form-control" id="Barcode_id" name="barcode_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Sale Price:</label>
                        <div class="col-md-10">          
                            <input autocomplete="OFF" type="text" class="form-control" id="sale_price"  name="sale_price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Barcode Quantity:</label>
                        <div class="col-md-10">          
                            <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty"  name="print_qty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-md-offset-5 col-md-7">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o"></i>&nbsp; <b> Save</b>
                        </button>
                         &nbsp; &nbsp;
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-refresh"></i>&nbsp;  <b>Reset</b>
                        </button>
                    </div>
                    </div>
                </form>
                 </div>
        </div>
<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
?>
    </body>
</html>


