<?php
include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Employee{   
    public function addEmployee($emp_no,$employee_fname,$employee_lname,$employee_email,$employee_nic,$employee_dob,$employee_gender,$employee_con,$employee_mob,$employee_role,$employee_house_no,$employee_street,$employee_city,$employee_account_no,$employee_account_name,$employee_bank_name,$employee_account_branch)
    {
         $con=$GLOBALS['con'];
         $sql="INSERT INTO employee(
                        emp_no,
                        employee_fname,
                        employee_lname,
                        employee_email,
                        employee_nic,
                        employee_dob,
                        employee_gender,
                        employee_con,
                        employee_mob,
                        employee_role,
                        employee_house_no,
                        employee_street,
                        employee_city,
                        employee_account_no,
                        employee_account_name,
                        employee_bank_name,         
                        employee_account_branch
                        )VALUES(
                        '$emp_no','$employee_fname','$employee_lname','$employee_email','$employee_nic','$employee_dob','$employee_gender','$employee_con','$employee_mob','$employee_role','$employee_house_no','$employee_street','$employee_city','$employee_account_no','$employee_account_name','$employee_bank_name','$employee_account_branch'
                        )";
         $result=$con->query($sql) or die($con->error);
         $employeeId=$con->insert_id;  //  getting the auto incremented id
         return $employeeId;
        
    }
  public function getAllEmployees()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM employee";
        $result=$con->query($sql);
        return $result;
    }
    public function getEmpNo()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT emp_no from employee order by emp_no DESC LIMIT 1";
        $result=$con->query($sql);
        return $result;
    }
   public function getEmployee($employeeId)
   {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM employee WHERE employee_id='$employeeId'";
        $result=$con->query($sql);
        return $result;
   }
   public function updateEmployee($employeeId,$employee_fname,$employee_lname,$employee_email,$employee_nic,$employee_dob,$employee_gender,$employee_con,$employee_mob,$employee_role,$employee_house_no,$employee_street,$employee_city,$employee_account_no,$employee_account_name,$employee_bank_name,$employee_account_branch)
   {
       $con=$GLOBALS["con"];
       $sql ="UPDATE employee SET "
                    . "employee_fname='$employee_fname',"
                    . "employee_lname='$employee_lname',"
                    . "employee_email='$employee_email',"
                    . "employee_nic='$employee_nic',"
                    . "employee_dob='$employee_dob',"
                    . "employee_gender='$employee_gender',"
                    . "employee_con='$employee_con',"
                    . "employee_mob='$employee_mob',"
                    . "employee_role='$employee_role',"
                    . "employee_house_no='$employee_house_no',"
                    . "employee_street='$employee_street',"
                    . "employee_city='$employee_city',"
                    . "employee_account_no='$employee_account_no',"
                    . "employee_account_name='$employee_account_name',"
                    . "employee_bank_name='$employee_bank_name',"
                    . "employee_account_branch='$employee_account_branch'"
                    . "WHERE employee_id='$employeeId'"; 
       $result=$con->query($sql)or die($con->error);
 
   }
   public function deactivateEmployee($employeeId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE employee SET employee_status='0' WHERE employee_id='$employeeId'";
        $result = $con->query($sql);
    }

    public function activateEmployee($employeeId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE employee SET employee_status='1' WHERE employee_id='$employeeId'";
        $result = $con->query($sql);
    }
    public function getAllEmployeeCont()
    {
        $con=$GLOBALS['con'];
        $sql="SELECT COUNT(employee_id) as ecount FROM employee";
        $result=$con->query($sql) or die($con->error);
        $count_row=$result->fetch_assoc();
        return $count_row["ecount"];
    }

    public function getAllEmployeesPagination($page,$txt)
    {
        $start=($page-1)*5;  ///  starting position of the next set of records
        $con=$GLOBALS['con'];
        if($txt=="")
        {
            $sql="SELECT * FROM employee LIMIT $start,5";
        }
        else
        {
            $sql="SELECT * FROM employee WHERE employee_fname LIKE '%$txt%' LIMIT $start,5";
        }
        $result=$con->query($sql) or die($con->error);
        return $result;

    }
    public function getEmployeeRole()
    {
        $con=$GLOBALS["con"];
        $sql= "SELECT * FROM employee_role";
        $result=$con->query($sql);
        return $result;
    }
    public function getEmployeeDetail($employeeId)
    {
        $con=$GLOBALS["con"];
        $sql= "SELECT * FROM employee_role r,employee e WHERE e.employee_role = r.empr_id AND e.employee_id='$employeeId'";
        $result=$con->query($sql);
        return $result;
    }

}