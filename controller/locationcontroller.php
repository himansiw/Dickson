<?php
 include '../model/location_model.php';
 include '../model/product_model.php';
 
   $locationObj=new Location();
   $productObj=new Product();
   
if(!isset($_REQUEST["status"])){ 
   ?><script> window.location="../index.php"</script><?php           
 }
 else{
    $status=$_REQUEST["status"];
    switch ($status)
    { 
            case "add_location":
        try {
            $rack_no=$_POST["rack_no"];
            $pid=$_POST["product_id"];
            $position=$_POST["position"];
            $location_id=$locationObj->addLocation($rack_no,$pid,$position);
             if ($location_id > 0) {
                    $msg = "Location Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/product-location.php?msg=' . $msg);
                } else {
                    throw new Exception("Location Addition Error");
                }
            }catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/product-location.php?msg=' . $msg);
            }
            break;
            
            case "edit_location":
            $location_id = $_POST["location_id"];
            $locationResult = $locationObj->getLocation($location_id);
            $lrow = $locationResult->fetch_assoc();
            ?>
            <input type="hidden" name="location_id" value="<?php echo $lrow["location_id"]; ?>">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Rack No.</label>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="rack_no">
                        <option value="">--</option>
                        <option value="0" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 0) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R1
                        </option>
                         <option value="1" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 1) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R2
                        </option>
                        <option value="2" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 2) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R3
                        </option>
                        <option value="3" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 3) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R4
                        </option>
                        <option value="4" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 4) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R5
                        </option>
                        <option value="5" name="rack_no" 
                                    <?php
                                    if ($lrow["rack_no"] == 5) {
                                        ?> 
                                selected="selected" 
                                        <?php
                                    }
                                    ?>
                        > 
                                        R6
                        </option>
                    </select>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Product code</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="pcode" value="<?php echo $lrow["pcode"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            
            <?php
            break;

            
        
    
    }
}
        
    
 
