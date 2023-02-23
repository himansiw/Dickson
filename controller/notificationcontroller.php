<?php
include '../commons/session.php';

include '../model/notification_model.php';
$notificationObj = new Notification();

if(isset($_REQUEST["status"]))
{


    $status=$_REQUEST["status"];
    switch ($status)
    {
        /**
         * Change the notification status
         */
        case "read":

            $nid=$_REQUEST["nid"];
            // decode nid
            $nid=  base64_decode($nid);
            ////  user id
            $cuser_id=$_SESSION["user"]["user_id"];
            // call the function as updateNotification  (notificationid) &  create a function to pass this notification id & change status to 0
            $notificationObj->updateNotification($nid, $cuser_id);
            ?>
            <script> window.history.back(); </script>
            <?php
            break;

    }

}





