<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Stock{

    /**
     * Get stock in or request qty in stock table
     * @param $product_id
     * @return int
     */
    function getReceivingStock($product_id)
    {
        $con =$GLOBALS["con"];
        $sql= "SELECT SUM(st_qty) as tot FROM stock WHERE p_id='$product_id' AND stock_status =1";
        $totResult=$con->query($sql);
        $totRow=$totResult->fetch_assoc();
        if($totRow["tot"]==null) // If qty is null then show zero in available stock
        {
            $totRow["tot"]=0;
        }
        return $totRow["tot"];
    }

    /**
     * Get currentt qty in stock table
     * @param $product_id
     * @return int
     */
    function getCurrentStock($product_id)
    {
        $con =$GLOBALS["con"];
        $sql= "SELECT SUM(current_qty) as tot1 FROM stock WHERE p_id='$product_id' AND stock_status =1";
        $totResult1=$con->query($sql);
        $totRow1=$totResult1->fetch_assoc();
        if($totRow1["tot1"]==null) // If qty is null then show zero in available stock
        {
            $totRow1["tot1"]=0;
        }
        return $totRow1["tot1"];
    }

    /**
     * Show the expire list in dashboard
     * @return mixed
     */
    function getExpireList()
    {
        $con =$GLOBALS["con"];
        $sql="SELECT i.*,p.product_name,p.pcode,p.pbarcode FROM stock i inner join product p on p.product_id = i.p_id WHERE i.exp_date >=DATE(now()) AND  DATE(now()) >= DATE_SUB(i.exp_date, INTERVAL 2 WEEK) AND i.expired_confirmed = 0 AND i.stock_status = 1";
        $productResult=$con->query($sql) or die($con->error);
        return $productResult;

    }

    /**
     * Add expire products into expire table
     * @param $pid
     * @param $eqty
     * @param $date_expired
     * @param $st_id
     * @return mixed
     */
    function addExpire($pid,$eqty,$date_expired,$st_id)
    {
        $con = $GLOBALS["con"];
        //Insert into sale table
        $sql ="INSERT INTO expire(pid,eqty,date_expired,st_id)VALUES('$pid','$eqty','$date_expired','$st_id')";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Get view expire product
     * @param $st_id
     * @return mixed
     */
    function viewExpireProduct($st_id) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM stock i, product p WHERE p.product_id = i.p_id  AND i.st_id='$st_id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Update expired_confirmed status into one in stock table
     * @param $st_id
     * @return mixed
     */
    function updateExpireStatus($st_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE stock SET expired_confirmed='1' WHERE st_id = '$st_id'";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Get view expire products in expire table
     * @return mixed
     */
    function getAllExpired() {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM expire e, product p WHERE p.product_id = e.pid order by date(e.date_created) desc";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get all low stock product list
     * @return mixed
     */
    function getReorderList()
    {
        $con =$GLOBALS["con"];
        $sql="SELECT i.*,p.product_name,p.pcode,p.pbarcode,p.reqty FROM stock i inner join product p on p.product_id = i.p_id WHERE p.reqty >=i.current_qty  AND i.reorder_confirmed = 0 AND i.stock_status = 1";
        $productResult=$con->query($sql) or die($con->error);
        return $productResult;
    }

    /**
     * Insert low products into low table
     * @param $pid
     * @param $lqty
     * @param $mqty
     * @param $st_id
     * @return mixed
     */
    function addLowProduct($pid,$lqty,$mqty,$st_id)
    {
        $con = $GLOBALS["con"];
        //Insert into sale table
        $sql ="INSERT INTO low(pid,lqty,mqty,st_id)VALUES('$pid','$lqty','$mqty','$st_id')";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * View low product detail in current id
     * @param $st_id
     * @return mixed
     */

    function viewLowProduct($st_id) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM stock i, product p WHERE p.product_id = i.p_id  AND i.st_id='$st_id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Update the reorder_confirmed status into one
     * @param $st_id
     * @return mixed
     */
    function updateLowStatus($st_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE stock SET reorder_confirmed='1' WHERE st_id = '$st_id'";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * view all low stock product detail in lowstock page
     * @return mixed
     */
    function getAllLowStock() {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM low l, product p WHERE p.product_id = l.pid order by date(l.date_created) desc";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * select product category
     * @return mixed
     */
    function getAllProducts()
    {
        $con = $GLOBALS["con"];
        $sql= "SELECT * FROM product p, category c WHERE  p.cat_id=c.cat_id";
        $productResult=$con->query($sql);
        return $stockResult;
    }

    function getAllProduct($product_id)
    {
        $con = $GLOBALS["con"];
        $sql= "SELECT * FROM product WHERE  product_id='$product_id'";
        $stockResult=$con->query($sql);
        return $stockResult;

    }
    function getAllProductDetail($product_id)
    {
        $con = $GLOBALS["con"];
        $sql= "SELECT * FROM stock s,product p WHERE s.p_id=p.product_id AND p.product_id='$product_id'";
        $stockResult=$con->query($sql);
        return $stockResult;

    }

    public function getSumStockGrouped()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT s.p_id,p.product_name,SUM(s.st_qty) as total FROM product p, stock s WHERE p.product_id=s.p_id GROUP BY s.p_id";
        $totResult=$con->query($sql) or die($con->error);
        return $totResult;

    }
}