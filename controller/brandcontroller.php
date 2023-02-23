<?php
include '../model/brand_model.php';
$brandObj = new Brand(); // create brand Object

if (!isset($_REQUEST["status"])) {
    ?>  
    <script> window.location = "../index.php"</script>
    <?php
} else {
    $status = $_REQUEST["status"];
    switch ($status) {
        case "add_brand":
            try {
                $brand_name = $_POST["brand_name"];
                $brand_id = $brandObj->addBrand($brand_name);
                if ($brand_id > 0) {
                    $msg = "Brand $brand_name  Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/brand.php?msg=' . $msg);
                } else {
                    throw new Exception("Brand Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/brand.php?msg=' . $msg);
            }
            break;

        case "edit_brand":
            $brand_id = $_POST["brand_id"];
            $brandResult = $brandObj->getBrand($brand_id);
            $brandrow = $brandResult->fetch_assoc();
            ?>
            <input type="hidden" name="brand_id" value="<?php echo $brandrow["brand_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Brand Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="brand_name" value="<?php echo $brandrow["brand_name"]; ?>"/>
                </div>
            </div>  
            <?php
            break;

        case "update_brand":
            $brand_id = $_POST["brand_id"];
            $brand_name = $_POST["brand_name"];
            $brandObj->updateBrand($brand_id, $brand_name);
            $msg = "Successfully Updated Brand  $brand_name";
            $msg = base64_encode($msg);
            header('Location: ../view/brand.php?msg=' . $msg);
            break;
        case "deactivateBrand":
            $brand_id = $_REQUEST["brand_id"];
    //Decode the encoded brand id to the normal numeric form.
            $brand_id = base64_decode($brand_id);
            $brandObj->deactivateBrand($brand_id);
            $msg = "Brand Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/brand.php?msg=' . $msg);
            break;
        //Active Brand.
        case "activateBrand":
            $brand_id = $_REQUEST["brand_id"];
            $brand_id = base64_decode($brand_id);
            $brandObj->activateBrand($brand_id);
            $msg = "Brand Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/brand.php?msg=' . $msg);
            break;
    }
}
