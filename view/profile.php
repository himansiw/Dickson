<html>
    <head>
        <title>Dicksons</title>
        <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/user_model.php';
        //Create user object.
        $userObj = new User(); 
        $roleResult = $userObj->getUserRoles();
        include '../model/module_model.php';
        $moduleObj = new Module();
        $moduleResult = $moduleObj->getAllModules();
        if (!isset($_REQUEST["user_id"])) {
            ?>
            <script> window.location = "../index.php"</script>
            <?php
        }
        $userId = $_REQUEST["user_id"];
        $userId = base64_decode($userId);
        //Get the specific user information.
        $userResult = $userObj->viewUser($userId);
        //Convert to associative array.
        $userRow = $userResult->fetch_assoc();
        $functionResult = $userObj->getUserFunctions($userId);
        $userFunctions = array();
        while ($fRow = $functionResult->fetch_assoc()) {
            //Push the function_id to array.
            array_push($userFunctions, $fRow["function_id"]);  
        }
       ?>
    </head>
    <body>
        <div class="container">
            <!--Header-->  
        <?php
            include_once 'header.php';
        ?>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <!--Page header-->
            <div class="row">
                <div class="col-lg-12">
                    <center> <h2 class="page-header"><b>View User</b></h2></center>
                </div>
            </div>
            <div class="row">
                    <?php
                      if (isset($_GET["msg"])) {
                    ?>       
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                    <?php
                    $msg = $_REQUEST["msg"];
                    $msg = base64_decode($msg);
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
                    <div id="alertDiv"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <form id="addUser" enctype="multipart/form-data" method="post" action="../controller/usercontroller.php?status=add_user">
                <div class="row" >
                    <div class="col-md-3">
                        <label class="control-label">First Name</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_fname"]; ?></label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Last Name</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_lname"]; ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">User Email</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_email"]; ?></label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">User Gender</label>
                    </div>
                    <div class="col-md-3">
                        <label class=" label label-primary">
                    <?php echo $gender = ($userRow["user_gender"] == 0) ? "Male" : "Female" ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">USER DOB</label>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <label class="control-label"><?php echo $userRow["user_dob"]; ?></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">USER NIC</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_nic"]; ?></label>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Contact Number 1</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_cno1"]; ?></label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Contact Number 2 (Mobile)</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["user_cno2"]; ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">User Role</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?php echo $userRow["role_name"]; ?></label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">User Image</label>
                    </div>
                    <div class="col-md-3">
                        <img id="prev_img" src="../images/user_image/<?php echo $userRow["user_image"]; ?>" width="100px" height="90px"/>
                    </div>

                </div>
                <div class="row" >
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row" >
                    <div class="col-md-12">&nbsp;</div>
                </div>

                <div class="container" id="myfunctions">
                    <!---   Load the functions  -->  

                    <div class="row" >
                        <div class="col-md-12">
                            <h4><b><label class="control-label"><u>Permissions</u></label></b></h4>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-12">&nbsp;</div>
                    </div>


<?php
$roleId = $userRow["user_role"];
$moduleResult = $userObj->getModulesByRole($roleId);
?>
                    <div class="row">
<?php
$mCounter = 0;
while ($mRow = $moduleResult->fetch_assoc()) {
    $moduleId = $mRow["module_id"];

    $functionResult = $userObj->getModuleFunctions($moduleId);

    $mCounter++;
    ?> 
                            <div class="col-md-3">
                                <label class="control-label"><?php echo $mRow["module_name"]; ?></label>
                                <br/>
                            <?php
                            while ($funRow = $functionResult->fetch_assoc()) {
                            ?>
                                    <input type="checkbox" class="chkbx"  name="myfunctions[]" value="<?php echo $funRow["function_id"]; ?>" 
                                <?php
                                if (in_array($funRow["function_id"], $userFunctions)) {
                                ?>
                                    checked="checked"
                                    <?php
                                    }
                                    ?>
                                           />
                                    <?php
                                    echo $funRow["function_name"];
                                    ?>
                                    <br/>
                                       <?php
                                       }
                                       ?>
                            </div>
                                       <?php
                                       if ($mCounter % 4 == 0) {
                                       ?>
                            </div>
                            <div class="row">
                                       <?php
                                       }
                                       ?>
                            <?php
                            }
                            ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-5">
                        &nbsp;
                    </div> 
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12"> &nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-12"> &nbsp;</div>
        </div>
                    <?php
                    include_once 'footer.php';
                    include '../includes/bootstrap_script_includes.php';
                    ?> 
    </body>
    <script type="text/javascript" src="../js/user_validation.js"></script>
    <script type="text/javascript">

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#prev_img')
                                .attr('src', e.target.result)
                                .height(70)
                                .width(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
    </script>
</html>
