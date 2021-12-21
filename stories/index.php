<?php
include '../connect/login.php';
include '../core/load.php';
$uuid='';
$userStory='';
$numStory=0;
if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
   $userInfo= $loadUser->getUserInfo($userid);
   $myStory= $loadUser->myStory($userid);
}else{
    header('Location:login.php');
}
if(!empty($_GET["uid"])){
  $numStory=$_GET["uid"];
}
if(!empty($_GET["uuid"])){
        $userStory=$_GET["uuid"];
       if($loadUser->checkIfStory($_GET['uuid'])->total == 0){
           $mol_story=$userid;
       }else{
        $mol_story=$_GET["uuid"];
       }
}else{
    $mol_story=$userid;
 
}
$userStories = $loadUser->getUserStories($mol_story);
$current_story=$userStories[0]->story_id;

if(!empty($_GET["uid"])){
    if($_GET["uid"]>0 && $_GET["uid"]<count($userStories)){
        $num_story=$_GET["uid"];
    }else{ 
        $num_story=0; 
    }
}else{
    $num_story=0;
}



$followingStories= $loadUser->getFollowingStories($userid,$mol_story);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories</title>
    <link rel="stylesheet" href="../assets/css/stories.css">
</head>

<body>
    <div class="watch_story">
        <div class="left_stories" dir="RTL">
            <?php 
         if($myStory != [] && $mol_story !='' && $mol_story !=$userid){
             ?>
            <a class="full_height_left">
                <div class="left_story_card">
                    <?php
                    if($myStory[0]->story_bg !='' ){
                        ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$myStory[0]->story_bg ?>"
                        class="right_story_card_img">
                    <?php
                    }else if($myStory[0]->story_img !=''){
                        ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$myStory[0]->story_img ?>"
                        class="right_story_card_img">
                    <?php
                    }
                    ?>
                    <div class="start_typing_small"><?php echo $myStory[0]->story_text ?></div> <img src=<?php echo 'http://localhost/facebook/'.$myStory[0]->profile_picture
                     ?> alt="" class="story_peak_img">
                </div>
            </a>
            <?php
         }
         ?>

        </div>

        <div class="story_player"
            data-mol_story="<?php echo $userStories[0]->first_name.' '.$userStories[0]->last_name ?>"
            data-id="<?php echo $userStories[0]->story_id ?>" data-occ="0"
            data-uuid="<?php echo $userStories[0]->user_id ?>">
            <div class="story_bar_container"
                style="grid-template-columns: repeat(<?php echo count($userStories)  ?>,1fr);">
                <?php
               for($i=0;$i<count($userStories);$i++){
                   ?>
                <div class="story_bar" style="width:<?php echo 450/count($userStories).'px' ?>"
                    data-occ="<?php echo $i ?>"></div>
                <?php
               }
               ?>
            </div>
            <img src=" <?php echo 'http://localhost/facebook/'.$userStories[$num_story]->profile_picture ?>" alt=""
                class="story_rounded_blue">
            <img class="story_bg_img"
                src="<?php echo 'http://localhost/facebook/'.$userStories[$num_story]->story_bg ?>" alt="">
            <?php
                if($userStories[$num_story]->story_text !=''){
                    ?>
            <div class="story_text_play"><?php echo $userStories[$num_story]->story_text ?></div>
            <?php
                }
                ?>
            <div class="story_viewer_btn">
                <i class="up_s_view"></i>
                <div class="total_um_viewers_story">
                    <?php 
                    
                    if($userStories[$num_story]->viewers != ''){
                        $tmp=explode(',',$userStories[$num_story]->viewers);
                     array_pop($tmp);
                      $viewers=$loadUser->getStoryViewersInfosAndReacts($tmp); 
                    }
                    
                    ?>
                    <?php if(count($tmp) ==0 || $userStories[$num_story]->viewers == ''){
                        echo'No viewers';

                    }else if(count($tmp) ==1){
                        echo count($tmp).' viewer';
                    }else if(count($tmp) >1){
                        echo count($tmp).' viewers';
                    }
                     ?>

                </div>
            </div>
            <div class="viewers_infos_whity">
                <div class="close_story_viewers">
                    <i class="close_story_viewers_icon"></i>
                </div>
                <div class="close_story_viewers_header">Story Details
                </div>
                <div class="stories_infos_previews">
                    <div class="story_3215">
                        <img src="http://localhost/facebook/assets/images/stories/14.jpg" alt="" class="story_3215_bg">
                    </div>
                </div>
                <div class="view_total_with_icon">
                    <i class="view_icon_41545"></i>
                    <span>2 Viewers</span>
                </div>
                <ul class="list_infos_story_ul_infos">
                    <li>
                        <div style="display: flex;align-items:center;gap:10px">
                            <img class="img_preinf14" src="http://localhost/facebook/assets/images/stories/14.jpg"
                                alt="">
                            <div class="flex_col_preinf14">
                                <span>Abdel Dalo</span>
                                <span>Replied in mesenger</span>
                            </div>
                        </div>
                        <div></div>
                    </li>
                </ul>
            </div>
        </div>
        <?php
     if($userid != $uuid){
         ?>
        <div class="story_react_reply">
            <div class="story_input_wrap">
                <input data-mol_story="<?php echo $user ?>" id="story_reply_input" type="text" placeholder="Reply...">
                <i class="story_btn_sticker"></i>
                <i class="story_btn_send" id="story_reply_input_send"></i>
            </div>
            <div class="story_react_icons">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/like.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/love.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/heart.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/haha.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/wow.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/sad.png" alt="">
                <img class="story_react_icon" id="like-react-story"
                    src="<?php echo BASE_URL?>assets/images/stories/angry.png" alt="">
            </div>
        </div>
        <?php
     }
     ?>
        <div class="full_height_right">
            <div class="go_right_wrap">
                <i class="go_right_mate"></i>
            </div>
        </div>
        <div class="right_stories">
            <?php
            $k=0;
            foreach($followingStories as $story){           
                $count=count($loadUser->getUserStories($story[0]->story_user));          
                    ?>
            <a class="full_height" data-mol_story="<?php echo $story[0]->first_name.' '.$story[0]->last_name ?>"
                data-s_id="<?php echo $k ?>" data-count="<?php echo $count ?>"
                data-uuid="<?php echo $story[0]->user_id ?>" data-id="<?php echo $story[0]->story_id ?>">
                <div class="right_story_card">
                    <?php
                  if($story[0]->story_bg !=''){
                      ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story[0]->story_bg ?>"
                        class="right_story_card_img">
                    <?php
                  }else if($story[0]->story_img !=''){
                    ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story[0]->story_bg ?>"
                        class="right_story_card_img">
                    <?php
                  }if($story[0]->story_text !=''){
                      ?>
                    <div class="start_typing_small"><?php echo $story[0]->story_text ?></div>
                    <?php
                  }
                  ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story[0]->profile_picture ?>" alt=""
                        class="story_peak_img">
                </div>
            </a>
            <?php
                $k++;
            }
            ?>

        </div>
    </div>
