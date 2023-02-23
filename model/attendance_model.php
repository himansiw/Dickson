<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Attendance
{
    public function addAttendance($emp_no, $emp_name, $att_date, $att_intime, $att_outtime)
    {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO attendance(emp_no,emp_name,att_date,att_intime,att_outtime)VALUES('$emp_no','$emp_name','$att_date','$att_intime','$att_outtime')";
        $con->query($sql);
        if ($con->insert_id > 0) {
            return $con->insert_id;
        } else {
            return false;
        }
    }

    public function getAllAttendance()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM attendance ORDER BY att_date DESC";
        $result = $con->query($sql);
        return $result;
    }
//
}