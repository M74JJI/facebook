<?php

include '../load.php';
include '../../connect/login.php';


$userid= login::isLoggedIn();

if(isset($_POST['userupdateNotifications'])){
    $userid= $_POST['userupdateNotifications'];
    $notifications=$loadUser->notificationsTotal($userid);
    echo count($notifications); 
}
if(isset($_POST['notifications'])){
    $userid= $_POST['notifications'];

    $loadUser->notificationsReset($userid);
}
if(isset($_POST['updateNotifications'])){
    $userid= $_POST['updateNotifications'];
    $profileid= $_POST['profileid'];
    $postid= $_POST['postid'];
    $notificationid=$_POST['notificationid']; 
    $loadUser->updateNotificationStatus($userid,$notificationid);
}

?>