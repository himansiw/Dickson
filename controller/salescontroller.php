<?php
include '../model/customer_model.php';
include '../model/product_model.php';
include '../model/sale_model.php';
include '../model/unit_model.php';

$customerObj = new Customer();// create customer Object
$productObj = new Product();  ///  create product Object
$saleObj = new Sale();
$unitObj = new Unit();
$unitResult = $unitObj->getAllUnits();
if(!isset($_REQUEST["status"]))
{
    ?>
    <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status)
    {
        /**
         * Get the products when serach product name or barcode
         */
        case "add_sale":
            $product_name = $_POST["saleproduct_id"];
            $product_id = $saleObj->getSearchProducts($product_name);
            ?>
            <ul class="list-unstyled">
                <?php
                if (mysqli_num_rows($product_id) > 0) {
                    while ($row = $product_id->fetch_assoc()) {
                        ?>
                        <li class="color" value="<?php echo $row["product_id"];?>"><?php echo $row["product_name"];?></li>
                        <?php
                    }
                } else {
                    ?>
                    <li class="color">Product Not Found </li>
                    <?php
                }
                ?>
            </ul>
            <?php
            break;

        /**
         * Get discount and price.
         */
        case "get_dis":
            $product_discount = $saleObj->getdiscountprice($_POST["productid"]);
            $result = $product_discount->fetch_assoc();
            $data[0] = $result['pdis'];
            $data[1]= $result['ppurchase_price'];
            $data[2]=$result['product_id'];
            echo json_encode($data);
            break;

        /**
         * Select the customer using anchor tag
         */
        case "get_customer":
            $cus_fname = $_POST["scus_id"];
            $scus_id = $saleObj->getSearchCustomers($cus_fname);//Get customer
            ?>
            <ul class="list-unstyled">
                <?php
                if (mysqli_num_rows($scus_id) > 0) {
                    while ($crow = $scus_id->fetch_assoc()) {
                        ?>
                        <a class="list-group-item list-group-item-action border-1" value="<?php echo $crow["cus_id"];?>" value1="<?php echo $crow["card_no"];?>" value2="<?php echo $crow["loyalty_point"];?>" href="#" style="font-size: 15px; color: black; text-decoration:none;background-color: #eeeeee"> <?php echo $crow["cus_fname"];?> <?php echo $crow["cus_lname"];?> </a>
                        <?php
                    }
                } else {
                    ?>
                    <a class="list-group-item list-group-item-action border-1" href="#" style="font-size: 15px; color: black; text-decoration:none;background-color: #eeeeee"> Walking Customer </a>
                    <?php
                }
                ?>
            </ul>
            <?php
            break;

        /**
         * when the customer select then given loyalty point and card no pass
         */
        case "point":
            $customer_point = $saleObj->getpoint($_POST["custid"]);
            $result1 = $customer_point->fetch_assoc();
            $data[0] = $result1['loyalty_point'];
            $data[1]= $result1['card_no'];
            echo json_encode($data);
            break;

        /**
         * when the add pay modal save button click then insert sale,sale item,loyalty detail,sale payment and update stock current qty
         */
        case "add_pay":
            $invoice_no = $_POST["invoice_no"];
            if (!isset($_POST["cusid"]) || empty($_POST["cusid"])) { //if the customer id empty the return customer id into zero
                $cusid = 0;
            } else {
                $cusid = $_POST["cusid"]; //else customer id not empty then return into given customer id
            }
            $scus_id = $_POST["scus_id"];
            $sales_sdate = $_POST["sales_sdate"];
            $productid= $_POST["productid"];
            $saleproduct_id = $_POST["saleproduct_id"];
            $sqty = $_POST["sqty"];
            $sdiscount = $_POST["sdiscount"];
            $sale_rprice = $_POST["sale_rprice"];
            $subprice_amount = $_POST["subprice_amount"];
            $sale_cardno = $_POST["sale_cardno"];
            $apoint = $_POST["apoint"];
            $c_point = $_POST["c_point"];
            $point_use = $_POST["point_use"];
            $r_point = $_POST["r_point"];
            $r_value = $_POST["r_value"];
            $stotal = $_POST["stotal"];
            $distotal = $_POST["distotal"];
            $netotal = $_POST["netotal"];
            $paid = $_POST["paid"];
            $due = $_POST["due"];
            $payment_mid= $_POST["payment_mid"];
            if(isset($payment_mid) && $payment_mid == 2) { //check whether a variable is set, which means that it has to be declared and is not NULL or pament method id equal to one
            $card_tid = $_POST['card_tid'];
            }else{
                $card_tid = 0; //else then return zero
            }

            $id = $saleObj->addSale($invoice_no,$cusid,$scus_id,$sales_sdate,$stotal,$distotal,$netotal,$paid,$due); // insert add sale

            if($id > 0) { //id grater than zero
                $sale_length = sizeof($productid);
                for ($n = 0; $n < $sale_length; $n++) {
                    $saleObj->addSaleItem($productid[$n], $saleproduct_id[$n], $sqty[$n], $sdiscount[$n], $sale_rprice[$n], $subprice_amount[$n], $id, $invoice_no); //inser sale item

                    $result = $saleObj->selectProduct($productid[$n]); //Get the selected product given invoice
                    if($result) {
                        while ($rrow = $result->fetch_assoc()) {
                            if ($rrow['current_qty'] > $sqty[$n]) { //if the current qty greater than st qty
                                $curqty = $rrow['current_qty'] - $sqty[$n]; //then get current qty given equation
                                $saleObj->updateQuantity($curqty, $rrow['st_id']); // update thq current qty
                                break;
                            } elseif ($rrow['current_qty'] == $sqty[$n]) { //when the current qty equal to st qty
                                $saleObj->updateQuantity2($rrow['st_id']);
                                break;
                            } elseif ($rrow['current_qty'] < $sqty[$n]) { //when the current qty less than st qty
                                $sqty[$n] = $sqty[$n] - $row['current_qty']; // then get st qty
                                $saleObj->updateQuantity2($rrow['st_id']);
                            }

                        }
                    }

                }
            }
            $id = $saleObj->addSalePayment($netotal,$paid,$due,$payment_mid,$card_tid,$invoice_no); // insert payment
            $id = $saleObj->addLoyaltyDetail($sale_cardno,$apoint,$c_point,$point_use,$r_point,$r_value,$cusid,$scus_id,$invoice_no);
            //Update the total loyalaty points in customer.
            $id = $saleObj->updateLoyaltyPoint($apoint,$cusid);
            break;

    }
}



