<?php
include '../model/employee_model.php';

$employeeObj = new Employee();// create employee Object;
$employeeRole = $employeeObj->getEmployeeRole();
if(!isset($_REQUEST["status"]))
{
  ?>  
 <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status) {
        case "add_employee":
            try {
                $emp_no = $_POST["emp_no"];
                $employee_fname = $_POST["employee_fname"];
                $employee_lname = $_POST["employee_lname"];
                $employee_email = $_POST["employee_email"];
                $employee_nic = $_POST["employee_nic"];
                $employee_dob = $_POST["employee_dob"];
                $employee_gender = $_POST["employee_gender"];
                $employee_con = $_POST["employee_con"];
                $employee_mob = $_POST["employee_mob"];
                $employee_role = $_POST["employee_role"];
                $employee_house_no = $_POST["employee_house_no"];
                $employee_street = $_POST["employee_street"];
                $employee_city = $_POST["employee_city"];
                $employee_account_no = $_POST["employee_account_no"];
                $employee_account_name = $_POST["employee_account_name"];
                $employee_bank_name = $_POST["employee_bank_name"];
                $employee_account_branch = $_POST["employee_account_branch"];
                $employeeId = $employeeObj->addEmployee($emp_no,$employee_fname,$employee_lname,$employee_email,$employee_nic,$employee_dob,$employee_gender,$employee_con,$employee_mob,$employee_role,$employee_house_no,$employee_street,$employee_city,$employee_account_no,$employee_account_name,$employee_bank_name,$employee_account_branch);
                if ($employeeId > 0) {
                    $msg = "Employee $employee_fname $employee_lname  Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/employee.php?msg=' . $msg);
                } else {
                    throw new Exception("Employee Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/employee.php?msg=' . $msg);
            }
            break;

        case "edit_employee":
             $employeeId = $_POST["employee_id"];
             $employeeResult = $employeeObj->getEmployee($employeeId);
             $employeerow = $employeeResult->fetch_assoc();
             ?>
            <input type="hidden" name="employee_id" value="<?php echo $employeerow["employee_id"]; ?>" />
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
                    <label class="form-control"><?php echo $employeerow["emp_no"]; ?> </label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">First Name</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="employee_fname" name="employee_fname" autocomplete="off" value="<?php echo $employeerow["employee_fname"]; ?>" />
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
                    <input type="text" class="form-control" id="employee_lname" name="employee_lname" autocomplete="off" value="<?php echo $employeerow["employee_lname"]; ?>"/>
                </div>

                <div class="col-md-3">
                    <label class="control-label">Email</label>
                </div>
                <div class="col-md-3">
                    <input type="text" id="employee_email" name="employee_email" class="form-control" autocomplete="off" value="<?php echo $employeerow["employee_email"]; ?>" />
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
                    <input type="text" id="employee_nic" name="employee_nic" class="form-control" autocomplete="off" value="<?php echo $employeerow["employee_nic"]; ?>" />
                </div>
                <div class="col-md-3">
                    <label class="control-label">DOB</label>
                </div>
                <div class="col-md-3">
                        <input type="date" id="employee_dob" name="employee_dob" class="form-control" autocomplete="off" value="<?php echo $employeerow["employee_dob"]; ?>" />
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
                    <input type="radio" name="gender" value="0"
                        <?php
                        if ($employeerow["employee_gender"] == 0) {
                            ?>
                            checked="checked"
                            <?php
                        }
                        ?>
                    />&nbsp;<label class="control-label">Male</label>
                    &nbsp;
                    <input type="radio" name="gender" value="1"
                        <?php
                        if ($employeerow["employee_gender"] == "1") {
                            ?>
                            checked="checked"
                            <?php
                        }
                        ?>

                    />&nbsp;<label class="control-label">FeMale</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Contact No.1</label>
                </div>
                <div class="col-md-3">
                    <input type="text" id="employee_con" name="employee_con" class="form-control" autocomplete="off" value="<?php echo $employeerow["employee_con"]; ?>" />
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
                    <input type="text" id="employee_mob" name="employee_mob"  class="form-control" autocomplete="off" value="<?php echo $employeerow["employee_mob"]; ?>" />
                </div>
                 <div class="col-md-3">
                     <label class="control-label">Employee Role</label>
                 </div>
                 <div class="col-md-3">
                        <select  class="form-control" name="employee_role" id="employee_role">
                            <option value="">---</option>
                            <?php
                                while ($emprow = $employeeRole->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $emprow["empr_id"]; ?>"
                             <?php
                             if($emprow["empr_id"]==$employeerow["employee_role"])
                             {
                             ?>
                                    selected="selected"
                            <?php
                             }
                            ?>
                              >
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
                <div class="col-md-3">
                    <label class="control-label"> House No.</label>
                </div>
                <div class="col-md-3">
                   <input type="text" class="form-control" id="employee_house_no" name="employee_house_no" autocomplete="off" value="<?php echo $employeerow["employee_house_no"]; ?>" />
                </div>
                <div class="col-md-3">
                    <label class="control-label"> Street</label>
                </div>
                <div class="col-md-3">
                   <input type="text" class="form-control" id="employee_street" name="employee_street" autocomplete="off" value="<?php echo $employeerow["employee_street"]; ?>" />
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
                   <input type="text" class="form-control" id="employee_city" name="employee_city" autocomplete="off" value="<?php echo $employeerow["employee_city"]; ?>" />
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
                    <input type="text" id="employee_account_no" name="employee_account_no" class="form-control" value="<?php echo $employeerow["employee_account_no"]; ?>"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Account Holder Name</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="employee_account_name" name="employee_account_name"  value="<?php echo $employeerow["employee_account_name"]; ?>" />
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
                    <input type="text" class="form-control" id="employee_bank_name" name="employee_bank_name" autocomplete="off" value="<?php echo $employeerow["employee_bank_name"]; ?>" />
                </div>
                <div class="col-md-3">
                    <label class="control-label">Branch</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="employee_account_branch" name="employee_account_branch" autocomplete="off" value="<?php echo $employeerow["employee_account_branch"]; ?>" />
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>    
            <?php
            break;

        case "update_employee":
            $employeeId = $_POST["employee_id"];
            $employee_fname = $_POST["employee_fname"];
            $employee_lname = $_POST["employee_lname"];
            $employee_email = $_POST["employee_email"];
            $employee_nic = $_POST["employee_nic"];
            $employee_dob = $_POST["employee_dob"];
            $employee_gender = $_POST["gender"];
            $employee_con = $_POST["employee_con"];
            $employee_mob = $_POST["employee_mob"];
            $employee_role=$_POST["employee_role"];
            $employee_house_no = $_POST["employee_house_no"];
            $employee_street = $_POST["employee_street"];
            $employee_city = $_POST["employee_city"];
            $employee_account_no = $_POST["employee_account_no"];
            $employee_account_name = $_POST["employee_account_name"];
            $employee_bank_name = $_POST["employee_bank_name"];
            $employee_account_branch = $_POST["employee_account_branch"];
            $employeeObj->updateEmployee($employeeId,$employee_fname,$employee_lname,$employee_email,$employee_nic,$employee_dob,$employee_gender,$employee_con,$employee_mob,$employee_house_no,$employee_street,$employee_city,$employee_account_no,$employee_account_name,$employee_bank_name,$employee_account_branch);
            $msg = "Successfully Updated Employee  $employee_fname";
            $msg = base64_encode($msg);
            header('Location: ../view/employee.php?msg=' . $msg);
            break;
        
        case "view_employee":
             $employeeId = $_POST["employee_id"];
             $employeeResult = $employeeObj->getEmployee($employeeId);
             $employeerow = $employeeResult->fetch_assoc();
             $getRole=$employeeObj->getEmployeeDetail($employeeId);
             $getEmployeeResult=$getRole->fetch_assoc();

             ?>
            <input type="hidden" name="employee_id" value="<?php echo $employeerow["employee_id"]; ?>" />
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
                    <label class="control-label"><?php echo $employeerow["emp_no"]; ?></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">First Name</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><?php echo $employeerow["employee_fname"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_lname"]; ?></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Email</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><?php echo $employeerow["employee_email"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_nic"]; ?></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">DOB</label>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <label class="control-label"><?php echo $employeerow["employee_dob"]; ?></label>
                    </div>
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
                    <label class=" label label-primary">
                        <?php echo $employee_gender = ($employeerow["employee_gender"] == 0) ? "Male" : "Female" ?>
                    </label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Contact No.1</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><?php echo $employeerow["employee_con"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_mob"]; ?></label>
                </div>
                <div class="col-md-3">
                     <label class="control-label">Employee Role</label>
                 </div>
                 <div class="col-md-3">
                     <label class="control-label"><?php echo $getEmployeeResult["emp_role"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_house_no"]; ?></label>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label"> Street</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><?php echo $employeerow["employee_street"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_city"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_account_no"]; ?></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Account Holder Name</label>
                </div>
                <div class="col-md-3">
               <label class="control-label"><?php echo $employeerow["employee_account_name"]; ?></label>
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
                    <label class="control-label"><?php echo $employeerow["employee_bank_name"]; ?></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Branch</label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><?php echo $employeerow["employee_account_branch"]; ?></label>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>    
            <?php
            break;
        
         case "deactivateEmployee":
            $employee_id = $_REQUEST["employee_id"];
//    Decode the encoded employee id to the normal numeric form.
            $employee_id = base64_decode($employee_id);
            $employeeObj->deactivateEmployee($employee_id);
            $msg = "Employee Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/employee.php?msg=' . $msg);
            break;
        //Active Employee.
        case "activateEmployee":
            $employee_id = $_REQUEST["employee_id"];
            $employee_id = base64_decode($employee_id);
            $employeeObj->activateEmployee($employee_id);
            $msg = "Employee Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/employee.php?msg=' . $msg);
            break;

    //Create pagination
        case "paginate":
          $page=$_POST["page"];
          $txt=$_POST["txt"];
          include_once '../model/employee_model.php';
          $employeeObj= new Employee();

          $employeeResult=$employeeObj->getAllEmployeesPagination($page,$txt);
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
            <div class="row">
                <div class="col-md-12">
                    <ul class="pagination">
                        <?php
                        for($x=1;$x<=$ceilpages;$x++)
                        {
                            ?>
                            <li
                                <?php
                                if($x==$page)
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
    <?php
    break;
}
}


