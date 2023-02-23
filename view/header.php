<?php
include '../commons/session.php';
include '../model/notification_model.php';
$notificationObj = new Notification();
$cuser_id=$_SESSION["user"]["user_id"];
// Get notification count
$notificationResult= $notificationObj->getUserNotificationCount($cuser_id);
$notification_array=$notificationResult->fetch_assoc();
//Get the list of notifications
$listResult=$notificationObj->getUnreadNotifications($cuser_id);

?>

<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard.php">
                <b>Dicksons Food City</b></a>  
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Right Menu-->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                    <span style="background-color: #ff5050;padding:5px;
                              border-radius:50px;color: #FFF">
                        <?php
                        echo $notification_array["cont"];
                        ?>
                        </span>
                </a>

                <ul class="dropdown-menu dropdown-alerts" id="notificationlist" style="padding-block: initial">
                    <?php
                    while($list_row=$listResult->fetch_assoc())
                    {
                    $notification_id=  base64_encode($list_row["notification_id"]);
                    ?>
                    <li>
                        <a href="../controller/notificationcontroller.php?status=read&nid=<?php echo $notification_id ?>">
                            <div>
                                <i class="fa fa-comment fa-fw"></i>&nbsp; <?php echo $list_row["description"];?>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#" data-toggle="modal" data-target="#allnot">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-double-down"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    <i class="fa fa-user-circle-o fa-fw"></i> <b> Welcome <?php echo $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"]; ?></b><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="profile.php?user_id=<?php echo base64_encode($_SESSION["user"]["user_id"]);  ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
<!--                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
<!--                    </li>-->
                    <li class="divider"></li>
                    <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
<div class="modal fade" id="allnot" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  modal-sm" role="document">
        <form action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>All Notification</b></h3><br>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered"  role="grid">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #f1f1f1;color:#0f0f0f;height:50px">
                            <th rowspan="1" colspan="1" style="text-align: center">
                                Description
                            </th>
                        </tr>
                        </thead>
                    <?php
                    $allNot=$notificationObj->allNotifications();
                    while ($nrow = $allNot->fetch_assoc()) {
                        $notificationid = $nrow["notification_id"];
                        $notificationid = base64_encode($notificationid);
                    ?>
                        <tr>
                            <td> <?php echo $nrow["description"]; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>

                </div>
            </div>
        </form>
    </div>
</div>
