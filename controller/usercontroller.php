<?php
if (isset($_REQUEST["status"])) {
    include '../model/user_model.php';
    $userObj = new User();
    include '../model/notification_model.php';
    $notificationObj = new Notification();

    $status = $_REQUEST["status"];
    switch ($status) {
        /**
         * Get user function.
         */
        case "getfunctions":
            $roleId = $_POST["role_id"];
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
                        <input type="checkbox" class="chkbx"  name="myfunctions[]" value="<?php echo $funRow["function_id"]; ?>" checked="checked"/>
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
            <?php
            break;
        /**
         * Insert user
         */
        case "add_user":
            echo $firstName = $_POST["fname"];
            echo "<br/>";
            echo $lastName = $_POST["lname"];
            echo "<br/>";
            echo $email = $_POST["user_email"];
            echo "<br/>";
            echo $dob = $_POST["dob"];
            echo "<br/>";
            echo $gender = $_POST["gender"];
            echo "<br/>";
            echo $nic = $_POST["nic"];
            echo "<br/>";
            echo $cno1 = $_POST["cno1"];
            echo "<br/>";
            echo $cno2 = $_POST["cno2"];
            echo "<br/>";
            echo $userRole = $_POST["user_role"];
            echo "<br/>";
            $userFunctions = array();
            //Contains selected function ids.
            $userFunctions = $_POST["myfunctions"];
            try {
                if ($firstName == "") {
                    throw new Exception("First Name Cannot Be Empty!");
                }
                if ($lastName == "") {
                    throw new Exception("Last Name Cannot Be Empty!");
                }
                if ($email == "") {
                    throw new Exception("Email Cannot Be Empty!");
                }
                if ($dob == "") {
                    throw new Exception("DOB Cannot Be Empty!");
                }
                if ($nic == "") {
                    throw new Exception("NIC Cannot Be Empty!");
                }
                if ($gender == "") {
                    throw new Exception("Gender Cannot Be Empty!");
                }
                if ($userRole == "") {
                    throw new Exception("User Role Cannot Be Empty!");
                }
                if ($cno1 == "") {
                    throw new Exception("Contact Number Cannot Be Empty!");
                }
                $patnic = "/^([0-9]{9}[vVxX]|[0-9]{12})$/";
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";
                if (!preg_match($patnic, $nic)) {
                    throw new Exception("Invalid NIC");
                }
                if (!preg_match($patemail, $email)) {
                    throw new Exception("Invalid Email Address");
                }
                //Upload image.
                if ($_FILES["user_img"]["name"] != "") {
                    $img = $_FILES["user_img"]["name"];
                    $img = "" . time() . "_" . $img;
                    //Obtain temporary location.
                    $tmp = $_FILES["user_img"]["tmp_name"];
                    $destination = "../images/user_image/$img";
                    move_uploaded_file($tmp, $destination);
                } else {
                    $img = "defaultImage.jpg";
                }
                //Validating the existence of the email address.
                $isValid=$userObj->validateEmail($email);
                if($isValid===false)
                {
                    throw new Exception("Email Address is Already Taken!!!");
                }
                //Create new users.
                $userId = $userObj->addUser($firstName, $lastName, $img, $email, $nic, $dob, $gender, $cno1, $cno2, $userRole, 1);
                if ($userId > 0) {
                    //Password convert into the shal
                    $pw = sha1($nic);
                    //Create new login for users
                    $loginId = $userObj->addLogin($email, $pw, $userId, 1);
                    foreach ($userFunctions as $f) {
                        $userObj->addUserFunction($userId, $f);
                    }

                    //   User was created
                    $notification_msg="A New User $firstName  was added!!!";
                    //  All  system's admins should be notified that and insert into notification table
                    $notification_id=$notificationObj->addNotification($notification_msg,"1");
                    //Check the notification_id not null
                    if($notification_id>0)
                    {
                        //Get the users assigned to a specific user role
                        $userResult=$userObj->getRoleUsers(1);  // get admin users
                        while($user_row=$userResult->fetch_assoc())
                        {
                            $user_id=$user_row["user_id"];
                            //Adding notifications to individual users
                            $notificationObj->assignNotifications($notification_id, $user_id);
                        }
                    }
                    $msg = "Successfully Inserted User $firstName" . " " . "$lastName";
                    $msg = base64_encode($msg);
                    header('Location: ../view/view-user.php?msg=' . $msg);
                }
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                $error = base64_encode($error);
                header('Location: ../view/add-user.php?error=' . $error);
            }

            break;
        /**
         * Deactivate user.
         */
        case "deactivateUser":
            $userId = $_POST["userId"];
            $userObj->deactivateUser($userId);
            break;
        /**
         * Active user.
         */
        case "activateUser":
            $userId = $_POST["userId"];
            $userObj->activateUser($userId);
            break;
        /**
         * Edit user.
         */
        case "edit_user":
            echo $userId = $_POST["user_id"];
            echo $firstName = $_POST["fname"];
            echo "<br/>";
            echo $lastName = $_POST["lname"];
            echo "<br/>";
            echo $email = $_POST["user_email"];
            echo "<br/>";
            echo $dob = $_POST["dob"];
            echo "<br/>";
            echo $gender = $_POST["gender"];
            echo "<br/>";
            echo $nic = $_POST["nic"];
            echo "<br/>";
            echo $cno1 = $_POST["cno1"];
            echo "<br/>";
            echo $cno2 = $_POST["cno2"];
            echo "<br/>";
            echo $userRole = $_POST["user_role"];
            echo "<br/>";
            $userFunctions = array();
            //Contains selected function ids.
            $userFunctions = $_POST["myfunctions"];
            try {
                if ($firstName == "") {
                    throw new Exception("First Name Cannot Be Empty!");
                }
                if ($lastName == "") {
                    throw new Exception("Last Name Cannot Be Empty!");
                }
                if ($email == "") {
                    throw new Exception("Email Cannot Be Empty!");
                }
                if ($dob == "") {
                    throw new Exception("DOB Cannot Be Empty!");
                }
                if ($nic == "") {
                    throw new Exception("NIC Cannot Be Empty!");
                }
                if ($gender == "") {
                    throw new Exception("Gender Cannot Be Empty!");
                }
                if ($userRole == "") {
                    throw new Exception("User Role Cannot Be Empty!");
                }
                if ($cno1 == "") {
                    throw new Exception("Contact Number Cannot Be Empty!");
                }
                $patnic = "/^([0-9]{9}[vVxX]|[0-9]{12})$/";

                if (!preg_match($patnic, $nic)) {
                    throw new Exception("Invalid NIC");
                }
                //Upload image.
                if ($_FILES["user_img"]["name"] != "") {
                    $img = $_FILES["user_img"]["name"];
                    $img = "" . time() . "_" . $img;
                    //Obtain temporary location.
                    $tmp = $_FILES["user_img"]["tmp_name"];
                    //Destination path
                    $destination = "../images/user_image/$img";
                    move_uploaded_file($tmp, $destination);
                } else {
                    $img = "defaultImage.jpg";
                }
                //Validating the email address
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";
                if (!preg_match($patemail, $email)) {
                    throw new Exception("Invalid Email Address");
                }
                //Check the existence of the email address or not.
                $isValid = $userObj->updateEmailValidation($userId, $email);
                if ($isValid === false) {
                    throw new Exception("Email Address is Already Taken!!!");
                }
                $userObj->updateUser($userId, $firstName, $lastName, $img, $email, $nic, $dob, $gender, $cno1, $cno2, $userRole, 1);
                if ($userId > 0) {
                    //Remove all   user functions for that user.
                    $userObj->removeUserFunctions($userId);
                    //Assign user functions.
                    foreach ($userFunctions as $f) {
                        $userObj->addUserFunction($userId, $f);
                    }
                    $msg = "Successfully Updated User $firstName" . " " . "$lastName";
                    $msg = base64_encode($msg);
                    header('Location: ../view/view-user.php?msg=' . $msg);
                }
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                $error= base64_encode($error);
                header('Location: ../view/add-user.php?msg=' . $error
                );
            }
            break;
    }
}
