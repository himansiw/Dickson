<?php
include '../model/supplier_model.php';

$supplierObj = new Supplier();// create employee Object;
if(!isset($_REQUEST["status"]))
{
  ?>  
 <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status) {
        case "add_supplier":
            try {
                $business_name = $_POST["business_name"];
                $sup_fname = $_POST["sup_fname"];
                $sup_lname = $_POST["sup_lname"];
                $sup_email = $_POST["sup_email"];
                $sup_nic = $_POST["sup_nic"];
                $sup_dob = $_POST["sup_dob"];
                $sup_gender = $_POST["sup_gender"];
                $sup_mob = $_POST["sup_mob"];
                $sup_con = $_POST["sup_con"];
                $sup_house_no = $_POST["sup_house_no"];
                $sup_street = $_POST["sup_street"];
                $sup_city = $_POST["sup_city"];
                $sup_account_no = $_POST["sup_account_no"];
                $sup_account_name = $_POST["sup_account_name"];
                $sup_bank_name = $_POST["sup_bank_name"];
                $sup_account_branch = $_POST["sup_account_branch"];
                $supplierId = $supplierObj->addSupplier($business_name,$sup_fname,$sup_lname,$sup_email,$sup_nic,$sup_dob,$sup_gender,$sup_mob,$sup_con,$sup_house_no,$sup_street,$sup_city,$sup_account_no,$sup_account_name,$sup_bank_name,$sup_account_branch);
                if ($supplierId > 0) {
                    $msg = "Supplier $sup_fname $sup_lname  Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/supplier.php?msg=' . $msg);
                } else {
                    throw new Exception("Supplier Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/supplier.php?msg=' . $msg);
            }
            break;

        case "edit_supplier":
             $supplierId = $_POST["sup_id"];
             $supplierResult = $supplierObj->getSupplier($supplierId);
             $suprow = $supplierResult->fetch_assoc();
             ?>
            <input type="hidden" name="sup_id" value="<?php echo $suprow["sup_id"]; ?>" />
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
                    <input type="text" class="form-control" id="business_name" name="business_name" value="<?php echo $suprow["business_name"]; ?>" />
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
                    <input type="text" class="form-control" id="sup_fname" name="sup_fname" value="<?php echo $suprow["sup_fname"]; ?>" />
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
                    <input type="text" class="form-control" id="sup_lname" name="sup_lname" value="<?php echo $suprow["sup_lname"]; ?>"/>
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
                <input type="text" id="sup_email" name="sup_email" class="form-control" value="<?php echo $suprow["sup_email"]; ?>" />
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
                    <input type="text" id="sup_nic" name="sup_nic" class="form-control"  value="<?php echo $suprow["sup_nic"]; ?>" />
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
                        <input type="date" id="sup_dob" name="sup_dob" class="form-control" value="<?php echo $suprow["sup_dob"]; ?>" />
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
                    <input type="radio" id="sup_gender" name="sup_gender" value="0"  
                        <?php
                        if ($suprow["sup_gender"] == 0) {
                            ?>
                                   checked="checked"  
                                   <?php
                               }
                               ?>
                               />&nbsp;<label class="control-label">Male</label>
                        &nbsp;
                        <input type="radio" id="sup_gender" name="sup_gender" value="1"
                        <?php
                        if ($suprow["sup_gender"] == "1") {
                            ?>     
                                   checked="checked"
                            <?php
                        }
                        ?>

                               />&nbsp;<label class="control-label">FeMale</label>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Mobile No:</label>
                </div>
                <div class="col-md-6">
                    <input type="text" id="sup_mob" name="sup_mob" class="form-control" value="<?php echo $suprow["sup_mob"]; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Alternate Contact No:</label>
                </div>
                <div class="col-md-6">
                    <input type="text" id="sup_con" name="sup_con"  class="form-control" value="<?php echo $suprow["sup_con"]; ?>" />
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
                   <input type="text" class="form-control" id="sup_house_no" name="sup_house_no" value="<?php echo $suprow["sup_house_no"]; ?>" />
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
                   <input type="text" class="form-control" id="sup_street" name="sup_street" value="<?php echo $suprow["sup_street"]; ?>" />
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
                   <input type="text" class="form-control" id="sup_city" name="sup_city" value="<?php echo $suprow["sup_city"]; ?>" />
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
                    <input type="text" id="sup_account_no" name="sup_account_no" class="form-control" value="<?php echo $suprow["sup_account_no"]; ?>"/>
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
                    <input type="text" class="form-control" id="sup_account_name" name="sup_account_name"  value="<?php echo $suprow["sup_account_name"]; ?>" />
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
                    <input type="text" class="form-control" id="sup_bank_name" name="sup_bank_name"  value="<?php echo $suprow["sup_bank_name"]; ?>" />
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
                    <input type="text" class="form-control" id="sup_account_branch" name="sup_account_branch"  value="<?php echo $suprow["sup_account_branch"]; ?>" />
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

        case "update_supplier":
            $supplierId = $_POST["sup_id"];
            $business_name = $_POST["business_name"];
            $sup_fname = $_POST["sup_fname"];
            $sup_lname = $_POST["sup_lname"];
            $sup_email = $_POST["sup_email"];
            $sup_nic = $_POST["sup_nic"];
            $sup_dob = $_POST["sup_dob"];
            $sup_gender = $_POST["sup_gender"];
            $sup_mob = $_POST["sup_mob"];
            $sup_con = $_POST["sup_con"];
            $sup_house_no = $_POST["sup_house_no"];
            $sup_street = $_POST["sup_street"];
            $sup_city = $_POST["sup_city"];
            $sup_account_no = $_POST["sup_account_no"];
            $sup_account_name = $_POST["sup_account_name"];
            $sup_bank_name = $_POST["sup_bank_name"];
            $sup_account_branch = $_POST["sup_account_branch"];
            $supplierObj->updateSupplier($supplierId,$business_name,$sup_fname,$sup_lname,$sup_email,$sup_nic,$sup_dob,$sup_gender,$sup_mob,$sup_con,$sup_house_no,$sup_street,$sup_city,$sup_account_no,$sup_account_name,$sup_bank_name,$sup_account_branch);
            $msg = "Successfully Updated Supplier  $sup_fname";
            $msg = base64_encode($msg);
            header('Location: ../view/supplier.php?msg=' . $msg);
            break;
        
        case "view_supplier":
             $supplierId = $_POST["sup_id"];
             $supplierResult = $supplierObj->getSupplier($supplierId);
             $suprow = $supplierResult->fetch_assoc();
             ?>
            <input type="hidden" name="sup_id" value="<?php echo $suprow["sup_id"]; ?>" />
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
                    <label class="control-label"><?php echo $suprow["business_name"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_fname"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_lname"]; ?></label>
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
            <label class="control-label"><?php echo $suprow["sup_email"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_nic"]; ?></label>
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
                        <label class="control-label"><?php echo $suprow["sup_dob"]; ?></label>
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
                    <label class=" label label-primary">
                    <?php echo $sup_gender = ($suprow["sup_gender"] == 0) ? "Male" : "Female" ?>
                    </label>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Mobile No:</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $suprow["sup_mob"]; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Alternate Contact No:</label>;
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $suprow["sup_con"]; ?></label>
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
                    <label class="control-label"> House No:</label>;;
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $suprow["sup_house_no"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_street"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_city"]; ?></label>
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
                <div class="col-md-6">
                    <label class="control-label">Account No:</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $suprow["sup_account_no"]; ?></label>
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
               <label class="control-label"><?php echo $suprow["sup_account_name"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_bank_name"]; ?></label>
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
                    <label class="control-label"><?php echo $suprow["sup_account_branch"]; ?></label>
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
        
         case "deactivateSupplier":
            $sup_id = $_REQUEST["sup_id"];
//    Decode the encoded employee id to the normal numeric form.
            $sup_id = base64_decode($sup_id);
            $supplierObj->deactivateSupplier($sup_id);
            $msg = "Supplier Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/supplier.php?msg=' . $msg);
            break;
        //Active Employee.
        case "activateSupplier":
            $sup_id = $_REQUEST["sup_id"];
            $sup_id = base64_decode($sup_id);
            $supplierObj->activateSupplier($sup_id);
            $msg = "Supplier Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/supplier.php?msg=' . $msg);
            break;
        
        
    }
}


