<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['nickname'])){
   $chatid=$_POST['nickname'];
   $userid=$_POST['userid'];
   $chat=$loadUser->getUserInfo($chatid);
   $user=$loadUser->getUserInfo($userid);
   $check=$loadUser->checkNickname($userid,$chatid);
   if($check->total !=0){
       $nickname=$loadUser->getNicknames($userid,$chatid);
   }
   ?>
<div class="exit_nickname">
    <i class="zfzfzfzfkzpofgj"></i>
</div>
<div class="nicknames_header">
    Nicknames
</div>
<div class="nicknames_body">
    <div class="nickname_item" id="nickname_item_chat" data-chat="<?php echo $chat->user_id ?>"
        data-user="<?php echo $user->user_id ?>">
        <div class="nick_left">
            <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="">
            <div class="nick_col">
                <?php
                if($check->total == 0){
                    echo "<span>Add nickname</span>";
                }else{ 
                    if($nickname->chat_nickname != ''){
                ?> <span><?php echo $nickname->chat_nickname ?></span>
                <?php }else{
                    echo "<span>Add nickname</span>";
                }
            }
                ?>
                <span><?php echo $chat->first_name.' '.$chat->last_name ?></span>
            </div>

        </div>
        <div class="nick_right">
            <i class="edito_icona"></i>
        </div>
    </div>

    <div class="nickname_item" id="nickname_item_user" data-chat="<?php echo $chat->user_id ?>"
        data-user="<?php echo $user->user_id ?>">
        <div class="nick_left">
            <img src="<?php echo BASE_URL.$user->profile_picture ?>" alt="">
            <div class="nick_col">
                <?php
                if($check->total == 0){
                    echo "<span>Add nickname</span>";
                }else{ 
                    if($nickname->user_nickname != ''){
                ?> <span><?php echo $nickname->user_nickname ?></span>
                <?php }else{
                    echo "<span>Add nickname</span>";
                }
            }
                ?>
                <span><?php echo $user->first_name.' '.$user->last_name ?></span>
            </div>
        </div>
        <div class="nick_right">
            <i class="edito_icona"></i>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#nickname_item_chat', function() {
    $(this).removeClass().addClass('nickname_item1').html(
        '<div class="nick_left"> <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt=""> <div class="nick_col"> <input type="text" placeholder="Add Nickname" id="chat_nickname"> </div></div><div class="nick_right" id="submit_chat_nick"> <i class="sub_iconaka"></i></div>'
    );
    $(this).find('input').focus()
})

$(document).on('click', '#nickname_item_user', function() {
    $(this).removeClass().addClass('nickname_item1').html(
        '<div class="nick_left"> <img src="<?php echo BASE_URL.$user->profile_picture ?>" alt=""> <div class="nick_col"> <input id="user_nickname" type="text" placeholder="Add Nickname"> </div></div><div class="nick_right" id="submit_user_nick"> <i class="sub_iconaka"></i></div>'
    );
    $(this).find('input').focus()
})


$(document).mouseup(function(e) {
    var container = new Array();

    container.push('#nickname_item_chat');
    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(this).removeClass().addClass('nickname_item').html(
                ' <div class="nick_left"> <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt=""> <div class="nick_col"> <span>Add nickname</span> <span><?php echo $chat->first_name.' '.$chat->last_name ?></span> </div> </div> <div class="nick_right"> <i class="edito_icona"></i> </div>'
            );

        }
    })
})
$(document).mouseup(function(e) {
    var container = new Array();

    container.push('#nickname_item_user');
    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(this).removeClass().addClass('nickname_item').html(
                ' <div class="nick_left"> <img src="<?php echo BASE_URL.$user->profile_picture ?>" alt=""> <div class="nick_col"> <span>Add nickname</span> <span><?php echo $user->first_name.' '.$user->last_name ?></span> </div> </div> <div class="nick_right"> <i class="edito_icona"></i> </div>'
            );

        }
    })
})



//---->submit 

$(document).on('click', '#submit_chat_nick', function() {
    var chat = $('#nickname_item_chat').data('chat');
    var user = "<?php echo $userid ?>"
    var chat_nickname = $('#chat_nickname').val();
    $.post('http://localhost/facebook/core/chat/submitNickname.php', {
        submi_chat_nick: chat,
        userid: user,
        chat_nickname: chat_nickname,
    }, function(data) {
        console.log(data)
        $('#nickname_item_chat').removeClass().addClass('nickname_item').html(
            ' <div class="nick_left"> <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt=""> <div class="nick_col"> <span>' +
            chat_nickname +
            '</span> <span><?php echo $chat->first_name.' '.$chat->last_name ?></span> </div> </div> <div class="nick_right"> <i class="edito_icona"></i> </div>'
        );
    })
})
$(document).on('click', '#submit_user_nick', function() {
    var chat = $('#nickname_item_user').data('chat');
    var user = "<?php echo $userid ?>"
    var chat_nickname = $('#user_nickname').val();
    $.post('http://localhost/facebook/core/chat/submitNickname.php', {
        submi_user_nick: chat,
        userid: user,
        chat_nickname: chat_nickname,
    }, function(data) {
        console.log(data)
        $('#nickname_item_user').removeClass().addClass('nickname_item').html(
            ' <div class="nick_left"> <img src="<?php echo BASE_URL.$user->profile_picture ?>" alt=""> <div class="nick_col"> <span>' +
            chat_nickname +
            '</span> <span><?php echo $user->first_name.' '.$user->last_name ?></span> </div> </div> <div class="nick_right"> <i class="edito_icona"></i> </div>'
        );
    })
})
</script>

<?php 
}