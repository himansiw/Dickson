<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Department{
    public function addDepartment($department_name,$description)
    {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO department(department_name,
                               description   
                               )VALUES(
                               '$department_name','$description'
                               )";
        $con->query($sql)or die($con->error);
        if($con->insert_id>0)
        {
            return $con->insert_id;
        }
        else{
            return false;
        }
    }
    public function getAllDepartments()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM department";
        $result=$con->query($sql);
        return $result;
    }
    public function getDepartment($department_id)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM department WHERE department_id='$department_id'";
        $result=$con->query($sql);
        return $result;
    }
    public function updateDepartment($department_id,$department_name,$description)
    {
        $con=$GLOBALS["con"];
        $sql="UPDATE department SET department_name='$department_name',description='$description' WHERE department_id='$department_id'";
        $result=$con->query($sql);
    }
    public function deactivateDepartment($department_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE department SET department_status='0' WHERE department_id='$department_id'";
        $result = $con->query($sql);
    }

    public function activateDepartment($department_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE department SET department_status='1' WHERE department_id='$department_id'";
        $result = $con->query($sql);
    }


}