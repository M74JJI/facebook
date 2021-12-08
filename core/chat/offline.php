<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['offlinechatid'])){
$userid=$_POST['userid'];
$chatid=$_POST['offlinechatid'];


$loadUser->updateOnlineMsg0($userid,$chatid);


}