<?php
include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

//Class name.
class Login {
    //Function name.
    public function validateLogin($username, $password) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user u , login l"
                . " WHERE u.user_id=l.user_id "
                . "AND l.login_username='$username' "
                . "AND l.login_password='$password'";
        //Execute query assign into result.
        $results = $con->query($sql);
        //Return result from the query.
        return $results;
    }
}
