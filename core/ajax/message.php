<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['useridMsg'])){
    $userid = $_POST['useridMsg'];
    $chatid=$_POST['chatid'];
    $msg=$_POST['msg'];


    $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    $messageData = $loadPost->messageData($userid,$chatid);
   
    foreach($messageData as $message){
       
       if($message->sender ==$userid){ ?>
<div class="msg_sender">
    <div class="actual_msg">
        <?php echo $message->message ?>
        <div class="msg_time1">
            <?php echo $loadUser->timeAgoAlt($message->messageAt) ?>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="msg_receiver">
    <img src="<?php echo $message->profile_picture ?>" alt="">
    <div class="actual_msg1">
        <?php echo $message->message ?>
        <div class="msg_time2">
            <?php echo $loadUser->timeAgoAlt($message->messageAt) ?>
        </div>
    </div>

</div>
<?php }
}
}

if(isset($_POST['showmsg'])){
    $chatid = $_POST['showmsg'];
    $userid=$_POST['yourid'];

    $messageData = $loadPost->messageData($userid,$chatid);

    echo '<div class="past-data-count" data-datacount="'.count($messageData).'"></div>';
   
    foreach($messageData as $message){
       
       if($message->sender ==$userid){ ?>
<div class="msg_sender">
    <div class="actual_msg" style="float:right">
        <?php echo $message->message ?>
        <div class="msg_time1">
            <?php echo $loadUser->timeAgoAlt($message->messageAt) ?>
        </div>
    </div>
</div><br>
<?php }else{ ?>
<div class="msg_receiver">
    <img src="<?php echo $message->profile_picture ?>" alt="">
    <div class="actual_msg1">
        <?php echo $message->message ?>
        <div class="msg_time2">
            <?php echo $loadUser->timeAgoAlt($message->messageAt) ?>
        </div>
    </div>

</div>
<?php }
}  
}
if(isset($_POST['dataCount'])){
    $chatid = $_POST['dataCount'];
    $userid=$_POST['profileid'];
    $messageData = $loadPost->messageData($userid,$chatid);
    echo count($messageData);
 
}



?>