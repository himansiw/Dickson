<?php
include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Supplier{   
    public function addSupplier($business_name,$sup_fname,$sup_lname,$sup_email,$sup_nic,$sup_dob,$sup_gender,$sup_mob,$sup_con,$sup_house_no,$sup_street,$sup_city,$sup_account_no,$sup_account_name,$sup_bank_name,$sup_account_branch)
    {
         $con=$GLOBALS['con'];
         $sql="INSERT INTO supplier(
                        business_name,
                        sup_fname,
                        sup_lname,
                        sup_email,
                        sup_nic,
                        sup_dob,
                        sup_gender,
                        sup_mob,
                        sup_con,
                        sup_house_no,
                        sup_street,
                        sup_city,
                        sup_account_no,
                        sup_account_name,
                        sup_bank_name,         
                        sup_account_branch
                        )VALUES(
                        '$business_name','$sup_fname','$sup_lname','$sup_email','$sup_nic','$sup_dob','$sup_gender','$sup_mob','$sup_con','$sup_house_no','$sup_street','$sup_city','$sup_account_no','$sup_account_name','$sup_bank_name','$sup_account_branch'
                        )";
         $result=$con->query($sql) or die($con->error);
         $supplierId=$con->insert_id;  //  getting the auto incremented id
         return $supplierId;
        
    }
  public function getAllSuppliers()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier";
        $result=$con->query($sql);
        return $result;
    }
   public function getSupplier($supplierId)
   {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier WHERE sup_id='$supplierId'";
        $result=$con->query($sql);
        return $result;
   }
   public function updateSupplier($supplierId,$business_name,$sup_fname,$sup_lname,$sup_email,$sup_nic,$sup_dob,$sup_gender,$sup_mob,$sup_con,$sup_house_no,$sup_street,$sup_city,$sup_account_no,$sup_account_name,$sup_bank_name,$sup_account_branch)
   {
       $con=$GLOBALS["con"];
       $sql = "UPDATE supplier SET "
                    . "business_name='$business_name',"
                    . "sup_fname='$sup_fname',"
                    . "sup_lname='$sup_lname',"
                    . "sup_email='$sup_email',"
                    . "sup_nic='$sup_nic',"
                    . "sup_dob='$sup_dob',"
                    . "sup_gender='$sup_gender',"
                    . "sup_mob='$sup_mob',"
                    . "sup_con='$sup_con',"
                    . "sup_house_no='$sup_house_no',"
                    . "sup_street='$sup_street',"
                    . "sup_city='$sup_city',"
                    . "sup_account_no='$sup_account_no',"
                    . "sup_account_name='$sup_account_name',"
                    . "sup_bank_name='$sup_bank_name',"
                    . "sup_account_branch='$sup_account_branch'"
                    . "WHERE sup_id='$supplierId'"; 
       $result=$con->query($sql)or die($con->error);
 
   }
   public function deactivateSupplier($supplierId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE supplier SET sup_status='0' WHERE sup_id='$supplierId'";
        $result = $con->query($sql);
    }

    public function activateSupplier($supplierId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE supplier SET sup_status='1' WHERE sup_id='$supplierId'";
        $result = $con->query($sql);
    }
   

}