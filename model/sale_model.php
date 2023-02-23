<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Sale{
    /**
     * Insert into sale table
     * @param $invoice_no
     * @param $cus_id
     * @param $scus_id
     * @param $sales_sdate
     * @param $stotal
     * @param $distotal
     * @param $netotal
     * @param $paid
     * @param $due
     * @return mixed
     */
    function addSale($invoice_no,$cus_id,$scus_id,$sales_sdate,$stotal,$distotal,$netotal,$paid,$due)
    {
        $con = $GLOBALS["con"];
        $sql ="INSERT INTO sale(invoice_no,cus_id,scus_id,sales_sdate,stotal,distotal,netotal,paid,due)VALUES('$invoice_no','$cus_id','$scus_id','$sales_sdate','$stotal','$distotal','$netotal','$paid','$due')";
        try {
            $con->query($sql);
            return $con->insert_id;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return FALSE;
        }
    }

    /**
     * Insert into sale item table
     * @param $productid
     * @param $saleproduct_id
     * @param $sqty
     * @param $sdiscount
     * @param $sale_rprice
     * @param $subprice_amount
     * @param $id
     * @param $invoice_no
     * @return mixed
     */
    function addSaleItem($productid,$saleproduct_id, $sqty, $sdiscount, $sale_rprice, $subprice_amount, $id,$invoice_no)
    {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO sale_item(
                        productid,
                        saleproduct_id,
                        sqty,
                        sdiscount,
                        sale_rprice,
                        subprice_amount,
                        id,
                        invoice_no
                        )VALUES(
                        '$productid','$saleproduct_id','$sqty','$sdiscount','$sale_rprice','$subprice_amount','$id','$invoice_no'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Insert into sale_payment table
     * @param $netotal
     * @param $paid
     * @param $due
     * @param $payment_mid
     * @param $card_tid
     * @param $invoice_no
     * @return mixed
     */
    function addSalePayment($netotal,$paid,$due,$payment_mid,$card_tid,$invoice_no)
    {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO sale_payment(
                        netotal,
                        paid,
                        due,
                        payment_mid,
                        card_tid,
                        invoice_no
                        )VALUES(
                        '$netotal','$paid','$due','$payment_mid','$card_tid','$invoice_no'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * select the product for what product in the that stock table
     * @param $productid
     * @return mixed
     */
    function selectProduct($productid)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM stock WHERE p_id='$productid' AND stock_status='1'";
        return $con->query($sql);
    }

    /**
     * when the current quatity greater than request quatity
     * @param $curqty
     * @param $st_id
     * @return mixed
     */
    function updateQuantity($curqty,$st_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE stock SET current_qty = '$curqty' WHERE st_id = '$st_id' AND stock_status='1'";
        return $con->query($sql);
    }

    /**
     * when the current qty equal to request qty or crrent qty less than to request qty
     * @param $st_id
     * @return mixed
     */
    function updateQuantity2($st_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE stock SET current_qty = '0', stock_status='0' WHERE st_id = '$st_id' ";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Insert loyalty details in given invoice
     * @param $sale_cardno
     * @param $apoint
     * @param $c_point
     * @param $point_use
     * @param $r_point
     * @param $r_value
     * @param $cus_id
     * @param $scus_id
     * @param $invoice_no
     * @return mixed
     */

    function addLoyaltyDetail($sale_cardno,$apoint,$c_point,$point_use,$r_point,$r_value,$cus_id,$scus_id,$invoice_no)
    {
        $con = $GLOBALS["con"];
        //Insert into loyalty_detail table
        $sql = "INSERT INTO loyalty_detail(
                        sale_cardno,
                        apoint,
                        c_point,
                        point_use,
                        r_point,
                        r_value,
                        cus_id,
                        scus_id,
                        invoice_no
                        )VALUES(
                        '$sale_cardno','$apoint','$c_point','$point_use','$r_point','$r_value','$cus_id','$scus_id','$invoice_no'
                        )";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * update the loyalty points given invoice
     * @param $apoint
     * @param $cus_id
     * @return mixed
     */
    function updateLoyaltyPoint($apoint,$cus_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET loyalty_point = '$apoint' WHERE cus_id = '$cus_id'";
        $con->query($sql);
        return $con->insert_id;
    }

    /**
     * Get  all sale details for invoice
     * @return mixed
     */
    public function getAllSale()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM sale INNER JOIN sale_item ON sale.id = sale_item.id INNER JOIN loyalty_detail ON sale.cus_id = loyalty_detail.cus_id";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get sale details for given invoice
     * @param $invoice_no
     * @return mixed
     */
    public function getSale($invoice_no)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM sale s WHERE s.invoice_no='$invoice_no'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get loyalty details for invoice
     * @param $invoice_no
     * @return mixed
     */
    public function getloyalDetails($invoice_no) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM loyalty_detail l WHERE l.invoice_no='$invoice_no'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get sale item details for given invoice
     * @param $invoice_no
     * @return mixed
     */
    public function getSaleItem($invoice_no)
    {
        $con = $GLOBALS["con"];;
        $sql="SELECT * FROM sale_item m,product p WHERE m.productid=p.product_id AND m.invoice_no='$invoice_no'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get payment details for given invoice
     * @param $invoice_no
     * @return mixed
     */
    public function getPaymentDetail($invoice_no)
    {
        $con = $GLOBALS["con"];;
        $sql="SELECT * FROM sale INNER JOIN sale_payment ON sale.invoice_no=sale_payment.invoice_no INNER JOIN payment_method ON sale_payment.payment_mid=payment_method.payment_mid WHERE sale.invoice_no='$invoice_no'";
        $result = $con->query($sql);
        return $result;
    }
    public function getCardDetail($invoice_no)
    {
        $con = $GLOBALS["con"];;
        $sql="SELECT * FROM sale_payment p,card_type c WHERE p.card_tid=c.card_tid AND p.invoice_no='$invoice_no'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get sum of qty for no pieces
     * @param $invoice_no
     * @return mixed
     */
    public function getNoPieces($invoice_no)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT SUM(sqty) as countqty FROM sale_item WHERE invoice_no='$invoice_no'";
        $result = $con->query($sql);
        $qtyrow = $result->fetch_assoc();
        $noPieceCount = $qtyrow["countqty"];
        return $noPieceCount;
        return $result;
    }

    /**
     * Get invoice no
     * @return mixed
     */
    function getInvoiceNo()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT invoice_no from sale order by invoice_no DESC LIMIT 1";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * search the product using barcode or product name
     * @return mixed
     */
    function getSearchProducts()
    {
        $con = $GLOBALS["con"];
        $product_name = $_POST["saleproduct_id"];
        $sql="SELECT * FROM product WHERE product_name LIKE '".$product_name."%' OR pbarcode LIKE '".$product_name."%'";
         // $sql = "SELECT * FROM product p, unit u WHERE product_name LIKE '" . $product_name . "%' AND p.unit_id=u.unit_id";
        $result = $con->query($sql);
        return $result;

    }

    /**
     * Get O/price for given product
     * @param $productId
     * @return mixed
     */
    function getdiscountprice($productId)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM product  WHERE product_id='$productId'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * when the select the customer type the mobile number then return customer name
     * @return mixed
     */
    function getSearchCustomers()
    {
        $con = $GLOBALS["con"];
        $cus_fname = $_POST["scus_id"];
        $sql= "SELECT * FROM customer WHERE cus_mob  LIKE '".$cus_fname."%'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the loyalty points for given customer
     * @param $customerId
     * @return mixed
     */
    function getpoint($customerId)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM customer  WHERE cus_id='$customerId'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get card no given customer
     * @return mixed
     */
    function getCardNo()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT card_no from customer order by card_no DESC LIMIT 1";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Total of nettotal group by days within one week
     * @return mixed
     */
    function sevenDay()
    {
        $con = $GLOBALS['con'];
        $sql="SELECT DATE(sales_sdate) AS date, SUM(netotal) AS total_sales FROM sale GROUP BY date HAVING date BETWEEN (CURRENT_DATE() - INTERVAL 7 DAY) AND CURRENT_DATE()";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Total of 1 week sale(nettotal)
     * @return mixed
     */
    function sevenDayTotal()
    {
        $con = $GLOBALS['con'];
        $sql="SELECT SUM(netotal) AS income FROM sale WHERE sales_sdate>= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get the all sale orders information in view-saleOrder page
     * @return mixed
     */
    public function getAllSaleDetails()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT id,invoice_no,scus_id,sales_sdate,netotal,sale_status FROM sale ORDER BY invoice_no DESC";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the product count in view-saleOrder page
     * @param $id
     * @return mixed
     */
    public function countItems($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT COUNT(productid) as countitem FROM sale_item WHERE id='$id'";
        $result = $con->query($sql);
        $itemrow = $result->fetch_assoc();
        $noItemCount = $itemrow["countitem"];
        return $noItemCount;
        return $result;
    }

    /**
     * Get the sale pay method in view-saleOrder page
     * @param $id
     * @return mixed
     */
    public function viewPayMethod($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM sale s,sale_payment p WHERE s.invoice_no=p.invoice_no AND s.id='$id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * et the specific sale order information in view-sale page
     * @param $id
     * @return mixed
     */
    public function getSaleDetail($id)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM sale INNER JOIN sale_item ON sale.id=sale_item.id  INNER JOIN customer ON sale.cus_id=customer.cus_id WHERE sale.id='$id'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get the specific sale order poduct items information in view-sale page
     * @param $piid
     * @return mixed
     */
    public function getSaleItemDetail($piid)
    {
        $con =  $GLOBALS["con"];
        $sql="SELECT * FROM sale s,sale_item i WHERE s.id=i.id AND i.id='$piid'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Get sale details for complete status for invoice
     * @param $id
     * @return mixed
     */
    public function completeSale($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM sale s,loyalty_detail l WHERE s.invoice_no=l.invoice_no AND s.id='$id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get sale item details for complete status for invoice
     * @param $id
     * @return mixed
     */
    public function completeSaleItem($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM sale_item m,product p WHERE m.productid=p.product_id AND m.id='$id'";
        $result = $con->query($sql);
        return $result;
    }

    /**
     * Get sum of qty for no pieces
     * @param $id
     * @return mixed
     */
    public function completeNoPieces($id)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT SUM(sqty) as countqty FROM sale_item WHERE id='$id'";
        $result = $con->query($sql);
        $qtyrow = $result->fetch_assoc();
        $noPieceCount = $qtyrow["countqty"];
        return $noPieceCount;
        return $result;
    }

    /**
     * Total sale nettotal in today price
     * @return mixed
     */
    public function getTodaySaleTotal()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT DATE(sales_sdate) AS date, SUM(netotal) AS total_sales FROM sale GROUP BY date HAVING date BETWEEN (CURRENT_DATE() - INTERVAL 0 DAY) AND CURRENT_DATE()";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $todaySale = $row["total_sales"];
        return $todaySale;
    }



}