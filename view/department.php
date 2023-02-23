<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/department_model.php';
        $departmentObj = new Department();
        $departmentResult = $departmentObj->getAllDepartments();
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
                    <center> <h2 class="page-header"><b>Departments</b></h2></center>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Product Master</li>
                <li class="breadcrumb-item active">Departments</li>
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
                    <div id="alertDiv1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-11">
                    <div class="well" style="margin:auto; padding: auto; width:100%;">
                        <div class="page-body">
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#myDepatment">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <!--table-->
                            <div class="table-responsive center-block">
                                <table class="table table-bordered table-striped" id="example" role="grid" style="width: 950px; float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px" >
                                            <th style="width: 40px">&nbsp;</th>
                                            <th rowspan="1" colspan="1" style="width: 100px;">
                                              Name
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 200px;">
                                               Description
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 80px;">
                                                Status
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 140px;">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($drow = $departmentResult->fetch_assoc()) {
                                        $department_id = $drow["department_id"];
                                        $department_id = base64_encode($department_id);
                                    ?>
                                        <tr>
                                            <td> <?php echo $drow["department_id"]; ?></td>
                                            <td> <?php echo $drow["department_name"]; ?></td>
                                            <td> <?php echo $drow["description"]; ?></td>
                                            <td> <?php
                                                if ($drow["department_status"] == 1) {
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
                                            if ($drow["department_status"] == 0) {
                                            ?>
                                        <a href="../controller/departmentcontroller.php?status=activateDepartment&department_id=<?php echo $department_id; ?>" class="btn btn-md btn-success" id="activate">
                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                            </a>
                                        &nbsp;
                                        &nbsp;
                                            <?php
                                            }
                                            ?>
                                        <!--Deactivate button-->
                                            <?php
                                            if ($drow["department_status"] == "1") {
                                            ?>
                                        <a href="../controller/departmentcontroller.php?status=deactivateDepartment&department_id=<?php echo $department_id; ?>" class="btn btn-md btn-danger" id="deactivate">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                            </a> 
                                            <?php
                                            }
                                            ?>
                                                &nbsp; || &nbsp;
                                                <button class="btn btn-md btn-warning" onclick="loadDepartment(<?php echo $drow["department_id"] ?>);" data-toggle="modal" data-target="#edit_department" >
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
    
 <!--Add Department-->
 <div class="modal fade" id="myDepatment" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form  id="addDepartment" action="../controller/departmentcontroller.php?status=add_department" method="post">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3 class="modal-title"><b>Create Department</b></h3><br>
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
                                <div  id="alertDiv"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Department Name</label> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="department_name" name="department_name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" >Description</label> 
                            </div>
                            <div class="col-md-6">
                                <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50" id="description"></textarea>
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
<!--Edit department-->
<div class="modal fade" id="edit_department" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editDepartment" action="../controller/departmentcontroller.php?status=update_department" method="post">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>Edit Department</b></h3><br>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        if (isset($_GET["msg2"])) {
                            ?>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <?php

                                    $msg1 = $_REQUEST["msg2"];
                                    $msg1 = base64_decode($msg2);
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
                            <div  id="alertDiv2"></div>
                        </div>
                    </div>
                    <div id="departmentCont">
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
    <script type="text/javascript" src="../js/product_master.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                buttons: [ 'copy','csv','print', 'excel', 'pdf' ],
                dom:
                    "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,-1],
                    [5,10,25,50,100,"All"]
                ]
            } );

            table.buttons().container()
                .appendTo( '#example_wrapper .col-md-5:eq(0)' );
            var url = window.location.href;//old url.
            var spliturl = url.split('?')[0];// Divide the old url on the question mark.
            var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
            window.history.pushState({},document.title,""+ newSpliturl);
        } );
    </script>

<script>
    function loadDepartment(x)
    {
        var url = "../controller/departmentcontroller.php?status=edit_department";
        $.post(url, {department_id: x}, function (data) {
            $("#departmentCont").html(data).show();
        });
    }
</script>
<script>
    $(function() {
        $("#msg").show();
        setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
    });

        $(function() {
            $("#error").show();
            setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
        });
</script>
</html>

