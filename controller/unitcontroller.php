<?php
include '../model/unit_model.php';
$unitObj = new Unit(); // create unit Object;
$unitResult = $unitObj->getAllUnits();
 
if (!isset($_REQUEST["status"])) {
    ?>  
    <script> window.location = "../index.php"</script>
    <?php
} else {
    $status = $_REQUEST["status"];
    switch ($status) {
        
  //Unit module.
        
         case "add_unit":
            try {
                $unit_name = $_POST["unit_name"];
                $short_name = $_POST["short_name"];
                $allow_decimal = $_POST["allow_decimal"];
                $unit_id = $unitObj->addUnit($unit_name,$short_name,$allow_decimal);
                if ($unit_id > 0) {
                    $msg = "Unit $unit_name  Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/unit.php?msg=' . $msg);
                } else {
                    throw new Exception("Unit Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/unit.php?msg=' . $msg);
            }
            break;

        case "edit_unit":
            $unit_id = $_POST["unit_id"];
            $unitResult = $unitObj->getUnit($unit_id);
            $unitrow = $unitResult->fetch_assoc();
            ?>
            <input type="hidden" name="unit_id" value="<?php echo $unitrow["unit_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Unit Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="unit_name"id="eunit_name" value="<?php echo $unitrow["unit_name"]; ?>" autocomplete="off"/>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Short Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="short_name" id="eshort_name" value="<?php echo $unitrow["short_name"]; ?> autocomplete="off""/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
             <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Allow decimal</label>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="allow_decimal" id="eallow_decimal">
                        <option value="">-- SELECT --</option>
                        <option value="1" name="allow_decimal" 
                                    <?php
                                    if ($unitrow["allow_decimal"] == 1) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        yes
                        </option>
                         
                        <option value="0" name="allow_decimal" 
                                    <?php
                                    if ($unitrow["allow_decimal"] == 0) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        >
                                        no
                        </option>
                    </select>
                </div>
            </div>
            <?php
            break;

        case "update_unit":
            $unit_id = $_POST["unit_id"];
            $unit_name = $_POST["unit_name"];
            $short_name = $_POST["short_name"];
            $allow_decimal = $_POST["allow_decimal"];
            $unitObj->updateUnit($unit_id, $unit_name,$short_name,$allow_decimal);
            $msg = "Successfully Updated Unit  $unit_name";
            $msg = base64_encode($msg);
            header('Location: ../view/unit.php?msg=' . $msg);
            break;
         case "deactivateUnit":
            $unit_id = $_REQUEST["unit_id"];
    //Decode the encoded brand id to the normal numeric form.
            $unit_id = base64_decode($unit_id);
            $unitObj->deactivateUnit($unit_id);
            $msg = "Unit Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/unit.php?msg=' . $msg);
            break;
        //Active Brand.
        case "activateUnit":
            $unit_id = $_REQUEST["unit_id"];
            $unit_id = base64_decode($unit_id);
            $unitObj->activateUnit($unit_id);
            $msg = "Unit Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/unit.php?msg=' . $msg);
            break;
        
    
    }
}