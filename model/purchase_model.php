<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnection();

class Purchase{
    /**
     * Insert purchase table
     * @param $purchaseref_no
     * @param $sup_id
     * @param $pusup_id
     * @param $supplier_email
     * @param $purchase_date
     * @param $message
     * @param $ptotal
     * @return mixed
     */
    function addPurchasing($purchaseref_no,$sup_id,$pusup_id,$supplier_email,$purchase_date,$message,$ptotal) {
        $con = $GLOBALS["con"];
        //Insert into purchase table
        $sql = "INSERT INTO purchase(purchaseref_no,sup_id,pusup_id,supplier_email,purchase_date,message,ptotal)VALUES('$purchaseref_no','$sup_id','$pusup_id','$supplier_email','$purchase_date','$message','$ptotal')";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Insert purchase item detail
     * @param $purproduct_id
     * @param $pqty
     * @param $purchaseorder_price
     * @param $ppurchase_price_amount
     * @param $purchase_id
     * @return mixed
     */
    function addPurchaseItem($purproduct_id,$pqty,$purchaseorder_price,$ppurchase_price_amount,$purchase_id) {
        $con = $GLOBALS["con"];
        //Insert into purchase item table
        $sql = "INSERT INTO purchase_item(
                        purproduct_id,
                        pqty,
                        purchaseorder_price,
                        ppurchase_price_amount,
                        purchase_id
                        )VALUES(
                        '$purproduct_id','$pqty','$purchaseorder_price','$ppurchase_price_amount','$purchase_id'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Get all purchase details and supplier details
     * @return mixed
     */
    public function getAllPurchase()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM purchase p, supplier s WHERE p.pusup_id=s.sup_id";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the all purchase orders information in view-purchaseOrder page
     * @return mixed
     */
    public function getAllPurchaseDetails()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT purchase_id,purchaseref_no,pusup_id,supplier_email,purchase_date,purchase_status FROM purchase ORDER BY purchaseref_no DESC";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the specific purchase order information in view-purchase page
     * @param $id
     * @return mixed
     */
    public function getPurchase($id)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM purchase INNER JOIN purchase_item ON purchase.purchase_id=purchase_item.purchase_id  INNER JOIN supplier ON purchase.sup_id=supplier.sup_id WHERE purchase.purchase_id='$id'";
        $result=$con->query($sql);
        return $result;
    }
    public function getPurchaseDetail($id)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM purchase p,supplier s WHERE p.sup_id=s.sup_id AND p.purchase_id='$id'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the specific purchase order poduct items information in view-purchase page
     * @param $piid
     * @return mixed
     */
    public function getPurchaseItem($piid)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM purchase p,purchase_item i WHERE p.purchase_id=i.purchase_id AND i.purchase_id='$piid'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Search the product name
     * @return mixed
     */
    function getSearchProducts()
    {
        $con = $GLOBALS["con"];
        $product_name = $_POST["purproduct_id"];
        //$sql="SELECT * FROM product WHERE product_name LIKE '".$product_name."%'";
        $sql="SELECT * FROM product p, unit u WHERE p.product_name LIKE '".$product_name."%' AND p.unit_id=u.unit_id";
        $result=$con->query($sql);
        return $result;

    }

    /**
     * Search the supplier name using supplier first name
     * @return mixed
     */
    function getSearchSupplier()
    {
        $con = $GLOBALS["con"];
        $sup_fname = $_POST["pusup_id"];
        $sql= "SELECT * FROM supplier WHERE sup_fname  LIKE '".$sup_fname."%'";
        $result=$con->query($sql);
        return $result;

    }

    /**
     * Get the leatest purchase reference number
     * @return mixed
     */
    function getPurchaseNo()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT purchaseref_no from purchase order by purchaseref_no DESC LIMIT 1";
        $result=$con->query($sql);
        return $result;
    }
    function deactivatePurchase($id) {
        $con = $GLOBALS["con"];
        $sql ="UPDATE purchase SET purchase_status='0' WHERE purchase_id='$id'";
        $result = $con->query($sql);
    }

    /**
     * When the select the receivied button then get order information
     * @param $id
     * @return mixed
     */
    function getOrderStatus($id) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM purchase p,purchase_item i WHERE p.purchase_id=i.purchase_id AND p.purchase_id='$id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Insert receiving
     * @param $reference_no
     * @param $sup_id
     * @param $stock_date
     * @param $total
     * @param $pay_id
     * @return mixed
     */
    function addReceiving($reference_no, $sup_id, $stock_date,$total,$pay_id) {
        $con = $GLOBALS["con"];
        //Insert into recive table
        $sql = "INSERT INTO receive(reference_no,sup_id,stock_date,total,pay_id)VALUES('$reference_no','$sup_id','$stock_date','$total','$pay_id')";
        $con->query($sql);
        return $con->insert_id;
    }

