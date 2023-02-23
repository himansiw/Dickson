<?php
include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

class backup
{

    function showTables()
    {
        $con = $GLOBALS["con"];
        $sql = "SHOW TABLES";
        $result = $con->query($sql);
        return $result;
    }

    function selectTable($table)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM $table";
        $result = $con->query($sql);
        return $result;
    }

    function getCreateTable($table)
    {
        $con = $GLOBALS["con"];
        $sql = "SHOW CREATE TABLE $table";
        $result = $con->query($sql);
        return $result;
    }
    function addBackup($reference,$name)
    {
        date_default_timezone_set("Asia/Colombo");
        $date = date("Y-m-d");
        $time = date("h:i:s");
        $con = $GLOBALS["con"];
        //Insert into sale item table
        $sql = "INSERT INTO backup(backup_date,backup_time,reference,backup_name )VALUES('$date','$time','$reference','$name')";
        $con->query($sql);
        return $con->insert_id;
    }
    public function getAllBackupDetails()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM backup ORDER BY backup_id DESC";
        $result=$con->query($sql);
        return $result;
    }

}