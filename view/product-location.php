<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/location_model.php';
        $locationObj = new Location();
        $locationResult = $locationObj->getAllLocations();
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <center> <h2 class="page-header"><b>Product Location</b></h2></center>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">Product Location</li>
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
                    <div class="well" style="margin:auto; padding:auto; width:90%;">
                        <div class="page-body">
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#locationModal">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                          <!--table-->
                            <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" aria-describedby="users_table_info" style="float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px" >
                                            <th style="width: 10px">&nbsp;</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 70px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                              Rack No.
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending" aria-label="Firstname: activate to sort column descending">
                                               Product Name
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending" aria-label="Firstname: activate to sort column descending">
                                                Shelf Position
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 100px;">
                                                Status
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 140px;" aria-label="Action">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                while ($lrow = $locationResult->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td> <?php echo $lrow["location_id"]; ?></td>
                                            <td> <?php 
                                                    if($lrow["rack_no"]==0){
                                                        echo "R1";
                                                    }elseif ($lrow["rack_no"]==1) {
                                                    echo "R2";
                                                    }elseif ($lrow["rack_no"]==2) {
                                                       echo"R3"; 
                                                    }elseif ($lrow["rack_no"]==3) {
                                                    echo"R4";   
                                                    }elseif ($lrow["rack_no"]==4) {
                                                    echo"R5";
                                                    }  else {
                                                     echo"R6";  
                                                    }
                                                      ?>
                                            </td>
                                            <td> <?php echo $lrow["product_name"];?></td>
                                            <td> <?php echo $lrow["position"]; ?></td>
                                            <td> <?php
                                                if ($lrow["location_status"] == 1) {
                                                    echo "active";
                                                } else {
                                                    echo "deactive";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            &nbsp;
                                            <!--Active button-->
                                            <?php
                                            if ($lrow["location_status"] == 0) {
                                            ?>
                                            <a href="../controller/locationcontroller.php?status=activateLocation&location_id=<?php echo $location_id; ?>" class="btn btn-md btn-success">
                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <?php
                                            }
                                            ?>
                                            <!--Deactivate button-->
                                            <?php
                                            if ($lrow["location_status"] == "1") {
                                            ?>
                                            <a href="../controller/locationcontroller.php?status=deactivateLocation&location_id=<?php echo $location_id; ?>" class="btn btn-md btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                            </a> 
                                            <?php
                                            }
                                            ?>
                                            &nbsp; || &nbsp;
                                            <button class="btn btn-md btn-warning" onclick="loadLocation(<?php echo $lrow["location_id"] ?>);" data-toggle="modal" data-target="#edit_location" >
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
            
        
 <!--Add Location-->
 <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form action="../controller/locationcontroller.php?status=add_location" method="post">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3 class="modal-title"><b>Create Product Location</b></h3><br>
                 </div>  
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Rack No.</label> 
                            </div>
                            <div class="col-md-6">
                             <select class="form-control" name="rack_no">
                                    <option selected="selected" value="">-- SELECT --</option>
                                    <option value="0"  name="rack_no">R1</option>
                                    <option value="1"  name="rack_no">R2</option>
                                    <option value="2"  name="rack_no">R3</option>
                                    <option value="3"  name="rack_no">R4</option>
                                    <option value="4"  name="rack_no">R5</option>
                                    <option value="5" name="rack_no">R6</option>
                                </select>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Product Name</label> 
                            </div>
                            <div class="col-md-6">
                              <select name="product_id" id="product_id" class="form-control">
                                    <option value="">-- SELECT --</option>
                                    <?php while ($prow = $productResult->fetch_assoc()) { ?>
                                        <option value="<?php echo $prow['product_id']; ?>"><?php echo $prow["product_name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Position</label> 
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="position" class="form-control"  id="position"/>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-6">&nbsp;</div>
                            <div class="col-md-6">
                                <p>(eg.Top Shelf,Medium Shelf or Bottom Shelf of Rack)</p>
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