</body>
<script src="../assets/js/jquery.js"></script>
<script>
var stories = [];

$(document).ready(function() {
    $.post('http://localhost/facebook/core/ajax/story.php', {
        get_all_stories: "<?php echo $userid ?>"
    }, function(data) {
        stories = JSON.parse(data);
        console.log(stories)

    })
})

$(document).on('click', '.full_height', function() {

    //----view story-->
    var story_id = $(this).data('id');
    var user = "<?php echo $userid ?>";
    var viewer = '' + user + ',';
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        viewStory: viewer,
        story_id: story_id
    }, function(data) {

    })
    //----view story-->
    var k = $(this).data('s_id');
    $('.story_player').attr('added', k);

    //lkhdma dyal lwst
    var wst_bg = $('.story_player').find('.story_bg_img').attr('src');
    var wst_text = $('.story_player').find('.story_text_play').text();
    var wst_profile_pic = $('.story_player').find('.story_rounded_blue').attr('src');
    $('.left_stories').prepend(
        '<a class="full_height_left"> <div class="left_story_card"> <img src=' + wst_bg +
        ' class="right_story_card_img"><div class="start_typing_small">' + wst_text +
        '</div> <img src=' + wst_profile_pic +
        ' alt="" class="story_peak_img"> </div></a>'
    )
    //lkhdma dyal lwst

    //lkhdma dyal limin
    var story_bg = $(this).find('.right_story_card_img').attr('src');
    var story_text = $(this).find('.start_typing_small').text();
    var story_peak_img = $(this).find('.story_peak_img').attr('src');
    var count = $(this).data('count');
    var mol_story = $(this).data('mol_story');
    var uuid = $(this).data('uuid');
    var story_id = $(this).data('id');
    var s_b = 450 / count;
    $('.story_bar_container').html('');
    $('.story_bar_container').css('grid-template-columns', 'repeat(' + count + ',1fr)');
    for (let i = 0; i < count; i++) {
        $('.story_bar_container').append('<div class="story_bar" data-occ=' + i + '></div>');
    }
    $('.story_bar').css('width', '' + s_b + '');
    //---7tha lwst--->
    $('.story_player').find('.story_bg_img').attr('src', story_bg);
    $('.story_player').attr('data-mol_story', mol_story);
    $('.story_player').attr('data-uuid', uuid);
    $('.story_player').attr('data-id', story_id);
    $('.story_player').find('.story_text_play').html(story_text);
    $('.story_rounded_blue').attr('src', story_peak_img);
    $('.story_rounded_blue').attr('mol_story', mol_story);
    //---7tha lwst--->


    for (let i = 0; i < k; i++) {
        if ($('.full_height[data-s_id=' + i + ']').length > 0) {
            var story_bg = $('.full_height[data-s_id=' + i + ']').find('.right_story_card_img').attr('src');
            var story_text = $('.full_height[data-s_id=' + i + ']').find('.start_typing_small').text();
            var story_peak_img = $('.full_height[data-s_id=' + i + ']').find('.story_peak_img').attr('src');
            $('.left_stories').prepend(
                '<a class="full_height_left"> <div class="left_story_card"> <img src=' + story_bg +
                ' class="right_story_card_img"><div class="start_typing_small">' + story_text +
                '</div> <img src=' + story_peak_img +
                ' alt="" class="story_peak_img"> </div></a>'
            )
        }
    }


    //lkhdma dyal limin
    for (let i = 0; i < k; i++) {

        $('.full_height[data-s_id=' + i + ']').remove();

    }
    $(this).remove();
    /*
      var a7a = 0;
     for (let i = k; i > 10; i--) {
         $('.full_height[data-s_id=' + i + ']').removeAttr('data-s_id').attr('data-s_id', a7a);
         a7a++;
     }
     */

})
$(document).on('click', '.full_height_left', function() {
    var story_bg = $(this).find('.right_story_card_img').attr('src');
    var story_img = $(this).find('.right_story_card_img_img').attr('src');
    var story_text = $(this).find('.start_typing_small').text();
    var mol_story = $(this).data('molstory');
    var count = $(this).data('count');
    var story_profile_pic = $(this).find('.story_peak_img').attr('src');

    //-----------------//

    if (story_bg != '') {
        $('.story_player').find('.story_bg_img').attr('src', story_bg);
    } else if (story_img != '') {
        $('.story_player').find('.story_bg_img').attr('src', story_img);
    }
    if (story_text != '') {
        $('.story_player').find('.story_text_play').html(story_text);

    }

    var s_b = 460 / count;


    $('.story_bar_container').css('grid-template-columns', 'repeat(' + count + ',1fr)');
    $('.story_bar').css('width', '' + s_b + '');
    $(this).hide();
})
$(document).on('focus', '#story_reply_input', function() {
    var mol_storyy = $('.story_player').data('mol_story');
    $('.story_react_icons').hide();
    $(this).css('width', '700px');
    $(this).attr('placeholder', 'Reply to ' + mol_storyy + ' ...');
    $('.story_btn_send').show()
    $('.story_btn_sticker').css('right', '3rem')
})

