<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['lastPersonId'])){
    $lastPersonId = $_POST['lastPersonId'];
    $userid = $_POST['userid'];
    $messageData = $loadPost->messageData($userid,$lastPersonId);
   
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
/* <?php echo $message->message ?> */


if(isset($_POST['getuserid'])){
$userid = $_POST['getuserid'];

$allusers=$loadPost->lastmessages($userid);


foreach($allusers as $user){
$length = strlen($user->message);
?>

<li class="msg_username" data-profileid="<?php echo $user->user_id ?>">
    <div class="msg_contcat">
        <img class="l3adab_asahbi_img" src="<?php echo $user->profile_picture ?>" alt="">
        <div class="contact_col">
            <div class="contact_name"><?php echo $user->first_name.' '.$user->last_name ?></div>
            <div class="contact_msg"><?php echo (($length>40) ? substr($user->message,0,40).'...' : $user->message ) ?>
            </div>
        </div>
        <div class="contact_timeAgo"><?php echo $loadUser->timeAgoAlt($user->messageAt) ?></div>
        <div class="contact_tick">
            <svg fill="#bcc0c4" height="16px" width="16px" viewBox="2 2 20 20" role="img"
                xmlns="http://www.w3.org/2000/svg">
                <title>Delivered</title>
                <path
                    d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm5.219 8-6.019 6.016a1 1 0 0 1 -1.414 0l-3.005-3.008a1 1 0 1 1 1.419-1.414l2.3 2.3 5.309-5.31a1 1 0 1 1 1.41 1.416z">
                </path>
            </svg>
        </div>
    </div>

</li>

<?php

    }
}

?>