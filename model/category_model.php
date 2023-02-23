<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

class Category {

    public function addCategory($cat_name, $cat_code) {
        $con = $GLOBALS["con"];
        $sql ="INSERT INTO category(cat_name,
                               cat_code
                               )VALUES(
                               '$cat_name','$cat_code'
                               )";
        $con->query($sql);
        if ($con->insert_id > 0) {
            return $con->insert_id;
        } else {
            return false;
        }
    }

    public function getAllCategories() {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM category";
        $result = $con->query($sql);
        return $result;
    }

    public function getCategory($cat_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM category WHERE cat_id='$cat_id'";
        $result = $con->query($sql);
        return $result;
    }

    public function updateCategory($cat_id, $cat_name, $cat_code) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE category SET "
            . "cat_name='$cat_name',"
            . "cat_code='$cat_code'"
            . "WHERE cat_id='$cat_id'";
        $result = $con->query($sql);
    }

    public function deactivateCategory($cat_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE category SET status='0' WHERE cat_id='$cat_id'";
        $result = $con->query($sql);
    }

    public function activateCategory($cat_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE category SET status='1' WHERE cat_id='$cat_id'";
        $result = $con->query($sql);
    }

}
