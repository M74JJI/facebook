<?php
include 'core/load.php';
include 'connect/login.php';
if(login::isLoggedIn() && isset($_GET['id'])){
    $userid = login::isLoggedIn();
    $postid =$_GET['id'];
    $src =$_GET['image']; 
 }else{
     header('Location:login.php');
 }



$main_react =$loadPost->main_react($userid,$postid);
$react_max_show =$loadPost->react_max_show($postid);
$main_react_count =$loadPost->main_react_count($postid);
$commentDetails = $loadPost->commentFetch($postid);
$totalCommentCount=$loadPost->totalCommentCount($postid);
$totalShareCount =$loadPost->totalShareCount($postid);


$post=$loadPost->getPost($postid);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">
    <link rel="stylesheet" href="assets/css/preview.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/header_menu.css">
</head>

<body style="height:100%">

    <div class="m_preview">
        <div class="mmm_left">
            <img src="<?php echo $src ?>" alt="">
        </div>
        <div class="mmm_right">

            <div class="a7a_header">
                <a href="" class="rounded_link hidein_sm">
                    <svg viewBox="0 0 44 44" width="1em" height="1em">
                        <circle cx="7" cy="7" r="6"></circle>
                        <circle cx="22" cy="7" r="6"></circle>
                        <circle cx="37" cy="7" r="6"></circle>
                        <circle cx="7" cy="22" r="6"></circle>
                        <circle cx="22" cy="22" r="6"></circle>
                        <circle cx="37" cy="22" r="6"></circle>
                        <circle cx="7" cy="37" r="6"></circle>
                        <circle cx="22" cy="37" r="6"></circle>
                        <circle cx="37" cy="37" r="6"></circle>
                    </svg>
                </a>
                <a href="" class="rounded_link hidein_sm">
                    <svg viewBox="0 0 28 28" alt="" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 fzdkajry" height="20"
                        width="20">
                        <path
                            d="M14 2.042c6.76 0 12 4.952 12 11.64S20.76 25.322 14 25.322a13.091 13.091 0 0 1-3.474-.461.956 .956 0 0 0-.641.047L7.5 25.959a.961.961 0 0 1-1.348-.849l-.065-2.134a.957.957 0 0 0-.322-.684A11.389 11.389 0 0 1 2 13.682C2 6.994 7.24 2.042 14 2.042ZM6.794 17.086a.57.57 0 0 0 .827.758l3.786-2.874a.722.722 0 0 1 .868 0l2.8 2.1a1.8 1.8 0 0 0 2.6-.481l3.525-5.592a.57.57 0 0 0-.827-.758l-3.786 2.874a.722.722 0 0 1-.868 0l-2.8-2.1a1.8 1.8 0 0 0-2.6.481Z">
                        </path>
                    </svg>
                </a>
                <a href="" class="rounded_link hidein_sm">
                    <svg viewBox="0 0 28 28" alt="" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 fzdkajry" height="20"
                        width="20">
                        <path
                            d="M7.847 23.488C9.207 23.488 11.443 23.363 14.467 22.806 13.944 24.228 12.581 25.247 10.98 25.247 9.649 25.247 8.483 24.542 7.825 23.488L7.847 23.488ZM24.923 15.73C25.17 17.002 24.278 18.127 22.27 19.076 21.17 19.595 18.724 20.583 14.684 21.369 11.568 21.974 9.285 22.113 7.848 22.113 7.421 22.113 7.068 22.101 6.79 22.085 4.574 21.958 3.324 21.248 3.077 19.976 2.702 18.049 3.295 17.305 4.278 16.073L4.537 15.748C5.2 14.907 5.459 14.081 5.035 11.902 4.086 7.022 6.284 3.687 11.064 2.753 15.846 1.83 19.134 4.096 20.083 8.977 20.506 11.156 21.056 11.824 21.986 12.355L21.986 12.356 22.348 12.561C23.72 13.335 24.548 13.802 24.923 15.73Z">
                        </path>
                    </svg>
                </a>
                <div style="position:relative">
                    <a class="rounded_link header_menu_link" id="open_thatmenu1">
                        <svg style="font-size: larger" viewBox="0 0 20 20" width="1em" height="1em">
                            <path
                                d="M10 14a1 1 0 0 1-.755-.349L5.329 9.182a1.367 1.367 0 0 1-.205-1.46A1.184 1.184 0 0 1 6.2 7h7.6a1.18 1.18 0 0 1 1.074.721 1.357 1.357 0 0 1-.2 1.457l-3.918 4.473A1 1 0 0 1 10 14z">
                            </path>
                        </svg>
                    </a>
                    <div class="wrapper1" id="menu_header1">
                        <ul class="menu-bar">
                            <li class="menu_me_wrap">
                                <div class="menu_me">
                                    <img src="<?php echo $post->profile_picture ?>" alt="">
                                    <div class="menu_me_name">
                                        <span><?php echo $post->first_name.' '.$post->last_name;?></span>
                                        <span>See your profile</span>
                                    </div>
                                </div>
                            </li>
                            <li class="menu_me_wrap">
                                <div class="header_feedback1" style=" padding: 10px 5px;margin-top: 0; cursor:pointer">
                                    <div class="feddback_left"><i class="feedback_icon"></i></div>
                                    <div class="feedback_right">
                                        <span class="text-blacko">Give feedback</span>
                                        <span class="text-secondo">Help us improve the new Facebook</span>
                                    </div>
                                </div>
                            </li>
                            <li class="menu_me_wrap1" style="margin-top:10px">
                                <a href="#" class="header_feedback">
                                    <div class="feddback_left"><i class="setting_img"></i></div>
                                    <div class="feedback_right">
                                        <span class="text-blacko">Setting & Privacy</span>
                                    </div>
                                </a>
                                <div class="arrow_right" style="margin-top:2px"><i class="arrow_img"></i></div>
                            </li>
                            <li class="menu_me_wrap1">
                                <a href="#" class="header_feedback">
                                    <div class="feddback_left"><i class="help_img"></i></div>
                                    <div class="feedback_right">
                                        <span class="text-blacko">Help & Support</span>
                                    </div>
                                </a>
                                <div class="arrow_right"><i class="arrow_img"></i></div>
                            </li>
                            <li class="menu_me_wrap1">
                                <a href="#" class="header_feedback">
                                    <div class="feddback_left"><i class="dark_img"></i></div>
                                    <div class="feedback_right">
                                        <span class="text-blacko">Display & Accessibility</span>
                                    </div>
                                </a>
                                <div class="arrow_right"><i class="arrow_img"></i></div>
                            </li>
                            <li class="menu_me_wrap1">
                                <a href="<?php echo BASE_URL.'logout.php' ?>" class="header_feedback">
                                    <div class="feddback_left"><i class="logout_img"></i></div>
                                    <div class="feedback_right">
                                        <span class="text-blacko">Log Out</span>
                                    </div>
                                </a>
                                <div class="arrow_right"><i class="arrow_img"></i></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="fixem">


                <div class="post_header">
                    <div class="post_header_left">
                        <a href="<?php echo BASE_URL.$post->link ?>"> <img src="<?php echo $post->profile_picture ?>"
                                alt=""></a>
                        <div class="post_header_left_name">
                            <a href="<?php echo BASE_URL.$post->link ?>" class="postedBy">
                                <?php echo $post->first_name.' '.$post->last_name ?>
                            </a>
                            <span class="postedAt">
                                <?php echo $loadUser->timeAgoAlt($post->postedAt) ?>
                                .
                                <svg fill="#65676b" style="margin-left:5px;margin-top:2px" viewBox="0 0 16 16"
                                    width="1em" height="1em" title="Shared with Public">

                                    <g fill-rule="evenodd" transform="translate(-448 -544)">
                                        <g>
                                            <path
                                                d="M109.5 408.5c0 3.23-2.04 5.983-4.903 7.036l.07-.036c1.167-1 1.814-2.967 2-3.834.214-1 .303-1.3-.5-1.96-.31-.253-.677-.196-1.04-.476-.246-.19-.356-.59-.606-.73-.594-.337-1.107.11-1.954.223a2.666 2.666 0 0 1-1.15-.123c-.007 0-.007 0-.013-.004l-.083-.03c-.164-.082-.077-.206.006-.36h-.006c.086-.17.086-.376-.05-.529-.19-.214-.54-.214-.804-.224-.106-.003-.21 0-.313.004l-.003-.004c-.04 0-.084.004-.124.004h-.037c-.323.007-.666-.034-.893-.314-.263-.353-.29-.733.097-1.09.28-.26.863-.8 1.807-.22.603.37 1.166.667 1.666.5.33-.11.48-.303.094-.87a1.128 1.128 0 0 1-.214-.73c.067-.776.687-.84 1.164-1.2.466-.356.68-.943.546-1.457-.106-.413-.51-.873-1.28-1.01a7.49 7.49 0 0 1 6.524 7.434"
                                                transform="translate(354 143.5)"></path>
                                            <path
                                                d="M104.107 415.696A7.498 7.498 0 0 1 94.5 408.5a7.48 7.48 0 0 1 3.407-6.283 5.474 5.474 0 0 0-1.653 2.334c-.753 2.217-.217 4.075 2.29 4.075.833 0 1.4.561 1.333 2.375-.013.403.52 1.78 2.45 1.89.7.04 1.184 1.053 1.33 1.74.06.29.127.65.257.97a.174.174 0 0 0 .193.096"
                                                transform="translate(354 143.5)"></path>
                                            <path fill-rule="nonzero"
                                                d="M110 408.5a8 8 0 1 1-16 0 8 8 0 0 1 16 0zm-1 0a7 7 0 1 0-14 0 7 7 0 0 0 14 0z"
                                                transform="translate(354 143.5)"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span>

                        </div>
                    </div>
                    <?php 
             if($userid === $post->user_id){
             ?>
                    <div class="post_header_right"><i class="fa-solid fa-ellipsis"></i></div>
                    <?php
             }else{ ?>
                    <div class="post_header_right"><i class="fa-solid fa-ellipsis"></i></div>
                    <?php }
             ?>
                </div>
                <div class="posttt">
                    <?php echo $post->post;
      
                ?>
                </div>
                <!------POST-HEADER------>
                <!------POST-INFOS------>
                <div class="react_infos">
                    <div class="nf-3">
                        <div class="react-comment-count-wrap" style="width:100%;display:flex;align-items:center">
                            <div class="react-count-wrap">
                                <div class="nf-3-react-icon">
                                    <div class="react-inst-img align-middle">
                                        <?php
                    foreach($react_max_show as $react_max){
                        echo '<img class="'.$react_max->reactType.'-max-show"
                         src="assets/images/react/'.$react_max->reactType.'.svg" alt=""
                          style="width:20px;height:20px;cursor:pointer">';
                    }
                         ?>
                                    </div>
                                </div>
                                <div class="nf-3-react-username">
                                    <?php 
                    if($main_react_count->maxreact =='0'){

                    }else{
                        echo $main_react_count->maxreact;
                    }
                    ?>
                                </div>

                            </div>
                        </div>



                    </div>
                    <div class="react_right_count">
                        <span class="comment-share-count">
                            <?php if(empty($totalCommentCount->totalComment)){

           }else{
               echo $totalCommentCount->totalComment.' comments' ;
           } ?>
                        </span>
                        <span class="share-count-wrap">
                            <?php
               if(empty($totalShareCount->totalShare)){}else{
                   echo $totalShareCount->totalShare.'Shares';
               }
               ?>
                        </span>
                    </div>

                </div>
                <!------POST-INFOS------>
                <!------POST-ACTIONS------>

                <div class="nf-4">

                    <div class="like-action-wrap" data-postid="<?php echo $post->post_id ?>"
                        data-userid="<?php echo $userid ?>">
                        <div class="react-bundle-wrap">

                        </div>
                        <div class="like-action ra">
                            <?php if(empty($main_react)){
?>
                            <div class="like-action-icon">
                                <img src="assets/images/like.png" style="width:20px" alt="">
                            </div>
                            <div class="like-action-text">
                                <span>Like</span>
                            </div>
                            <?php }else{ ?>
                            <div class="like-action-icon">
                                <img class="react_icon_md"
                                    src="assets/images/react/<?php echo $main_react->reactType ?>.svg" alt="" class="">
                                <div class="like-action-text">
                                    <span
                                        class="<?php echo $main_react->reactType."-color" ?>"><?php echo $main_react->reactType; ?></span>
                                </div>
                            </div>
                            <?php  }?>
                        </div>
                        <div style="margin-right:17px" class=" react_btn_wrapper comment-action">
                            <i class="comment_button"></i>Comment
                        </div>
                        <div class="react_btn_wrapper share-action" data-postid="<?php echo $post->post_id ?>"
                            data-profilepic="<?php echo $post->profile_picture ?>" data-userid="<?php echo $userid ?>"
                            data-profileid="<?php echo $post->user_id; ?>">

                            <i class="share_button"></i>Share
                        </div>
                    </div>

                </div>
                <!------POST-ACTIONS------>
                <!------POST-COMMENTS------>
                <div class="nf-5">
                    <div class="comment-list">
                        <ul class="add-comment">
                            <?php 
    
                        if(!empty($commentDetails)){
                        

                        foreach ($commentDetails as $comment){
                        
                        
                            $com_react_max_show =$loadPost->com_react_max_show($comment->commentedOn,$comment->comment_id);
                            $com_main_react_count =$loadPost->com_main_react_count($comment->commentedOn,$comment->comment_id);
                            $com_reactCheck =$loadPost->com_reactCheck($userid,$comment->commentedOn,$comment->comment_id);
                    
                        ?>
                            <!-------COMMENT------>
                            <li class="new-comment">
                                <div class="com-details">
                                    <div class="com-profile-pic">
                                        <a href="#">
                                            <span class="top-pic">
                                                <img src="<?php echo $comment->profile_picture ?>" class="pdp_comment"
                                                    alt="">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="com-pro-wrap">
                                        <div class="com-text-react-wrap">
                                            <div class="com-text-option-wrap align-middle">
                                                <div class="com-pro-text align-middle">

                                                    <div class="com-react-placeholder-wrap align-middle">
                                                        <div class="flex_col">
                                                            <span class="nf-pro-name">
                                                                <a href="#" class="nf-pr-name">
                                                                    <?php echo ''.$comment->first_name.' '.$comment->last_name.'' ?>
                                                                </a>
                                                            </span>
                                                            <span class="com-text" style="margin-left:5px"
                                                                data-postid="<?php echo $comment->commentedOn ?>"
                                                                data-userid="<?php echo $post->id ?>"
                                                                data-commentid="<?php echo $comment->comment_id ?>"
                                                                data-profilepic="<?php echo $post->profile_picture ?>">

                                                                <?php echo $comment->comment ?>

                                                            </span>
                                                        </div>
                                                        <div class="com-nf-3-wrap">
                                                            <?php 
                                                if($com_main_react_count->maxreact =='0'){ 
                                                }else{
                                            ?>
                                                            <div class="com-nf-3 align-middle">
                                                                <div class="nf-3-react-icon">
                                                                    <div class="align-middle react-inst-img">
                                                                        <?php
                                             foreach($com_react_max_show as $react_max){
                                                 echo '<img class="'.$react_max->reactType.'-max-show"
                                                  src="assets/images/react/'.$react_max->reactType.'.svg" alt=""
                                                   style="height:17px;width:17px;cursor:pointer;">';
                                                 
                                             }
                                             ?>
                                                                    </div>
                                                                </div>
                                                                <div class="nf-3-react-username">
                                                                    <?php
                                              if($com_main_react_count->maxreact =='0'){
                                     
                                              }else{
                                                  echo $com_main_react_count->maxreact;
                                              }
                                                ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                        
                                              ?>

                                                        </div>
                                                    </div>
                                                </div>

                                                <?php 
                                  
                                    if($userid == $comment->commentedBy){
                                        ?>
                                                <div class="com-dot-option-wrap"
                                                    data-postid="<?php echo $comment->commentedOn ?>"
                                                    data-userid="<?php echo $userid  ?>"
                                                    data-commentid="<?php echo $comment->comment_id ?>">
                                                    <div class="com-dot"> <i class="fa-solid fa-ellipsis"></i>
                                                    </div>

                                                </div>
                                                <div class="com-option-details-container1"
                                                    id="com-option-details-container1">
                                                </div>
                                                <?php
                                    }else{}
                                    ?>
                                            </div>
                                            <?php 
                        if($comment->image !=''){
                            $imgs=json_decode($comment->image);
                            $count = 0;
                            for($i=0;$i<count($imgs);$i++){
                                echo'
                                <img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
                                class="comment_img_plz" >
                                ';   
                            }
                        
                        }
                         ?>
                                            <div class="com-react">

                                                <div class="com-rlike-react"
                                                    data-postid="<?php echo $comment->commentedOn ?>"
                                                    data-userid="<?php echo $userid  ?>"
                                                    data-commentid="<?php echo $comment->comment_id ?>">
                                                    <div class="com-react-bundle-wrap"
                                                        data-commentid="<?php echo $comment->comment_id ?>">

                                                    </div>
                                                    <?php
                                        if(empty($com_reactCheck)){
                                            echo '<div class="com-like-action-text"><span>Like</span></div>';
                           
                                        }else{
                                             
                                          
                                         echo '<div class="com-like-action-text"><span class="'.$com_reactCheck->reactType.'-color">'.$com_reactCheck->reactType.'</span></div>'; 
                                            
                                        }
                                        ?>
                                                </div>
                                                <b class="com-reply-action"
                                                    data-postid="<?php echo $comment->commentedOn ?>"
                                                    data-profilepic="<?php echo $post->profile_picture ?>">
                                                    Reply
                                                </b>
                                                <div class="com-time">
                                                    <?php echo $loadUser->timeAgoAlt($comment->commentedAt) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <!-------COMMENT------>
                            <?php }} ?>
                        </ul>

                    </div>




                    <div class="comment-write1">
                        <div class="com-pro-pick">
                            <a href="#">
                                <div class="top-pic">
                                    <img src="<?php echo $post->profile_picture ?>" alt="">
                                </div>
                            </a>
                        </div>


                        <div class="com-input">
                            <div class="comment-input" data-postid="<?php echo $post->post_id ?>"
                                data-userid="<?php echo $userid  ?>">
                                <input type="text" class="comment-input-style comment-submit" id="comment-inputt"
                                    placeholder="Write a comment..." />
                                <div class="comment_toolss">
                                    <input type="file" id="comment_imggg" class='hidden'>
                                    <div class="m_tool" id="camera_m">
                                        <i class="camera_m"></i>
                                    </div>
                                    <div class="m_tool">
                                        <i class="m_gif"></i>
                                    </div>
                                    <div class="m_tool">
                                        <i class="m_sticker"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="comment_img_preview"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="assets/js/header.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/dist/emojionearea.js"></script>
        <script>
        $(document).on('click', '#open_thatmenu1', function() {
            $('#menu_header1').toggle()
        })
        $('input#comment-inputt').emojioneArea({

        })

        //------------------->
        // react system 


        $(document).on('click', '.like-action', function() {

            var likeActionIcon = $(this).find('.like-action-icon img');
            var likeReactParent = $(this).parents('.like-action-wrap');
            var nf4 = $(likeReactParent).parents('.nf-4');
            var nf_3 = $(nf4).siblings('.react_infos').find('.react-count-wrap');
            var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
            var reactNumText = $(reactCount).text();
            var postId = $(likeReactParent).data('postid');
            var userId = $(likeReactParent).data('userid');
            var typeText = $(this).find('.like-action-text span');
            var typeR = $(typeText).text();
            var spanClass = $(this).find('.like-action-text').find('span');

            if ($(spanClass).attr('class') !== undefined) {

                if ($(likeActionIcon).attr('src') == 'assets/images/like.png') {

                    (spanClass).addClass('like-color');
                    $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                        'reactIconSize');
                    spanClass.text('like');
                    mainReactSubmit(typeR, postId, userId, nf_3);
                } else {
                    $(likeActionIcon).attr('src', 'assets/images/like.png');
                    spanClass.removeClass('like-color');
                    spanClass.text('like');
                    mainReactDelete(typeR, postId, userId, nf_3);
                }
            } else if ($(spanClass).attr('class') === undefined) {
                (spanClass).addClass('like-color');
                $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, nf_3);

            } else {
                (spanClass).addClass('like-color');
                $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, nf_3);
            }

        })

        function mainReactSubmit(typeR, postId, userId, nf_3) {

            var profileId = "<?php echo $post->user_id; ?>"
            console.log(nf_3)
            $.post('http://localhost/facebook/core/ajax/react.php', {
                reactType: typeR,
                postId: postId,
                userId: userId,
                profileId: profileId,
            }, function(data) {
                $(nf_3).empty().html(data);

            })

        }

        function mainReactDelete(typeR, postId, userId, nf_3) {

            var profileId = "<?php echo $post->user_id; ?>"

            $.post('http://localhost/facebook/core/ajax/react.php', {
                deleteReactType: typeR,
                postId: postId,
                userId: userId,
                profileId: profileId,
            }, function(data) {
                $(nf_3).empty().html(data);


            })

        }
        //m tired of js here
        $('.nf-4').hover(function() {
            var mainReact = $(this).find('.react-bundle-wrap');
            $(mainReact).html(
                '<div style="height:50px; z-index: 9999999999999999999999999999999999999999999; display: flex; align-items: center; background-color: #fff; position: absolute; top: -3.3rem; padding: 0 5px; border-radius: 50px;"> <div class="like-react-click"> <img src="assets/images/gif/like.gif" alt="" class="react-icon"> </div> <div class="love-react-click"> <img src="assets/images/gif/love.gif" alt="" class="react-icon"> </div> <div class="heart-react-click"> <img src="assets/images/gif/heart.gif" alt="" class=" react-icon"> </div> <div class="haha-react-click"> <img src="assets/images/gif/haha.gif" alt="" class="react-icon"> </div> <div class="wow-react-click"> <img src="assets/images/gif/wow.gif" alt="" class="react-icon"> </div> <div class="sad-react-click"> <img src="assets/images/gif/sad.gif" alt="" class="react-icon"> </div> <div class="angry-react-click"> <img src="assets/images/gif/angry.gif" alt="" class="react-icon"> </div></div>'
            );
        }, function() {
            var mainReact = $(this).find('.react-bundle-wrap');
            $(mainReact).html('');



        })
        /*
        $('.like-action-wrap').hover(function() {
        var mainReact = $(this).find('.react-bundle-wrap');
        $(mainReact).css('display', 'flex');
        }, function() {

        $(mainReact).css('display', 'none');


        })

        */

        $(document).on('click', '.react-icon', function() {
            var likeReact = $(this).parent();

            reactApply(likeReact);

        })

        function reactApply(sClass) {
            if ($(sClass).hasClass('like-react-click')) {
                mainReactSub('like', 'blue');
            } else if ($(sClass).hasClass('love-react-click')) {
                mainReactSub('love', 'red');

            } else if ($(sClass).hasClass('heart-react-click')) {
                mainReactSub('heart', 'red');

            } else if ($(sClass).hasClass('haha-react-click')) {
                mainReactSub('haha', 'yellow');
            } else if ($(sClass).hasClass('angry-react-click')) {
                mainReactSub('angry', 'red');

            } else if ($(sClass).hasClass('sad-react-click')) {
                mainReactSub('sad', 'yellow');
            } else if ($(sClass).hasClass('wow-react-click')) {
                mainReactSub('wow', 'yellow');
            } else {

            }
        }

        function mainReactSub(typeR, color) {

            var reactColor = '' + typeR + '-color';
            var pClass = $('.' + typeR + '-react-click');
            var likeReactParent = $(pClass).parents('.like-action-wrap');

            var nf4 = $(likeReactParent).parents('.nf-4');
            var nf_3 = $(nf4).siblings('.react_infos').find('.react-count-wrap');
            var reactCount = $(nf_3).find('.nf-3-react-username');
            var reactNumberText = $(reactCount).text();
            var postId = $(likeReactParent).data('postid');
            var userId = $(likeReactParent).data('userid');

            var likeAction = $(likeReactParent).find('.like-action');
            var likeActionIcon = $(likeAction).find('.like-action-icon img');
            var spanClass = $(likeAction).find('.like-action-text').find('span');

            if ($(spanClass).hasClass(reactColor)) {
                $(spanClass).removeClass();
                spanClass.text('like');
                $(likeActionIcon).attr('src', 'assets/images/like.png');
                mainReactDelete(typeR, postId, userId, nf_3);
            } else if ($(spanClass).attr('class') !== undefined) {

                $(spanClass).removeClass().addClass(reactColor);
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src',
                    'assets/images/react/' + typeR + '.svg').addClass('reactIconSize');
                mainReactSubmit(typeR, postId, userId, nf_3);
            } else {

                $(spanClass).addClass(reactColor);
                $(likeActionIcon).attr('src', 'assets/images/react/' + typeR + '.svg').addClass(
                    'reactIconSize');
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src', 'assets/images/react/' + typeR + '.svg')
                    .addClass('reactIconSize');

                mainReactSubmit(typeR, postId, userId, nf_3);

            }
        }

        //------------------COMMENT SUBMIT --------------------------------
        $(document).on('click', '.react_btn_wrapper.comment-action', function() {


        })
        $('.comment-input').keyup(function(e) {
            if (e.keyCode == 13) {
                var inputNull = $(this);
                var comment = $(this).find('.emojionearea-editor').html();
                var postid = $(this).data('postid');
                var userid = $(this).data('userid');
                var profileid = "<?php echo $post->user_id ?>";
                var formData = new FormData();
                var images = [];
                var files = $('#comment_imggg')[0].files;
                if (files.length != 0) {
                    if (files.length > 20) {
                        errors += "maximum 20 images is allowed.";

                    } else {
                        for (var i = 0; i < files.length; i++) {
                            var name = document.getElementById('comment_imggg').files[i].name;
                            images += '{\"imageName\":\"user/' + <?php echo $userid; ?> +
                                '/comment/' + name + '\"},';

                            var extension = name.split('.').pop().toLowerCase();
                            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                errors +=
                                    '<p>Invalid ' + i +
                                    ' File. Only gif,png,jpg,jpeg are allowed.</p>';
                            }
                            var ofReader = new FileReader();
                            ofReader.readAsDataURL(document.getElementById('comment_imggg').files[i]);
                            var f = document.getElementById('comment_imggg').files[i];
                            var file_size = f.size || f.fileSize;
                            if (file_size > 2000000) {
                                errors += '<p>' + i + ' File Size is larger than 5mb</p>'
                            } else {
                                formData.append('file[]', document.getElementById('comment_imggg')
                                    .files[
                                        i]);


                            }
                        }
                    }
                    if (files.length < 1) {

                    } else {
                        var str = images.replace(/,\s*$/, "");
                        var strImg = '[' + str + ']';

                    }
                }
                var commentPlaceholder = $(this).parents('.nf-5').find('ul.add-comment');

                if (comment == "") {
                    alert('Please Add comment first.');
                } else {
                    $.ajax({
                        type: "POST",
                        url: 'http://localhost/facebook/core/ajax/comment.php',
                        data: {
                            comment: comment,
                            userid: userid,
                            postid: postid,
                            profileid: profileid,
                            image_c: strImg,
                        },
                        cache: false,
                        success: function(html) {
                            $(commentPlaceholder).append(html);
                            $(inputNull).val('');
                            $('.emojionearea-editor').html('');
                            $('.comment_img_preview').empty().hide;
                            commentHover();
                        }
                    })
                }


            }
        })
        commentHover();

        function commentHover() {
            $('.com-rlike-react').hover(function() {
                var mainReact = $(this).find('.com-react-bundle-wrap');
                $(mainReact).html(
                    '<div style=" z-index: 9999999999999999999999999999999999999999999; display: flex; height: 50px; align-items: center; background-color: #fff; position: absolute; top: -3.3rem; padding: 0 5px; border-radius: 50px;"><div class="com-like-react-click"> <img src="assets/images/gif/like.gif" alt="" class="com-react-icon"> </div> <div class="com-love-react-click"> <img src="assets/images/gif/love.gif" alt="" class="com-react-icon"> </div> <div class="com-heart-react-click"> <img src="assets/images/gif/heart.gif" alt="" class=" com-react-icon"> </div> <div class="com-haha-react-click"> <img src="assets/images/gif/haha.gif" alt="" class="com-react-icon"> </div> <div class="com-wow-react-click"> <img src="assets/images/gif/wow.gif" alt="" class="com-react-icon"> </div> <div class="com-sad-react-click"> <img src="assets/images/gif/sad.gif" alt="" class="com-react-icon"> </div> <div class="com-angry-react-click"> <img src="assets/images/gif/angry.gif" alt="" class="com-react-icon"> </div></div>'
                );
            }, function() {
                var mainReact = $(this).find('.com-react-bundle-wrap');
                $(mainReact).html('');
            })
        }



        //-------COMMENT REACT ACTIONS----------------
        $(document).on('click', '.com-react-icon', function() {
            var com_bundle = $(this).parents('.com-react-bundle-wrap');
            var commentid = $(com_bundle).data('commentid');
            console.log('commentid--->', commentid);
            var likeReact = $(this).parent();
            comReactApply(likeReact, commentid);
        })

        function comReactApply(sClass, commentid) {

            if ($(sClass).hasClass('com-like-react-click')) {
                comReactSub('like', commentid);
            } else if ($(sClass).hasClass('com-love-react-click')) {
                comReactSub('love', commentid);
            } else if ($(sClass).hasClass('com-heart-react-click')) {
                comReactSub('heart', commentid);
            } else if ($(sClass).hasClass('com-haha-react-click')) {
                comReactSub('haha', commentid);
            } else if ($(sClass).hasClass('com-wow-react-click')) {
                comReactSub('wow', commentid);
            } else if ($(sClass).hasClass('com-sad-react-click')) {
                comReactSub('sad', commentid);
            } else if ($(sClass).hasClass('com-angry-react-click')) {
                comReactSub('angry', commentid);
            } else {
                console.log('not found');
            }

        }

        function comReactSub(typeR, commentid) {

            var reactColor = '' + typeR + '-color';
            var parentClass = $('.com-' + typeR + '-react-click');

            var grandParent = $(parentClass).parents('.com-rlike-react');
            var postid = $(grandParent).data('postid');
            var userid = $(grandParent).data('userid');
            var spanClass = $(grandParent).find('.com-like-action-text').find('span');
            var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-text-option-wrap').find(
                '.com-nf-3-wrap');

            console.log('ahiooooo--->', com_nf_3);


            if ($(spanClass).attr('class') !== undefined) {
                if ($(spanClass).hasClass(reactColor)) {
                    $(spanClass).removeAttr('class');
                    $spanClass.text('Like');
                    comReactDelete(typeR, postid, userid, commentid, com_nf_3);
                } else {
                    $(spanClass).removeClass().addClass(reactColor);
                    spanClass.text(typeR);
                    comReactSubmit(typeR, postid, userid, commentid, com_nf_3);
                }
            } else {
                $(spanClass).addClass(reactColor);
                spanClass.text(typeR);
                comReactSubmit(typeR, postid, userid, commentid, com_nf_3);
            }


        }

        $(document).on('click', '.com-like-action-text', function() {
            console.log('rrrrrr')
            var thisParents = $(this).parents('.com-rlike-react');
            console.log('adadadad', thisParents);
            var postid = $(thisParents).data('postid');
            console.log('postid->', postid);
            var userid = $(thisParents).data('userid');
            var commentid = $(thisParents).data('commentid');
            console.log('commentid->', commentid);
            var typeText = $(thisParents).find('.com-like-action-text');
            var typeR = $(typeText).text();
            var com_nf_3 = $(thisParents).parents('.com-react').siblings(
                    '.com-text-option-wrap')
                .find(
                    '.com-nf-3-wrap');
            console.log('ahiooooo--->', com_nf_3);

            var spanClass = $(thisParents).find('.com-like-action-text').find('span');
            if ($(spanClass).attr('class') !== undefined) {
                $(spanClass).removeAttr('class');
                spanClass.text('Like');
                comReactDelete(typeR, postid, userid, commentid, com_nf_3);
            } else {
                $(spanClass).addClass('like-color');
                spanClass.text('Like');
                comReactSubmit(typeR, postid, userid, commentid, com_nf_3);
            }

        })

        function comReactSubmit(typeR, postid, userid, commentid, com_nf_3) {
            console.log('postid---->', postid);
            var profileid = "<?php echo $post->user_id; ?>";
            $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                    commentid: commentid,
                    reactType: typeR,
                    postid: postid,
                    userid: userid,
                    profileid: profileid,
                },
                function(data) {
                    $(com_nf_3).empty().html(data);
                    console.log(data);
                });

        }

        function comReactDelete(typeR, postid, userid, commentid, com_nf_3) {
            var profileid = "<?php echo $post->user_id; ?>";
            $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                    deleteReactType: typeR,
                    deleteCommentid: commentid,
                    postid: postid,
                    userid: userid,
                    profileid: profileid,
                },
                function(data) {
                    $(com_nf_3).empty().html(data);
                    console.log(data);
                });

        }
        $(document).on('mouseover', '.new-comment', function() {
            $('.com-dot-option-wrap').css('display', "flex")
        })
        $(document).on('mouseout', '.new-comment', function() {
            $('.com-dot-option-wrap').hide()

        })

        $(document).on('click', '.com-dot-option-wrap', function() {
            $('.com-dot-option-wrap').removeAttr('id');
            $(this).attr('id', 'com-opt-click');
            var postid = $(this).data('postid');
            var userid = $(this).data('userid');
            var commentid = $(this).data('commentid');
            var comDetails = $(this).siblings('.com-option-details-container1');
            $(comDetails).show().html(
                '<div class="com-option-details1" > <ul> <li class="com-edit" data-postid="' +
                postid + '" data-userid="' + userid + '" data-commentid="' + commentid +
                '"> Edit</li> <li class="com-delete" data-postid="' + postid +
                '" data-userid="' + userid + '" data-commentid="' + commentid +
                '"> Delete</li> <li class="com-privacy" data-postid="' + postid +
                '" data-userid="' + userid + '" data-commentid="' + commentid +
                '"> Privacy</li> </ul> </div>');


        })

        $(document).on('click', 'li.com-edit', function() {
            var comTextContainer = $(this).parents('.com-dot-option-wrap').siblings(
                '.com-pro-text').find('.com-text');
            var addId = $(comTextContainer).attr('id', 'editComPut');
            var getComText1 = $(comTextContainer).text();
            var postid = $(comTextContainer).data('postid');
            var userid = $(comTextContainer).data('userid');
            var commentid = $(comTextContainer).data('commentid');
            var profilepic = $(comTextContainer).data('profilepic');
            var getComText = getComText1.replace(/\s+/g, " ").trim();
            $('.com-dot-option-wrap').html(
                '<div class="top-box-show"><div class="close-box"><i class="fa-solid fa-xmark"></i> </div> <div class="comment-dialog-show"> <div class="profilePic"> <img src="' +
                profilepic +
                '" alt=""> </div> <div class="status-prof-textarea"> <textarea name="textStatus" cols="30" class="editCom" autofocus style="resize: none;" rows="1">' +
                getComText + '</textarea> </div> <div class="edit-com-save" data-postid="' +
                postid + '" data-userid="' + userid + '" data-commentid="' + commentid +
                '"> Save </div> </div> </div>');
        })

        $(document).on('click', '.edit-com-save', function() {
            var postid = $(this).data('postid');
            var userid = $(this).data('userid');
            var commentid = $(this).data('commentid');
            var editedText = $(this).siblings('status-prof-textarea').find('.editCom');
            var editedTextVal = $(editedText).val();
            console.log(editedTextVal)
            $.post('http://localhost/facebook/core/ajax/editComment.php', {
                postid: postid,
                userid: userid,
                editedTextVal: editedTextVal,
                commentid: commentid,
            }, function(data) {
                $('#editComPut').html(data).removeAttr('id');
                $('.com-dot-option-wrap').empty();
            })
        })
        $(document).on('click', '.com-delete', function() {
            var postid = $(this).data('postid');
            var userid = $(this).data('userid');
            var commentid = $(this).data('commentid');
            var commentContainer = $(this).parents('.new-comment');
            var profileid = "<?php echo $post->user_id ?>";
            var r = confirm('Are you sure you want to delete this comment.');
            if (r === true) {
                $.post('http://localhost/facebook/core/ajax/editComment.php', {
                    deletePostid: postid,
                    userid: userid,
                    commentid: commentid,
                    profileid: profileid,
                }, function(data) {
                    $(commentContainer).empty();
                })
            }
        })

        //----------------SHARE--------------------------------------
        $(document).on('click', '.share-action', function() {

            var postid = $(this).data('postid');
            var userid = $(this).data('userid');
            var profilepic = $(this).data('profilepic');
            var profileid = $(this).data('profileid');
            var nf_1 = $(this).parents('.nf-4').siblings('.post_header').html();
            var nf_2 = $(this).parents('.nf-4').siblings('.nf-2').html();
            $('.post_share_box').html(
                '<div style=" position: fixed; top: 50%; left: 50%;transform:translate(-50%,-50%); display: flex; flex-direction: column; border-radius: 10px; padding: 10px 15px; overflow-y: auto; box-shadow: 0 8px 32px 0 rgba(173, 174, 182, 0.17); width: 500px; min-height: 420px; max-height: 620px; background-color: #fff;"> <div class="post_box_header"> <h3>Share Post</h3> <div class="header_icon" id="close_share"><i class="fa-solid fa-xmark"></i></div> </div><div class="share_box_field"><textarea class="share_text" autofocus style="resize:none;" placeholder="Whats on your mind ? mohamed"></textarea></div> ' +
                nf_1 + '' + nf_2 +
                '<button data-postid="' + postid + '" data-userid="' + userid +
                '" data-profilepic="' + profilepic + '" data-profileid="' + profileid +
                '" class="post_button post-share" id="post-share">Share</button></div>');

            /* $('.post_header_right').hide(); */
        })

        $(document).on('click', '#post-share', function() {
            var userid = $(this).data('userid');
            var postid = $(this).data('postid');
            var profileid = $(this).data('profileid');
            var shareText = $(this).siblings('.share_box_field').find('.share_text').val();

            $.post('http://localhost/facebook/core/ajax/share.php', {
                shareText: shareText,
                profileid: profileid,
                postid: postid,
                userid: userid,
            }, function(data) {
                console.log(data)

            })

        })
        //---- Post Manupilation--->

        //-----------------------------------COMMENT PHOTO--->
        $(document).on('click', '#camera_m', function() {
            $('#comment_imggg').click();
        })
        $(function() {
            $(document).on('change', '#comment_imggg', function() {

                var name = $('#comment_imggg').val().split('\\').pop();
                var file_data = $('#comment_imggg').prop('files')[0];
                var file_size = file_data["size"];
                var file_type = file_data["type"].split('/').pop();
                var userid = "<?php echo $userid ?>";
                var image_name = 'user/' + userid + '/cover/' + name + '';
                var form_data = new FormData();
                form_data.append('file', file_data);
                if (name != '') {
                    $.post('http://localhost/facebook/core/ajax/CommentPicture.php', {
                        image_name_c: image_name,
                        userid: userid
                    }, function(data) {


                    })
                }
                $.ajax({
                    url: 'http://localhost/facebook/core/ajax/CommentPicture.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(data) {
                        $('.comment_img_preview').append(data)
                    }
                })


            })
        })




        $(document).mouseup(function(e) {
            var container = new Array();

            container.push('.com-option-details-container1');

            $.each(container, function(key, value) {
                if (!$(value).is(e.target) && $(value).has(e.target)
                    .length === 0) {
                    $(value).hide()


                }
            })
        })
        //------------------->
        </script>
</body>

</html>