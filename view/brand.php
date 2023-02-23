<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/brand_model.php';
        $brandObj = new Brand();
        $brandResult = $brandObj->getAllBrands();
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
                    <center> <h2 class="page-header"><b>Brands</b></h2></center>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">Brands</li>
            </ol>
                <div class="row">
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
            <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
            <div class="row">
                    <div class="col-md-1">&nbsp;</div>
                <div class="col-md-11"> 
                    <div class="well" style="margin:auto; padding:auto; width:80%;">
                    <div class="page-body">
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                        <!--table-->
                           <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" style="width: 740px; float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                                           <th style="width: 40px">&nbsp;</th>
                                            <th rowspan="1" colspan="1" style="width: 140px;">
                                                First Name
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 80px;">
                                                Status
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 100px;">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($brow = $brandResult->fetch_assoc()) {
                                        $brand_id = $brow["brand_id"];
                                        $brand_id = base64_encode($brand_id);
                                    ?>
                                    <tr>
                                        <td> <?php echo $brow["brand_id"]; ?></td>
                                        <td> <?php echo $brow["brand_name"]; ?></td>
                                        <td> <?php
                                    if ($brow["brand_status"] == 1) {
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
                                            if ($brow["brand_status"] == 0) {
                                            ?>
                                            <a href="../controller/brandcontroller.php?status=activateBrand&brand_id=<?php echo $brand_id; ?>" class="btn btn-md btn-success">
                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <?php
                                            }
                                            ?>
                                            <!--Deactivate button-->
                                            <?php
                                            if ($brow["brand_status"] == "1") {
                                            ?>
                                            <a href="../controller/brandcontroller.php?status=deactivateBrand&brand_id=<?php echo $brand_id; ?>" class="btn btn-md btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                            </a> 
                                            <?php
                                            }
                                            ?>
                                            &nbsp; || &nbsp;
                                            <button class="btn btn-md btn-warning" onclick="loadData(<?php echo $brow["brand_id"] ?>);"    data-toggle="modal" data-target="#editBrand" >
                                            <i class="fa fa-edit"></i> <b>Edit</b></button> 
                                            &nbsp;
                                        </td>
                                        &nbsp;
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
            
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="../controller/brandcontroller.php?status=add_brand" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>Create Brands</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label" >Brand Name</label> 
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="brand_name" /> 
                                </div>
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


        <!--        Edit brand-->
        <div class="modal fade" id="editBrand" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="../controller/brandcontroller.php?status=update_brand" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>Edit Brand</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div id="brandCont">
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

    <script>
        function loadData(x)
        {
            var url = "../controller/brandcontroller.php?status=edit_brand";
            $.post(url, {brand_id: x}, function (data) {
                $("#brandCont").html(data).show();
            });
        }
    </script>


</html>
