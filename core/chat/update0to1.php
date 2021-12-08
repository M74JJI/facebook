<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['update0to1'])){
    $userid=$_POST['update0to1'];

   $list = $loadUser->getChatList($userid);
    $loadUser->update0to1all($userid,$list);
    $loadUser->updateOnlinetoOffline($userid,$list);


}

?>