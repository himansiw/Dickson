<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/category_model.php';
        include'../model/subcategory_model.php';
        $categoryObj = new Category();
        $subCategoryObj = new Subcategory();
        $categoryResult = $categoryObj->getAllCategories();
        $categoryResult2 = $categoryObj->getAllCategories();
        $subcategoryResult = $subCategoryObj->getAllsubCategories();
        ?>
    </head>
    <body>
        <?php
        include_once'header.php';
        ?>
        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-lg-10">
                    <center> <h2 class="page-header"><b>Categories & Subcategories</b></h2></center>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Master</li>
                        <li class="breadcrumb-item active">Categories & Sub categories</li>
                    </ol>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                    <!-- alert message-->
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
            <div class="row">
                <div class="col-md-12">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-10">
                                <button type="button" class="btn btn-rounded" style="color:#4682B4" data-toggle="modal" data-target="#myCategory">
                                    <b><i class="fa fa-plus-square"></i> Add Category</b></button>
                                <button type="button" class="btn btn-rounded" style="color:#4682B4" data-toggle="modal" data-target="#mySubCategory">
                                    <b><i class="fa fa-plus-square"></i> Add Sub Category</b></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!--table-->
                                <h3>Categories >></h3>
                                <div class="table-responsive center-block">         
                                    <table class="table table-bordered table-striped" id="example" role="grid"  style=" float:left;">
                                        <!--table heading-->
                                        <thead>
                                            <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px" >
                                                <th style="width: 30px">&nbsp;</th>
                                                <th rowspan="1" colspan="1" style="width:120px;">
                                                    Category Name
                                                </th>
                                                <th rowspan="1" colspan="1" style="width:120px;">
                                                    Category Code
                                                </th>
                                                <th  rowspan="1" colspan="1" style="width: 80px;">
                                                    Status
                                                </th>
                                                <th  rowspan="1" colspan="1" style="width:100px;" >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($catrow = $categoryResult->fetch_assoc()) {
                                            $cat_id = $catrow["cat_id"];
                                            $cat_id= base64_encode($cat_id);
                                            ?>
                                            <tr>
                                                <td> <?php echo$catrow["cat_id"]; ?></td>
                                                <td><?php echo $catrow["cat_name"]; ?></td> 
                                                <td><?php echo $catrow["cat_code"]; ?></td>
                                                <td> <?php
                                                    if ($catrow["status"] == 1) {
                                                        echo "Active";
                                                    } else {
                                                        echo "Deactive";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                    <!--Active button-->
                                                    <?php
                                                    if ($catrow["status"] == 0) {
                                                        ?>
                                                        <a href="../controller/categorycontroller.php?status=activateCategory&cat_id=<?php echo $cat_id; ?>" class="btn btn-md btn-success">
                                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                                        </a>
                                                    &nbsp;
                                                    &nbsp;
                                                        <?php
                                                    }
                                                    ?>
                                                    <!--Deactivate button-->
                                                    <?php
                                                    if ($catrow["status"] == "1") {
                                                        ?>
                                                        <a href="../controller/categorycontroller.php?status=deactivateCategory&cat_id=<?php echo $cat_id; ?>" class="btn btn-md btn-danger">
                                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                                        </a> 
                                                        <?php
                                                    }
                                                    ?>
                                                    ||
                                                    <button class="btn btn-sm btn-warning" onclick="loadCategory(<?php echo $catrow["cat_id"] ?>);" data-toggle="modal" data-target="#edit_category" >
                                                        <i class="fa fa-edit"></i> <b>Edit</b>
                                                    </button>
                                                </td>
                                                &nbsp;
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <!--sub category start-->
                            <div class="col-md-6">
                                <h3>Sub Categories >></h3>
                                &nbsp;
                                <div class="table-responsive center-block">         
                                    <table class="table table-bordered table-striped" id="example_1" role="grid"  style="float:left;">
                                        <!--table heading-->
                                        <thead>
                                            <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px" >
                                                <th style="width: 20px">&nbsp;</th>
                                                <th  rowspan="1" colspan="1" style="width: 120px;">
                                                    Category Name
                                                </th>
                                                <th rowspan="1" colspan="1" style="width: 100px;">
                                                    Subcategory Name
                                                </th>
                                                <th rowspan="1" colspan="1" style="width: 80px;">
                                                    Status 
                                                </th>
                                                <th rowspan="1" colspan="1" style="width: 170px;" >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($subcatrow = $subcategoryResult->fetch_assoc()) {
                                            $sub_cat_id= $subcatrow["sub_cat_id"];
                                            $sub_cat_id = base64_encode($sub_cat_id);
                                            ?>
                                            <tr>
                                                <td><?php echo $subcatrow["sub_cat_id"]; ?></td>
                                                <td><?php echo $subcatrow["cat_name"]; ?></td>
                                                <td><?php echo $subcatrow["sub_cat_name"]; ?></td>
                                                <td> <?php
                                                    if ($subcatrow["sub_status"] == 1) {
                                                        echo "Active";
                                                    } else {
                                                        echo "Deactive";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <!--Active button-->
                                                    <?php
                                                    if ($subcatrow["sub_status"] == 0) {
                                                        ?>
                                                        <a href="../controller/categorycontroller.php?status=activateSubcategory&sub_cat_id=<?php echo $sub_cat_id; ?>" class="btn btn-md btn-success">
                                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                                        </a>
                                                    &nbsp;
                                                    &nbsp;
                                                        <?php
                                                    }
                                                    ?>
                                                    <!--Deactivate button-->
                                                    <?php
                                                    if ($subcatrow["sub_status"] == "1") {
                                                        ?>
                                                        <a href="../controller/categorycontroller.php?status=deactivateSubcategory&sub_cat_id=<?php echo $sub_cat_id; ?>" class="btn btn-md btn-danger">
                                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                                        </a> 
                                                        <?php
                                                    }
                                                    ?>
                                                    ||
                                                    <button class="btn btn-sm btn-warning" onclick="loadSubCat(<?php echo $subcatrow["sub_cat_id"] ?>);" data-toggle="modal" data-target="#edit_subcat" >
                                                        <i class="fa fa-edit"></i> <b>Edit</b>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
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
                <div class="col-md-12">&nbsp;</div>
            </div>
        </div>
    <!--Add Category-->
    <div class="modal fade" id="myCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="addCategory" action="../controller/categorycontroller.php?status=add_category" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Create Category</b></h3><br>
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
                                <div  id="alertDiv1"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Category Name</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cat_name" name="cat_name"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Category code</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cat_code" name="cat_code"  autocomplete="off" />
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-save"></i> Save</button>
                    </div> 
                </div> 
            </form>  
        </div>
    </div>

    <!--Edit category-->
    <div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editCategory" action="../controller/categorycontroller.php?status=update_category" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Edit Category</b></h3><br>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            if (isset($_GET["msg2"])) {
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <?php

                                        $msg2 = $_REQUEST["msg2"];
                                        $msg2 = base64_decode($msg2);
                                        echo $msg2;
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
                                <div  id="alertDiv2"></div>
                            </div>
                        </div>
                        <div id="categoryCont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary" value="update"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div> 
            </form>  
        </div>
    </div>

    <!--Add Sub Category-->
    <div class="modal fade" id="mySubCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="addSubcategory" action="../controller/categorycontroller.php?status=add_subcategory" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Create Subcategory</b></h3><br>
                    </div>  
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            if (isset($_GET["msg3"])) {
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <?php

                                        $msg3 = $_REQUEST["msg3"];
                                        $msg3 = base64_decode($msg3);
                                        echo $msg3;
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
                                <div  id="alertDiv3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Subcategory Name</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name"  autocomplete="off"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Category Name</label> 
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="cat_id" name="cat_id">
                                     <option value="">-- SELECT --</option>
                                    <?php
                                    while ($catrow2 = $categoryResult2->fetch_assoc()) {//2 is used to avoid confusion
                                        ?>
                                        <option value="<?php echo $catrow2["cat_id"]; ?>">
                                            <?php echo $catrow2["cat_name"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?> 
                                </select> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-save"></i> Save</button>
                    </div> 
                </div> 
            </form>  
        </div>
    </div>
    <!--Edit Subcategory-->
    <div class="modal fade" id="edit_subcat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editSubcategory" action="../controller/categorycontroller.php?status=update_subcategory" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Edit Subcategory</b></h3><br>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            if (isset($_GET["msg4"])) {
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <?php

                                        $msg4 = $_REQUEST["msg4"];
                                        $msg4 = base64_decode($msg4);
                                        echo $msg4;
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
                                <div  id="alertDiv4"></div>
                            </div>
                        </div>
                        <div id="subcategoryCont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div> 
            </form>  
        </div>
    </div>
</body>
    <?php
    include '../includes/bootstrap_script_includes.php';
    include '../includes/datatable_script_include.php';
    include_once 'footer.php';?>
    </body>
    <script type="text/javascript" src="../js/category.js"></script>


</html>

