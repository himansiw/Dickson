<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/unit_model.php';
        $unitObj = new Unit();
        $unitResult = $unitObj->getAllUnits();
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
                    <center> <h2 class="page-header"><b>Units</b></h2></center>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">Units</li>
            </ol>
            <div class="row">
                <!-- alert message-->
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
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-11"> 
                    <div class="well" style="margin:auto; padding:auto; width:100%;">
                        <div class="page-body">
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#myUnit">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>     
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <!--table-->
                            <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" aria-describedby="users_table_info" style="width: 900px; float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px" >
                                            <th style="width: 40px">&nbsp;</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                              Name
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending" aria-label="Firstname: activate to sort column descending">
                                               Short Name
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending" aria-label="Firstname: activate to sort column descending">
                                                Allow Decimal
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="users_table" rowspan="1" colspan="1" style="width: 80px;">
                                                Status
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 140px;" aria-label="Action">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                      <?php
                                    while ($urow = $unitResult->fetch_assoc()) {
                                        $unit_id = $urow["unit_id"];
                                        $unit_id = base64_encode($unit_id);
                                    ?>
                                        <tr>
                                            <td> <?php echo $urow["unit_id"]; ?></td>
                                            <td> <?php echo $urow["unit_name"]; ?></td>
                                            <td> <?php echo $urow["short_name"]; ?></td>
                                            <td> <?php
                                                if ($urow["allow_decimal"] == 1) {
                                                    echo "yes";
                                                } else {
                                                    echo "no";
                                                }
                                                 ?>
                                            </td>
                                            <td> <?php
                                                if ($urow["unit_status"] == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "Deactive";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                &nbsp;
                                                &nbsp;
                                                <!--Active button-->
                                                <?php
                                                if ($urow["unit_status"] == 0) {
                                                ?>
                                                <a href="../controller/unitcontroller.php?status=activateUnit&unit_id=<?php echo $unit_id; ?>" class="btn btn-md btn-success">
                                                <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                                </a>
                                                <?php
                                                }
                                                ?>
                                                <!--Deactivate button-->
                                                <?php
                                                if ($urow["unit_status"] == "1") {
                                                ?>
                                                <a href="../controller/unitcontroller.php?status=deactivateUnit&unit_id=<?php echo $unit_id; ?>" class="btn btn-md btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                                </a> 
                                                <?php
                                                }
                                                ?>
                                                &nbsp; || &nbsp;
                                                <!--delete button-->
                                                <button class="btn btn-md btn-warning" onclick="loadUnit(<?php echo $urow["unit_id"] ?>);" data-toggle="modal" data-target="#edit_unit" >
                                                    <i class="fa fa-edit"></i> <b>Edit</b>
                                                </button>
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
    
 <!--Add Unit-->
 <div class="modal fade" id="myUnit" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form id="addUnit" action="../controller/unitcontroller.php?status=add_unit" method="post">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3 class="modal-title"><b>Create Unit</b></h3><br>
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
                                <label class="control-label" >Unit Name</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="uname" name="unit_name" autocomplete="off" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Short Name</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="short_name" id="shortname" autocomplete="off" />
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Allow decimal</label> 
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="decimal" name="allow_decimal">
                                    <option selected="selected" value="">-- SELECT --</option>
                                    <option value="1"  name="allow_decimal">yes</option>
                                    <option value="0"  name="allow_decimal">no</option>
                                </select>
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
<!--Edit unit-->
<div class="modal fade" id="edit_unit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editUnit" action="../controller/unitcontroller.php?status=update_unit" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>Edit Unit</b></h3><br>
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
                    <div id="unitCont">
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
    include '../includes/bootstrap_script_includes.php';
    include '../includes/datatable_script_include.php';
    include_once 'footer.php';?>
    </body>
    <script type="text/javascript" src="../js/unit.js"></script>


</html>

