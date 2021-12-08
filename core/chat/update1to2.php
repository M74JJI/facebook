<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['update1to2'])){
    $userid=$_POST['update1to2'];
    $chatid=$_POST['chatid'];

    $loadUser->getLastMsgSendByUser($userid,$chatid);


}

?>