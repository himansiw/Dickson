<html>
<head>
    <title>Dicksons</title>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/product_model.php';
    $productObj = new Product();
    if (!isset($_REQUEST["product_id"])) {
        ?>
        <script> window.location = "../index.php"</script>
        <?php
    }
    $productId = $_REQUEST["product_id"];
    $productId = base64_decode($productId);
    //Get the specific product information.
    $pResult = $productObj->getAllProduct($productId);
    //Convert to associative array.
    $pRow = $pResult->fetch_assoc();

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
            <center> <h2 class="page-header"><b>Display Product</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Product Master</a></li>
        <li class="breadcrumb-item active"><a href="view-product.php">View Products</a></li>
        <li class="breadcrumb-item active">Display Product</li>
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


    <!--form-->
    <form id="addProduct" enctype="multipart/form-data" method="post" action="">
        <!--form_row-1-->
        <div class="row" >
            <div class="col-md-3">
                <label class="control-label">SKU</label>
            </div>
            <div class="col-md-3">
                 <label class="control-label"><?php echo $pRow["pcode"]; ?></label>
            </div>

            <div class="col-md-3">
                <label class="control-label">Product Name</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["product_name"]; ?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row" >
            <div class="col-md-3">
                <label class="control-label">Brand</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["brand_name"]; ?></label>
            </div>

            <div class="col-md-3">
                <label class="control-label">Department</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["department_name"]; ?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row" >
            <div class="col-md-3">
                <label class="control-label">Category</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["cat_name"]; ?></label>
            </div>
            <div class="col-md-3">
                <label class="control-label">Sub category</label>
            </div>
            <div class="col-md-3">
                    <label class="control-label"><?php echo $pRow["sub_cat_name"]; ?></label>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row" >
            <div class="col-md-3">
                <label class="control-label">Barcode</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["pbarcode"]; ?></label>
            </div>

            <div class="col-md-3">
                <label class="control-label">Unit</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["unit_name"]; ?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Product Image</label>
            </div>
            <div class="col-md-3">
                <img id="prev_img" src="../images/product_image/<?php echo $pRow["product_image"]; ?>" width="100px" height="90px" />
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Default Regular Unit Price</label>
            </div>
            <div class="col-md-3">
                <label class="control-label">Rs <?php echo $pRow["ppurchase_price"]; ?>.00</label>
            </div>
            <div class="col-md-3">
                <label class="control-label">Default O/Price</label>
            </div>
            <div class="col-md-3">
                <label class="control-label">Rs <?php echo $pRow["pdis"]; ?>.00</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Re-order Quentity</label>
            </div>
            <div class="col-md-3">
                <label class="control-label"><?php echo $pRow["reqty"]; ?></label>
            </div>
        </div>
    </form>
</div>


<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';?>
</body>
</html>
