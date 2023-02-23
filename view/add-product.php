<html>
<head>
    <title>Dicksons</title>
    <style>
        .tit {
            background-color: #0f0f0f;
            color: #ffffff;
        }
    </style>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/brand_model.php';
    include '../model/category_model.php';
    include '../model/subcategory_model.php';
    include '../model/unit_model.php';
    include '../model/department_model.php';
    include '../model/module_model.php';
    include '../model/product_model.php';
    $brandObj = new Brand();
    $brandResult = $brandObj->getAllBrands();
    $categoryObj = new Category();
    $categoryResult = $categoryObj->getAllCategories();
    $subCategoryObj = new Subcategory();
    $subcategoryResult = $subCategoryObj->getAllsubCategories();
    $unitObj = new Unit();
    $unitResult = $unitObj->getAllUnits();
    $departmentObj = new Department();
    $departmentResult = $departmentObj->getAllDepartments();
    $moduleObj = new Module();
    $moduleResult = $moduleObj->getAllModules();

    //Creat the sku no.
    $productObj = new Product();//create the product object
    $skuno = $productObj->getSkuNo();//call method to load last id
    if (mysqli_num_rows($skuno) > 0) { //check result=0 or not
        if ($prrow = $skuno->fetch_assoc()) {//fetch last invoice no
            $lastid = $prrow['pcode'];
            $lastid = substr($lastid, 2, 7);//separating numeric part
            $lastid = $lastid + 1;//Incrementing numeric part
            $lastid = "DS" . sprintf('%04s', $lastid);//concatenating incremented value
            $skuNo = $lastid;
        }
    } else { //if not make id
        $lastid = "DS0001";
        $skuNo = $lastid;
    }

    $barcodeno = $productObj->getBarcodeNo();//call method to load last id
    if (mysqli_num_rows($barcodeno) > 0) { //check result=0 or not
        if ($brrow = $barcodeno->fetch_assoc()) {//fetch last invoice no
            $lastid = $brrow['pbarcode'];
            $lastid = substr($lastid, 2, 7);//separating numeric part
            $lastid = $lastid + 1;//Incrementing numeric part
            $lastid = "1" . sprintf('%03s', $lastid);//concatenating incremented value
            $barcodeNo = $lastid;
        }
    } else { //if not make id
        $lastid = "1001";
        $barcodeNo = $lastid;
    }
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
            <center><h2 class="page-header"><b>Add Product</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Product Master</a></li>
        <li class="breadcrumb-item active"><a href="view-product.php">View Products</a></li>
        <li class="breadcrumb-item active">Add Product</li>
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


    <!--form-->
    <form id="addProduct" enctype="multipart/form-data" method="post"
          action="../controller/productcontroller.php?status=add_product">
        <!--form_row-1-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">SKU</label>
            </div>
            <div class="col-md-3">
                        <span class="pseudo-tooltip-wrapper" style="font-size: 15px"
                              data-title=" This will be auto generated when you add a new product. ">
                        <input type="text" id="p_code" name="pcode" class="form-control" value="<?php echo $skuNo ?>"/>
                        </span>
            </div>

            <div class="col-md-3">
                <label class="control-label">Product Name</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="p_name" name="product_name" autocomplete="off" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Brand</label>
            </div>
            <div class="col-md-3">
                <select id="pbid" name="brand_id" class="form-control">
                    <option value="">-- SELECT --</option>
                    <?php
                    while ($brow = $brandResult->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $brow["brand_id"] ?>">
                            <?php echo $brow["brand_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="control-label">Department</label>
            </div>
            <div class="col-md-3">
                <select id="pdid" name="department_id" class="form-control">
                    <option value="">-- SELECT --</option>
                    <?php while ($drow = $departmentResult->fetch_assoc()) { ?>
                        <option value="<?php echo $drow['department_id']; ?>"><?php echo $drow["department_name"]; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Category</label>
            </div>
            <div class="col-md-3">
                <select id="p_catid" name="cat_id" class="form-control">
                    <option value="">-- SELECT --</option>
                    <?php
                    while ($catrow = $categoryResult->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $catrow["cat_id"] ?>"><?php echo $catrow["cat_name"] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="control-label">Sub category</label>
            </div>
            <div class="col-md-3">
                <div id="subcatdiv">
                    <select name="sub_cat_id" id="sub_cat" class="form-control">
                        <option value="">-- SELECT --</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Barcode</label>
            </div>
            <div class="col-md-3">
                         <span class="pseudo-tooltip-wrapper" style="font-size: 15px" data-title="1XXX">
                        <input type="text" id="p_barcode" autocomplete="off" name="pbarcode" class="form-control"
                               value="<?php echo $barcodeNo ?> "/>
                         </span>
            </div>

            <div class="col-md-3">
                <label class="control-label">Unit</label>
            </div>
            <div class="col-md-3">
                <select id="p_unit" name="unit_id" class="form-control">
                    <option value="">-- SELECT --</option>
                    <?php while ($unitrow = $unitResult->fetch_assoc()) { ?>
                        <option value="<?php echo $unitrow['unit_id']; ?>"><?php echo $unitrow['unit_name']; ?>
                            (<?php echo $unitrow['short_name']; ?>)
                        </option>
                    <?php } ?>
                </select>
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
                <input type="file" name="product_img" id="product_img" onchange="readURL(this)" class="form-control"/>
                <br/>
                <img id="prev_img"/>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Default Regular Unit Price</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                    <input type="number" class="form-control text-right" autocomplete="off" name="ppurchase_price"
                           step="any" id="ppurchase_price" value="0">
                    <span class="input-group-addon zero">
                                .00
                            </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="control-label">Default O/Price</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                            <span class="input-group-addon">
                                Rs
                            </span>
                    <input type="number" class="form-control text-right" autocomplete="off" name="pdis" id="pdis"
                           value="0">
                    <span class="input-group-addon">
                                    .00
                            </span>
                </div>
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
                <input type="number" class="form-control text-right" autocomplete="off" name="reqty" id="reqty"
                       value="0">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-5">
                &nbsp;
            </div>
            <!--button-->
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>&nbsp; <b> Save</b>
                </button>
                &nbsp; &nbsp;
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp; <b>Reset</b>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>
<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php'; ?>
</body>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $( '#prev_img' )
                    .attr( 'src', e.target.result )
                    .height( 70 )
                    .width( 80 );
            };
            reader.readAsDataURL( input.files[0] );
        }
    }
</script>
<script type="text/javascript" src="../js/product_validation.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
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
