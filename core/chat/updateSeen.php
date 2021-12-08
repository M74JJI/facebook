<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['update_seen'])){

    $chatid=$_POST['update_seen'];
    $messageData = $loadPost->messageData($userid,$chatid);
    $chat=$loadUser->getUserInfo($chatid);  
    $length=count($messageData); 

    $lastMessage = $loadUser->getLastMsgSendByUser($userid,$chatid);
    $online = (strtotime(time())-$chat->last_activity)< 2  ? true : false; 


    if($online == false){
        
    }


}
?>