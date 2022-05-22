<?php
include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
 }else{
     header('Location:login.php');
 }
 
 $userInfo = $loadUser->getUserInfo($userid);
 $friends_requests_Total=$loadUser->getFriendsRequestsTotal($userid);
 $posts=$loadPost->Homeposts($userid,100);
 $friends = $loadUser->getAllFriends($userid);
 $allusers = $loadPost->lastmessages($userid);
 $search_history=$loadUser->getSearchHistory($userid);
 $notifications=$loadUser->notifications($userid);
 $notificationsTotal=$loadUser->notificationsTotal($userid);
 $lastMsgReceived=$loadPost->lastPersonMsg($userid);
 $userStories=$loadUser->getUserStories($userid);
 $stories=$loadUser->getAllFollowingStories($userid);
 if(!empty($lastMsgReceived)){
     $lastMsgUserid = $lastMsgReceived->user_id;
 }

 
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if(count($notificationsTotal)>0){echo '('.count($notificationsTotal).')';}   ?>Facebook</title>
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/profile.css" />
    <link rel="stylesheet" href="assets/css/friends.css" />
    <link rel="stylesheet" href="assets/css/header_menu.css" />
    <link rel="stylesheet" href="assets/css/chat.css" />
    <link rel="icon" href="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">
    <link rel="stylesheet" href="assets/emojis/emojis.css">
    <link rel="stylesheet" href="assets/css/home.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"
        integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/jquery.js"></script>

    <script src="assets/dist/emojionearea.js"></script>

</head>

<?php include 'components/header.php' ?>


