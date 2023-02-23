<?php
include_once '../commons/dbConnection.php';
        $dbConnObj= new dbConnection();
class Subcategory{   
     public function addSubcategory($sub_cat_name,$cat_id)
    {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO sub_category(sub_cat_name,cat_id)VALUES('$sub_cat_name','$cat_id')";
        $con->query($sql)or die($con->error);
        if($con->insert_id>0)
        {
            return $con->insert_id;
        }
        else{ 
            return false;
        } 
    }
    public function getAllSubcategories()
    {                                                                           
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM sub_category s,category c WHERE s.cat_id=c.cat_id";
        $result=$con->query($sql);
        return $result;
    }
    public function getAssignedSubCategories($cat_id){
         $con=$GLOBALS['con'];
         $sql="SELECT * FROM sub_category  WHERE cat_id='$cat_id'";
         $result=$con->query($sql); 
         return $result;   
    }
    public function editAssignedSubCategories($productId){
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM sub_category s,product p WHERE s.sub_cat_id=p.sub_cat_id AND p.product_id='$productId'";
        $result=$con->query($sql);
        return $result;
    }
   public function getSubcategory($sub_cat_id)
   {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM sub_category s,category c WHERE s.cat_id=c.cat_id AND sub_cat_id='$sub_cat_id'";
        $result=$con->query($sql);
        return $result;
   }
   public function updateSubcategory($sub_cat_id,$sub_cat_name){
        $con = $GLOBALS['con'];
        $sql = "UPDATE sub_category SET "
                . "sub_cat_name='$sub_cat_name'"
                . "WHERE sub_cat_id='$sub_cat_id'";
        $result = $con->query($sql);
    }
    public function deactivateSubcategory($sub_cat_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE sub_category SET sub_status='0' WHERE sub_cat_id='$sub_cat_id'";
        $result = $con->query($sql);
    }

    public function activateSubcategory($sub_cat_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE sub_category SET sub_status='1' WHERE sub_cat_id='$sub_cat_id'";
        $result = $con->query($sql);
    }


}