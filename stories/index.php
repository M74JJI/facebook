<?php
include '../connect/login.php';
include '../core/load.php';
$uuid='';
$story_id='';
if(!empty($_GET["uuid"])){
    $story_id=$_GET["uuid"];
   
}else{

}
if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
   $userInfo= $loadUser->getUserInfo($userid);
   $myStory= $loadUser->myStory($userid);
   $mainStory;
   $stories= $loadUser->getAllStoriesRanked($userid);
 /*  $followingStories= $loadUser->getAllFollowingStories($userid);*/
    foreach($stories as $story){
        if($story->story_id == $story_id){
          $mainStory= $story;
        }
    }
}else{
    header('Location:login.php');
}
$songs = array(
    array(
        'name' => 'Suicidal toughts',
        'cover' => "http://localhost/facebook/assets/images/songs_images/You're Nobody (Til Somebody Kills You).jpg",
        'artist' => 'Biggie Smalls',
        'src' => 'http://localhost/facebook/assets/songs/song1.mp3',
        'lyrics' =>
        "0 | When I die, fuck it, I wanna go to hell
        2 | 'Cause I'm a piece of shit, it ain't hard to fuckin' tell
      5.5 | It don't make sense, goin' to heaven with the goodie-goodies
        8 | Dressed in white, I like black Timbs and black hoodies
       11 | God'll prob'ly have me on some real strict shit
        14 | No sleepin' all day, no gettin' my dick licked"
    ),
 
);
$lyrics ="0 | When I die, fuck it, I wanna go to hell
2 | 'Cause I'm a piece of shit, it ain't hard to fuckin' tell
5.5 | It don't make sense, goin' to heaven with the goodie-goodies
8 | Dressed in white, I like black Timbs and black hoodies
11 | God'll prob'ly have me on some real strict shit
14 | No sleepin' all day, no gettin' my dick licked";

