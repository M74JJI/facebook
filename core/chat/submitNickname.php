<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['submi_chat_nick'])){
    $chatid=$_POST['submi_chat_nick'];
    $userid=$_POST['userid'];
    $chat_nickname=$_POST['chat_nickname'];
    $check=$loadUser->checkNickname($userid,$chatid);
    if($check->total ==0){
        $loadUser->create('nicknames',array('chat_nickname'=>$chat_nickname,'user_id'=>$userid,'chat_id'=>$chatid));
        $loadUser->create('nicknames',array('user_nickname'=>$chat_nickname,'user_id'=>$chatid,'chat_id'=>$userid));
    }else{
            $nickname=$loadUser->getNicknames($userid,$chatid);
            if($nickname->user_nickname == ''){
                $loadUser->updateChatNickname($userid,$chatid,$chat_nickname);
  
            }else if($nickname->chat_nickname == ''){
                $loadUser->updateChatNickname2($userid,$chatid,$chat_nickname);
            }else{
                $loadUser->updateChatNickname2($userid,$chatid,$chat_nickname);
            }
    }
    


}
if(isset($_POST['submi_user_nick'])){
    $chatid=$_POST['submi_user_nick'];
    $userid=$_POST['userid'];
    $chat_nickname=$_POST['chat_nickname'];
    $check=$loadUser->checkNickname($userid,$chatid);
    if($check->total ==0){
        $loadUser->create('nicknames',array('user_nickname'=>$chat_nickname,'user_id'=>$userid,'chat_id'=>$chatid));
        $loadUser->create('nicknames',array('chat_nickname'=>$chat_nickname,'user_id'=>$chatid,'chat_id'=>$userid));
    }else{
            $nickname=$loadUser->getNicknames($userid,$chatid);
            if($nickname->chat_nickname == ''){
                $loadUser->updateChatNickname($userid,$chatid,$chat_nickname);
  
            }else if($nickname->user_nickname == ''){
                $loadUser->updateChatNickname2($chatid,$userid,$chat_nickname);
            }else{
                $loadUser->updateChatNickname2($chatid,$userid,$chat_nickname);
            }
    }
    


}