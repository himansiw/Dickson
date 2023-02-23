<?php
include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

class Location {

    public function addLocation($rack_no,$product_id,$position) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO product_location(
                               rack_no,
                               product_id,
                               position
                               )VALUES(
                               '$rack_no','$product_id','$position'
                               )";
        $con->query($sql);
        if ($con->insert_id > 0) {
            return $con->insert_id;
        } else {
            return false;
        }
    }

    public function getLocation($location_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM product_location WHERE location_id='$location_id'";
        $result = $con->query($sql);
        return $result;
    }

    public function getAllLocations() {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM product_location l,product p WHERE l.product_id=p.product_id";
        $result = $con->query($sql);
        return $result;
    }

    public function getAssignedProducts($pid) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product_location  WHERE pid=$pid";
        $result = $con->query($sql);
        return $result;
    }

    public function updateLocation($location_id, $rack_no, $product_id,$position) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE product_location SET "
            . "rack_no='$rack_no',"
            . "product_id='$product_id',"
            . "position='$position'"
            . "WHERE location_id='$location_id'";
        $result = $con->query($sql);
    }



}
