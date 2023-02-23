<?php

include_once '../commons/dbConnection.php';
        $dbConnObj= new dbConnection();
class Unit{   
    public function addUnit($unit_name,$short_name,$allow_decimal)
    {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO unit(unit_name,
                               short_name,   
                               allow_decimal
                               )VALUES(
                               '$unit_name','$short_name','$allow_decimal'
                               )";
        $con->query($sql);
        if($con->insert_id>0)
        {
            return $con->insert_id;
        }
        else{ 
            return false;
        } 
    }
    public function getAllUnits()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM unit";
        $result=$con->query($sql);
        return $result;
    }
   public function getUnit($unit_id)
   {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM unit WHERE unit_id='$unit_id'";
        $result=$con->query($sql);
        return $result;
   }
   public function updateUnit($unit_id,$unit_name,$short_name,$allow_decimal)
   {
        $con=$GLOBALS["con"];
        $sql="UPDATE unit SET "
                        ." unit_name='$unit_name',"
                        ."short_name='$short_name',"
                        ."allow_decimal='$allow_decimal'"
                        ." WHERE unit_id='$unit_id'";
        $result=$con->query($sql);
   }
   public function deactivateUnit($unit_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE unit SET unit_status='0' WHERE unit_id='$unit_id'";
        $result = $con->query($sql);
    }

    public function activateUnit($unit_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE unit SET unit_status='1' WHERE unit_id='$unit_id'";
        $result = $con->query($sql);
    }


}