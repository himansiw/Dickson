<?php
//Db class name.
class dbConnection {

    public $conn;//db object
    private $hostname = "localhost";
    private $dbusename = "root"; //db user name
    private $dbpassword = ""; //password
    private $db = "dickson"; //db name

    function __construct() {
        $this->conn = new mysqli(
                $this->hostname, $this->dbusename, $this->dbpassword, $this->db //create db connection
        );
        if (!$this->conn->connect_error) { // expection handle in connection
            $GLOBALS["con"] = $this->conn;
        } else {
            echo "Not Success";
            $GLOBALS["con"] = $this->conn;
        }
    }

}


