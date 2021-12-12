<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['reactmsg'])){
    $msg=$_POST['reactmsg'];
    $react=$_POST['react'];
    $userid=$_POST['userid'];
    $message=$loadUser->getMessageById($msg);

    if($message->sender == $userid){
     $loadUser->messageReactSender($msg,$react);
    }else{
        
        $loadUser->messageReactReceiver($msg,$react);
    }
  
  
}