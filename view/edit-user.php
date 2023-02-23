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
             <script> window.location="../index.php"</script>
        <?php
          }
          $userId=$_REQUEST["user_id"];
          $userId=  base64_decode($userId);
          $userResult=$userObj->viewUser($userId);
          $userRow=$userResult->fetch_assoc();
          //Get user functions.
          $functionResult=  $userObj->getUserFunctions($userId);
          $userFunctions=array();
          while($fRow=$functionResult->fetch_assoc())
          {
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
                <center> <h2 class="page-header"><b>Edit User</b></h2></center>
            </div>
            </div>
             <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="dashboard.php">User</a></li>
                <li class="breadcrumb-item active"><a href="view-user.php">View Users</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <!-- alert message-->
            <div class="row">
                <?php
                if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
                    ?>
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
                    <?php
                }
                ?>
                <div class="col-md-12">
                    <div id="alertDiv"></div>
                </div>
            </div>
            <form id="editUser" enctype="multipart/form-data" method="post" action="../controller/usercontroller.php?status=edit_user">
                <input type="hidden" name="user_id" value="<?php echo $userId;  ?>"/>
           <div class="row" >
                    <div class="col-md-3">
                        <label class="control-label">First Name</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $userRow["user_fname"]; ?>" />
                    </div>

                   <div class="col-md-3">
                        <label class="control-label">Last Name</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="lname" class="form-control" value="<?php echo $userRow["user_lname"];  ?>" id="lname"/>
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
                        <input type="text" name="user_email" class="form-control" value="<?php echo $userRow["user_email"];  ?>" id="user_email" readonly="readonly"/>
                    </div>
                   <div class="col-md-3">
                        <label class="control-label">User Gender</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="gender" value="0"  
                        <?php
                        if ($userRow["user_gender"] == 0) {
                            ?>
                                   checked="checked"  
                                   <?php
                               }
                               ?>
                               />&nbsp;<label class="control-label">Male</label>
                        &nbsp;
                        <input type="radio" name="gender" value="1"
                        <?php
                        if ($userRow["user_gender"] == "1") {
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
                    <div class="col-md-3">
                        <label class="control-label">USER DOB</label>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" name="dob" class="form-control" value="<?php echo $userRow["user_dob"];  ?>" id="dob" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                   <div class="col-md-3">
                        <label class="control-label">USER NIC</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="nic" class="form-control" value="<?php echo $userRow["user_nic"];  ?>" id="nic" />
                    </div>     
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Contact Number 1 (Land)</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cno1" class="form-control" value="<?php echo $userRow["user_cno1"];  ?>" id="cno1" />
                    </div>
                   <div class="col-md-3">
                        <label class="control-label">Contact Number 2 (Mobile)</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cno2" class="form-control" value="<?php echo $userRow["user_cno2"];  ?>" id="cno2" />
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
                        <select name="user_role" class="form-control" 
                                id="user_role">
                            <option value="">---</option>
                            <?php
                               while($role_row=$roleResult->fetch_assoc())
                               {
                            ?>
                            <option value="<?php  echo $role_row["role_id"]; ?>"  
                             <?php  
                             if($role_row["role_id"]==$userRow["role_id"])
                             {
                             ?>   
                                    selected="selected" 
                            <?php    
                             }
                            ?>  
                              >
                            <?php  echo $role_row["role_name"]; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
        
                   <div class="col-md-3">
                        <label class="control-label">User Image</label>
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="user_img" id="user_img" onchange="readURL(this)"  class="form-control" />
                        <br/>
                        <img id="prev_img" src="../images/user_image/<?php echo $userRow["user_image"];  ?>" width="100px" height="90px"/>
                    </div>
            </div>
            <div class="row" >
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="container" id="myfunctions">
                <!---   Load the functions  -->  
                
            <div class="row" >
                <div class="col-md-12">
                    <h4><b><label class="control-label"><u>Select Permissions</u></label></b></h4>
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
            <label class="control-label"><?php echo $mRow["module_name"];  ?></label>
            <br/>
            <?php
                while($funRow=$functionResult->fetch_assoc())
                {
                 ?>
            <input type="checkbox" class="chkbx"  name="myfunctions[]" value="<?php  echo $funRow["function_id"]; ?>" 
                   
                   <?php  
                    if(in_array($funRow["function_id"], $userFunctions))
                    {
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
                if($mCounter%4==0)
                {
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
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-edit"></span>&nbsp;Update
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <span class="fa fa-refresh"></span>&nbsp;  Reset
                        </button>
                    </div>

                </div>
            </form>
        <div class="row">
            <div class="col-md-12"> &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12"> &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12"> &nbsp;</div>
        </div>
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
    <script type="text/javascript">
        setTimeout(function () {

            // Adding the class dynamically
            $('.alert').addClass('hide');
        }, 5000);
    </script>

</html>
