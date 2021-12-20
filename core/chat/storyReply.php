<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['storyReply'])){
    $userid = $_POST['storyReply'];
    $chatid=$_POST['chatid'];
    $story_text=$_POST['story_text'];
    $reply_text=$_POST['reply_text'];
    $image=$_POST['image'];
    $a7a=$loadUser->getUserInfo($chatid);
    $online=$loadUser->getOnlineStatus($chatid,$userid);
    if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'images'=>$image,'isStory'=>1,'receiver'=>$chatid,'status'=>2,'messageAt'=>date('Y-m-d H:i:s')));
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'status'=>1,'images'=>$image,'isStory'=>1,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }else{
        
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'images'=>$image,'isStory'=>1,'status'=>0,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }
    
  
}