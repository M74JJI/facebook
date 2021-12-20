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
            $k=0;
            foreach($followingStories as $story){           
                $count=count($loadUser->getUserStories($story[0]->story_user));          
                    ?>
            <a class="full_height" data-s_id="<?php echo $k ?>" data-count="<?php echo $count ?>">
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
    //---7tha lwst--->
    $('.story_player').find('.story_bg_img').attr('src', story_bg);
    $('.story_player').find('.story_text_play').html(story_text);
    $('.story_rounded_blue').attr('src', story_peak_img);
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
</script>

</html>