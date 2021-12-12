<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();
if(isset($_POST['forward_chat'])){

$chatid=$_POST['forward_chat'];
$userid=$_POST['userid'];
$msg=$_POST['msg'];
$a7a=$loadUser->getUserInfo($chatid);
$online=$loadUser->getOnlineStatus($chatid,$userid);
$message=$loadUser->getMessageById($msg);
$checkforward=$loadUser->checkIfForwardRecentExists($userid,$chatid);

if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
    $id = $loadUser->create('messages',array('message'=>$message->message,'images'=>$message->images,'sender'=>$userid,'receiver'=>$chatid,'status'=>2,'messageAt'=>date('Y-m-d
    H:i:s')));
     if($checkforward->total==0){
         $loadUser->create('recentForward',array('molchi_id'=>$userid,'recent_id'=>$chatid,'createdAt'=>date('Y-m-d H:i:s')));
     }else if($checkforward->total>0){
        $laodUser->updateRecentForwards($userid,$chatid);
     } 
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $id=$loadUser->create('messages',array('message'=>$message->message,'images'=>$message->images,'sender'=>$userid,'status'=>1,'receiver'=>$chatid,'messageAt'=>date('Y-m-d
        H:i:s')));
        if($checkforward->total==0){
            $loadUser->create('recentForward',array('molchi_id'=>$userid,'recent_id'=>$chatid,'createdAt'=>date('Y-m-d H:i:s')));
        }else if($checkforward->total>0){
           $laodUser->updateRecentForwards($userid,$chatid);
        } 
        }else{

        $id=$loadUser->create('messages',array('message'=>$message->message,'images'=>$message->images,'sender'=>$userid,'status'=>0,'receiver'=>$chatid,'messageAt'=>date('Y-m-d
        H:i:s')));
        if($checkforward->total==0){
            $loadUser->create('recentForward',array('molchi_id'=>$userid,'recent_id'=>$chatid,'createdAt'=>date('Y-m-d H:i:s')));
        }else if($checkforward->total>0){
           $loadUser->updateRecentForwards($userid,$chatid);
        } 
        }
     echo $id;
        }

        if(isset($_POST['delete_message'])){
            $msg=$_POST['delete_message'];
            $userid=$_POST['userid'];
            $loadUser->delete('messages',array('msg_id'=>$msg));
        } 
        if(isset($_POST['updateRecent'])){
            $userid=$_POST['updateRecent'];
            $recentForwards=$loadUser->getRecentForwards($userid);
            ?><div class="forwad_list_contacts_header">
    Recent
</div><?php
            foreach($recentForwards as $recent){
                ?>
<div class="forward_friend_item" data-chat="<?php echo $recent->user_id ?>" data-msg="<?php echo $msg ?>">
    <div class="forward_friend_it_left">
        <img src="<?php echo $recent->profile_picture ?>" alt="">
        <span><?php echo $recent->first_name.' '.$recent->last_name ?></span>
    </div>
    <button class="forward_send" id="forward_sendd">Send</button>
</div>
<?php
              }
        }