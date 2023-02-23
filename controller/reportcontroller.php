<?php
include '../model/report_model.php';


$reportObj = new Report();
if(!isset($_REQUEST["status"]))
{
    ?>
    <script> window.location="../index.php"</script>
    <?php
}
else {
    $status = $_REQUEST["status"];
    switch ($status) {

        case "filter_date":
           $start=$_POST["start"];
           $end=$_POST["end"];
        $reportResult = $reportObj->getAllPurchase($start,$end);
           ?>
                        <?php
                        while ($prowRow = $reportResult->fetch_assoc()) { //associative array
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
            }
}