$(document).on('click', '#story_reply_input_send', function() {
    var reply_text = $('#story_reply_input').val();
    var chatid = $('.story_player').data('uuid');
    var imagee = $('.story_player').find('.story_bg_img').attr('src');
    var story_text = $('.story_player').find('.story_text_play').text();
    var userid = "<?php echo $userid ?>";
    var image = '[{"name":"' + imagee + '"}]';
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        storyReply: userid,
        chatid: chatid,
        image: image,
        story_text: story_text,
        reply_text: reply_text
    }, function(data) {
        console.log(data)
    })

})
$(document).mouseup(function(e) {
    var container = new Array();
    container.push('.story_input_wrap');
    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $('.story_react_icons').show();
            $(value).css('width', '300px');
            $(value).attr('placeholder', 'Reply...');
            $('.story_btn_send').hide()
            $('.story_btn_sticker').css('right', '1rem')

        }
    })
})
//---->view story---->
$(document).ready(function() {
    var story_id = $('.story_player').data('id');
    var user = "<?php echo $userid ?>";
    var viewer = '' + user + ',';
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        viewStory: viewer,
        story_id: story_id
    }, function(data) {

    })

})
//---->view story---->

$(document).on('click', '.go_right_wrap', function() {
    var user_id = $('.story_player').data('uuid');
    var occurence = $('.story_player').data('occ');
    clearInterval(resss);
    setInterval(function() {
        if (kkk == 100) {
            kkk = 0;
        } else {
            var bar = $('.story_bar[data-occ=' + occurence + ']');
            $(bar).html('<div class="bar_progress" style="width:' + kkk + '%"></div>');
            kkk += 3;
        }
    }, 500)

    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        getNextStory: user_id,
        occurence: occurence
    }, function(data) {
        if (data == 'no-exist') {

        } else {
            story = JSON.parse(data);
            console.log(story.story_bg);
            if (story.story_bg != '') {
                $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' +
                    story.story_bg + '');
            } else if (story.story_img != '') {
                $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' +
                    story.story_img + '');
            }
            $('.story_player').attr('data-mol_story', '' + story.first_name + '.' + story
                .last_name +
                '');
            $('.story_player').attr('data-uuid', story.user_id);
            $('.story_player').attr('data-id', story.story_id);
            $('.story_player').find('.story_text_play').html(story.story_text);
            $('.story_rounded_blue').attr('src', 'http://localhost/facebook/' +
                story.profile_picture + '');
            $('.story_rounded_blue').attr('mol_story', story.user_id);
            $('.story_player').data(occurence++);
        }
    })

})
var occurence = 0;
setInterval(function() {

    var user_id = $('.story_player').data('uuid');
    occurence = $('.story_player').data('occ');

    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        getNextStory: user_id,
        occurence: occurence
    }, function(data) {
        if (data == 'no-exist') {

        } else {
            story = JSON.parse(data);

            if (story.story_bg != '') {
                $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' +
                    story.story_bg + '');
            } else if (story.story_img != '') {
                $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' +
                    story.story_img + '');
            }
            $('.story_player').attr('data-mol_story', '' + story.first_name + '.' + story
                .last_name +
                '');
            $('.story_player').attr('data-uuid', story.user_id);
            $('.story_player').attr('data-id', story.story_id);
            $('.story_player').find('.story_text_play').html(story.story_text);
            $('.story_rounded_blue').attr('src', 'http://localhost/facebook/' +
                story.profile_picture + '');
            $('.story_rounded_blue').attr('mol_story', story.user_id);
            $('.story_player').attr('data-occ', occurence + 1);

        }
    })
}, 15000)
/*
var kkk = 0;
var resss = setInterval(function() {
    if (kkk == 105) {
        kkk = 0;
        occurence++;
    } else {
        var bar = $('.story_bar[data-occ=' + occurence + ']');
        $(bar).html('<div class="bar_progress" style="width:' + kkk + '%"></div>');
        kkk += 5;
    }
}, 700)
*/
</script>

</html>