<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['refreshmsgs'])){
    $userid = $_POST['refreshmsgs'];
    $chatid=$_POST['chatid'];


    
    $messageData = $loadPost->messageData($userid,$chatid);
     foreach ($messageData as $i => $message){
        if($message->user_id == $userid){ ?>
<div class="mess_right">
    <div class="mssssg"><?php echo $message->message ?></div>
    <?php

        if($i<count($messageData)-1 && strtotime($message->messageAt) - strtotime($messageData[$i+1]->messageAt)>-5000){
            ?>
    <div class="timeit"><?php echo $loadUser->timeAgo($message->messageAt) ?></div>

    <?php }else{}
        ?>

</div>

<?php  }else{ ?>

<div class="mess_left">
    <img src="<?php echo $message->profile_picture ?>" alt="">
    <div class="mssssg1"><?php echo $message->message ?></div>
</div>

<?php  }
        ?>


<?php  } ?>
<?php
}





?>