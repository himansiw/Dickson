<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/product_model.php';
        $productObj= new Product();
        $productResult=$productObj->getAllProducts();
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
                    <center> <h2 class="page-header"><b>View Products</b></h2></center>
                </div>
                  <div class="col-md-1">&nbsp;</div>
            </div>
              <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">View Products</li>
                </ol>
                </div>
                <div class="col-md-1">&nbsp;</div>
              </div>
                <div class="row">
                <div class="col-md-1">&nbsp;</div>
               <div class="col-md-10">
                   <?php
                    if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
                        ?>
                        <div class="row">
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
                        </div>
                                <?php
                            }
                            ?>    
                </div>
                <div class="col-md-1">&nbsp;</div>
                </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                   <div class="col-md-1"> &nbsp;</div>
                   <div class="col-md-10"> 
                    <div class="page-body">
               
                     <a href="add-product.php" class="btn btn-primary" style="float:right; width:150px; height:35px;">
                        <i class="fa fa-plus"></i>
                            <b>Add Product</b>
                     </a>
              
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                        <!--table-->
                           <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped" id="example" role="grid"  style="float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                                           <th style="width:10px">&nbsp;</th>
                                           <th  rowspan="1" colspan="1" style="width:80px;">
                                                Product image
                                            </th>
                                            <th   rowspan="1" colspan="1" style="width:80px;">
                                                SKU
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:150px;">
                                                Product name
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                               Category
                                            </th>
                                            <!--th  rowspan="1" colspan="1" style="width:80px;">
                                               Department
                                            </th-->
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                               Barcode No.
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 80px;">
                                                Status
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width: 300px;">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($prow = $productResult->fetch_assoc()) { //associative array
                                        $productId = $prow["product_id"];
                                        $productId = base64_encode($productId);    
                                    ?>
                                        <tr>
                                            <td><?php echo $prow["product_id"]; ?></td>
                                            <td><img src="../images/product_image/<?php echo $prow["product_image"]; ?>" width="70" height="60" /></td>
                                            <td><?php echo $prow["pcode"]; ?></td>
                                            <td><?php echo $prow["product_name"]; ?></td>
                                            <td><?php echo $prow["cat_name"]; ?></td>
                                           
                                            <td><?php echo $prow["pbarcode"]; ?></td>
                                            <td>
                                                <?php
                                                if ($prow["product_status"] == "1") {
                                                    echo "Available";
                                                } else {
                                                    echo "Unavailable";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!--Active button-->
                                                <?php
                                                if ($prow["product_status"] == 0) {
                                                ?>
                                                <a href="../controller/productcontroller.php?status=activateProduct&product_id=<?php echo $productId; ?>" class="btn btn-md btn-success">
                                                <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Available</b>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <?php
                                                }
                                                ?>
                                                <!--Deactivate button-->
                                                <?php
                                                if ($prow["product_status"] == "1") {
                                                ?>
                                                <a href="../controller/productcontroller.php?status=deactivateProduct&product_id=<?php echo $productId; ?>" class="btn btn-md btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Unavailable</b>
                                                </a> 
                                                <?php
                                                }
                                                ?>
                                                &nbsp;
                                                <!-- view user button-->
                                                <a href="../view/display-product.php?product_id=<?php echo $productId;  ?>"  class="btn btn-md btn-info">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;<b>View</b>
                                                </a>
                                                &nbsp;
                                                <!--edit button-->
                                                <a href="../view/edit-product.php?product_id=<?php echo $productId; ?>" class="btn btn-md btn-primary">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;<b>Edit</b></a>     
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                        </table>
                    </div>
                   
                </div>
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
            </div>
            
<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
?>
    </body>


    <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </script>
</html>