/*
if(!empty($_GET["uuid"])){
        $story_id=$_GET["uuid"];
       if($loadUser->checkIfStory($_GET['uuid'])->total == 0){
           $mol_story=$userid;
       }else{
        $story=$loadUser->getCurrentStory($story_id);
        $mol_story=$story->story_user;
       }
}else{
    $mol_story=$userid;
 
}

$followingStories= $loadUser->getFollowingStories($userid,$mainStory->user_id);
*/
$total= count($loadUser->getUserStories($mainStory->story_user));
$max= count($stories);
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
        <audio class="player" id="audio_player"></audio>
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
                    <img src=<?php echo 'http://localhost/facebook/'.$myStory[0]->profile_picture
                     ?> alt="" class="story_peak_img">
                </div>
            </a>
            <?php
         }
         ?>

        </div>
        <div class="da3wa_lah">
            <div class="story_player" data-order="<?php echo $mainStory->order ?>"
                data-total="<?php echo count($stories) ?>" data-src="<?php echo $mainStory->song ?>"
                data-lyrics="<?php echo $lyrics ?>"
                data-mol_story="<?php echo $mainStory->first_name.' '.$mainStory->last_name ?>"
                data-count="<?php echo$mainStory->count ?>" data-id="<?php echo $mainStory->story_id ?>"
                data-uuid="<?php echo $mainStory->user_id ?>">
                <div class="story_bar_container" style="grid-template-columns: repeat(<?php echo $total  ?>,1fr);">
                    <?php
               for($i=0;$i<$total;$i++){
                   ?>
                    <div class="story_bar" style="width:<?php echo 450/$total.'px' ?>">
                        <div class="bar_progress" data-occ="<?php echo $i ?>"></div>
                    </div>
                    <?php
               }
               ?>
                </div>
                <img src=" <?php echo 'http://localhost/facebook/'.$mainStory->profile_picture ?>" alt=""
                    class="story_rounded_blue">
                <img class="story_bg_img" src="<?php echo 'http://localhost/facebook/'.$mainStory->story_bg ?>" alt="">
                <div class="lyricso" style="display: none">

                </div>
                <?php
             
                if($mainStory->story_user ==$userid){

               
                ?>
                <div class="story_viewer_btn">
                    <i class="up_s_view"></i>
                    <div class="total_um_viewers_story">
                        <?php 
                    
                    if($mainStory->viewers != ''){
                        $tmp=explode(',',$mainStory->viewers);
                     array_pop($tmp);
                      $viewers=$loadUser->getStoryViewersInfosAndReacts($tmp); 
                    }
                    
                    ?>
                        <?php if($mainStory->viewers == ''){
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
                            <img src="http://localhost/facebook/assets/images/stories/14.jpg" alt=""
                                class="story_3215_bg">
                        </div>
                    </div>
                    <div class="view_total_with_icon">
                        <i class="view_icon_41545"></i>
                        <span> <?php if($mainStory->viewers == ''){
                        echo'No viewers';

                    }else if(count($tmp) ==1){
                        echo count($tmp).' viewer';
                    }else if(count($tmp) >1){
                        echo count($tmp).' viewers';
                    }
                     ?></span>
                    </div>
                    <ul class="list_infos_story_ul_infos">
                        <?php 
                        if($viewers !=''){

                            foreach($viewers as $viewer){
                             

                                ?>
                        <li>
                            <div style="display: flex;align-items:center;gap:10px">
                                <img class="img_preinf14" src="<?php echo BASE_URL.$viewer->profile_picture ?>" alt="">
                                <div class="flex_col_preinf14">
                                    <span><?php echo $viewer->first_name.' '.$viewer->last_name ?></span>
                                    <!-- <span>Replied in mesenger</span> -->
                                </div>
                            </div>
                            <div></div>
                        </li>
                        <?php
                        }
                    }
                        ?>
                    </ul>
                </div>
                <?php  } ?>
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
       
        foreach ($stories as $i=> $story){
            if($story->order < $mainStory->order && $story->story_user != $mainStory->story_user && $story->story_user != $userid&& $story->main=='yes'){
                ?>
            <a class="full_height" data-mol_story="<?php echo $story->first_name.' '.$story->last_name ?>"
                data-count="<?php echo $mainStory->count ?>" data-uuid="<?php echo $story->user_id ?>"
                data-id="<?php echo $story->story_id ?>" data-order="<?php echo $story->order ?>">
                <div class="right_story_card">
                    <?php
                          if($story->story_bg !=''){
                              ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->story_bg ?>" class="right_story_card_img">
                    <?php
                          }else if($story->story_img !=''){
                              ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->story_bg ?>" class="right_story_card_img">
                    <?php
                          }
                          ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->profile_picture ?>" alt=""
                        class="story_peak_img">
                </div>
            </a>
            <?php
            }
            
        }
        foreach ($stories as $i=> $story){
            
            if($story->order > $mainStory->order && $story->story_user != $mainStory->story_user && $story->story_user != $userid && $story->main=='yes'){
                ?>
            <a class="full_height" data-mol_story="<?php echo $story->first_name.' '.$story->last_name ?>"
                data-count="<?php echo $mainStory->count ?>" data-uuid="<?php echo $story->user_id ?>"
                data-id="<?php echo $story->story_id ?>" data-order="<?php echo $story->order ?>">
                <div class="right_story_card">
                    <?php
                          if($story->story_bg !=''){
                              ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->story_bg ?>" class="right_story_card_img">
                    <?php
                          }else if($story->story_img !=''){
                              ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->story_bg ?>" class="right_story_card_img">
                    <?php
                          }
                          ?>
                    <img src="<?php echo 'http://localhost/facebook/'.$story->profile_picture ?>" alt=""
                        class="story_peak_img">
                </div>
            </a>
            <?php
            }
            
        }
        ?>
        </div>
    </div>
</body>
<script src="../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    $('.story_player').click()
})
$(document).on('click', '.story_player', function() {
    var src = $(this).data('src');
    var lyricss = $(this).data('lyrics');
    $('.lyricso').html(lyricss);
    console.log(lyricss)
    $('.player').attr('src', src)
    $('#audio_player')[0].play();
    $('.lyrics').html(lyricss);
    $('.player').show()

    const player = document.querySelector('.player')
    const lyrics = document.querySelector('.lyricso')
    const lines = lyrics.textContent.trim().split('\n')

    lyrics.removeAttribute('style')
    lyrics.innerText = ''

    let syncData = []

    lines.map((line, index) => {
        const [time, text] = line.trim().split('|')
        syncData.push({
            'start': time.trim(),
            'text': text.trim()
        })
    })

    player.addEventListener('timeupdate', () => {
        syncData.forEach((item) => {

            if (player.currentTime >= item.start) lyrics.innerText = item.text
        })
    })


})
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
    $('#audio_player')[0].pause();
    percentage = 0;
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
    var k = $(this).data('order');
    $('.story_player').attr('added', k);
    //lkhdma dyal lwst
    var wst_bg = $('.story_player').find('.story_bg_img').attr('src');
    var wst_profile_pic = $('.story_player').find('.story_rounded_blue').attr('src');
    $('.left_stories').prepend(
        '<a class="full_height_left"> <div class="left_story_card"> <img src=' + wst_bg +
        ' class="right_story_card_img"><img src=' + wst_profile_pic +
        ' alt="" class="story_peak_img"> </div></a>'
    )
    //lkhdma dyal lwst

    //lkhdma dyal limin
    var story_bg = $(this).find('.right_story_card_img').attr('src');
    var story_peak_img = $(this).find('.story_peak_img').attr('src');
    var count = $(this).data('count');
    var mol_story = $(this).data('mol_story');
    var uuid = $(this).data('uuid');
    var story_id = $(this).data('id');
    var order = $(this).data('order');
    var src = $(this).data('src');
    var s_b = 450 / count;
    $('.story_bar_container').html('');
    $('.story_bar_container').css('grid-template-columns', 'repeat(' + count + ',1fr)');
    for (let i = 0; i < count; i++) {
        $('.story_bar_container').append('<div class="story_bar" data-occ=' + i +
            '><div class="bar_progress" data-occ="' + i + '"></div></div>');
    }
    $('.story_bar').css('width', '' + s_b + '');
    //---7tha lwst--->
    $('.story_player').find('.story_bg_img').attr('src', story_bg);
    $('.story_player').attr('data-mol_story', mol_story);
    $('.story_player').attr('data-order', order);
    $('.story_player').attr('data-uuid', uuid);
    $('.story_player').attr('data-count', count);
    $('.story_player').attr('data-id', story_id);
    $('.story_rounded_blue').attr('src', story_peak_img);
    $('.story_rounded_blue').attr('mol_story', mol_story);
    //---7tha lwst--->


    for (let i = 0; i < k; i++) {
        if ($('.full_height[data-order=' + i + ']').length > 0) {
            var story_bg = $('.full_height[data-order=' + i + ']').find('.right_story_card_img').attr('src');
            var story_peak_img = $('.full_height[data-order=' + i + ']').find('.story_peak_img').attr('src');
            $('.left_stories').prepend(
                '<a class="full_height_left" data-order="' + order +
                '"> <div class="left_story_card"> <img src=' + story_bg +
                ' class="right_story_card_img"> <img src=' + story_peak_img +
                ' alt="" class="story_peak_img"> </div></a>'
            )
        }
    }


    //lkhdma dyal limin
    for (let i = 0; i < k; i++) {

        $('.full_height[data-order=' + i + ']').remove();

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
    var mol_story = $(this).data('molstory');
    var order = $(this).data('order');
    var story_profile_pic = $(this).find('.story_peak_img').attr('src');
    //-----------------//

    if (story_bg != '') {
        $('.story_player').find('.story_bg_img').attr('src', story_bg);
    } else if (story_img != '') {
        $('.story_player').find('.story_bg_img').attr('src', story_img);
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
    var userid = "<?php echo $userid ?>";
    var image = '[{"name":"' + imagee + '"}]';
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        storyReply: userid,
        chatid: chatid,
        image: image,
        reply_text: reply_text
    }, function(data) {
        console.log(data)
    })

})
/*
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
*/
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
    $('#audio_player')[0].pause();

    clearInterval(tim);
    percentage = 0;

    var orderr = $('.story_player').data('order');
    var totall = $('.story_player').data('total');

    var total = $('.right_stories *');
    var next_right = $('.right_stories').children(':first').data('order');
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        checkIfNextHasSameUser: "<?php echo $userid ?>",
        order: orderr,
    }, function(data) {
        if (data == 'false') {
            $('.right_stories').children(':first').remove();
        }
    })


    if (total.length == 0) {


    } else {
        $.post('http://localhost/facebook/core/chat/storyReply.php', {
            getNextStory: "<?php echo $userid ?>",
            order: orderr,
            next_right: next_right,
        }, function(data) {
            $('.da3wa_lah').html(data);
            var src = $('.story_player').data('src');
            $('.player').attr('src', src);
            $('#audio_player')[0].play();
        })
    }

})
var timer = 15000;
tim = setInterval(function() {
    $('#audio_player')[0].pause();
    percentage = 0;
    var orderr = $('.story_player').data('order');
    var totall = $('.story_player').data('total');
    var total = $('.right_stories *');
    var next_right = $('.right_stories').children(':first').data('order');
    $.post('http://localhost/facebook/core/chat/storyReply.php', {
        checkIfNextHasSameUser: "<?php echo $userid ?>",
        order: orderr,
    }, function(data) {
        if (data == 'false') {
            $('.right_stories').children(':first').remove();
        }
    })
    if (total.length == 0) {} else {
        $.post('http://localhost/facebook/core/chat/storyReply.php', {
            getNextStory: "<?php echo $userid ?>",
            order: orderr,
            next_right: next_right,
        }, function(data) {
            $('.da3wa_lah').html(data);
            var src = $('.story_player').data('src');
            $('.player').attr('src', src);
            $('#audio_player')[0].play();
        })
    }

}, timer)
$(document).on('keyup', '.go_right_wrap', function() {
    var total = $('.right_stories *');
    if (total.length == 5) {
        $('.go_right_wrap').hide();
    }
})
var countd = 750;
var percentage = 5;
bar = setInterval(function() {
    if (percentage == 100) {
        percentage = 0;
    }
    var count = $('.story_player').data('count') - 1;

    $('.bar_progress[data-occ=' + count + ']').css('width', '' + percentage + '%');
    percentage += 5;
}, countd)
setInterval(function() {
    var total = $('.right_stories *');
    if (total.length == 0) {
        $('.go_right_wrap').hide();

    } else {
        var count = $('.story_player').data('count') - 1;
        for (var i = 0; i < count; i++) {
            $('.bar_progress[data-occ=' + i + ']').css('width', '100%');
        }

    }
}, 100)
</script>

</html>