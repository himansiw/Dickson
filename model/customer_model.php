<?php
include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Customer{
    public function addCustomer($card_no,$cus_fname,$cus_lname,$cus_mob,$cus_email,$cus_nic,$cus_house_no,$cus_street,$cus_city,$loyalty_point)
    {
        $con=$GLOBALS['con'];
        $sql="INSERT INTO customer(
                        card_no,
                        cus_fname,
                        cus_lname,
                        cus_mob,
                        cus_email,
                        cus_nic,
                        cus_house_no,
                        cus_street,
                        cus_city,
                        loyalty_point
                        )VALUES(
                        '$card_no','$cus_fname','$cus_lname','$cus_mob','$cus_email','$cus_nic','$cus_house_no','$cus_street','$cus_city','5'
                        )";
        $result=$con->query($sql) or die($con->error);
        $customerId=$con->insert_id;  //  getting the auto incremented id
        return $customerId;

    }
    public function getAllCustomer()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM customer";
        $result=$con->query($sql);
        return $result;
    }
    function getCardNo()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT card_no from customer order by card_no DESC LIMIT 1";
        $result = $con->query($sql);
        return $result;
    }
    public function getCustomer($customerId)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM customer WHERE cus_id='$customerId'";
        $result=$con->query($sql);
        return $result;
    }
    public function updateCustomer($customerId,$card_no,$cus_fname,$cus_lname,$cus_mob,$cus_email,$cus_nic,$cus_house_no,$cus_street,$cus_city)
    {
        $con=$GLOBALS["con"];
        $sql = "UPDATE customer SET "
            . "card_no='$card_no',"
            . "cus_fname='$cus_fname',"
            . "cus_lname='$cus_lname',"
            . "cus_mob='$cus_mob',"
            . "cus_email='$cus_email',"
            . "cus_nic='$cus_nic',"
            . "cus_house_no='$cus_house_no',"
            . "cus_street='$cus_street',"
            . "cus_city='$cus_city'"
            . "WHERE cus_id='$customerId'";
        $result=$con->query($sql)or die($con->error);

    }
    public function deactivateCustomer($customerId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET cus_status='0' WHERE cus_id='$customerId'";
        $result = $con->query($sql);
    }

    public function activateCustomer($customerId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET cus_status='1' WHERE cus_id='$customerId'";
        $result = $con->query($sql);
    }


}