<body style="background:#f0f2f5">
    <div class="facebook">
        <div class="facebook_left">
            <div style="border-bottom: 1px solid #ced0d4">
                <div class="home_links">
                    <a href="<?php echo BASE_URL.$userInfo->link ?>" class="home_link" style="padding-top:10px">
                        <img class="home_iagina" src="<?php echo $userInfo->profile_picture ?>" alt="">
                        <span><?php echo $userInfo->first_name.' '.$userInfo->last_name ?></span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/friends.png" alt="">
                        <span>Find Friends</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/marketplace.png" alt="">
                        <span>Marketplace</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/watch.png" alt="">
                        <span>Watch</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/groups.png" alt="">
                        <span>Groups</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/memories.png" alt="">
                        <span>Memories</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/saved.png" alt="">
                        <span>Saved</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/pages.png" alt="">
                        <span>Pages</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/Events.png" alt="">
                        <span>Jobs</span>
                    </a>
                    <a class="home_link" id="open_more">
                        <div class="arrit_down">
                            <svg viewBox="0 0 16 16" width="1em" height="1em"
                                class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 fzdkajry jnigpg78 odw8uiq3">
                                <g fill-rule="evenodd" transform="translate(-448 -544)">
                                    <path fill-rule="nonzero"
                                        d="M452.707 549.293a1 1 0 0 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L456 552.586l-3.293-3.293z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span>See more</span>
                    </a>
                </div>
                <div class="sub_home_links">
                    <a href="#" class="home_link">
                        <img src="assets/images/home/ad.png" alt="">
                        <span>Ad Center</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/ads.png" alt="">
                        <span>Ads Manager</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/campus.png" alt="">
                        <span>Campus</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/climate.png" alt="">
                        <span>Climate Science Center</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/community.png" alt="">
                        <span>Community Help</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/covid.png" alt="">
                        <span>COVID-19 Information Center</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/emotional.png" alt="">
                        <span>Emotional Health</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/pay.png" alt="">
                        <span>Facebook Pay</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/fav.png" alt="">
                        <span>Favorites</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/gaming.png" alt="">
                        <span>Gaming Video</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/live.png" alt="">
                        <span>Live Videos</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/messenger.png" alt="">
                        <span>Messenger</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/messkids.png" alt="">
                        <span>Messenger Kids</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/recent.png" alt="">
                        <span>Most Recent</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/recentad.png" alt="">
                        <span>Recent Ad Activity</span>
                    </a>
                    <a href="#" class="home_link">
                        <img src="assets/images/home/weather.png" alt="">
                        <span>Weather</span>
                    </a>
                </div>
                <a class="home_link" id="open_less">
                    <div class="arrit_down">
                        <svg viewBox="0 0 16 16" width="1em" height="1em"
                            class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 fzdkajry jnigpg78 odw8uiq3">
                            <g fill-rule="evenodd" transform="translate(-448 -544)">
                                <path fill-rule="nonzero"
                                    d="M452.707 549.293a1 1 0 0 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L456 552.586l-3.293-3.293z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span>See less</span>
                </a>
            </div>
            <div class="shortcuts">
                <span>Your Shortcuts
                </span>
                <div class="short_edit">Edit</div>
            </div>
            <div class="bt_left">
                <a href="#">Privacy.</a>
                <a href="#">Terms.</a>
                <a href="#">Advertising.</a>
                <a href="#">Ad Choices.</a>
                <a href="#">Cookies.</a>
                <a href="#">More.</a><br>
                <a href="#">Meta @ 2021</a>
            </div>
        </div>
        <div class="facebook_middle">

            <!-------Hidden Elements--------->

            <!-------Hidden Elements--------->

            <!-------llah yster--------->
            <!--------STORIES----------->


            <div class="stories_wrapper">
                <a href="http://localhost/facebook/stories/create" class="create_story">
                    <img src="<?php echo $userInfo->profile_picture ?>" alt="">
                    <div class="add_round_story">
                        <div class="add_round_story_inside">
                            <svg viewBox="0 0 20 20" width="1em" height="1em" fill="#fff"
                                class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 p361ku9c jnigpg78 odw8uiq3">
                                <g fill-rule="evenodd" transform="translate(-446 -350)">
                                    <g fill-rule="nonzero">
                                        <path d="M95 201.5h13a1 1 0 1 0 0-2H95a1 1 0 1 0 0 2z"
                                            transform="translate(354.5 159.5)"></path>
                                        <path d="M102.5 207v-13a1 1 0 1 0-2 0v13a1 1 0 1 0 2 0z"
                                            transform="translate(354.5 159.5)"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="create_story_text">Create Story</div>
                    <div class="greyesh"></div>
                </a>
                <?php 
                if(count($userStories)>0){
                    ?>
                <a href="http://localhost/facebook/stories?uuid=<?php echo $userStories[0]->story_id ?>"
                    class="story_peak">
                    <img class="story_peak_img" src="<?php echo $userStories[0]->profile_picture ?>" alt="">
                    <?php
                      if($userStories[0]->story_bg != ''){
                         
                          ?>
                    <img class="img" src="<?php echo $userStories[0]->story_bg ?>" alt="">
                    <?php
                      }else if($userStories[0]->story_img !=''){
                        ?>
                    <img class="img" src="<?php echo $userStories[0]->story_img ?>" alt="">
                    <?php
                      }
                      if($userStories[0]->story_text != ''){
                        ?>
                    <span class="preview_st_text"><?php echo $userStories[0]->story_text ?></span>
                    <?php
                    }
                      ?>
                </a>
                <?php
                }
                    
                ?>


                <div class="list_of_stories">
                    <?php 
                    if($stories !=''){
                        foreach ($stories as $story){
                            $count=count($loadUser->getUserStories($story->story_user));
                            if( $story->main=='yes'){
                                ?>
                    <a href="http://localhost/facebook/stories?uuid=<?php echo $story->story_id ?>" class="story_peak">
                        <img class="story_peak_img" src="<?php echo $story->profile_picture ?>" alt="">
                        <?php
      
                          
                           ?>
                        <img class="img" src="<?php echo $story->story_bg ?>" alt="">
                        <?php
                       
                       
                       ?>
                    </a>
                    <?php
                            }
                            }
                            
                        
            
                      } 
                 ?>
                </div>
            </div>
            <!--------STORIES----------->

            <!--------create post----------->
            <div class="home_post_wrapper">
                <div class="home_post_top">
                    <img class="home_user_post_img" src=<?php echo $userInfo->profile_picture ?> alt="">
                    <div class="home_post_open">

                        Whats' on your mind, <?php echo $userInfo->first_name ?>?

                    </div>
                </div>
                <div class="home_post_bottom">
                    <div class="home_choice">
                        <svg viewBox="0 0 24 24" width="1.5rem" height="1.5rem" fill="#f3425f">
                            <g fill-rule="evenodd" transform="translate(-444 -156)">
                                <g>
                                    <path
                                        d="M113.029 2.514c-.363-.088-.746.014-1.048.234l-2.57 1.88a.999.999 0 0 0-.411.807v8.13a1 1 0 0 0 .41.808l2.602 1.901c.219.16.477.242.737.242.253 0 .508-.077.732-.235.34-.239.519-.65.519-1.065V3.735a1.25 1.25 0 0 0-.971-1.22m-20.15 6.563c.1-.146 2.475-3.578 5.87-3.578 3.396 0 5.771 3.432 5.87 3.578a.749.749 0 0 1 0 .844c-.099.146-2.474 3.578-5.87 3.578-3.395 0-5.77-3.432-5.87-3.578a.749.749 0 0 1 0-.844zM103.75 19a3.754 3.754 0 0 0 3.75-3.75V3.75A3.754 3.754 0 0 0 103.75 0h-10A3.754 3.754 0 0 0 90 3.75v11.5A3.754 3.754 0 0 0 93.75 19h10z"
                                        transform="translate(354 158.5)"></path>
                                    <path
                                        d="M98.75 12c1.379 0 2.5-1.121 2.5-2.5S100.129 7 98.75 7a2.503 2.503 0 0 0-2.5 2.5c0 1.379 1.121 2.5 2.5 2.5"
                                        transform="translate(354 158.5)"></path>
                                </g>
                            </g>
                        </svg>
                        Live Video
                    </div>
                    <div class="home_choice" id="open_post_imgs_direct">
                        <svg viewBox="0 0 24 24" width="1.5rem" height="1.5rem" fill="#45bd62">
                            <g fill-rule="evenodd" transform="translate(-444 -156)">
                                <g>
                                    <path
                                        d="m96.968 22.425-.648.057a2.692 2.692 0 0 1-1.978-.625 2.69 2.69 0 0 1-.96-1.84L92.01 4.32a2.702 2.702 0 0 1 .79-2.156c.47-.472 1.111-.731 1.774-.79l2.58-.225a.498.498 0 0 1 .507.675 4.189 4.189 0 0 0-.251 1.11L96.017 18.85a4.206 4.206 0 0 0 .977 3.091s.459.364-.026.485m8.524-16.327a1.75 1.75 0 1 1-3.485.305 1.75 1.75 0 0 1 3.485-.305m5.85 3.011a.797.797 0 0 0-1.129-.093l-3.733 3.195a.545.545 0 0 0-.062.765l.837.993a.75.75 0 1 1-1.147.966l-2.502-2.981a.797.797 0 0 0-1.096-.12L99 14.5l-.5 4.25c-.06.674.326 2.19 1 2.25l11.916 1.166c.325.026 1-.039 1.25-.25.252-.21.89-.842.917-1.166l.833-8.084-3.073-3.557z"
                                        transform="translate(352 156.5)"></path>
                                    <path fill-rule="nonzero"
                                        d="m111.61 22.963-11.604-1.015a2.77 2.77 0 0 1-2.512-2.995L98.88 3.09A2.77 2.77 0 0 1 101.876.58l11.603 1.015a2.77 2.77 0 0 1 2.513 2.994l-1.388 15.862a2.77 2.77 0 0 1-2.994 2.513zm.13-1.494.082.004a1.27 1.27 0 0 0 1.287-1.154l1.388-15.862a1.27 1.27 0 0 0-1.148-1.37l-11.604-1.014a1.27 1.27 0 0 0-1.37 1.15l-1.387 15.86a1.27 1.27 0 0 0 1.149 1.37l11.603 1.016z"
                                        transform="translate(352 156.5)"></path>
                                </g>
                            </g>
                        </svg>
                        Photo/video
                    </div>
                    <div class="home_choice">
                        <svg viewBox="0 0 24 24" fill="#f7b928" width="1.6rem" height="1.6rem"
                            class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 ky11obwa rgmg9uty b73ngqbp">
                            <g fill-rule="evenodd" transform="translate(-444 -156)">
                                <g>
                                    <path
                                        d="M107.285 13c.49 0 .841.476.712.957-.623 2.324-2.837 4.043-5.473 4.043-2.636 0-4.85-1.719-5.473-4.043-.13-.48.222-.957.712-.957h9.522z"
                                        transform="translate(353.5 156.5)"></path>
                                    <path fill-rule="nonzero"
                                        d="M114.024 11.5c0 6.351-5.149 11.5-11.5 11.5s-11.5-5.149-11.5-11.5S96.173 0 102.524 0s11.5 5.149 11.5 11.5zm-2 0a9.5 9.5 0 1 0-19 0 9.5 9.5 0 0 0 19 0z"
                                        transform="translate(353.5 156.5)"></path>
                                    <path
                                        d="M99.524 8.5c0 .829-.56 1.5-1.25 1.5s-1.25-.671-1.25-1.5.56-1.5 1.25-1.5 1.25.671 1.25 1.5m8.5 0c0 .829-.56 1.5-1.25 1.5s-1.25-.671-1.25-1.5.56-1.5 1.25-1.5 1.25.671 1.25 1.5m-.739 4.5h-9.522c-.49 0-.841.476-.712.957.623 2.324 2.837 4.043 5.473 4.043 2.636 0 4.85-1.719 5.473-4.043.13-.48-.222-.957-.712-.957m-2.165 2c-.667.624-1.592 1-2.596 1a3.799 3.799 0 0 1-2.596-1h5.192"
                                        transform="translate(353.5 156.5)"></path>
                                </g>
                            </g>
                        </svg>
                        Feeling/activity
                    </div>
                </div>
            </div>
            <!--------create post----------->

            <!--------posts----------->
            <!------POSTS------>
            <?php foreach ($posts as $post) { ?>



            <!------POST  FUNCTIONS DATA------>
            <?php 
            $profileId=$post->user_id;
    $main_react =$loadPost->main_react($userid,$post->post_id);
    $react_max_show =$loadPost->react_max_show($post->post_id);
    $main_react_count =$loadPost->main_react_count($post->post_id);
    $commentDetails = $loadPost->commentFetch($post->post_id);
    $totalCommentCount=$loadPost->totalCommentCount($post->post_id);
    $totalShareCount =$loadPost->totalShareCount($post->post_id);
   
    if(empty($post->shareId)){

    }else{
       $shareDetails = $loadPost->shareFetch($post->shareId,$post->postedBy);

    }
?>
            <!------POST  FUNCTIONS DATA------>
            <!------POST------>
            <div class="post">
                <div class="post_share_box">

                </div>
                <!------POST-HEADER------>
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
             if($userid === $profileId){ ?>
                    <div style="position:relative">
                        <div class="post_header_right">
                            <i class="fa-solid fa-ellipsis">
                            </i>
                        </div>
                        <ul class="post-menu" data-userid="<?php echo $userid; ?>"
                            data-userid="<?php echo $post->post_id; ?>">
                            <li>
                                <i class="pin_icon"></i>
                                <div class="li-a7a">
                                    <span>Pin Post</span>
                                </div>
                            </li>
                            <li id="open-save-post" data-postid="<?php echo $post->post_id; ?>"> <i
                                    class="sav_icon"></i>
                                <div class="li-a7a">
                                    <span>Save Post</span>
                                    <span class="spanitto">Add this to your saved items.</span>
                                </div>
                            </li>
                            <div class="hrr"></div>
                            <li id="open-edit-post" data-postid="<?php echo $post->post_id; ?>">
                                <i class="ed_icon"></i>
                                <div class="li-a7a">
                                    <span>Edit Post</span>
                                </div>
                            </li>
                            <li>
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yP/r/0e5FTOFd_jg.png" alt="">
                                <div class="li-a7a">
                                    <span>Edit audience</span>
                                </div>
                            </li>
                            <li>
                                <i class="nott_icon"></i>
                                <div class="li-a7a">
                                    <span>Turn off notifications for this post</span>
                                </div>
                            </li>
                            <li>
                                <i class="tr_icon"></i>
                                <div class="li-a7a">
                                    <span>turn off translations</span>
                                </div>
                            </li>
                            <li>
                                <i class="d_icon"></i>
                                <div class="li-a7a">
                                    <span>Edit date</span>
                                </div>
                            </li>
                            <li>
                                <i class="ref_icon"></i>
                                <div class="li-a7a">
                                    <span>Refresh share attachment</span>
                                </div>
                            </li>
                            <div class="hrr"></div>
                            <li>
                                <i class="arch_icon"></i>
                                <div class="li-a7a">
                                    <span>Move to archive</span>
                                </div>
                            </li>
                            <li id="delete_post" data-postid="<?php echo $post->post_id ?>"
                                data-userid="<?php echo $userid ?>">
                                <i class="tr_icon"></i>
                                <div class="li-a7a">
                                    <div class="li-a7a">
                                        <span>Move to trash</span>
                                        <span class="spanitto">items in your trash are deleted after 30 days.</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php  }else{ ?>
                    <div style=" position:relative">
                        <div class="post_header_right">
                            <i class="fa-solid fa-ellipsis">
                            </i>
                        </div>
                        <ul class="post-menu" data-userid="<?php echo $userid; ?>"
                            data-userid="<?php echo $post->post_id; ?>">
                            <li id="open-save-post">
                                <i class="sav_icon"></i>
                                <div class="li-a7a">
                                    <span>Save Post</span>
                                    <span class="spanitto">Add this to your saved items.</span>
                                </div>
                            </li>
                            <div class="hrr"></div>

                            <li>
                                <i class="cpy_icon"></i>
                                <div class="li-a7a">
                                    <span>Copy Link</span>
                                </div>
                            </li>
                            <li>
                                <i class="nott_icon"></i>
                                <div class="li-a7a">
                                    <span>Turn on notifications for this post</span>
                                </div>
                            </li>
                            <li>
                                <i class="emb_icon"></i>
                                <div class="li-a7a">
                                    <span>Embed</span>
                                </div>
                            </li>
                            <div class="hrr"></div>


                            <li>
                                <i class="sav_icon"></i>
                                <div class="li-a7a">
                                    <span>Hide Post</span>
                                    <span class="spanitto">See fewer posts like this.</span>
                                </div>
                            </li>
                            <li>
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yr/r/G0M6vSYdWBi.png" alt="">
                                <div class="li-a7a">
                                    <span>Snoose <?php echo $post->first_name.' '.$post->last_name ?> for 30
                                        days.</span>
                                    <span class="spanitto">Temporarily stop seeing posts.</span>
                                </div>
                            </li>
                            <li id="unfollow_menu" data-userid="<?php echo $userid ?>"
                                data-profileId="<?php echo $post->user_id ?>">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yI/r/bnvx9uLOEsq.png" alt="">
                                <div class="li-a7a">
                                    <span>Unfollow <?php echo $post->first_name.' '.$post->last_name ?></span>
                                    <span class=" spanitto">Stop seeing posts from this user.</span>
                                </div>
                            </li>
                            <li>
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y8/r/0lXA3kApbrr.png" alt="">
                                <div class="li-a7a">
                                    <span>Find support or repost post</span>
                                    <span class="spanitto">I'm concerened about this post..</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <?php   } ?>


                </div>
                <!------POST-HEADER------>

                <div class="nf-2">
                    <!------POST-TEXT------>
                    <div class="post_text" id="post_text" data-postid="<?php echo $post->post_id ?>">
                        <?php  
           

           if(empty($post->shareId)){

               $temp = $post->post;
               $new = preg_replace("/@([\w]+)/","<a class='mention_link' href='".BASE_URL."$1'>$0</a>",$temp);
                echo $new;
             
           }else{
                echo $post->shareText;
                   echo '<span class="shared-post-txt" data-postid="'.$post->post_id;'" data-userid="'.$userid;'" data-profilepic="'.$post->profile_picture;'">'.$post->shareText.'</span>';
                   
               
               foreach($shareDetails as $share){
                   ?>
                        <div class=" share-container">

                            <div class="post_header">
                                <div class="post_header_left">
                                    <a href="<?php echo BASE_URL.$post->link ?>"> <img
                                            src="<?php echo $share->profile_picture ?>" alt=""></a>
                                    <div class="post_header_left_name">
                                        <a href="<?php echo BASE_URL.$share->link ?>" class="postedBy">
                                            <?php echo $share->first_name.' '.$share->last_name ?>
                                        </a>
                                        <span class="postedAt"><?php echo $loadUser->timeAgo($share->postedAt) ?></span>
                                    </div>
                                </div>

                            </div>
                            <!------POST-TEXT------>
                            <div class="nf-2">
                                <!------POST-TEXT------>
                                <div class="post_text">
                                    <?php echo $share->post ?>
                                </div>
                                <!------POST-TEXT------>

                                <!------POST-IMAGES------>
                                <?php 
    if($share->postImages !=''){
        $imgs=json_decode($share->postImages);
        $count = 0;
        for($i=0;$i<count($imgs);$i++){
            echo'<div class="post_images" data-img-id="'.$post->post_id.'">
           <a href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'"> <img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
            class="post_img" data-userid="'.$userid.'" data-profileid="'.$post->user_id.'" data-postid="'.$post->post_id.'"></a>
            </div>';   
        }
    
    }
     ?>
                            </div>
                            <!------POST-TEXT------>
                            <?php
               }
               
        
            }
           ?>
                        </div>


                        <!------POST-IMAGES------>
                        <?php 
    if($post->postImages !=''){
        $imgs=json_decode($post->postImages);
        $lengthh=count($imgs);
        


        
    
        $link = BASE_URL.'post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[0]->imageName;
        $count = 0;
        if(count($imgs)==1){ ?>
                        <div class="grid_1"> <?php
            for($i=0;$i<count($imgs);$i++){ 
                echo'
                 <a   href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                class="" data-userid="'.$userid.'" data-profileid="'.$post->user_id.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                        </div>
                        <?php  }
        if(count($imgs)==2){ ?>
                        <div class="grid_2"> <?php
            for($i=0;$i<count($imgs);$i++){ 
                echo'
                 <a   href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                class="" data-userid="'.$userid.'" data-profileid="'.$post->user_id.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                        </div>
                        <?php  }
        if(count($imgs)==3){ ?>
                        <div class="grid_3"> <?php
            for($i=0;$i<count($imgs);$i++){ 
                echo'
                 <a  class="img-'.$i.'" href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                 data-userid="'.$userid.'" data-profileid="'.$profileId.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                        </div>
                        <?php  }
        if(count($imgs)==4){ ?>
                        <div class="grid_4"> <?php
            for($i=0;$i<count($imgs);$i++){ 
                echo'
                 <a  class="img-'.$i.'" href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                 data-userid="'.$userid.'" data-profileid="'.$profileId.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                        </div>
                        <?php  }
        if(count($imgs)==5){ ?>
                        <div class="grid_5"> <?php
            for($i=0;$i<count($imgs);$i++){ 
                echo'
                 <a  class="img-'.$i.'" href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                 data-userid="'.$userid.'" data-profileid="'.$profileId.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                        </div>
                        <?php  }
        if(count($imgs)>5){ ?>
                        <div class="grid_5"> <?php
            for($i=0;$i<5;$i++){ 
                echo'
                 <a  class="img-'.$i.'" href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'" data-length="'.$lengthh.'"
                            data-img-id="'.$post->post_id.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'"
                                 data-userid="'.$userid.'" data-profileid="'.$profileId.'"
                                data-postid="'.$post->post_id.'"></a>
                            ';
                          
                            } ?>
                            <a href="<?php echo BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[4]->imageName ?>"
                                data-length="'.$lengthh.'" class="more-pics-shadow">
                                <?php echo '+'.$lengthh - 4 ?>
                            </a>
                        </div>
                        <?php  }



                        }?>

                    </div>
                    <!------POST-IMAGES------>

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
                          style="width:18.5px;height:18.5px;cursor:pointer">';
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

                    <!------POST-ACTIONS------>
                    <div class="border-t">
                        <div class="bbb"></div>
                    </div>
                    <div class="nf-4" style="transform: translateX(2.7rem);">

                        <div class="like-action-wrap" data-postid="<?php echo $post->post_id ?>"
                            data-userid="<?php echo $userid ?>" data-profileid="<?php echo $post->user_id ?>">
                            <div class="react-bundle-wrap">

                            </div>
                            <div class="like-action ra" data-profileid="<?php echo $post->user_id ?>">
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
                                        src="assets/images/react/<?php echo $main_react->reactType ?>.svg" alt=""
                                        class="">
                                    <div class="like-action-text">
                                        <span
                                            class="<?php echo $main_react->reactType."-color" ?>"><?php echo $main_react->reactType; ?></span>
                                    </div>
                                </div>
                                <?php  }?>
                            </div>
                        </div>
                        <div class=" react_btn_wrapper comment-action">
                            <i class="comment_button"></i>Comment
                        </div>
                        <div class="react_btn_wrapper share-action" data-postid="<?php echo $post->post_id ?>"
                            data-profilepic="<?php echo $userInfo->profile_picture ?>"
                            data-userid="<?php echo $userid ?>" data-profileid="<?php echo $post->user_id; ?>">

                            <i class="share_button"></i>Share
                        </div>


                    </div>

                    <!------POST-ACTIONS------>
                    <!------POST-COMMENTS------>

                    <!------POST-COMMENTS------>
                    <div class="nf-5">
                        <div class="comment-list">
                            <ul class="add-comment">
                                <div class="comment-write">
                                    <div class="com-pro-pick">
                                        <a href="#">
                                            <div class="top-pic">
                                                <img src="<?php echo $userInfo->profile_picture ?>" alt="">
                                            </div>
                                        </a>
                                    </div>


                                    <div class="com-input">
                                        <div class="comment-input" data-postid="<?php echo $post->post_id ?>"
                                            data-userid="<?php echo $userid  ?>"
                                            data-profileid="<?php echo $post->user_id  ?>">
                                            <input type="text" class="comment-input-style comment-submit"
                                                id="comment-inputt" placeholder="Write a comment..." />
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
                                <?php 
    
                        if(!empty($commentDetails)){
                        $slicer=3;

                        foreach (array_slice($commentDetails,0,$slicer) as $comment){
                        
                        
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
                                                    <img src="<?php echo $comment->profile_picture ?>"
                                                        class="pdp_comment" alt="">
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
                                                                    data-userid="<?php echo $userInfo->id ?>"
                                                                    data-commentid="<?php echo $comment->comment_id ?>"
                                                                    data-profilepic="<?php echo $userInfo->profile_picture ?>">

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
                                                    <div class="com-dot-option-wrap">
                                                        <div class="com-dot"
                                                            data-postid="<?php echo $comment->commentedOn ?>"
                                                            data-userid="<?php echo $userid  ?>"
                                                            data-commentid="<?php echo $comment->comment_id ?>">
                                                            <i class="fa-solid fa-ellipsis"></i>
                                                        </div>
                                                        <div class="com-option-details-container"
                                                            id="com-option-details-container">
                                                        </div>

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
                                                        data-commentid="<?php echo $comment->comment_id ?>"
                                                        data-profileid="<?php echo $post->user_id ?>">
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
                                                        data-profilepic="<?php echo $userInfo->profile_picture ?>">
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
                            <?php
                           if(count($commentDetails) >3){ ?>
                            <div class="show_more_com" data-postid="<?php echo $post->post_id ?>">
                                <a>View more comments
                                </a>
                            </div>
                            <?php }
                           ?>



                        </div>





                        <!------POST-INFOS------>


                    </div>
                    <!------POST------>



                    <!------POSTS------>
                    <!--------posts----------->
                </div>
                <?php } ?>
                <!-------llah yster--------->
            </div>
            <div class="facebook_right">

                <div class="contacts_m_list">
                    <div class="mlist_header">
                        <span>Contacts</span>
                        <div class="mrighte">
                            <div class="micon">
                                <svg fill="#65676b" viewBox="0 0 16 16" width="1em" height="1em"
                                    class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv gl3lb2sf hhz5lgdu">
                                    <g fill-rule="evenodd" transform="translate(-448 -544)">
                                        <path
                                            d="M457.25 552.5H455v2.25a.75.75 0 0 1-1.5 0v-2.25h-2.25a.75.75 0 0 1 0-1.5h2.25v-2.25a.75.75 0 0 1 1.5 0V551h2.25a.75.75 0 0 1 0 1.5m6.38-4.435a.62.62 0 0 0-.64.047l-2.49 1.634v-1.394a1.854 1.854 0 0 0-1.852-1.852l-8.796.002a1.854 1.854 0 0 0-1.851 1.852v6.793c0 1.021.83 1.852 1.852 1.852l1.147-.002h7.648a1.854 1.854 0 0 0 1.852-1.851v-1.392l2.457 1.61a.641.641 0 0 0 .673.071.663.663 0 0 0 .37-.601v-6.167c0-.26-.142-.49-.37-.602">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="micon"><svg fill="#65676b" viewBox="0 0 16 16" width="1em" height="1em"
                                    class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv gl3lb2sf hhz5lgdu">
                                    <g fill-rule="evenodd" transform="translate(-448 -544)">
                                        <g fill-rule="nonzero">
                                            <path
                                                d="M10.743 2.257a6 6 0 1 1-8.485 8.486 6 6 0 0 1 8.485-8.486zm-1.06 1.06a4.5 4.5 0 1 0-6.365 6.364 4.5 4.5 0 0 0 6.364-6.363z"
                                                transform="translate(448 544)"></path>
                                            <path
                                                d="M10.39 8.75a2.94 2.94 0 0 0-.199.432c-.155.417-.23.849-.172 1.284.055.415.232.794.54 1.103a.75.75 0 0 0 1.112-1.004l-.051-.057a.39.39 0 0 1-.114-.24c-.021-.155.014-.356.09-.563.031-.081.06-.145.08-.182l.012-.022a.75.75 0 1 0-1.299-.752z"
                                                transform="translate(448 544)"></path>
                                            <path
                                                d="M9.557 11.659c.038-.018.09-.04.15-.064.207-.077.408-.112.562-.092.08.01.143.034.198.077l.041.036a.75.75 0 0 0 1.06-1.06 1.881 1.881 0 0 0-1.103-.54c-.435-.058-.867.018-1.284.175-.189.07-.336.143-.433.2a.75.75 0 0 0 .624 1.356l.066-.027.12-.061z"
                                                transform="translate(448 544)"></path>
                                            <path
                                                d="m13.463 15.142-.04-.044-3.574-4.192c-.599-.703.355-1.656 1.058-1.057l4.191 3.574.044.04c.058.059.122.137.182.24.249.425.249.96-.154 1.41l-.057.057c-.45.403-.986.403-1.411.154a1.182 1.182 0 0 1-.24-.182zm.617-.616.444-.444a.31.31 0 0 0-.063-.052c-.093-.055-.263-.055-.35.024l.208.232.207-.206.006.007-.22.257-.026-.024.033-.034.025.027-.257.22-.007-.007zm-.027-.415c-.078.088-.078.257-.023.35a.31.31 0 0 0 .051.063l.205-.204-.233-.209z"
                                                transform="translate(448 544)"></path>
                                        </g>
                                    </g>
                                </svg></div>
                            <div class="micon"><svg fill="#65676b" viewBox="0 0 20 20" width="1em" height="1em"
                                    class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv jnigpg78 odw8uiq3">
                                    <g fill-rule="evenodd" transform="translate(-446 -350)">
                                        <path
                                            d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0">
                                        </path>
                                    </g>
                                </svg></div>
                        </div>
                    </div>
                    <div class="mm_list_friends">
                        <?php
                        foreach ($friends as $friend){ ?>
                        <div class="contact_tochat" data-chatid="<?php echo $friend->user_id ?>">
                            <img src="<?php echo BASE_URL.$friend->profile_picture ?>" alt="">
                            <span> <?php echo $friend->first_name.' '.$friend->last_name ?></span>
                            <?php
                            if(time() - strtotime($friend->last_activity)>2){
                                if(strlen($loadUser->timeAgoAlt($friend->last_activity))<4){
                                    ?>
                            <div class="online_tag" style="width:20px">
                                <span><?php echo $loadUser->timeAgoAlt($friend->last_activity) ?></span>
                            </div>
                            <?php
                                }else{
                                    ?>
                            <div class="online_tag">
                                <span><?php echo $loadUser->timeAgoAlt($friend->last_activity) ?></span>
                            </div>
                            <?php
                                }
                            }else{ ?>
                            <div class="online_tag" style="width:15px;height:15px;left:1.8rem">
                                <div class="green_round_point"></div>
                            </div>
                            <?php }
                            ?>
                        </div>
                        <?php }
                        ?>
                    </div>

                </div>
            </div>

        </div>

        <!-------CREATE POST POPUP----->
        <?php include 'components/box_post.php' ?>
        <!-----Chat Popups------>
        <div class="chat_popup_container">

        </div>
        <!-----Chat Popups------>

        <!-----Save Popup------>
        <?php
        $collections = $loadUser->getSavedCollections($userid);

        ?>

        <div class="save-popup">
            <div class="close_save">
                <i class="s_close"></i>
            </div>
            <div class="save_header">
                Save To
            </div>
            <ul class="save_collections">
                <label for="later">
                    <div style="display:flex;align-items:center;gap:8px">
                        <img src="assets/images/later.jpg" style="width:50px;height:50px;border-radius:10px" alt="">
                        <div class=" col">
                            <span>For later</span>
                            <div
                                style="display:flex;align-items:center;font-weight:400;color:#65676b;font-size:14px;gap:5px">
                                <div class="only_icon"></div>
                                Only me
                            </div>
                        </div>
                    </div>
                    <input type="radio" name="save" id="later" checked>
                </label>
                <div class="c_collections">
                    <?php
                    foreach ($collections as $collection){ ?>
                    <label for="<?php echo $collection->col_id ;?>">
                        <div style="display:flex;align-items:center;gap:8px">
                            <img src="assets/images/later.jpg" style="width:50px;height:50px;border-radius:10px" alt="">
                            <div class=" col">
                                <span><?php echo $collection->name ;?></span>
                                <div
                                    style="display:flex;align-items:center;font-weight:400;color:#65676b;font-size:14px;gap:5px">
                                    <div class="only_icon"></div>
                                    Only me
                                </div>
                            </div>
                        </div>
                        <input type="radio" name="save" id="<?php echo $collection->col_id ;?>">
                    </label>





                    <?php  }
                 ?>
                </div>
                <div class="add_coll">
                    <div class="plus_hh">
                        <i class="plus_iccon"></i>
                    </div>
                    New Collection

                </div>
                <div class="create_coll">
                    <span>Name</span>
                    <input type="text" placeholder="Give your collection a name..." id="col_name"
                        onkeyup="checkKhawyaf3amra()">
                    <div class="coll_btns">
                        <button id="cancel_coll">Cancel</button>
                        <button id="create_coll">Create</button>

                    </div>
                </div>

            </ul>
            <button class="done_save">Done</button>

        </div>
        <!-----Save Popup------>


        <!-------Preview Image Popup---->

        <!-------Preview Image Popup---->


        <script src="assets/js/header.js"></script>


        <script>
        $('#post_textarea').emojioneArea({

        })



        //--Update Seen Status from 0 to 1 For all messages receiver------------------->
        $(document).ready(function() {
            $.post('http://localhost/facebook/core/chat/update0to1.php', {
                update0to1: "<?php echo $userid ?>"
            }, function(data) {

            })

        })

        //--Update Seen Status from 0 to 1 For all messages receiver------------------->






        //-----------Notifications---->


        //-----------Mnetion--->


        //-----------Notifications---->


        $('.post_images').ready(function() {


        })



        function checkKhawyaf3amra() {

            if ($('#col_name').val() === "") {
                $('#create_coll').css('background', '#e4e6eb');
                $('#create_coll').css('cursor', 'not-allowed');
                $('#create_coll').css('color', '#bcc0c4');
            } else {
                $('#create_coll').css('background', '#1877f2');
                $('#create_coll').css('cursor', 'pointer');
                $('#create_coll').css('color', '#fff');

            }
        }
        //----->make input longer---->
        $(document).ready(function() {

            $(document).on('focus', '.emojionearea-editor', function() {

                // $('.m14_left').hide();
                $(this).css('width', '300px !important');

            })
        })
        //----->make input longer---->





        $(document).on('click', '#open_more', function() {
            $('.sub_home_links').show()
            $('#open_more').hide()
            $('#open_less').css('display', 'flex');
            $('.bt_left').css('position', 'relative');
        })
        $(document).on('click', '#open_less', function() {
            $('.sub_home_links').hide()
            $('#open_less').hide()
            $('#open_more').show()
            $('.bt_left').css('position', 'absolute');
        })



        //cleaner


        //menu bar

        $(document).on('click', '#open_thatmenu1', function() {
            $('#menu_header1').toggle()
        })



        //--------Open Chat--------------------->
        //--------Change svg color->

        //--------Change svg color->
        $(document).on('click', '.contact_tochat', function() {
            var userid = "<?php echo $userid ?>"
            var chatid = $(this).data('chatid');

            $.post('http://localhost/facebook/core/ajax/chat.php', {
                popup_chat: chatid,
                userid: userid,
            }, function(data) {
                if ($('.popup_chat[data-chat=' + chatid + ']').length > 0) {

                } else {
                    $('.popin_dem_chats').append(data);

                    //  $('#ligh_send[data-chat=' + chatid + ']').focus();*/
                    scrolla(chatid);
                    $('#ligh_send[data-chat=' + chatid + ']').emojioneArea({

                    });

                }
            })

        })





        $('input#comment-inputt').emojioneArea({

        })



        //-------------LINK EMOJI TO CREATE POST----------------->


        //------------POST----------------->
        $('.post_icon11').on('click', function() {
            $('.preview_container').show();
            $('#emoji_wrapper').css('display', 'none');
            $('.emojionearea-editor').css('max-height', '30px');
            $('.emojionearea-editor').css('overflow', 'auto');

        })


        //---- Post Manupilation--->
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
            var profileId = $(likeReactParent).data('profileid');
            var typeText = $(this).find('.like-action-text span');
            var typeR = $(typeText).text();
            var spanClass = $(this).find('.like-action-text').find('span');

            if ($(spanClass).attr('class') !== undefined) {

                if ($(likeActionIcon).attr('src') == 'assets/images/like.png') {

                    (spanClass).addClass('like-color');
                    $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                        'reactIconSize');
                    spanClass.text('like');
                    mainReactSubmit(typeR, postId, userId, profileId, nf_3);
                } else {
                    $(likeActionIcon).attr('src', 'assets/images/like.png');
                    spanClass.removeClass('like-color');
                    spanClass.text('like');
                    mainReactDelete(typeR, postId, userId, profileId, nf_3);
                }
            } else if ($(spanClass).attr('class') === undefined) {
                (spanClass).addClass('like-color');
                $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, profileId, nf_3);

            } else {
                (spanClass).addClass('like-color');
                $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, profileId, nf_3);
            }

        })

        function mainReactSubmit(typeR, postId, userId, profileId, nf_3) {



            $.post('http://localhost/facebook/core/ajax/react.php', {
                reactType: typeR,
                postId: postId,
                userId: userId,
                profileId: profileId,
            }, function(data) {
                $(nf_3).empty().html(data);

            })

        }

        function mainReactDelete(typeR, postId, userId, profileId, nf_3) {


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
        $('.like-action-wrap').hover(function() {
            var mainReact = $(this).find('.react-bundle-wrap');
            setTimeout(function() {
                $(mainReact).html(
                    '<div style="box-shadow: 1px 3px 17px 5px rgba(0,0,0,0.12);height:50px; z-index: 9999999999999999999999999999999999999999999; display: flex; align-items: center; background-color: #fff; position: absolute; top: -4.3rem; padding: 0 5px; border-radius: 50px;"> <div class="like-react-click"> <img src="assets/images/gif/like.gif" alt="" class="react-icon"> </div> <div class="love-react-click"> <img src="assets/images/gif/love.gif" alt="" class="react-icon"> </div> <div class="heart-react-click"> <img src="assets/images/gif/heart.gif" alt="" class=" react-icon"> </div> <div class="haha-react-click"> <img src="assets/images/gif/haha.gif" alt="" class="react-icon"> </div> <div class="wow-react-click"> <img src="assets/images/gif/wow.gif" alt="" class="react-icon"> </div> <div class="sad-react-click"> <img src="assets/images/gif/sad.gif" alt="" class="react-icon"> </div> <div class="angry-react-click"> <img src="assets/images/gif/angry.gif" alt="" class="react-icon"> </div></div>'
                );
            }, 500)
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
            var profileId = $(likeReactParent).data('profileid');

            var likeAction = $(likeReactParent).find('.like-action');
            var likeActionIcon = $(likeAction).find('.like-action-icon img');
            var spanClass = $(likeAction).find('.like-action-text').find('span');

            if ($(spanClass).hasClass(reactColor)) {
                $(spanClass).removeClass();
                spanClass.text('like');
                $(likeActionIcon).attr('src', 'assets/images/like.png');
                mainReactDelete(typeR, postId, userId, profileId, nf_3);
            } else if ($(spanClass).attr('class') !== undefined) {

                $(spanClass).removeClass().addClass(reactColor);
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src',
                    'assets/images/react/' + typeR + '.svg').addClass('reactIconSize');
                mainReactSubmit(typeR, postId, userId, profileId, nf_3);
            } else {

                $(spanClass).addClass(reactColor);
                $(likeActionIcon).attr('src', 'assets/images/react/' + typeR + '.svg').addClass(
                    'reactIconSize');
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src', 'assets/images/react/' + typeR + '.svg')
                    .addClass('reactIconSize');

                mainReactSubmit(typeR, postId, userId, profileId, nf_3);

            }
        }

        //------------------COMMENT SUBMIT --------------------------------
        $(document).on('click', '.react_btn_wrapper.comment-action', function() {

            $(this).parents('.nf-4').siblings('.nf-5').toggle();

        })
        $(document).on('click', '.react_right_count', function() {
            $(this).parents('.react_infos').siblings('.nf-5').toggle()

        })
        $('.comment-input').keyup(function(e) {
            if (e.keyCode == 13) {
                var inputNull = $(this);
                var comment = $(this).find('.emojionearea-editor').html();
                var postid = $(this).data('postid');
                var userid = $(this).data('userid');
                var profileid = $(this).data('profileid');
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
                            ofReader.readAsDataURL(document.getElementById('comment_imggg').files[
                                i]);
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

            }

        }

        function comReactSub(typeR, commentid) {

            var reactColor = '' + typeR + '-color';
            var parentClass = $('.com-' + typeR + '-react-click');

            var grandParent = $(parentClass).parents('.com-rlike-react');
            var postid = $(grandParent).data('postid');
            var userid = $(grandParent).data('userid');
            var profileid = $(grandParent).data('profileid');
            var spanClass = $(grandParent).find('.com-like-action-text').find('span');
            var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-text-option-wrap').find(
                '.com-nf-3-wrap');




            if ($(spanClass).attr('class') !== undefined) {
                if ($(spanClass).hasClass(reactColor)) {
                    $(spanClass).removeAttr('class');
                    $spanClass.text('Like');
                    comReactDelete(typeR, postid, userid, commentid, profileid, com_nf_3);
                } else {
                    $(spanClass).removeClass().addClass(reactColor);
                    spanClass.text(typeR);
                    comReactSubmit(typeR, postid, userid, commentid, profileid, com_nf_3);
                }
            } else {
                $(spanClass).addClass(reactColor);
                spanClass.text(typeR);
                comReactSubmit(typeR, postid, userid, commentid, profileid, com_nf_3);
            }


        }

        $(document).on('click', '.com-like-action-text', function() {

            var thisParents = $(this).parents('.com-rlike-react');

            var postid = $(thisParents).data('postid');

            var userid = $(thisParents).data('userid');
            var profileid = $(thisParents).data('profileid');
            var commentid = $(thisParents).data('commentid');

            var typeText = $(thisParents).find('.com-like-action-text');
            var typeR = $(typeText).text();
            var com_nf_3 = $(thisParents).parents('.com-react').siblings(
                    '.com-text-option-wrap')
                .find(
                    '.com-nf-3-wrap');


            var spanClass = $(thisParents).find('.com-like-action-text').find('span');
            if ($(spanClass).attr('class') !== undefined) {
                $(spanClass).removeAttr('class');
                spanClass.text('Like');
                comReactDelete(typeR, postid, userid, commentid, profileid, com_nf_3);
            } else {
                $(spanClass).addClass('like-color');
                spanClass.text('Like');
                comReactSubmit(typeR, postid, userid, commentid, profileid, com_nf_3);
            }

        })

        function comReactSubmit(typeR, postid, userid, commentid, profileid, com_nf_3) {

            $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                    commentid: commentid,
                    reactType: typeR,
                    postid: postid,
                    userid: userid,
                    profileid: profileid,
                },
                function(data) {
                    $(com_nf_3).empty().html(data);

                });

        }

        function comReactDelete(typeR, postid, userid, commentid, profileid, com_nf_3) {
            var profileid = "<?php echo $userid; ?>";
            $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                    deleteReactType: typeR,
                    deleteCommentid: commentid,
                    postid: postid,
                    userid: userid,
                    profileid: profileid,
                },
                function(data) {
                    $(com_nf_3).empty().html(data);

                });

        }

        $(document).on('click', '.com-dot', function() {
            $('.com-dot').removeAttr('id');
            $(this).attr('id', 'com-opt-click');
            var postid = $(this).data('postid');
            var userid = $(this).data('userid');
            var commentid = $(this).data('commentid');
            var comDetails = $(this).siblings('.com-option-details-container');
            $(comDetails).show().html(
                '<div class="com-option-details" style="z-index:2;color:#000;"> <ul> <li class="com-edit" data-postid="' +
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
            var profileid = "<?php echo $userid ?>";
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

        //---------------------->preview single image->


        //---------------------->preview single image->


        //------------POST----------------->

        //send message----------------->


        setTimeout(function() {
            $(document).on('keyup', '.emojionearea-editor', function(e) {

                if (e.keyCode == 13) {
                    var useridd = "<?php echo $userid ?>";
                    var chatidd = $(this).parents('.popup_chat').data('chatid');
                    var This = $(this);
                    var msg = $(this).html();
                    var msgg = msg.slice(0, -15);

                    var blasa = $(this).parents('.popu_char_a7em')
                        .siblings('.popup_chat_area')
                        .find('.messaging_popup');

                    $.ajax({
                        type: 'POST',
                        url: "http://localhost/facebook/core/ajax/messageChat.php",
                        data: {
                            useridMsg: useridd,
                            chatid: chatidd,
                            msg: msg,
                        },
                        success: function(data) {
                            $(blasa).html(data);

                            /* 
                             loadUser();
                             console.log(data);
                             $('.msg_box').html(data);
                             $('.messeges_wrap').html(data);
                             $(This).text('');

                             scrolla();
                             */
                        }
                    })
                }
            })
        }, 500);
        //send message----------------->


        //--------->unfollow
        $(document).on('click', '#unfollow_menu', function() {
            var This = $(this);
            var userid = $(this).data('userid');
            var profileid = $(this).data('profileid');
            $.post('http://localhost/facebook/core/ajax/follow.php', {
                userid: userid,
                unfollow: profileid,
            }, function(data) {
                $(This).parents('.post-menu').hide()

            })
        })
        //--------->unfollow

        //------------Click Outside----------------->

        //------------------------------>
        $(document).on('click', '.post_header_right', function() {
            $('.post-menu').hide()
            $(this).siblings('.post-menu').show()
        })
        //------------------------------>


        //-----Save Post------------->

        $(document).on('click', '.add_coll', function() {
            $(this).hide()
            $('.create_coll').css('display', 'flex');
        })


        /*  $(document).on('change', 'input#col_name', function() {
             console.log($(this).val());
             if ($(this).val() !== '') {
                 $('#create_coll').css('background', '#1877f2');
                 $('#create_coll').css('pointer', 'pointer');
                 $('#create_coll').css('color', '#fff');

             }
         }) */
        $(document).on('click', '#cancel_coll', function() {
            $('.create_coll').hide()
            $('.add_coll').show()
        })
        //------create collection-->
        $(document).on('click', '#create_coll', function() {
            var name = $('#col_name').val();
            var userid = "<?php echo $userid ?>";

            $.post('http://localhost/facebook/core/ajax/savePost.php', {
                col_name: name,
                userid: userid,
            }, function(data) {
                $('.create_coll').hide();
                $('.c_collections').append(data)
                $('.add_coll').show();
                $('#col_name').val('');


            })
        })
        $(document).on('click', '.done_save', function() {
            var userid = "<?php echo $userid ?>";
            var postid = $(this).parents('.save-popup').data('postid');
            var col = $('input[name=save]:checked', ).attr('id');




            $.ajax({
                type: 'POST',
                url: "http://localhost/facebook/core/ajax/savePost.php",
                data: {
                    userid: userid,
                    postid: postid,
                    col: col,
                },
                success: function(data) {
                    $('.save-popup').hide();


                }


            })
        })

        //update contact list->
        function updateContactsList() {
            var updateContactList = "<?php echo $userid ?>";
            $.post('http://localhost/facebook/core/chat/updateContactList.php', {
                updateContactList: updateContactList,
            }, function(data) {
                $('.mm_list_friends').html(data);
            })

        }

        var updatconList = setInterval(function() {
            updateContactsList();
        }, 1000)
        //update contact list->




        //------create collection-->

        $(document).on('click', '#open-save-post', function() {
            var postid = $(this).data('postid');
            $('.post-menu').hide()
            $('.save-popup').attr('data-postid', postid).css('display', 'flex');

        })
        $(document).on('click', '.close_save', function() {
            $('.save-popup').hide();

        })
        //-----Save Post------------->

        //---------Show more--->
        $(document).on('click', '.show_more_com', function() {
            var This = $(this);

            var slicer = 6;
            var postid = $(this).data('postid');

            $.post('http://localhost/facebook/core/ajax/showMore.php', {
                slicer: slicer,
                postid: postid,

            }, function(data) {
                $(This).parents('.comment-list').empty().html(data);
                slicer += 3;
                $('input#comment-inputt').emojioneArea({

                })
            })
        })
        //---------Show more--->

        //---------Delete Post--->
        $(document).on('click', '#delete_post', function() {
            var postid = $(this).data('postid');
            var userid = $(this).data('userid');

            $.post('http://localhost/facebook/core/ajax/deletePost.php', {
                delete_post: postid,
                userid: userid,
            }, function(data) {

            })
        })
        //---------Delete Post--->

        //-------Notifications---->
        $(document).on('click', '#open_notif', function() {

        })

        //-------Notifications---->




        $(document).mouseup(function(e) {
            var container = new Array();

            container.push('.save-popup');
            container.push('.post-menu ');

            $.each(container, function(key, value) {
                if (!$(value).is(e.target) && $(value).has(e.target)
                    .length === 0) {
                    $(value).hide()


                }
            })
        })
        //------------Click Outside----------------->


        $(document).on('click', '#open_post_imgs_direct', function() {
            $('#post_box').show();
            $('.added_ikhe').show();
            $('#post_imgs_preview').hide();
            $('.facebook_left').css('opacity', '0.3');
            $('.facebook_middle').css('opacity', '0.3');
            $('.facebook_right').css('opacity', '0.3');
        })
        </script>
</body>


</html>