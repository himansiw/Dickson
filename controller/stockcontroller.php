<?php
include '../model/stock_model.php';

$stockObj = new Stock();// create stock Object
if(!isset($_REQUEST["status"]))
{
    ?>
    <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status) {

        /**
         * Insert expire table and update the expire_confirmed status into one
         */
        case "add_expire":

            $st_id = $_POST["st_id"];
            $pid = $_POST["pid"];
            $eqty = $_POST["eqty"];
            $date_expired= $_POST["date_expired"];

            $id = $stockObj->addExpire($pid,$eqty,$date_expired,$st_id);
            $id = $stockObj->updateExpireStatus($st_id);

            $msg = "Successfully Confirmed Expired product!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/expire.php?msg=' . $msg);
            break;

        case "add_low":

            $st_id = $_POST["st_id"];
            $pid = $_POST["pid"];
            $lqty = $_POST["lqty"];
            $mqty = $_POST["mqty"];


            $id = $stockObj->addLowProduct($pid,$lqty,$mqty,$st_id);
            $id = $stockObj->updateLowStatus($st_id);

            $msg = "Successfully Confirmed Low stock product!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/lowstock.php?msg=' . $msg);
            break;
    }


}