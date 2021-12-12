<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['forward'])){
   $chatid=$_POST['forward'];
   $userid=$_POST['userid'];
   $msg=$_POST['msg'];
   $user=$loadUser->getUserInfo($userid);
   $friends=$loadUser->getAllFriends($userid);
 
   $recentForwards=$loadUser->getRecentForwards($userid);
   if(count($recentForwards) !=0){
       echo '<div class="forward_recent"> <div class="forwad_list_contacts_header">
                Recent
            </div>';
    foreach($recentForwards as $recent){
      ?>
<div class="forward_friend_item" data-chat="<?php echo $recent->user_id ?>" data-msg="<?php echo $msg ?>">
    <div class="forward_friend_it_left">
        <img src="<?php echo $recent->profile_picture ?>" alt="">
        <span><?php echo $recent->first_name.' '.$recent->last_name ?></span>
    </div>
    <button class="forward_send" id="forward_sendd1">Send</button>
</div>
<?php
    }
    echo '</div>';
  }else{}
  echo '<div class="forward_friends"> <div class="forwad_list_contacts_header">
  Contacts
</div>';
   foreach($friends as $friend){
       ?>
<div class="forward_friend_item" data-chat="<?php echo $friend->user_id ?>" data-msg="<?php echo $msg ?>">
    <div class="forward_friend_it_left">
        <img src="<?php echo $friend->profile_picture ?>" alt="">
        <span><?php echo $friend->first_name.' '.$friend->last_name ?></span>
    </div>
    <button class="forward_send" id="forward_sendd">Send</button>
</div>





<?php 
        }
        echo '</div>';

        }