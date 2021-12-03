<?php

include '../load.php';
include '../../connect/login.php';

$userid=login::isLoggedIn();

if($_POST['regex']){
    $tag = implode($_POST['regex']);
    if(substr($tag,0,1) === '@'){
        $mention = str_replace('@','',$tag);
        $mention_user =$loadUser->getMentions($mention); 


        foreach($mention_user as $mention){
            ?>
<li dtat-profileid="<?php echo $mention->user_id ?>">
    <img src="<?php echo BASE_URL.$mention->profile_picture ?>" style="width:30px" alt="">
    <div class="mention_name" data-profileid="<?php echo $mention->user_id ?>"
        data-link=" <?php echo $mention->link ?>">
        <?php echo $mention->first_name.' '.$last_name ?>
    </div>
</li>

<?php
                }
    }

}


?>