<?php
include '../model/supplier_model.php';
include '../model/product_model.php';
include '../model/purchase_model.php';
include '../model/unit_model.php';

$supplierObj = new Supplier();// create supplier Object
$productObj = new Product();  ///  create product Object
$purchaseObj = new Purchase();
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
         * Search product name ang get purchase price
         */
        case "add_purchase":
            $product_name = $_POST["purproduct_id"];
            $product_id = $purchaseObj->getSearchProducts($product_name);

            ?>
            <ul class="list-unstyled">
                <?php
                if (mysqli_num_rows($product_id) > 0) {
                    while ($row = $product_id->fetch_assoc()) {
                        ?>
                        <li class="color" value="<?php echo $row["ppurchase_price"];?>"><?php echo $row["product_name"];?> </li>
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

        case "get_suppliername":
            $sup_fname = $_POST["pusup_id"];
            $ssup_id = $purchaseObj->getSearchSupplier($sup_fname);
            ?>
            <ul class="list-unstyled">
                <?php
            if (mysqli_num_rows($ssup_id) > 0) {
                while ($srow = $ssup_id->fetch_assoc()) {
                ?>
                <a class="list-group-item list-group-item-action border-1" value="<?php echo $srow["sup_email"];?>" value1="<?php echo $srow["business_name"];?>" value2="<?php echo $srow["sup_id"];?>" href="#" style="font-size: 15px; color: black; text-decoration:none;background-color: #eeeeee"> <?php echo $srow["sup_fname"];?> <?php echo $srow["sup_lname"];?> </a>
                <?php
                    }
                } else {
                    ?>
                    <a class="list-group-item list-group-item-action border-1" href="#" style="font-size: 15px; color: black; text-decoration:none;background-color: #eeeeee"> Supplier Not Found </a>
                    <?php
                }
                ?>
            </ul>
            <?php
            break;
        /**
         * Send purchase order into supplier and insert data into table
         */
        case "add_email":
            $purchaseref_no = $_POST["purchaseref_no"];
            $sup_id = $_POST["sup_id"];
            $pusup_id = $_POST["pusup_id"];
            $getSupplier=$supplierObj->getAllSuppliers($pusup_id);
            $getSupplierResult=$getSupplier->fetch_assoc();
            $supplier_email = $_POST["supplier_email"];
            $purchase_date = $_POST["purchase_date"];
            $message = $_POST["message"];
            $purproduct_id = $_POST["purproduct_id"];
            $pqty = $_POST["pqty"];
            $purchaseorder_price = $_POST["purchaseorder_price"];
            $ppurchase_price_amount = $_POST["ppurchase_price_amount"];
            $ptotal = $_POST["ptotal"];
            include '../includes/email_include.php';
            try {
                $purchase_id = $purchaseObj->addPurchasing($purchaseref_no,$sup_id, $pusup_id, $supplier_email, $purchase_date, $message, $ptotal);
                if ($purchase_id > 0) {
                        /* Set the mail sender. */
                        $mail->setFrom('mail@et.lk', 'Dicksons Food City Management');
                        /*Set a different reply-to address*/
                        $mail->addReplyTo('mail@et.lk', 'dicksonsfoodcity749@gmail.com');
                        /* Add a recipient. */
                        $mail->addAddress($_POST['supplier_email'], $_POST["pusup_id"]);
                        /* Set the subject. */
                        $mail->Subject = 'To order items for purchase' . ' ' . $_POST["purchaseref_no"];
                        /*Set an HTML email message*/
                        $mail->isHTML(true);
                    /*Set the mail body*/
                    $mail->Body .= '<div style="border: 1px solid #000000; margin: auto; padding-left:2%; padding-right: 2%">'
                        . '<br>'
                        . '<img src="https://graph.facebook.com/259221401278733/picture?type=large" alt="" width="70" height="60" align="right" style="padding-left: 2%"/><p style="font-weight: bold;text-align: right;font-size: 24px;font-family: Arial;color: black;padding-right: 10px">PURCHASE-ORDER</p>'
                        . '<br>'
                        . '<p style="margin: auto;font-weight: bold;border: 1px solid #e7b475;padding: 16px;text-align: center;font-size: 20px;font-family: Arial;color: white;background-color:#e7b475;width: 96%">Express Dicksons Food City' .'<br>'.'392G Dangedara,Galle,Sri Lanka'.'<br>'.'No.0912 235 249</p>'
                        . '<p style="font-size: 14px; color: #e9a077 ;font-weight: bold;font-family:sans-serif"> OrderID' .' '.'[' . $_POST["purchaseref_no"] . ']' . ' ' .'Date' . ' ' .'['. $_POST["purchase_date"] .']'.'</p>'
                        . '<table width="40%" border="0">'
                        . '<tr style="text-align: left;font-weight: bold;font-size: 14px"> Vendor Details' .' '.':'.'</tr>'
                        . '<tr>'
                        . '<th style="text-align: left"> Company name </th>'
                        . '<td>'.$getSupplierResult["business_name"].'</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<th style="text-align: left;font-weight: bold"> Vendor name</th>'
                        . '<td>'.$getSupplierResult["sup_fname"] . ' ' .$getSupplierResult["sup_lname"] . '</td>'
                        . '</tr>'
                        . '<tr style="text-align: left">'
                        . '<th> Address</th>'
                        . '<td>'.$getSupplierResult["sup_house_no"] . ',' .$getSupplierResult["sup_street"] .','.$getSupplierResult["sup_city"].'</td>'
                        . '</tr>'
                        . '</table>'
                        . '<p style="font-size: 15px; font-family:sans-serif">'.'  '. $_POST["message"]  .'</p>'
                        . '<table cellpadding="2" cellspacing="0" aria-rowspan="1" width="96%"  border="1">'
                        . '<thead style="font-size: medium;text-align: center; ">'
                        . '<tr style="height: 35px">'
                        . '<th> Product Name </th>'
                        . '<th> Qty </th>'
                        . '<th> Unit Price </th>'
                        . '<th> Sub Total </th>'
                        . '</tr>'
                        . '</thead>'
                        . '<tbody>';
                    $purchase_length = sizeof($_POST["purproduct_id"]);
                    for ($i = 0; $i < $purchase_length; $i++) {
                        /* Set the mail message body. */
                        $mail-> Body .=
                            '<tr style="height: 35px">'
                            . '<td>' . $_POST["purproduct_id"][$i] . '</td>'
                            . '<td>' . $_POST["pqty"][$i] . '</td>'
                            . '<td>' . 'Rs.' . $_POST["purchaseorder_price"][$i] . '</td>'
                            . '<td>' . 'Rs.' . $_POST["ppurchase_price_amount"][$i] . '</td>'
                            . '</tr>';

                        $purchaseObj->addPurchaseItem($_POST["purproduct_id"][$i], $_POST["pqty"][$i], $_POST["purchaseorder_price"][$i], $_POST["ppurchase_price_amount"][$i], $purchase_id);
                    }
                    $mail->Body.=
                        '</tbody>'
                        .'<tfoot>'
                        .'<tr style="height: 35px">'
                        .'<td colspan="3" style="text-align: right;font-weight: bold;font-family:sans-serif"> Total</td>'
                        .'<td>' . 'Rs.' . $_POST["ptotal"] . '</td>'
                        .'</tr>'
                        .'</tfoot>'
                        .'</table>'
                        .'<p style="font-size: 12px; color: black ;font-weight: bold;font-family:SansSerif;text-align:center">'.'Thank'.' '.'You'.'</p>'
                        .'<br>'
                        .'</div>';
                        /* Finally send the mail. */
                        if ($mail->send()) {
                            $msg = " Mail successfully Sent!!";
                            $msg = base64_encode($msg);
                            header('Location: ../view/purchase-order.php?msg=' . $msg);
                        } else {
                            throw new Exception(" Error");
                        }
                }
            }
            catch (Exception $ex)
            {
                $msg=$ex->getMessage();
                $msg=  base64_encode($msg);
                header('Location: ../view/purchase-order.php?msg=' . $msg);
            }
            break;
        /**
         * Successfully received order
         */
        case "deactivatePurchase":
            $id = $_REQUEST["purchase_id"];
            //Decode the encoded  id to the normal numeric form.
            $id = base64_decode($id);
            $purchaseObj->deactivatePurchase($id);
            $msg = "Purchase Order Successfully Recieved!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-purchaseOrder.php?msg=' . $msg);
            break;
        /**
         * when the purchase order recieved get success message modal
         */
        case "view_status":
        $id = $_REQUEST["purchase_id"];
        $RecivesStatus =$purchaseObj -> getOrderStatus($id);
        $purrow = $RecivesStatus->fetch_assoc();
        ?>
        <input type="hidden" name="purchase_id" value="<?php echo $purrow["purchase_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Reference Number</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $purrow["purchaseref_no"]; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Supplier Name</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $purrow["pusup_id"]; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Supplier Name</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php echo $purrow["pusup_id"]; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Status</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Received Order</label>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <?php
        break;

        case "cancelPurchase":
            $id = $_REQUEST["purchase_id"];
            //Decode the encoded  id to the normal numeric form.
            $id = base64_decode($id);
            $cancelStatus =$purchaseObj -> getPurchaseDetail($id);
            if ($cancelStatus->num_rows > 0) {
                $purrow = $cancelStatus->fetch_assoc();
                $supplier_email =$purrow["supplier_email"];
                $purchaseref_no =$purrow["purchaseref_no"];
                $psup_id=$purrow["psup_id"];

                include '../includes/email_include.php';

                $mail->setFrom('mail@et.lk', 'Dicksons Food City Management System');
                $mail->addReplyTo('mail@et.lk', 'Dicksons Food City management System');
                $mail->addAddress($supplier_email,$psup_id); //Add a recipient

                $mail->Subject = 'Cancel to order item of purchase'.' ' .$purchaseref_no;

                $mail->isHTML(true); //Set email format to HTML

                $body .= "<h4>Dear Sir/Madam ;</h4>";
                $body .= "<h3>Kindly request to cancel the this purchase order.</h3>";
                $body .= "<h4>Thank you</h4>";

                $mail->Body = $body;
                if ($mail->send()) {
                    $msg = " Mail successfully Sent!!";
                    $msg = base64_encode($msg);
                    header('Location: ../view/view-purchaseOrder.php?msg=' . $msg);
                } else {
                    throw new Exception(" Error");
                }
            }

            break;




        /**
         * Search the products in grn
         */
        case "search_receiving":
            $product_name = $_POST["rproduct_id"];
            $product_id = $purchaseObj->getSearchReceiveProduct($product_name);

            ?>
            <ul class="list-unstyled">
                <?php
                if (mysqli_num_rows($product_id) > 0) {
                    while ($row = $product_id->fetch_assoc()) {
                        ?>
                        <li class="color" value="<?php echo $row["product_id"];?>"><?php echo $row["product_name"];?> </li>
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
        case "search_receiving":
            $statusid = $_POST["statusid"];
            $product_id = $purchaseObj->getSearchReceiveProduct($statusid);

            ?>
            <ul class="list-unstyled">
                <?php
                if (mysqli_num_rows($product_id) > 0) {
                    while ($row = $product_id->fetch_assoc()) {
                        ?>
                        <li class="color" value="<?php echo $row["product_id"];?>"><?php echo $row["product_name"];?> </li>
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

        case "filter_status":
            $purchase_status=$_POST["purchase_status"];
            $statusResult = $purchaseObj->getAllstatus($purchase_status);
            ?>
            <?php
            while ($prowRow = $statusResult->fetch_assoc()) { //associative array
                ?>
                <tr>
                    <td><?php echo $prowRow["purchaseref_no"]; ?></td>
                    <td><?php echo date("M d, Y", strtotime($prowRow["purchase_date"])) ?></td>
                    <td><?php echo $prowRow["pusup_id"]; ?></td>
                    <td><?php echo $prowRow["supplier_email"] ;?></td>
                    <td>
                        <?php
                        if ($prowRow["purchase_status"] == "1") {
                            echo "Pending order";
                        } else {
                            echo "Received order";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>

            <?php


            break;

        /**
         * saving the reciving table
         */
        case "add_receiving":
            $reference_no = $_POST["reference_no"];
            $sup_id = $_POST["sup_id"];
            $stock_date = $_POST["stock_date"];
            $rproduct_id = $_POST["rproduct_id"];
            $product_id = $_POST["product_id"];
            $rqty= $_POST["rqty"];
            $rpurchase_price= $_POST["rpurchase_price"];
            $purchase_price_amount = $_POST["purchase_price_amount"];
            $rdis = $_POST["rdis"];
            $regullar_price= $_POST["regullar_price"];
            $rm_date= $_POST["rm_date"];
            $rexp_date= $_POST["rexp_date"];
            $total = $_POST["total"];
            $gtotal= $_POST["gtotal"];
            $rpaid= $_POST["rpaid"];
            $rdue= $_POST["rdue"];
            $pay_id= $_POST["pay_id"];
            $payment_mid= $_POST["payment_mid"];
            $card_tid= $_POST["card_tid"];

            $id = $purchaseObj->addReceiving($reference_no, $sup_id, $stock_date,$total,$pay_id);
            if($id > 0)
            {
                $receive_length = sizeof($_POST["rproduct_id"]);
                for ($x = 0; $x < $receive_length; $x++)
                {
                    $purchaseObj->addReceiveItem($rproduct_id[$x],$product_id[$x],$rqty[$x], $rpurchase_price[$x], $purchase_price_amount ,$rdis[$x], $regullar_price[$x], $rm_date[$x], $rexp_date[$x], $id);
                }

                $stock_length = sizeof($_POST["rqty"]);
                for($y=0; $y<$stock_length; $y++)
                {
                    $purchaseObj->addStock($rqty[$y],$rqty[$y],$stock_date,$rexp_date[$y],$regullar_price[$y],1,$product_id[$y],$id);
                }
            //   Update the total regullar price in product.
                $payment_length = sizeof($_POST["product_id"]);
                for($n=0; $n<$payment_length; $n++)
                {
                    //$purchaseObj->updateProductPrice($regullar_price[$n],$product_id[$n]);
                }

            }
            $id = $purchaseObj->addRecievePayment($gtotal,$rpaid,$rdue,$pay_id,$payment_mid,$card_tid,$id);

            $msg = " Receiving successfully Added!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-receiveOrder.php?msg=' . $msg);
            break;

        case "deactivateRecieve":
            $id = $_REQUEST["id"];
            //Decode the encoded  id to the normal numeric form.
            $id = base64_decode($id);
            $purchaseObj->deactivateRecieve($id);
            $msg = "Recieve Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-receiveOrder.php?msg=' . $msg);
            break;
        //Active user.
        case "activateRecieve":
            $id = $_REQUEST["id"];
//            $product_id = $_REQUEST["product_id"];
//            $regullar_price= $_REQUEST["regullar_price"];
//            $payment_length = sizeof($_POST["product_id"]);
//            for($n=0; $n<$payment_length; $n++)
//            {
//                $purchaseObj->updateProductPrice($regullar_price[$n],$product_id[$n]);
//            }
            //Decode the encoded  id to the normal numeric form.
            $id = base64_decode($id);
            $purchaseObj->activateRecieve($id);
            $msg = "Recieve Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-receiveOrder.php?msg=' . $msg);
            break;
        case "paid":
            $id = $_REQUEST["id"];
            //Decode the encoded  id to the normal numeric form.
            $id = base64_decode($id);
            $purchaseObj->paid($id);
            $msg = "Due Payment Successfully Completed!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-receiveOrder.php?msg=' . $msg);
            break;

    }
}


   