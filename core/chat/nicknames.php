<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['nickname'])){
   $chatid=$_POST['nickname'];
   $userid=$_POST['userid'];
   $chat=$loadUser->getUserInfo($chatid);
   $user=$loadUser->getUserInfo($userid);
   ?>
<div class="nicknames_header">
    Nicknames
</div>
<div class="nicknames_body">
    <div class="nickname_item">
        <div class="nick_left">
            <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="">
            <div class="nick_col">
                <span>Add nickname</span>
                <span><?php echo $chat->first_name.' '.$chat->last_name ?></span>
            </div>
        </div>
        <div class="nick_right">
            <i class="edito_icona"></i>
        </div>
    </div>
    <div class="nickname_item">
        <div class="nick_left">
            <img src="<?php echo BASE_URL.$user->profile_picture ?>" alt="">
            <div class="nick_col">
                <span>Add nickname</span>
                <span><?php echo $user->first_name.' '.$user->last_name ?></span>
            </div>
        </div>
        <div class="nick_right">
            <i class="edito_icona"></i>
        </div>
    </div>
</div>
<?php 
}