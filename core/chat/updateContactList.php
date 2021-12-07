<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['updateContactList'])){

    $userid=$_POST['updateContactList'];
    $friends = $loadUser->getAllFriends($userid);
  
                        foreach ($friends as $friend){ ?>
<div class="contact_tochat" data-chatid="<?php echo $friend->user_id ?>">
    <img src="<?php echo BASE_URL.$friend->profile_picture ?>" alt="">
    <span> <?php echo $friend->first_name.' '.$friend->last_name ?></span>
    <?php
                            if(time() - strtotime($friend->last_activity)>2){
                                if(strlen($loadUser->timeAgoAlt($friend->last_activity))<4){
                                    ?>
    <div class="online_tag" style="width:20px">
        <span><?php echo $loadUser->timeAgoAlt($friend->last_activity) ?></span>
    </div>
    <?php
                                }else{
                                    ?>
    <div class="online_tag">
        <span><?php echo $loadUser->timeAgoAlt($friend->last_activity) ?></span>
    </div>
    <?php
                                }
                            }else{ ?>
    <div class="online_tag" style="width:15px;height:15px;left:1.8rem">
        <div class="green_round_point"></div>
    </div>
    <?php }
                            ?>
</div>
<?php }
                        


}