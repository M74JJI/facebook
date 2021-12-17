<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['check_for_calls'])){
    $userid=$_POST['check_for_calls'];
   $call= $loadUser->checkForCalls($userid);

   if($call !='' ){
       $info=$loadUser->getUserInfo($call->call_user);
      ?>

<div class="calls_exit">
    <i class="zfzfzfzfkzpofgj"></i>
</div>
<div class="calls_header">
    Incoming video chat
</div>
<div class="caller_infos">
    <img src="<?php echo BASE_URL.$info->profile_picture ?>" alt="">
    <div class="call_col_flex">
        <div class="caller_text"><?php echo $info->first_name.' '.$info->last_name ?> is calling you.</div>
        <div class="caller_caption">The call will start as soon as you answer.</div>
    </div>
</div>
<div class="calling_repond_decline">
    <a href="" class="decline_call_link">Decline</a>
    <button id="accept_call" data-username="<?php echo $info->user_id ?>" data-chat="<?php echo $info->user_id ?>"
        class="accept_call_btn">
        <i class="respond_video_icon"></i> Accept
    </button>
</div>
<?php
      
   }else{
       exit;
   }
}

if(isset($_POST['createCall'])){
    $userid=$_POST['createCall'];
    $chatid=$_POST['chat'];
    $check=$loadUser->checkCallexist($userid,$chatid);
    if($check->total ==0){
        $loadUser->create('calls',array('call_user'=>$userid,'call_chat'=>$chatid,'call_status'=>1));
    }else{
        $loadUser->sendCall($userid,$chatid);
    }
}
if(isset($_POST['checkBeforeSendCall'])){
    $userid=$_POST['checkBeforeSendCall'];
    $check=$loadUser->checkBeforeSendCall($userid);
    if($check->total !=0){
        echo 'exists';
    }
}