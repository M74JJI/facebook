<?php 

include '../load.php';
include '../../connect/login.php';

$userid=login::isLoggedIn();
$allusers = $loadPost->lastmessages($userid);


foreach ($allusers as $last){ 


    if($last->seqnum==1){

   

    if($last->receiver != $userid){ 
     $infos= $loadUser->getUserInfo($last->receiver);
    }
     else{ 

         $infos= $loadUser->getUserInfo($last->sender);
     }
     ?>
<div class="ms74g" data-userid="<?php echo $userid ?>" data-chat="<?php echo $infos->user_id ?>">
    <div class="ty415">
        <img src="<?php echo $infos->profile_picture ?>" alt="">
    </div>
    <div class="tx45">
        <span class="name_145454545"><?php echo $infos->first_name.' '.$infos->last_name ?></span>
        <span
            style="font-size:12px;color:#65676b;display:flex;align-items:center"><?php echo $loadUser->timeAgoAlt($last->messageAt) ?>
            <div style="color:#000;padding:2px;font-weight:600"> . </div><?php echo $last->message ?>
        </span>

    </div>

</div>

<?php }
        }

?>