<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

class User{
    /**
     * Get the user role when the role status one
     * @return mixed
     */
    public function getUserRoles() {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM role WHERE role_status='1'";
        $results = $con->query($sql);
        return $results;
    }

    /**
     * Get role for given module
     * @param $roleId
     * @return mixed
     */
    public function getModulesByRole($roleId) {
        $con = $GLOBALS['con'];
        $sql ="SELECT * FROM module m, module_role r WHERE m.module_id=r.module_id AND r.role_id='$roleId'";
        $results = $con->query($sql);
        return $results;
    }

    /**
     * Get the function given module
     * @param $moduleId
     * @return mixed
     */
    function getModuleFunctions($moduleId) {
        $con = $GLOBALS['con'];
        $sql ="SELECT * FROM function WHERE module_id='$moduleId'";
        $results = $con->query($sql);
        return $results;
    }

    /**
     * Get the validate email for user email
     * @param $email
     * @return bool
     */
    function validateEmail($email) {
        $con = $GLOBALS['con'];
        $sql ="SELECT 1 FROM user WHERE user_email='$email'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Inser user
     * @param $user_fname
     * @param $user_lname
     * @param $user_image
     * @param $user_email
     * @param $user_nic
     * @param $user_dob
     * @param $user_gender
     * @param $user_cno1
     * @param $user_cno2
     * @param $user_role
     * @param $user_status
     * @return mixed
     */
    function addUser($user_fname, $user_lname, $user_image, $user_email, $user_nic, $user_dob, $user_gender, $user_cno1, $user_cno2, $user_role, $user_status) {
        $con = $GLOBALS['con'];
        $sql ="INSERT INTO user(user_fname,
                        user_lname,
                        user_image,
                        user_email,
                        user_nic,
                        user_dob,
                        user_gender,
                        user_cno1,
                        user_cno2,
                        user_role,
                        user_status
                        )VALUES(
                        '$user_fname','$user_lname','$user_image','$user_email','$user_nic','$user_dob','$user_gender','$user_cno1','$user_cno2','$user_role','$user_status'
                        )";
        $result = $con->query($sql);
        $userId = $con->insert_id;  //  getting the auto incremented id
        return $userId;
    }

    /**
     * Insert login
     * @param $login_username
     * @param $login_password
     * @param $user_id
     * @param $login_status
     * @return mixed
     */
    function addLogin($login_username, $login_password, $user_id, $login_status) {
        $con = $GLOBALS["con"];
        $sql ="INSERT INTO login(login_username,login_password,user_id,login_status)
            VALUES('$login_username','$login_password','$user_id','1')";
        $con->query($sql);
        $loginId = $con->insert_id;
        return $loginId;
    }

    /**
     * insert function user
     * @param $userId
     * @param $functionId
     */

    function addUserFunction($userId, $functionId) {
        $con = $GLOBALS["con"];
        $sql ="INSERT INTO function_user(user_id,function_id)VALUES('$userId','$functionId')";
        $con->query($sql);
    }

    /**
     * Get all users given role
     * @return mixed
     */
    function getAllUsers() {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM user u, role r WHERE u.user_role=r.role_id";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Update the user status into zero then deactivate
     * @param $userId
     */

    function deactivateUser($userId) {
        $con = $GLOBALS["con"];
        $sql ="UPDATE user SET user_status='0' WHERE user_id='$userId'";
        $result = $con->query($sql);
    }

    /**
     * update the user status into one then get active user
     * @param $userId
     */

    function activateUser($userId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE user SET user_status='1' WHERE user_id='$userId'";
        $result = $con->query($sql);
    }

    /**
     * Get given user details
     * @param $userId
     * @return mixed
     */
    function viewUser($userId) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM user u, role r WHERE u.user_role=r.role_id AND u.user_id='$userId'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get user function given user
     * @param $userId
     * @return mixed
     */
    function getUserFunctions($userId) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM function_user WHERE user_id='$userId'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * @param $userId
     * @param $email
     * @return boolupdate email validation given user
     */
    function updateEmailValidation($userId, $email) {
        $con = $GLOBALS['con'];
        $sql ="SELECT 1 FROM user WHERE user_email='$email' AND user_id!=$userId";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Update user details
     * @param $userId
     * @param $user_fname
     * @param $user_lname
     * @param $user_image
     * @param $user_email
     * @param $user_nic
     * @param $user_dob
     * @param $user_gender
     * @param $user_cno1
     * @param $user_cno2
     * @param $user_role
     * @param $user_status
     */
    function updateUser($userId, $user_fname, $user_lname, $user_image, $user_email, $user_nic, $user_dob, $user_gender, $user_cno1, $user_cno2, $user_role, $user_status) {
        $con = $GLOBALS['con'];

        if ($user_image != "defaultImage.jpg") {
            //if the user image not equal to default image
            $sql ="UPDATE user SET "
                . "user_fname='$user_fname',"
                . "user_lname='$user_lname',"
                . "user_image='$user_image',"
                . "user_email='$user_email',"
                . "user_nic='$user_nic',"
                . "user_dob='$user_dob',"
                . "user_gender='$user_gender',"
                . "user_cno1='$user_cno1',"
                . "user_cno2='$user_cno2',"
                . "user_role='$user_role'"
                . "WHERE user_id='$userId'";
        } else {
            //user image equal to default image
            $sql ="UPDATE user SET "
                . "user_fname='$user_fname',"
                . "user_lname='$user_lname',"
                . "user_email='$user_email',"
                . "user_nic='$user_nic',"
                . "user_dob='$user_dob',"
                . "user_gender='$user_gender',"
                . "user_cno1='$user_cno1',"
                . "user_cno2='$user_cno2',"
                . "user_role='$user_role'"
                . "WHERE user_id='$userId'";
        }
        $result = $con->query($sql) or die($con->error);
    }

    /**
     * when unclick in check box then remove user function
     * @param $userId
     */
    function removeUserFunctions($userId) {
        $con = $GLOBALS['con'];
        $sql ="DELETE FROM function_user WHERE user_id='$userId'";
        $result = $con->query($sql) or die($con->error);
    }

    /**
     * Get all activate user count
     * @return mixed
     */
    function getActiveUserCount() {
        $con = $GLOBALS['con'];
        $sql ="SELECT COUNT(user_id) as countactiveuser FROM user WHERE user_status='1'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $activeUserCount = $row["countactiveuser"];
        return $activeUserCount;
    }

    /**
     * Get all deactivate user count
     * @return mixed
     */
    function getDeactiveUserCount() {
        $con = $GLOBALS['con'];
        $sql ="SELECT COUNT(user_id) as countdeactiveuser FROM user WHERE user_status='0'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $deactiveUserCount = $row["countdeactiveuser"];
        return $deactiveUserCount;
    }

    /**
     * verify account.
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email){
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM user WHERE user_email='$email'AND user_status='1'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * when the user reset the password then change into new password
     * @param $userId
     * @param $newPassword
     */
    public function changePassword($userId,$newPassword)
    {
        $newPassword= sha1($newPassword);
        $con=$GLOBALS["con"];
        $sql="UPDATE login SET login_password='$newPassword' WHERE user_id='$userId'";
        $result=$con->query($sql);
    }

    /**
     * Get the user role for notification
     * @param $role_id
     * @return mixed
     */
    public function getRoleUsers($role_id)
    {
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM user WHERE user_role='$role_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;

    }


}
