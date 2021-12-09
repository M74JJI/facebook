<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['chat_count'])){
    $userid=$_POST['chat_count'];
    $list = $loadUser->getChatList($userid); 
    $listed = $loadUser->getChatListWithCount($userid,$list); 
    echo json_encode($listed);
  
}

if(isset($_POST['checkChatChanges'])){
    $userid=$_POST['checkChatChanges'];
    $chat=$_POST['chat'];
    $total=$_POST['totall'];
    $count=$loadUser->checkChatChanges($userid,$chat);
    
    $info=array();
    $info[0]['chat']=$chat;
    $info[0]['total']=$total;
    $info[0]['count']=$count->total;


    echo json_encode($info);

  
}