<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['refreshmsgs'])){
    $userid = $_POST['refreshmsgs'];
    $chatid=$_POST['chatid'];
  
    $messageData = $loadPost->messageData($userid,$chatid);
    $chat=$loadUser->getUserInfo($chatid);   
    ?>
<div class="ar27_h">
    <img src="<?php echo $chat->profile_picture ?>" alt="">
    <div class="h27_name" style="word-break:keep-all"><?php echo $chat->first_name.' '.$chat->last_name ?></div>
    <div class="h23_det">
        You're friends on Facebook

    </div>
    <div class="h23_det">Lives in Branes, Tanger, Morocco
    </div>
    <div class="h23_det">Studied Cybersecurity & Cybercrime at ENSA de Tanger
    </div>

</div>
<div class="messaging_popup" data-count="<?php echo count($messageData) ?>" data-chat="<?php echo $chatid; ?>"> <?php foreach ($messageData as $i => $message){
                if($message->user_id == $userid){ ?> <div class="mess_right">
        <div class="mssssg"><?php echo $message->message ?></div>
        <?php

                if($i<count($messageData)-1 && strtotime($message->messageAt) - strtotime($messageData[$i+1]->messageAt)>-5000){
                    ?>
        <div class="timeit"><?php echo $loadUser->timeAgoAlt($message->messageAt) ?></div>

        <?php }else{}
                ?>
        <?php
                if($i==count($messageData)-1 && time() - strtotime($chat->last_activity)>2){ ?>
        <div class="not_seen">
            <svg fill="#cdd0d3" height="14px" width="14px" viewBox="2 2 20 20" role="img"
                data-testid="message_delivery_state_sent" xmlns="http://www.w3.org/2000/svg">
                <title>Sent</title>
                <path
                    d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm0 18.5a8.5 8.5 0 1 1 8.5-8.5 8.51 8.51 0 0 1 -8.5 8.5z">
                </path>
                <path
                    d="m15.982 8.762-5.482 5.487-2.482-2.478a.75.75 0 0 0 -1.06 1.06l3.008 3.008a.748.748 0 0 0 1.06 0l6.016-6.016a.75.75 0 0 0 -1.06-1.061z">
                </path>
            </svg>

        </div>
        <?php }else if($i==count($messageData)-1 && time() - strtotime($chat->last_activity)<2 && $message->status == 0){ ?>
        <div class="not_seen">
            <svg fill="#cdd0d3" height="14px" width="14px" viewBox="2 2 20 20" role="img"
                xmlns="http://www.w3.org/2000/svg">
                <title>Delivered</title>
                <path
                    d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm5.219 8-6.019 6.016a1 1 0 0 1 -1.414 0l-3.005-3.008a1 1 0 1 1 1.419-1.414l2.3 2.3 5.309-5.31a1 1 0 1 1 1.41 1.416z">
                </path>
            </svg>
        </div>

        <?php } else if($message->status ==1 && $i==count($messageData)-1 ){  ?>
        <div class="not_seen">
            <img class="seen_message" src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="">
        </div>
        <?php }
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

</div>




<?php
}
?>