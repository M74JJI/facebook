<?php
include '../connect/login.php';
include '../core/load.php';
$uuid='';
if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
   $userInfo= $loadUser->getUserInfo($userid);
   $myStory= $loadUser->myStory($userid);
}else{
    header('Location:login.php');
}
if(!empty($_GET["uuid"])){
       if($loadUser->checkIfStory($_GET['uuid'])->total == 0){
           $mol_story=$userid;
       }else{
        $mol_story=$_GET["uuid"];
       }
}else{
    $mol_story=$userid;
 
}

$userStories = $loadUser->getUserStories($mol_story);
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
        <div class="story_player" data-uuid="<?php echo $userStories[0]->user_id ?>">
            <div class="story_bar_container"
                style="grid-template-columns: repeat(<?php echo count($userStories)  ?>,1fr);">
                <?php
               for($i=0;$i<count($userStories);$i++){
                   ?>
                <div class="story_bar" style="width:<?php echo 460/count($userStories).'px' ?>"></div>
                <?php
               }
               ?>
            </div>
            <img src="<?php echo 'http://localhost/facebook/'.$userStories[$num_story]->profile_picture ?>" alt=""
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
        </div>
        <div class="full_height_right">
            <div class="go_right_wrap">
                <i class="go_right_mate"></i>
            </div>
        </div>
        <div class="right_stories">
            <?php
            foreach($followingStories as $story){
                $count=count($loadUser->getUserStories($story[0]->user_id));
           
                    ?>
            <a class="full_height" data-molstory="<?php echo $story[0]->first_name.' '.$story[0]->last_name ?>"
                data-count="<?php echo $count ?>" data-story_user="<?php echo $story[0]->story_user ?>">
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
                        class="right_story_card_img_img">
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

    //---->dir story flwst
    var story_user = $(this).data('story_user');
    var index;
    var story_bg = $('.story_player').find('.story_bg_img').attr('src');
    var story_text = $('.story_player').find('.story_text_play').text();
    var story_profile_pic = $('.story_player').find('.story_rounded_blue').attr('src');
    for (let i = 0; i < stories.length; i++) {

        for (let j = 0; j < stories[i].length; j++) {
            if (stories[i][j].story_user == story_user) {
                index = i;
            }
        }

    }

    if (stories[index][0].story_bg != '') {
        $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' + stories[index][0]
            .story_bg + '');
    } else if (story_img != '') {
        $('.story_player').find('.story_bg_img').attr('src', 'http://localhost/facebook/' + stories[index][0]
            .story_img + '');
    }
    if (stories[index].story_text != '') {
        $('.story_player').find('.story_text_play').html(stories[index][0].story_text);
    }
    $('.story_rounded_blue').attr('src', 'http://localhost/facebook/' + stories[index][0]
        .profile_picture + '');
    $(this).hide();


    //---->dir stories li 9bl f chmal

    $('.left_stories').html('');

    for (let i = 0; i < index; i++) {
        if (stories[i][0].story_bg != '') {
            $('.left_stories').prepend(
                '<a class="full_height_left"> <div class="left_story_card"> <img src="http://localhost/facebook/' +
                stories[i][0].story_bg +
                '" class="right_story_card_img"><div class="start_typing_small">' +
                stories[i][0].story_text +
                '</div> <img src="http://localhost/facebook/' + stories[i][0].profile_picture +
                '" alt="" class="story_peak_img"> </div></a>'
            )
        } else if (stories[index][0].story_img != '') {
            $('.left_stories').prepend(
                '<a class="full_height_left"> <div class="left_story_card"> <img src="http://localhost/facebook/' +
                stories[i][0].story_img +
                ' class="right_story_card_img"><div class="start_typing_small">' +
                stories[i][0].story_text +
                '</div> <img src="http://localhost/facebook/' + stories[i][0].profile_picture +
                '" alt="" class="story_peak_img"> </div></a>'
            )
        }

    }

    $('.left_stories').prepend(
        '<a class="full_height_left"> <div class="left_story_card"> <img src=' + story_bg +
        ' class="right_story_card_img"><div class="start_typing_small">' + story_text +
        '</div> <img src=' + story_profile_pic +
        ' alt="" class="story_peak_img"> </div></a>'
    )

    /*
    $('.left_stories').prepend(
        '<a class="full_height_left"> <div class="left_story_card"> <img src=' +
        bg + ' class="right_story_card_img"><div class="start_typing_small">' +
        text +
        '</div> <img src=' + pdp + ' alt="" class="story_peak_img"> </div></a>'
    )
    
 

    //-----------------//

    //-----------------//
   */

    /*

    var s_b = 460 / count;
    console.log(s_b)
    $('.story_bar_container').css('grid-template-columns', 'repeat(' + count + ',1fr)');
    $('.story_bar_container').html('')
    for (let i = 0; i < count; i++) {
        $('.story_bar_container').append('<div class="story_bar"></div>');
    }
    $('.story_bar').css('width', '' + s_b + '');


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
</script>

</html>