    function addReceiveItem($rproduct_id,$product_id, $rqty, $rpurchase_price, $purchase_price_amount, $rdis, $regullar_price, $rm_date, $rexp_date,$id) {
        $con = $GLOBALS["con"];
        //Insert into recive item table
        $sql = "INSERT INTO receive_item(
                        rproduct_id,
                        product_id,
                        rqty,
                        rpurchase_price,
                        purchase_price_amount,
                        rdis,
                        regullar_price,
                        rm_date,
                        rexp_date,
                        id
                        )VALUES(
                        '$rproduct_id','$product_id','$rqty','$rpurchase_price','$purchase_price_amount','$rdis','$regullar_price','$rm_date','$rexp_date','$id'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Insert into stock table in receiving details
     * @param $qty
     * @param $cqty
     * @param $stock_date
     * @param $rexp_date
     * @param $price
     * @param $st_type
     * @param $product_id
     * @param $id
     * @return mixed
     */
    function addStock($qty,$cqty, $stock_date, $rexp_date,$price, $st_type,$product_id,$id) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO stock(
                        st_qty,
                        current_qty,
                        st_date,
                        exp_date,
                        price,
                        st_type,
                        p_id,
                        id
                        )VALUES(
                        '$qty','$cqty','$stock_date','$rexp_date','$price','1','$product_id','$id'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    function addRecievePayment($gtotal,$rpaid,$rdue,$pay_id,$payment_mid,$card_tid,$id)
    {
        $con = $GLOBALS["con"];
        //Insert into receive_payment table
        $sql = "INSERT INTO receive_payment(
                        gtotal,
                        rpaid,
                        rdue,
                        pay_id,
                        payment_mid,
                        card_tid,
                        id
                        )VALUES(
                        '$gtotal','$rpaid','$rdue','$pay_id','$payment_mid','$card_tid','$id'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    function updateProductPrice($regullar_price,$product_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE product SET ppurchase_price = '$regullar_price' WHERE product_id = '$product_id'";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Get all information in pay_type(status) table
     * @return mixed
     */
    public function getAllPayType()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM pay_type";
        $result=$con->query($sql);
        return $result;
    }

    //Get all information in pay_method table
    public function getAllPayMethod()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM payment_method";
        $result=$con->query($sql);
        return $result;
    }

    //Get all information in pay_type table
    public function getAllCardType()
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM card_type";
        $result=$con->query($sql);
        return $result;
    }
    // Display all receiving items in table
    public function getAllReceive()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM supplier a INNER JOIN receive b ON a.sup_id=b.sup_id INNER JOIN receive_payment c ON b.id=c.id INNER JOIN pay_type d ON c.pay_id=d.pay_id";
        $result=$con->query($sql);
        return $result;
    }
    // Search product name
    function getSearchReceiveProduct()
    {
        $con = $GLOBALS["con"];
        $status_name = $_POST["statusid"];
        $sql="SELECT * FROM product p, unit u WHERE p.product_name LIKE '".$product_name."%' AND p.unit_id=u.unit_id";
        $result=$con->query($sql);
        return $result;

    }
    // Search product name
    function getSearchStatus()
    {
        $con = $GLOBALS["con"];
        $product_name = $_POST["rproduct_id"];
        $sql="SELECT * FROM purchase WHERE purchase_status='$product_name'";
        $result=$con->query($sql);
        return $result;

    }
    public function getAllReceives()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM supplier a INNER JOIN receive b ON a.sup_id=b.sup_id INNER JOIN receive_item c ON b.id=c.id INNER JOIN product d ON c.product_id=d.product_id";
        $result=$con->query($sql);
        return $result;
    }
    public function getReceive($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM receive WHERE id='$id'";
        $result=$con->query($sql);
        return $result;
    }

    function deactivateRecieve($id) {
        $con = $GLOBALS["con"];
        $sql ="UPDATE receive SET rstatus='0' WHERE id='$id'";
        $result = $con->query($sql);
    }

    function activateRecieve($id) {
        $con = $GLOBALS["con"];
        $sql ="UPDATE receive SET rstatus='1' WHERE id='$id'";
        $result = $con->query($sql);
    }

    function paid($id) {
        $con = $GLOBALS["con"];
        $sql ="UPDATE receive_payment SET pay_id='2' WHERE id='$id'";
        $result = $con->query($sql);
    }

    function viewRecieve($id) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM receive r, receive_item i WHERE r.id=i.id AND r.id='$id'";
        $result = $con->query($sql);
        return $result;
    }
    function getDueSum() {
        $con = $GLOBALS['con'];
        $sql ="SELECT SUM(rdue) as sumactivedue FROM receive_payment";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $sumDue = $row["sumactivedue"];
        return $sumDue;
    }
    function getPaydstatus() {
        $con = $GLOBALS['con'];
        $sql ="SELECT COUNT(rdue) as countdue FROM receive_payment WHERE pay_id='1'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $countDue = $row["countdue"];
        return $countDue;
    }
    function getPaypstatus() {
        $con = $GLOBALS['con'];
        $sql ="SELECT COUNT(rdue) as countpaid FROM receive_payment WHERE pay_id='2'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $countPaid = $row["countpaid"];
        return $countPaid;
    }
    //get receiving grandtotal price
    function getTotal() {
        $con = $GLOBALS['con'];
        $sql ="SELECT SUM(gtotal) as sumtotal FROM receive_payment";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $sumTotal= $row["sumtotal"];
        return $sumTotal;
    }
    //Get the specific purchase order information in view-purchase
    public function getReceivinge($id)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM receive INNER JOIN supplier ON receive.sup_id=supplier.sup_id WHERE receive.id='$id'";
        $result=$con->query($sql);
        return $result;
    }

    //Get the specific purchase order items information in view-purchase
    public function getReceiveItem($piid)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM receive p,receive_item i WHERE p.id=i.id AND i.id='$piid'";
        $result=$con->query($sql);
        return $result;
    }
    public function getTodayPurchaseCount()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT DATE(purchase_date) AS date, COUNT(purchaseref_no) AS tot_purchase FROM purchase GROUP BY date HAVING date BETWEEN (CURRENT_DATE() - INTERVAL 0 DAY) AND CURRENT_DATE()";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $countPurchase = $row["tot_purchase"];
        return $countPurchase;
    }
    public function getAllp()
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM purchase";
        $result=$con->query($sql);
        return $result;
    }
    function getAllstatus($purchase_status)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM `purchase` WHERE purchase_status ='$purchase_status'";
        $result=$con->query($sql);
        return $result;
    }


    }



