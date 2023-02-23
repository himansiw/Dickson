<?php
include '../model/customer_model.php';

$customerObj = new Customer();// create employee Object;
if(!isset($_REQUEST["status"]))
{
    ?>
    <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status) {
        case "add_customer":
            try {
                $card_no = $_POST["card_no"];
                $cus_fname = $_POST["cus_fname"];
                $cus_lname = $_POST["cus_lname"];
                $cus_mob = $_POST["cus_mob"];
                $cus_nic = $_POST["cus_nic"];
                $cus_email = $_POST["cus_email"];
                $cus_house_no = $_POST["cus_house_no"];
                $cus_street = $_POST["cus_street"];
                $cus_city = $_POST["cus_city"];
                $loyalty_point=$_POST["loyalty_point"];
                $customerId = $customerObj->addCustomer($card_no,$cus_fname,$cus_lname,$cus_mob,$cus_email,$cus_nic,$cus_house_no,$cus_street,$cus_city,5);
                if ($customerId > 0) {
                    $msg = "Customer $cus_fname $cus_lname  Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/customer.php?msg=' . $msg);
                } else {
                    throw new Exception("Customer Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/customer.php?msg=' . $msg);
            }
            break;

        case "edit_customer":
            $customerId = $_POST["cus_id"];
            $customerResult = $customerObj->getCustomer($customerId);
            $cusrow = $customerResult->fetch_assoc();
            ?>
            <input type="hidden" name="cus_id" value="<?php echo $cusrow["cus_id"]; ?>" />
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
                    <label class="control-label">Card No</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="ecard_no" name="card_no" value="<?php echo $cusrow["card_no"]; ?>" readonly="readonly" style="background-color: white"/>
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
                    <input type="text" class="form-control" id="ecus_fname" name="cus_fname" value="<?php echo $cusrow["cus_fname"]; ?>" />
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
                    <input type="text" class="form-control" id="ecus_lname" name="cus_lname" value="<?php echo $cusrow["cus_lname"]; ?>"/>
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
                    <input type="text" id="ecus_mob" name="cus_mob" class="form-control" value="<?php echo $cusrow["cus_mob"]; ?>" />
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
                    <input type="text" id="ecus_email" name="cus_email" class="form-control" value="<?php echo $cusrow["cus_email"]; ?>" />
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
                    <input type="text" id="ecus_nic" name="cus_nic" class="form-control"  value="<?php echo $cusrow["cus_nic"]; ?>" />
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
                    <input type="text" class="form-control" id="ecus_house_no" name="cus_house_no" value="<?php echo $cusrow["cus_house_no"]; ?>" />
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
                    <input type="text" class="form-control" id="ecus_street" name="cus_street" value="<?php echo $cusrow["cus_street"]; ?>" />
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
                    <input type="text" class="form-control" id="ecus_city" name="cus_city" value="<?php echo $cusrow["cus_city"]; ?>" />
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

        case "update_customer":
            $customerId = $_POST["cus_id"];
            $cus_fname = $_POST["cus_fname"];
            $cus_lname = $_POST["cus_lname"];
            $cus_mob = $_POST["cus_mob"];
            $cus_email = $_POST["cus_email"];
            $cus_nic = $_POST["cus_nic"];
            $cus_house_no = $_POST["cus_house_no"];
            $cus_street = $_POST["cus_street"];
            $cus_city = $_POST["cus_city"];
            $customerObj->updateCustomer($customerId,$cus_fname,$cus_lname,$cus_mob,$cus_email,$cus_nic,$cus_house_no,$cus_street,$cus_city);
            $msg = "Successfully Updated customer  $cus_fname";
            $msg = base64_encode($msg);
            header('Location: ../view/customer.php?msg=' . $msg);
            break;

        case "view_customer":
            $customerId = $_POST["cus_id"];
            $customerResult = $customerObj->getCustomer($customerId);
            $cusrow = $customerResult->fetch_assoc();
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
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Card No</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $cusrow["card_no"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_fname"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_lname"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_mob"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_email"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_nic"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_house_no"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_street"]; ?></label>
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
                    <label class="control-label"><?php echo $cusrow["cus_city"]; ?></label>
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

        case "deactivateCustomer":
            $cus_id = $_REQUEST["cus_id"];
//    Decode the encoded customer id to the normal numeric form.
            $cus_id = base64_decode($cus_id);
            $customerObj->deactivateCustomer($cus_id);
            $msg = "Customer Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/customer.php?msg=' . $msg);
            break;
        //Active Customer.
        case "activateCustomer":
            $cus_id = $_REQUEST["cus_id"];
            $cus_id = base64_decode($cus_id);
            $customerObj->activateCustomer($cus_id);
            $msg = "Customer Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/customer.php?msg=' . $msg);
            break;


    }
}


