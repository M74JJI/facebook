<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['lghaleblahchatid'])){
$lghaleblahchatid=$_POST['lghaleblahchatid'];
$useri=$_POST['userid'];

$loadUser->bdlOkfOnline($userid,$lghaleblahchatid);



}

if(isset($_POST['lghaleblahchatid2'])){
$lghaleblahchatid=$_POST['lghaleblahchatid2'];
$useri=$_POST['userid'];

$loadUser->bdlOkfOnlinel0($userid,$lghaleblahchatid);



}

if(isset($_POST['resetOnlinat'])){
$useri=$_POST['resetOnlinat'];

$loadUser->rdOnline0kamlin($userid);



}