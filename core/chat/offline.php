<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['offlinechatid'])){
$userid=$_POST['userid'];
$chatid=$_POST['offlinechatid'];
$msg=$loadUser->getLastMsgSendByUser($userid,$chatid);

$loadUser->updateOnlineMsg0($msg->msg_id);
echo $msg->msg_id;

}