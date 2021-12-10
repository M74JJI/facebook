<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['useridMsg'])){
    $userid = $_POST['useridMsg'];
    $chatid=$_POST['chatid'];
    $msg=$_POST['msg'];
    $a7a=$loadUser->getUserInfo($chatid);
    $online=$loadUser->getOnlineStatus($chatid,$userid);
    

    if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'receiver'=>$chatid,'status'=>2,'messageAt'=>date('Y-m-d H:i:s')));
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'status'=>1,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }else{
        
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'status'=>0,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }
    
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
exit;
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
    <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
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
if(isset($_POST['messageImages'])){
    $userid = $_POST['messageImages'];
    $chatid=$_POST['chatid'];
    $msg=$_POST['msg'];
    $images=$_POST['images'];
    $a7a=$loadUser->getUserInfo($chatid);
    $online=$loadUser->getOnlineStatus($chatid,$userid);


    if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'receiver'=>$chatid,'status'=>2,'images'=>$images,'messageAt'=>date('Y-m-d H:i:s')));
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'status'=>1,'receiver'=>$chatid,'images'=>$images,'messageAt'=>date('Y-m-d H:i:s')));
    }else{
        
        $loadUser->create('messages',array('message'=>$msg,'sender'=>$userid,'status'=>0,'receiver'=>$chatid,'images'=>$images,'messageAt'=>date('Y-m-d H:i:s')));
    }
    
    $messageData = $loadPost->messageData($userid,$chatid);
     foreach ($messageData as $i => $message){
        if($message->user_id == $userid){ ?>
<div class="mess_right">
    <!---Start--------------------------------mssssg------>
    <?php 
                if($message->images =='' && $message->message !=''){
                    echo '<div class="mssssg">'.$message->message.'</div>';
                }else if($message->images != '' && $message->message==''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?>
    <div class="images_in_messages_1">
        <img src="<?php echo $images[0]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==2){
                        ?>
    <div class="images_in_messages_2">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==3){
                        ?>
    <div class="images_in_messages_3">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==4){
                        ?>
    <div class="images_in_messages_4">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
        <img src="<?php echo $images[3]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==5){
                        ?>
    <div class="images_in_messages_5">
        <div class="images_in_flex_2">
            <img src="<?php echo $images[0]->name ?>" alt="">
            <img src="<?php echo $images[1]->name ?>" alt="">
        </div>
        <div class="images_in_flex_3">
            <img src="<?php echo $images[2]->name ?>" alt="">
            <img src="<?php echo $images[3]->name ?>" alt="">
            <img src="<?php echo $images[4]->name ?>" alt="">
        </div>
    </div>
    <?php 
                    }
                    else {
                        ?>
    <div class="images_in_messages_6">
        <?php
                   foreach ($images as $img){
                       ?>
        <img src="<?php echo $img->name ?>" alt="">
        <?php
                   }
                   ?>

    </div>
    <?php 
                    }
                    
                }else if($message->message !='' && $message->images !=''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?>
    <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_1">
        <img src="<?php echo $images[0]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==2){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_2">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==3){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_3">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==4){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_4">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
        <img src="<?php echo $images[3]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==5){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_5">
        <div class="images_in_flex_2">
            <img src="<?php echo $images[0]->name ?>" alt="">
            <img src="<?php echo $images[1]->name ?>" alt="">
        </div>
        <div class="images_in_flex_3">
            <img src="<?php echo $images[2]->name ?>" alt="">
            <img src="<?php echo $images[3]->name ?>" alt="">
            <img src="<?php echo $images[4]->name ?>" alt="">
        </div>
    </div>
    <?php 
                    }
                    else {
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_6">
        <?php
                   foreach ($images as $img){
                       ?>
        <img src="<?php echo $img->name ?>" alt="">
        <?php
                   }
                   ?>

    </div>
    <?php 
                    }
                }
                ?>


    <!---End-------------------------------------->
    <?php



                if($i<count($messageData)-1 && strtotime($message->messageAt) - strtotime($messageData[$i+1]->messageAt)>-5000){
                    ?>
    <div class="timeit"><?php echo $loadUser->timeAgoAlt($message->messageAt) ?></div>

    <?php }else{}
                    if($lastMessage->msg_id == $message->msg_id && $i==count($messageData)-1){
                ?>
    <div class="update_seen_or" data-chat="<?php echo $chatid ?>">
        <?php
                    if($lastMessage->status ==0){
                        ?>
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
        <?php
                    }else if($lastMessage->status==1){
                        ?>
        <div class="not_seen">
            <svg fill="#cdd0d3" height="14px" width="14px" viewBox="2 2 20 20" role="img"
                xmlns="http://www.w3.org/2000/svg">
                <title>Delivered</title>
                <path
                    d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm5.219 8-6.019 6.016a1 1 0 0 1 -1.414 0l-3.005-3.008a1 1 0 1 1 1.419-1.414l2.3 2.3 5.309-5.31a1 1 0 1 1 1.41 1.416z">
                </path>
            </svg>
        </div>
        <?php
                    }else if($lastMessage->status==2){
                        ?>
        <div class="not_seen">
            <img class="seen_message" src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="">
        </div>
        <?php
                    }
                     
                     ?>
    </div>
    <?php } ?>
