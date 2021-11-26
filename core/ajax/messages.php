<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['getuserid'])){
    $userid = $_POST['getuserid'];

    $allusers=$loadPost->lastmessages($userid);


    foreach($allusers as $user){ ?>
<li class="msg_username" data-profileid="<?php echo $user->user_id ?>">
    <?php echo $user->firt_name ?>
</li>

<?php

    }
}

?>