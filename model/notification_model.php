<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Notification{

    /**
     * send notifications to users of a particular user role
     * @param $msg
     * @param $userRole
     * @return mixed
     */
    public function addNotification($msg,$userRole)
    {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO notification(description,role_id,status)VALUES('$msg',"
            . "'$userRole','1')";
        $result=$con->query($sql);
        $notification_id=$con->insert_id;
        return $notification_id;
    }

    /**
     * Insert notificatin user table
     * @param $notification
     * @param $user_id
     */
    public function assignNotifications($notification,$user_id)
    {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO notification_user(notification_id,user_id)"
            . "VALUES('$notification','$user_id')";
        $result=$con->query($sql);

    }

    /**
     * Get unread notification count
     * @param $user_id
     * @return mixed
     */
    public function getUserNotificationCount($user_id)
    {
        $con=$GLOBALS['con'];
        $sql="SELECT COUNT(notification_id) as cont FROM notification_user"
            . " WHERE user_id='$user_id' AND notification_status='1'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    /**
     * Get all unread notification given user
     * @param $user_id
     * @return mixed
     */
    public function getUnreadNotifications($user_id)
    {
        $con= $GLOBALS["con"];
        $sql="SELECT * FROM notification n, notification_user u "
            . "WHERE n.notification_id=u.notification_id  AND u.notification_status='1'"
            . " AND u.user_id='$user_id'";
        $result=$con->query($sql);
        return $result;
    }

    /**
     * Update notification status
     * @param $notification_id
     * @param $user_id
     * @return mixed
     */
    public function updateNotification($notification_id,$user_id)
    {
        $con=$GLOBALS['con'];
        $sql="UPDATE notification_user SET notification_status='0' WHERE user_id='$user_id' AND notification_id='$notification_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    /**
     * Get all notification
     * @param $user_id
     * @return mixed
     */
    public function allNotifications()
    {

        $con=$GLOBALS['con'];
        $sql="SELECT * FROM notification";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function displayAllNotifications($user_id)
    {

        $con=$GLOBALS['con'];
        $sql="SELECT * FROM notification_user WHERE user_id='$user_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }


}