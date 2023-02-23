<html>
    <head>
        <title>Dicksons</title>
         <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <style>
            .modal .modal-body {
                max-height: 550px;
                overflow-y: auto;
            }
        </style>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/employee_model.php';
        $employeeObj = new Employee();
        $employeeResult = $employeeObj->getAllEmployees();
        $employeeRole = $employeeObj->getEmployeeRole();
        $empno = $employeeObj->getEmpNo();
        if (mysqli_num_rows($empno) > 0) {
            if ($emprow= mysqli_fetch_assoc($empno)) {
                $lastid = $emprow['emp_no'];
                $lastid = substr($lastid, 4, 8);//separating numeric part
                $lastid = $lastid + 1;//Incrementing numeric part
                $lastid = "EMP-" . sprintf('%03s', $lastid);//concatenating incremented value
                $empNo = $lastid;
            }
        }
        else {
            $lastid = "EMP-001";
            $empNo = $lastid;
        }
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
                    <center> <h2 class="page-header"><b>View Employee</b></h2></center>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                        <li class="breadcrumb-item active">View Employee</li>
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
            <div id="empcont">
                <?php

                $employeeResult=$employeeObj->getAllEmployeesPagination(1,"");
                $ecount=$employeeObj->getAllEmployeeCont();

                $number_of_pages=$ecount/5;
                $ceilpages=  ceil($number_of_pages);

                ?>
            <div class="row">
                <div class="col-md-1"> &nbsp;</div>
                   <div class="col-md-10"> 
                    <div class="page-body">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="searchtext" />
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="naviagetopage(1);" id="searchbtn"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#myemployee">
                                <i class="fa fa-plus"></i>
                                <b>Add New</b>
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
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
                                                Mobile number
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                                Account no
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                                Bank
                                            </th>
                                            <th  rowspan="1" colspan="1" style="width:80px;">
                                                Branch
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
                                    while ($employeerow = $employeeResult->fetch_assoc()) {
                                    $employeeId = $employeerow["employee_id"];
                                    $employeeId = base64_encode($employeeId);
                                    ?>
                                    <tr>
                                        <td><?php echo $employeerow["employee_id"]; ?></td>
                                        <td><?php echo $employeerow["employee_fname"]; ?></td>
                                        <td><?php echo $employeerow["employee_lname"]; ?></td>
                                        <td><?php echo $employeerow["employee_mob"]; ?></td>
                                        <td><?php echo $employeerow["employee_account_no"]; ?></td>
                                        <td><?php echo $employeerow["employee_bank_name"]; ?></td>
                                        <td><?php echo $employeerow["employee_account_branch"]; ?></td>
                                        <td>
                                            <?php
                                            if ($employeerow["employee_status"] == "1") {
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
                                           if ($employeerow["employee_status"] == 0) {
                                                ?>
                                                <a href="../controller/employeecontroller.php?status=activateEmployee&employee_id=<?php echo $employeeId; ?>" class="btn btn-md btn-success">
                                                    <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                                </a>
                                            &nbsp;
                                            &nbsp;
                                            <?php
                                            }
                                            ?>
                                            <!--Deactivate button-->
                                            <?php
                                            if ($employeerow["employee_status"] == "1") {
                                                ?>
                                                <a href="../controller/employeecontroller.php?status=deactivateEmployee&employee_id=<?php echo $employeeId; ?>" class="btn btn-md btn-danger">
                                                    <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                                </a> 
                                            <?php
                                            }
                                            ?>
                                            &nbsp;
                                            <!--Edit button-->
                                                <button class="btn btn-md btn-primary" onclick="loadData(<?php echo $employeerow["employee_id"] ?>);" data-toggle="modal" data-target="#editEmployee" >
                                                    <i class="fa fa-edit"></i> <b>Edit</b></button> 
                                                &nbsp;
                                            <!--View button-->
                                               <button class="btn btn-md btn-info" onclick="loadView(<?php echo $employeerow["employee_id"] ?>);" data-toggle="modal" data-target="#viewEmployee" >
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
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="pagination">
                                    <?php
                                    for($x=1;$x<=$ceilpages;$x++)
                                    {
                                        ?>
                                        <li
                                            <?php
                                            if($x==1)
                                            {
                                                ?>
                                                class="active"
                                                <?php
                                            }
                                            ?>
                                        >
                                            <a href="#" onclick="naviagetopage(<?php echo $x;  ?>);" ><?php echo $x;  ?></a></li>

                                        <?php
                                    }
                                    ?>
                                </ul>
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
        
            <!--Add Employee Modal -->
            <div class="modal fade" id="myemployee" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog  modal-lg" role="document">
                    <form action="../controller/employeecontroller.php?status=add_employee" method="post"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title"><b>Add Employee</b></h3><br>
                            </div>
                            <div class="modal-body">
                                <!--personal details-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Personal Details:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Employee No.</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="emp_no" name="emp_no" value="<?php  echo $empNo ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">First Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="employee_fname" name="employee_fname"  autocomplete="off" placeholder="Employee first name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Last Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="employee_name" name="employee_lname"autocomplete="off" placeholder="Employee last name" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Email</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="employee_email" name="employee_email" class="form-control"  autocomplete="off" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">NIC</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="employee_nic" name="employee_nic" class="form-control" placeholder="NIC" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">DOB</label>
                                    </div>
                                    <div class="col-md-3">
                                            <input type="date" id="employee_dob" name="employee_dob" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Gender</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" id="employee_gender" name="employee_gender" value="0" checked="checked"  />&nbsp;<label class="control-label">Male</label>
                                        &nbsp;
                                        <input type="radio" id="employee_gender" name="employee_gender" value="1" />&nbsp;<label class="control-label">FeMale</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Contact No.1</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="employee_con" name="employee_con" autocomplete="off"  placeholder="Enter Land number...." class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Contact No.2</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="employee_mob" name="employee_mob" autocomplete="off" placeholder="Enter mobile number...." class="form-control" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Employee Role</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="employee_role" name="employee_role"  class="form-control">
                                            <option value="">--Select--</option>
                                            <?php
                                            while ($emprow = $employeeRole->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $emprow["empr_id"] ?>">
                                                    <?php echo $emprow["emp_role"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Address Details:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label"> House No.</label>
                                    </div>
                                    <div class="col-md-3">
                                       <input type="text" class="form-control" id="employee_house_no"  autocomplete="off" name="employee_house_no" placeholder="Houseno." />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label"> Street</label>
                                    </div>
                                    <div class="col-md-3">
                                       <input type="text" class="form-control" id="employee_street" name="employee_street"  autocomplete="off" placeholder="Street" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label"> City</label>
                                    </div>
                                    <div class="col-md-3">
                                       <input type="text" class="form-control" id="employee_city" name="employee_city" autocomplete="off" placeholder="City" />
                                    </div>
                                </div>
                                <!--bank details-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Bank Details:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Account No.</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="employee_account_no" name="employee_account_no" class="form-control" placeholder="Account No."/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Account Holder Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="employee_account_name" name="employee_account_name" placeholder="Account Holder Name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Bank Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="employee_bank_name" name="employee_bank_name" placeholder="Bank Name" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Branch</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="employee_account_branch" name="employee_account_branch" placeholder="Branch" />
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
            <div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="../controller/employeecontroller.php?status=update_employee" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>Edit Employee</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div id="employeeCont">
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
             <div class="modal fade" id="viewEmployee" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="../controller/employeecontroller.php?status=view_employee" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title"><b>View Employee</b></h3><br>
                        </div>
                        <div class="modal-body">
                            <div id="viewemployee">
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
            include_once 'footer.php';
            include '../includes/bootstrap_script_includes.php';
            ?>
      </body>
<!--      <script src="../js/datatable/jquery-3.5.1.js"></script>-->
<!--      <script src="../js/datatable/jquery.dataTables.min.js"></script>-->
<!--      <script src="../js/datatable/dataTables.bootstrap.min.js"></script>-->
<!--      <script>-->
<!--            $(document).ready(function () {-->
<!--            $('#example').DataTable();-->
<!--            });-->
<!--      </script>-->


    <script type="text/javascript" src="../js/employee_validation.js"></script>
    <script>
        function loadData(x)
        {
            var url = "../controller/employeecontroller.php?status=edit_employee";
            $.post(url, {employee_id: x}, function (data) {
                $("#employeeCont").html(data).show();
            });
        }
    </script>
    <script>
        function loadView(x)
        {
            var url = "../controller/employeecontroller.php?status=view_employee";
            $.post(url, {employee_id: x}, function (data) {
                $("#viewemployee").html(data).show();
            });
        }
    </script>

</html>