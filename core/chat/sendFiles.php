<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['sendFiles'])){
    $files=$_POST['sendFiles'];
    $text=$_POST['text'];
    $chatid=$_POST['chat'];
    $userid=$_POST['userid'];
    $a7a=$loadUser->getUserInfo($chatid);
    $online=$loadUser->getOnlineStatus($chatid,$userid);
    

    if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
        $loadUser->create('messages',array('message'=>$text,'sender'=>$userid,'receiver'=>$chatid,'status'=>2,'files'=>$files,'messageAt'=>date('Y-m-d H:i:s')));
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $loadUser->create('messages',array('message'=>$text,'sender'=>$userid,'status'=>1,'files'=>$files,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }else{
        
        $loadUser->create('messages',array('message'=>$text,'sender'=>$userid,'status'=>0,'files'=>$files,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }
    

}