<?php
include '../model/department_model.php';
$departmentObj = new Department(); // create department Object;
$departmentResult = $departmentObj->getAllDepartments();

if (!isset($_REQUEST["status"])) {
    ?>
    <script> window.location = "../index.php"</script>
    <?php
} else {
    $status = $_REQUEST["status"];
    switch ($status) {

        //Department module.

        case "add_department":
            try {
                $department_name = $_POST["department_name"];
                $description = $_POST["description"];
                $department_id = $departmentObj->addDepartment($department_name,$description);
                if ($department_id > 0) {
                    $msg = "Department $department_name Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/department.php?msg=' . $msg);
                } else {
                    throw new Exception("Department Addition Error");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/department.php?msg=' . $msg);
            }
            break;

        case "edit_department":
            $department_id = $_POST["department_id"];
            $departmentResult = $departmentObj->getDepartment($department_id);
            $departmentrow = $departmentResult->fetch_assoc();
            ?>
            <input type="hidden" name="department_id" value="<?php echo $departmentrow["department_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Department Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" id="department_name" class="form-control" name="department_name"  value="<?php echo $departmentrow["department_name"]; ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Description</label>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control" rows="3" name="description" cols="50"><?php echo $departmentrow["description"]; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php
            break;
        case "update_department":
            $department_id = $_POST["department_id"];
            $department_name = $_POST["department_name"];
            $description = $_POST["description"];
            $departmentObj->updateDepartment($department_id,$department_name,$description);
            $msg = "Successfully Updated Department  $department_name";
            $msg = base64_encode($msg);
            header('Location: ../view/department.php?msg=' . $msg);
            break;
        case "deactivateDepartment":
            $department_id = $_REQUEST["department_id"];
            //Decode the encoded brand id to the normal numeric form.
            $department_id = base64_decode($department_id);
            $departmentObj->deactivateDepartment($department_id);
            $msg = "Department Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/department.php?msg=' . $msg);
            break;
        //Active Brand.
        case "activateDepartment":
            $department_id = $_REQUEST["department_id"];
            $department_id = base64_decode($department_id);
            $departmentObj->activateDepartment($department_id);
            $msg = "Department Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/department.php?msg=' . $msg);
            break;


    }
}