<?php
include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
}else{
    header('Location:login.php');
}

$userInfo = $loadUser->getUserInfo($userid);
if(isset($_GET['id'])==true && empty($_GET['id']===false)){
    $username =$loadUser->checkInput($_GET['id']);
    $profileId =$loadUser->getUserId($username);
}else{
    $profileId=$userid;
       
}


    $profileInfos = $loadUser->getUserInfo($profileId);
    $posts = $loadPost->posts($userid,$profileId,20);
    $requestCheck=$loadPost->requestCheck($userid,$profileId);
    $requestConfirm=$loadPost->requestConfirm($profileId,$userid);
    $followCheck=$loadPost->followCheck($profileId,$userid);
    $friends=$loadUser->getAllFriends($userid);
    $notificationsTotal=$loadUser->notificationsTotal($userid);


?>

<!DOCTYPE html>
<html lang="en">


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
<?php 
include 'components/header.php';
include 'components/box_post.php'
?>

<body>


    <div class="profile_top_container">
        <div class="profile_container">
            <div class="cover" style="background-image: url(<?php echo $profileInfos->cover ?>)">
                <?php if($profileId == $userid){ ?>
                <div class="upload_container" id="upload_container">
                    <input type="file" class="hidden" name="upload_btn" id="upload_btn" name="">
                    <div class="felx">
                        <i class="uplaod_icon"></i>
                        <span>Add Cover Photo</span>
                    </div>
                    <div class="uplaod_menu" id="upload_menu">
                        <div class="menu_item" id="open_ex_covers">
                            <div class="menu_icon1"></div>
                            Select Photo
                        </div>
                        <div class="menu_item" id="upload_cover">
                            <div class="menu_icon2"></div>
                            Upload Photo
                        </div>

                    </div>

                </div>

                <?php  } ?>


            </div>

            <div class="profile_pic_container">
                <div class="pdp_container">
                    <img class="pdp" src="<?php echo $profileInfos->profile_picture ?>" alt="">
                    <input type="file" class="hidden" id="upload_btn_profile" name="upload_btn_profile">
                    <?php if($profileId == $userid){ ?>
                    <div class="pdp_icon" id="pdf_container">
                        <div class="icon_pdf"></div>
                    </div>
                    <?php } ?>
                </div>
                <div class="upper_name">
                    <div class="full_name"><?php echo $profileInfos->first_name.' '.$profileInfos->last_name ?></div>
                    <a href="#" class="friends_link"><?php echo count($friends) ?> Friends</a>
                    <div class="friends_peak">
                        <?php
                     for($i = 0; $i<2;$i++){
                         if($friends[$i] !=''){
                             ?>
                        <img src="<?php echo $friends[$i]->profile_picture ?>" alt="">
                        <?php
                         }
                     }
                     if(count($friends)>2){
                         ?>
                        <div class="more_friends_count">
                            +<?php echo count($friends)-2 ?>
                        </div>

                        <?php
                     }
                     ?>
                    </div>
                </div>


                <?php if($profileId == $userid){ ?>
                <div class="upper_right_link">
                    <a href="http://localhost/facebook/stories/create" class="add_to_story">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add to Story</a>
                    <a href="#" class="edit_profile_link" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">
                        <img src="https://www.facebook.com/rsrc.php/v3/yW/r/OR6SzrfoMFg.png" alt="">
                        Edit Profile</a>
                </div>
                <?php }else{ ?>
                <!------------------------------>
                <div class="request_wrap">
                    <?php if(empty($requestCheck)){
                        if(empty($requestConfirm)){ ?>
                    <div class="profile_add_friend" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">
                        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yz/r/JonZjQBHWuh.png">
                        <div class="profile_add_friend_text">Add Friend</div>
                    </div>
                    <?php
                        }else if($requestConfirm->requestStatus=='0'){ ?>
                    <div style="position: relative;" class="confirm_requests">
                        <div class="profile_confirm_friend" id="show_popup_respond">
                            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yF/r/5nzjDogBZbf.png">
                            <div class="profile_add_friend_text">Respond</div>
                        </div>
                        <div class="confirm_request_popup" id="confirm_request_popup">
                            <div class="confirm_request" data-userid="<?php echo $userid ?>"
                                data-profileid="<?php echo $profileId ?>">Confirm</div>
                            <div class="delete_request" data-userid="<?php echo $userid ?>"
                                data-profileid="<?php echo $profileId ?>">Delete</div>
                        </div>
                    </div>


                    <?php
                        }else if($requestConfirm->requestStatus=='1'){?>
                    <div style="position: relative;" class="friends_wrapmf">
                        <div class="friends_btn" id="friends_btn">
                            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yF/r/5nzjDogBZbf.png">
                            <div class="profile_add_friend_text">Friends</div>
                        </div>
                        <div class="friends_popup" id="friends_popup">
                            <div class="favorites_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yU/r/oIIZ26adGMr.png" alt="">
                                Favorites
                            </div>
                            <div class="edit_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y_/r/y302a2iLPfV.png" alt="">
                                Edit Friend List
                            </div>
                            <div class="unfollow_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yI/r/bnvx9uLOEsq.png" alt="">
                                Unfollow
                            </div>
                            <div class="unfriend_friend" data-userid="<?php echo $userid ?>"
                                data-profileid="<?php echo $profileId ?>">
                                <i class="unfriend_icon"></i>
                                Unfriend
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                            
                        }
                    }else if($requestCheck->requestStatus =='0'){?>

                    <div class="cancel_request_btn" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">
                        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yo/r/Qg9sXPTnmFb.png">
                        <div class="profile_add_friend_text">Cancel Request</div>
                    </div>
                    <?php 
                    }else if($requestCheck->requestStatus =='1'){ ?>
                    <div style="position: relative;" class="friends_wrapmf">
                        <div class="friends_btn" id="friends_btn">
                            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yF/r/5nzjDogBZbf.png">
                            <div class="profile_add_friend_text">Friends</div>
                        </div>
                        <div class="friends_popup" id="friends_popup">
                            <div class="favorites_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yU/r/oIIZ26adGMr.png" alt="">
                                Favorites
                            </div>
                            <div class="edit_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y_/r/y302a2iLPfV.png" alt="">
                                Edit Friend List
                            </div>
                            <div class="unfollow_friend">
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yI/r/bnvx9uLOEsq.png" alt="">
                                Unfollow
                            </div>
                            <div class="unfriend_friend" data-userid="<?php echo $userid ?>"
                                data-profileid="<?php echo $profileId ?>">
                                <i class="unfriend_icon"></i>
                                Unfriend
                            </div>
                        </div>
                    </div>
                    <?php }else{} ?>

                    <!----FOLLOW SYSTEM-------------------------->
                    <?php if(empty($followCheck)){ ?>
                    <div class="follow_btn" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">
                        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y8/r/oABzID6cE5f.png" alt="">
                        <span class="follow_btn_text">Follow</span>
                    </div>
                    <?php
                    }else{?>
                    <div class="unfollow_btn" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">
                        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/eLq9OvKfGbc.png" alt="">
                        <span class="follow_btn_text">Following</span>
                    </div>
                    <?php  } ?>
                    <!----FOLLOW SYSTEM-------------------------->
                    <div class="message_friend">
                        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yg/r/111xWLHJ_6m.png" alt="">
                        Message
                    </div>
                </div>
                <!------------------------------>

                <?php } ?>



            </div>
            <?php if(empty($requestCheck)){
                        if(empty($requestConfirm)){ ?>

            <?php
                        }else if($requestConfirm->requestStatus=='0'){ ?>
            <div class="confirm_wall">
                <span class="send_req_text"><?php echo $profileInfos->first_name ?> sent you a friend request</span>
                <div class="profile_confirm_friend1">
                    <div class="send_req_text_confirm" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">Confirm Request</div>
                    <div class="send_req_delete" data-userid="<?php echo $userid ?>"
                        data-profileid="<?php echo $profileId ?>">Delete Request</div>
                </div>

            </div>


            <?php
                        }
                    } ?>
            <div class="profile_menu">
                <div class="menu">
                    <a href="<?php echo BASE_URL.'profile.php?id='.$profileInfos->link.'' ?>"
                        class="menu_item1 active_menu_item">Posts</a>
                    <a href="<?php echo BASE_URL.'about.php?id='.$profileInfos->link.'' ?>" class="menu_item1">About</a>
                    <div class="menu_item1 hidein_sm">Friends</div>
                    <div class="menu_item1">Photos</div>
                    <div class="menu_item1 hidein_sm">Story Archive</div>
                    <div class="menu_item1">Videos</div>
                    <div class="menu_item1 hidein_sm">More</div>
                </div>
                <div class="menu_dots "><i class="fa-solid fa-ellipsis"></i></div>
            </div>
        </div>
    </div>
    <div class="profile_middle">
        <div class="profile_middle_container">
            <!-- left-->
            <div class="left_profile">
                <!-- Intro-->
                <div class="intro">
                    <h3 class="intro_title">Intro</h3>
                    <div class="intro_item">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <div class="item_name">Studied Cybersecurity & Cybercrime at </div>
                        <div class="item_value">ENSA de Tanger</div>
                    </div>
                    <div class="intro_item">
                        <i class="fa-solid fa-house-chimney"></i>
                        <div class="item_name">Lives in</div>
                        <div class="item_value">Ksar eL kebir, Morocco</div>
                    </div>
                    <div class="intro_item">
                        <i class="fa-solid fa-rss"></i>
                        <div class="item_name">Followed by</div>
                        <div class="item_value">171 people</div>
                    </div>
                    <div class="intro_item">
                        <i class="fa-brands fa-instagram"></i>
                        <a href="#" class="item_name social_link">med_hajji7</a>

                    </div>

                </div>
                <div class="intro">
                    <div class="spaced">
                        <h3>Photos</h3>
                        <a href="#" class="social_link">See All Photos</a>
                    </div>
                    <div class="photos_wrap">
                        <img src=<?php echo $profileInfos->profile_picture ?> alt="">
                        <img src=<?php echo $profileInfos->cover ?> alt="">

                    </div>
                </div>
                <div class="intro">
                    <div class="spaced">
                        <h3>Friends</h3>
                        <a href="#" class="social_link">See All Friends</a>
                    </div>
                    <span>1 Friend(s)</span>
                    <div class="photos_wrap">
                        <img src="https://scontent.frba2-1.fna.fbcdn.net/v/t1.6435-1/p200x200/133575443_4841862209219963_4271163266524344012_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=7206a8&_nc_ohc=Y_sRwgJzxq4AX93dUCP&_nc_ht=scontent.frba2-1.fna&oh=939ae3ded139894a3fe3a09bc465a259&oe=61BDB100"
                            alt="">


                    </div>
                </div>
            </div>
            <!-- right-->
            <div class="right_profile">

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



            </div>

            <div class="profile_box" id="pdp_box">
                <div class="box_header">
                    <h3 class="header_title">Update profile picture </h3>
                    <div class="header_icon" id="header_icon"><i class="fa-solid fa-xmark"></i></div>
                </div>
                <div class="box_buttons">
                    <button class="box_btn1" id="box_btn1"><i class="fa-solid fa-plus"></i>Upload Photo</button>
                    <button class="box_btn2"><i class="frame_icon"></i> Add Frame</button>
                </div>
                <span class="profilePictures_wrapspan">Profile pictures
                </span>
                <div class="profilePictures_wrap">



                </div>

            </div>
            <div class="cover_box" id="cover_box">
                <div class="box_header">
                    <h3 class="header_title">Select Photo</h3>
                    <div class="header_icon" id="close_cover"><i class="fa-solid fa-xmark"></i></div>
                </div>
                <span style="padding-top:7px" class="profilePictures_wrapspan">cover photos
                </span>
                <div class="coverPictures_wrap">



                </div>

            </div>



            <script src="assets/dist/emojionearea.js"></script>
            <script>
            $('#post_textarea').emojioneArea({

            })
            $(document).on('click', '#add_photos', function() {
                $('.preview_container').show()
                $('.emoji_wrapper').hide()
            })
            //----Open o change profile picture-->
            $(document).on('click', '#pdf_container', function() {
                $.post('http://localhost/facebook/core/ajax/updateExistingPicture.php', {
                    existing_image_list: "<?php echo $userid ?>",
                }, function(data) {
                    $('.profilePictures_wrap').html(data);
                    $('#pdp_box').show();
                })
            })
            $(document).on('click', '#open_ex_covers', function() {
                $.post('http://localhost/facebook/core/ajax/updateExistingCover.php', {
                    existing_cover_list: "<?php echo $userid ?>",
                }, function(data) {
                    $('.coverPictures_wrap').html(data);
                    $('#cover_box').show();
                })
            })
            $(document).on('click', '#box_btn1', function() {
                $('#upload_btn_profile').click();
            })
            $(document).on('click', '#upload_container', function() {
                $('#upload_menu').show();
            })
            $(document).on('click', '#upload_cover', function() {
                $('#upload_btn').click();
            })
            $(document).on('click', '#header_icon', function() {
                $('#pdp_box').hide();
            })
            $(document).on('click', '#close_cover', function() {
                $('#cover_box').hide();
            })
            $(document).on('click', '#pick_existing_profile_picture', function() {
                var image = $(this).data('img');
                $.post('http://localhost/facebook/core/ajax/updateExistingPicture.php', {
                    existing_image: image,
                    userid: "<?php echo $userid ?>",
                }, function(data) {
                    $('.pdp').attr('src', data);
                    $('#pdp_box').hide();
                })
            })
            $(document).on('click', '#pick_existing_cover_picture', function() {
                var image = $(this).data('img');
                $.post('http://localhost/facebook/core/ajax/updateExistingCover.php', {
                    existing_cover: image,
                    userid: "<?php echo $userid ?>",
                }, function(data) {

                    $('.cover').css('background-image', 'url(' + image + ')');
                    $('#cover_box').hide();
                })
            })
            //----Open o change profile picture-->

            $(function() {
                $(document).on('change', '#upload_btn', function() {

                    var name = $('#upload_btn').val().split('\\').pop();
                    var file_data = $('#upload_btn').prop('files')[0];
                    var file_size = file_data["size"];
                    var file_type = file_data["type"].split('/').pop();
                    var userid = "<?php echo $userid ?>";
                    var image_name = 'user/' + userid + '/cover/' + name + '';
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profile.php', {
                            image_name: image_name,
                            userid: userid
                        }, function(data) {



                        })
                    }
                    $.ajax({
                        url: 'http://localhost/facebook/core/ajax/profile.php',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(data) {
                            $('.cover').css('background-image', 'url(' + data + ')')
                            $('.uplaod_menu').hide();
                        }
                    })


                })

                $(document).on('change', '#upload_btn_profile', function() {

                    var name = $('#upload_btn_profile').val().split('\\').pop();
                    var file_data = $('#upload_btn_profile').prop('files')[0];
                    var file_size = file_data['size'];
                    var file_type = file_data['type'].split('/').pop();
                    var userid = "<?php echo $userid ?>";
                    var image_name = 'user/' + userid + '/profilePicture/' + name + '';
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profilePicture.php', {
                            image_name: image_name,
                            userid: userid
                        }, function(data) {

                        })
                        $.ajax({
                            url: 'http://localhost/facebook/core/ajax/profilePicture.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function(data) {
                                $('.pdp').attr('src', "" + data + "");
                                $('.profile_box').css('display', 'none');
                            }
                        })
                    }
                })



                //----------------SHARE--------------------------------------




                //----------------SEND REQUEST--------------------------------------

                //-----send request
                $(document).on('click', '.profile_add_friend', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $(this).find('.profile_add_friend_text').text('Cancel Request');
                    $(this).removeClass().addClass('cancel_request_btn');
                    $('.follow_btn').removeClass().addClass('unfollow_btn');
                    $('.unfollow_btn').find('.follow_btn_text').text(
                        'Following');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        request: profileid,
                        userid: userid,
                    }, function(data) {})

                })
                //-----confirm request
                $(document).on('click', '.confirm_request', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    var parent = $(this).parents('.confirm_requests');
                    $('.confirm_wall').empty().css('display', 'none');
                    $(parent).empty().html(
                        '<div class="friends_btn"> <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yF/r/5nzjDogBZbf.png"> <div class="profile_add_friend_text">Friends</div> </div>'
                    );
                    $('.follow_btn').removeClass().addClass('unfollow_btn');
                    $('.unfollow_btn').find('.follow_btn_text').text(
                        'Following');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        Confirmrequest: profileid,
                        userid: userid,
                    }, function(data) {})


                })
                //-----confirm request
                $(document).on('click', '.send_req_text_confirm', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $(this).parents('.confirm_wall').empty().css('display', 'none');
                    $('.confirm_requests').empty().html(
                        '<div class="friends_btn"> <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yF/r/5nzjDogBZbf.png"> <div class="profile_add_friend_text">Friends</div> </div>'
                    );
                    $('.follow_btn').removeClass().addClass('unfollow_btn');
                    $('.unfollow_btn').find('.follow_btn_text').text(
                        'Following');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        Confirmrequest: profileid,
                        userid: userid,
                    }, function(data) {})

                })

                //-----cancel request
                $(document).on('click', '.cancel_request_btn', function() {
                    $(this).find('.profile_add_friend_text').text('Add Friend');
                    $(this).removeClass().addClass('profile_add_friend');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $('.unfollow_btn').removeClass().addClass('follow_btn');
                    $('.follow_btn').find('.follow_btn_text').text(
                        'Follow');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        Cancelrequest: profileid,
                        userid: userid,
                    }, function(data) {})
                })
                //-----delete request



                $(document).on('click', '.delete_request', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    var parent = $(this).parents('.confirm_requests');
                    $('.confirm_wall').empty().css('display', 'none');
                    $(parent).removeClass();
                    $(parent).empty().html(
                        ' <div class="profile_add_friend" data-userid="' + userid +
                        '" data-profileid="' + profileid +
                        '"> <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yz/r/JonZjQBHWuh.png"> <div class="profile_add_friend_text">Add Friend</div> </div>'
                    );
                    $('.unfollow_btn').removeClass().addClass('follow_btn');
                    $('.follow_btn').find('.follow_btn_text').text(
                        'Follow');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        deleteRequest: profileid,
                        userid: userid,
                    }, function(data) {})
                })

                $(document).on('click', '.send_req_delete', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $(this).parents('.confirm_wall').empty().css('display', 'none');
                    $('.confirm_requests').empty().html(
                        '<div class="profile_add_friend" data-userid="' + userid +
                        '" data-profileid="' + profileid +
                        '"> <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yz/r/JonZjQBHWuh.png"> <div class="profile_add_friend_text">Add Friend</div> </div>'
                    );
                    $('.unfollow_btn').removeClass().addClass('follow_btn');
                    $('.follow_btn').find('.follow_btn_text').text(
                        'Follow');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        deleteRequest: profileid,
                        userid: userid,
                    }, function(data) {})
                })




                //-----Unfriend 
                $(document).on('click', '.unfriend_friend', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $('.friends_popup').empty().css('width', '0').css('padding', '0');

                    $('.friends_wrapmf').find('.friends_btn').empty().removeClass().html(
                        ' <div class="profile_add_friend" data-userid="' + userid +
                        '" data-profileid="' + profileid +
                        '"> <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yz/r/JonZjQBHWuh.png"> <div class="profile_add_friend_text">Add Friend</div> </div>'
                    );
                    $('.unfollow_btn').removeClass().addClass('follow_btn');
                    $('.follow_btn').find('.follow_btn_text').text(
                        'Follow');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        Unfriendrequest: profileid,
                        userid: userid,
                    }, function(data) {})
                })

                //----------------SEND REQUEST--------------------------------------

                //-------------FOLLOW SYSTEM-------------------------->
                $(document).on('click', '.follow_btn', function() {
                    userid = $(this).data('userid');
                    profileid = $(this).data('profileid');
                    $(this).removeClass().addClass('unfollow_btn');
                    $(this).find('.follow_btn_text').text(
                        'Following');

                    $.post('http://localhost/facebook/core/ajax/follow.php', {
                        follow: profileid,
                        userid: userid,
                    }, function(data) {})
                })
                $(document).on('click', '.unfollow_btn', function() {
                    userid = $(this).data('userid');
                    profileid = $(this).data('profileid');
                    $(this).removeClass().addClass('follow_btn');
                    $(this).find('.follow_btn_text').text(
                        'Follow');
                    $.post('http://localhost/facebook/core/ajax/follow.php', {
                        unfollow: profileid,
                        userid: userid,
                    }, function(data) {})
                })

                //-------------FOLLOW SYSTEM-------------------------->





                //clkick outside

                $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push('.com-option-details-container');



                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target)
                            .length === 0) {
                            $(value).empty();

                        }
                    })
                })
                //friends menu ffs

                $(document).on('click', '#friends_btn', function() {
                    $('#friends_popup').css('display', 'block')
                })
                //friends menu ffs
                $(document).mouseup(function(e) {
                    var container = new Array();


                    container.push('.confirm_request_popup');
                    container.push('.friends_popup');
                    container.push('#menu_header');

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target)
                            .length === 0) {
                            $(value).css('display', 'none');

                        }
                    })
                })
                $(document).on('click', '#show_popup_respond', function() {
                    $('#confirm_request_popup').css('display', 'flex')
                })



                //----------------Accepting Request------------------


                //cleaner

                //menu bar


                $(document).mouseup(function(e) {
                    var container = new Array();


                    container.push('.uplaod_menu');



                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target)
                            .length === 0) {
                            $(value).css('display', 'none');

                        }
                    })
                })


            })
            </script>





</body>

</html>