</div>

<?php  }else{ ?>

<div class="mess_left">
    <!---Start--------------------------------mssssg------>
    <?php 
                if($message->images =='' && $message->message !=''){
                    echo '<img class="p45545_img" src='.$message->profile_picture.'><div class="mssssg1">'.$message->message.'</div>';
                }else if($message->images != '' && $message->message==''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?>
    <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_1">
        <img src="<?php echo $images[0]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==2){
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_2">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==3){
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_3">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==4){
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_4">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
        <img src="<?php echo $images[3]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==5){
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_5">
        <div class="images_in_flex_2">
            <img src="<?php echo $images[0]->name ?>" alt="">
            <img src="<?php echo $images[1]->name ?>" alt="">
        </div>
        <div class="images_in_flex_3">
            <img src="<?php echo $images[2]->name ?>" alt="">
            <img src="<?php echo $images[3]->name ?>" alt="">
            <img src="<?php echo $images[4]->name ?>" alt="">
        </div>
    </div>
    <?php 
                    }
                    else {
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div class="images_in_messages_6">
        <?php
                   foreach ($images as $img){
                       ?>
        <img src="<?php echo $img->name ?>" alt="">
        <?php
                   }
                   ?>

    </div>
    <?php 
                    }
                    
                }else if($message->message !='' && $message->images !=''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?> <img class="p45545_img" src="<?php echo $message->profile_picture ?>" alt="">
    <div>
        <div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
            <?php echo $message->message ?></div>
        <div class="images_in_messages_1">
            <img src="<?php echo $images[0]->name ?>" alt="">
        </div>
    </div>
    <?php 
                    }
                    else if(count($images)==2){
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_2">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==3){
                        ?><div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_3">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==4){
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_4">
        <img src="<?php echo $images[0]->name ?>" alt="">
        <img src="<?php echo $images[1]->name ?>" alt="">
        <img src="<?php echo $images[2]->name ?>" alt="">
        <img src="<?php echo $images[3]->name ?>" alt="">
    </div>
    <?php 
                    }
                    else if(count($images)==5){
                        ?><div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_5">
        <div class="images_in_flex_2">
            <img src="<?php echo $images[0]->name ?>" alt="">
            <img src="<?php echo $images[1]->name ?>" alt="">
        </div>
        <div class="images_in_flex_3">
            <img src="<?php echo $images[2]->name ?>" alt="">
            <img src="<?php echo $images[3]->name ?>" alt="">
            <img src="<?php echo $images[4]->name ?>" alt="">
        </div>
    </div>
    <?php 
                    }
                    else {
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-bottom:5px">
        <?php echo $message->message ?></div>
    <div class="images_in_messages_6">
        <?php
                   foreach ($images as $img){
                       ?>
        <img src="<?php echo $img->name ?>" alt="">
        <?php
                   }
                   ?>

    </div>
    <?php 
                    }
                }
                ?>


    <!---End-------------------------------------->


</div>

<?php  }
        ?>


<?php  } ?>
<?php
exit;
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