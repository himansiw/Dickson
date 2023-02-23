<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Report
{

    function getAllPurchase($from,$to)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM `purchase` WHERE purchase_date BETWEEN '$from' AND '$to'";
        $result=$con->query($sql);
        return $result;
    }
}
