<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['delete_chat'])){
$chatid=$_POST['delete_chat'];
$userid=$_POST['userid'];

$loadUser->deleteAllChat($userid,$chatid);

}