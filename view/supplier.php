<html>
    <head>
        <title>Dicksons</title>
         <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <style>
            .modal .modal-body {
                max-height: 500px;
                overflow-y: auto;
            }
        </style>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/supplier_model.php';
        $supplierObj = new Supplier();
        $supplierResult = $supplierObj->getAllSuppliers();
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
                    <center> <h2 class="page-header"><b>View Supplier</b></h2></center>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
                        <li class="breadcrumb-item active">View Supplier</li>
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
                <div class="col-md-1">&nbsp;</div>
                </div>
            <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
            <div class="row">
                <div class="col-md-1"> &nbsp;</div>
                   <div class="col-md-10"> 
                    <div class="page-body">
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#mysupplier">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                        <!--table-->
                           <div class="table-responsive center-block">         
                                <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" style="float:left;">
                                    <!--table heading-->
                                    <thead>
                                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                                            <th style="width: 10px">&nbsp;</th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                                First name
                                            </th>
                                            <th   rowspan="1" colspan="1" style="width:100px;">
                                                Last name
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:60px;">
                                                Business name
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                               Email
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                                Account no.
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 80px;">
                                                Status
                                            </th>
                                            <th rowspan="1" colspan="1" style="width: 160px;">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($suprow = $supplierResult->fetch_assoc()) {
                                    $supplierId = $suprow["sup_id"];
                                    $supplierId = base64_encode($supplierId);
                                    ?>
                                    <tr>
                                        <td><?php echo $suprow["sup_id"]; ?></td>
                                        <td><?php echo $suprow["sup_fname"]; ?></td>
                                        <td><?php echo $suprow["sup_lname"]; ?></td>
                                        <td><?php echo $suprow["business_name"]; ?></td>
                                        <td><?php echo $suprow["sup_email"]; ?></td>
                                        <td><?php echo $suprow["sup_account_no"]; ?></td>
                                        <td>
                                            <?php
                                            if ($suprow["sup_status"] == "1") {
                                                echo "Activate";
                                            } else {
                                                echo "Deactivate";
                                            }
                                     ?>
                                        </td>
                                        <td>
                                            &nbsp;
                                            <!--Active button-->
                                            <?php
                                           if ($suprow["sup_status"] == 0) {
                                                ?>
                                            <a href="../controller/suppliercontroller.php?status=activateSupplier&sup_id=<?php echo $supplierId; ?>" class="btn btn-sm btn-success">
                                                    <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                                </a>
                                            &nbsp;
                                            &nbsp;
                                            <?php
                                            }
                                            ?>
                                            <!--Deactivate button-->
                                            <?php
                                            if ($suprow["sup_status"] == "1") {
                                                ?>
                                            <a href="../controller/suppliercontroller.php?status=deactivateSupplier&sup_id=<?php echo $supplierId; ?>" class="btn btn-sm btn-danger">
                                                    <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                                </a> 
                                            <?php
                                            }
                                            ?>
                                            &nbsp;
                                            <!--Edit button-->
                                                <button class="btn btn-sm btn-primary" onclick="loadData(<?php echo $suprow["sup_id"] ?>);" data-toggle="modal" data-target="#editSupplier" >
                                                    <i class="fa fa-edit"></i> <b>Edit</b></button> 
                                            &nbsp;
                                            <!--View button-->
                                               <button class="btn btn-sm btn-info" onclick="loadView(<?php echo $suprow["sup_id"] ?>);" data-toggle="modal" data-target="#viewSupplier" >
                                                    <i class="fa fa-eye"></i> <b>View</b></button>   
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
        
            <!--Add Employee Modal -->
            <div class="modal fade" id="mysupplier" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="../controller/suppliercontroller.php?status=add_supplier" method="post"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title"><b>Add Supplier</b></h3><br>
                            </div>
                            <div class="modal-body">
                                <!--personal details-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Personal Details -:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Business Name:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Employee business name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">First Name:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="sup_fname" name="sup_fname" placeholder="Supplier first name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Last Name:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="sup_lname" name="sup_lname" placeholder="Supplier last name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Email:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="sup_email" name="sup_email" class="form-control" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">NIC:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="sup_nic" name="sup_nic" class="form-control" placeholder="NIC" />
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">DOB:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="date" id="sup_dob" name="sup_dob" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Gender:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" id="sup_gender" name="sup_gender" value="0" checked="checked"  />&nbsp;<label class="control-label">Male</label>
                                        &nbsp;
                                        <input type="radio" id="sup_gender" name="sup_gender" value="1" />&nbsp;<label class="control-label">FeMale</label>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Mobile No: </label>
                                    </div>
                                    <div class="col-md-6">
                                         <input type="text" id="sup_mob" name="sup_mob"  placeholder="Enter mobile number...." class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Alternate Contact No: </label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" id="sup_con" name="sup_con"  placeholder="Enter alternate contact number...." class="form-control" /> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Address Details -:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label"> House No:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" id="sup_house_no" name="sup_house_no" placeholder="Houseno." />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label"> Street:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" id="sup_street" name="sup_street" placeholder="Street" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label"> City:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" id="sup_city" name="sup_city" placeholder="City" />
                                    </div>
                                </div>
                                <!--bank details-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Bank Details -:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Account No:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="sup_account_no" name="sup_account_no" class="form-control" placeholder="Account No."/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Account Holder Name:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="sup_account_name" name="sup_account_name" placeholder="Account Holder Name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Bank Name:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="sup_bank_name" name="sup_bank_name" placeholder="Bank Name" />
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Branch:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="sup_account_branch" name="sup_account_branch" placeholder="Branch" />
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
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
            
            <!--Edit Employee-->
            <div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="../controller/suppliercontroller.php?status=update_supplier" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>Edit Supplier</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div id="supplierCont">
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
            
            <!--View Employee modal-->
             <div class="modal fade" id="viewSupplier" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="../controller/suppliercontroller.php?status=view_supplier" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>View Supplier</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div id="viewsupplier">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
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
    <script type="text/javascript" src="../js/user_validation.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5,6,7 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5,6,7 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5,6,7 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5,6,7 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5,6,7]
                        }
                    },
                    'colvis'
                ],
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
        $(function() {
            $("#msg").show();
            setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
        });
    </script>
    <script>
        $(function() {
            $("#error").show();
            setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
        });
    </script>

        

    <script>
        function loadData(x)
        {
            var url = "../controller/suppliercontroller.php?status=edit_supplier";
            $.post(url, {sup_id: x}, function (data) {
                $("#supplierCont").html(data).show();
            });
        }
    </script>
    <script>
        function loadView(x)
        {
            var url = "../controller/suppliercontroller.php?status=view_supplier";
            $.post(url, {sup_id: x}, function (data) {
                $("#viewsupplier").html(data).show();
            });
        }
    </script>

</html>