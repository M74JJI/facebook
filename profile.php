<?php
include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
}else{
    header('Location:login.php');
}

$userInfo = $loadUser->getUserInfo($userid);
if(isset($_GET['id'])==true && empty($_GET['id'])==false){
    $username= $loadUser->checkInput($_GET['id']);
    $profileId = $loadUser->getUserId($username);
    $profileInfos = $loadUser->getUserInfo($profileId);
    $posts = $loadPost->posts($userid,$profileId,20);
    $requestCheck=$loadPost->requestCheck($userid,$profileId);
    $requestConfirm=$loadPost->requestConfirm($profileId,$userid);
    $followCheck=$loadPost->followCheck($profileId,$userid);
    
}else{
    header('Location:index.php');
}



?>

<!DOCTYPE html>
<html lang="en">


<?php include_once './components/Header.php' ?>

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
                        <div class="menu_item">
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
                    <a href="#" class="friends_link">3 Friends</a>
                    <div class="friends_peak">
                        <img src="https://scontent.frba2-1.fna.fbcdn.net/v/t1.6435-9/133575443_4841862209219963_4271163266524344012_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=Y_sRwgJzxq4AX93dUCP&tn=1gVMqtKhTUNj1UfJ&_nc_ht=scontent.frba2-1.fna&oh=8401718414d38b9ddcafa2ab3f655545&oe=61BEB7BF"
                            alt="">
                    </div>
                </div>


                <?php if($profileId == $userid){ ?>
                <div class="upper_right_link">
                    <a href="#" class="add_to_story">
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
                    <div style="position: relative;" class="friends_holder">
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
                    <div style="position: relative;" class="friends_holder">
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
                    message
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
                <div class="post_wrapper">
                    <div class="post_top">
                        <img class="user_post_img" src=<?php echo $userInfo->profile_picture ?> alt="">
                        <div class="post_open">
                            <?php if($profileId === $userid){ ?>
                            Whats' on your mind?
                            <?php }else { ?>
                            Write something to <?php $profileInfos->first_name ?>...
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="post_bottom">
                        <div class="choice">
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
                        <div class="choice">
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
                        <div class="choice">
                            <div class="event_img"></div>
                            Life Event
                        </div>
                    </div>
                </div>

                <div class="posts_wrap">
                    <div class="posts_main">
                        <div class="posts_main_header">
                            <h4>Posts</h4>
                            <div class="posts_header_tools">
                                <a href="#" class="posts_header_tool">
                                    <i class="filters_icon"></i>
                                    Filters</a>
                                <a href="#" class="posts_header_tool">
                                    <i class="manage_icon"></i>
                                    Manage Posts</a>
                            </div>
                        </div>
                    </div>
                    <!------POSTS------>
                    <?php foreach ($posts as $post) { ?>



                    <!------POST  FUNCTIONS DATA------>
                    <?php 
                        $main_react =$loadPost->main_react($userid,$post->id);
                        $react_max_show =$loadPost->react_max_show($post->id);
                        $main_react_count =$loadPost->main_react_count($post->id);
                        $commentDetails = $loadPost->commentFetch($post->id);
                        $totalCommentCount=$loadPost->totalCommentCount($post->id);
                        $totalShareCount =$loadPost->totalShareCount($post->id);
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
                                <a href="<?php echo BASE_URL.$post->link ?>"> <img
                                        src="<?php echo $post->profile_picture ?>" alt=""></a>
                                <div class="post_header_left_name">
                                    <a href="<?php echo BASE_URL.$post->link ?>" class="postedBy">
                                        <?php echo $post->first_name.' '.$post->last_name ?>
                                    </a>
                                    <span class="postedAt"><?php echo $loadUser->timeAgo($post->postedAt) ?></span>
                                </div>
                            </div>
                            <?php 
                            if($userid === $profileId){
                                ?>
                            <div class="post_header_right"><i class="fa-solid fa-ellipsis"></i></div>
                            <?php
                            }
                            ?>
                        </div>
                        <!------POST-HEADER------>

                        <div class="nf-2">
                            <!------POST-TEXT------>
                            <div class="post_text">
                                <?php  
                               
                    
                               if(empty($post->shareId)){
                                   echo $post->post;
                                 
                               }else{
                                    echo $post->shareText;
                                       echo '<span class="shared-post-txt" data-postid="'.$post->id;'" data-userid="'.$userid;'" data-profilepic="'.$post->profile_picture;'">'.$post->shareText.'</span>';
                                       
                                   
                                   foreach($shareDetails as $share){
                                       ?>
                                <div class="share-container">

                                    <div class="post_header">
                                        <div class="post_header_left">
                                            <a href="<?php echo BASE_URL.$post->link ?>"> <img
                                                    src="<?php echo $share->profile_picture ?>" alt=""></a>
                                            <div class="post_header_left_name">
                                                <a href="<?php echo BASE_URL.$share->link ?>" class="postedBy">
                                                    <?php echo $share->first_name.' '.$share->last_name ?>
                                                </a>
                                                <span
                                                    class="postedAt"><?php echo $loadUser->timeAgo($share->postedAt) ?></span>
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
                                echo'<div class="post_images" data-img-id="'.$post->id.'">
                                <img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
                                class="post_img">
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
                            $count = 0;
                            for($i=0;$i<count($imgs);$i++){
                                echo'<div class="post_images" data-img-id="'.$post->id.'">
                                <img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
                                class="post_img">
                                </div>';   
                            }
                        
                        }
                         ?>
                            </div>
                            <!------POST-IMAGES------>

                            <!------POST-INFOS------>
                            <div class="react_infos">
                                <div class="nf-3">
                                    <div class="react-comment-count-wrap"
                                        style="width:100%;display:flex;align-items:center">
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

                            <!------POST-ACTIONS------>

                            <div class="nf-4">

                                <div class="like-action-wrap" data-postid="<?php echo $post->id ?>"
                                    data-userid="<?php echo $userid ?>">
                                    <div class="react-bundle-wrap">

                                    </div>
                                    <div class="like-action ra">
                                        <?php if(empty($main_react)){
                                    ?>
                                        <div class="like-action-icon">
                                            <img src="assets/images/like.svg" style="width:20px" alt="">
                                        </div>
                                        <div class="like-action-text">
                                            <span>Like</span>
                                        </div>
                                        <?php }else{ ?>
                                        <div class="like-action-icon">
                                            <img class="react_icon_md"
                                                src="assets/images/react/<?php echo $main_react->reactType ?>.svg"
                                                alt="" class="">
                                            <div class="like-action-text">
                                                <span><?php echo $main_react->reactType; ?></span>
                                            </div>
                                        </div>
                                        <?php  }?>
                                    </div>
                                    <div class="react_btn_wrapper comment-action">
                                        <i class="comment_button"></i>Comment
                                    </div>
                                    <div class="react_btn_wrapper share-action" data-postid="<?php echo $post->id ?>"
                                        data-profilepic="<?php echo $userInfo->profile_picture ?>"
                                        data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId; ?>">

                                        <i class="share_button"></i>Share
                                    </div>
                                </div>

                            </div>
                            <!------POST-ACTIONS------>
                            <!------POST-COMMENTS------>

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
                                                                                <div
                                                                                    class="align-middle react-inst-img">
                                                                                    <?php
                                                                 foreach($com_react_max_show as $react_max){
                                                                     echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.svg" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                     
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
                                                                data-profilepic="<?php echo $userInfo->profile_picture ?>">
                                                                Reply
                                                            </b>
                                                            <div class="com-time">
                                                                <?php echo $loadUser->timeAgo($comment->commentedAt) ?>
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
                                <div class="comment-write">
                                    <div class="com-pro-pick">
                                        <a href="#">
                                            <div class="top-pic">
                                                <img style="width:30px" src="<?php echo $userInfo->profile_picture ?>"
                                                    alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="com-input">
                                        <div class="comment-input">
                                            <input type="text" class="comment-input-style comment-submit"
                                                placeholder="Write a comment..." data-postid="<?php echo $post->id ?>"
                                                data-userid="<?php echo $userid  ?>" />
                                        </div>
                                    </div>
                                </div>




                                <!------POST-INFOS------>


                            </div>
                            <!------POST------>



                            <!------POSTS------>
                        </div>
                        <?php } ?>
                    </div>
                </div>

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
            </div>
            <div class="post_box" id="post_box">
                <div class="post_box_header">
                    <h3>Create Post</h3>
                    <div class="header_icon" id="close_post"><i class="fa-solid fa-xmark"></i></div>
                </div>
                <div class="post_user_infos">
                    <img class="box_post_img" src=<?php echo $userInfo->profile_picture ?> alt="">
                    <div class="privacy_box_box">
                        <h6><?php echo $userInfo->first_name.' '. $userInfo->last_name; ?></h6>
                        <span><i class="fa-solid fa-user-group"></i>Friends<i class="fa-solid fa-sort-down"></i></span>
                    </div>
                </div>
                <div class="errors_post" id="errors_post"></div>
                <div class="box_area">
                    <div class="textarea_post" id="post_textarea"></div>
                </div>
                <div class="emoji_wrapper" id="emoji_wrapper">
                    <img style="width:40px;cursor:pointer"
                        src="https://www.facebook.com/images/composer/SATP_Aa_square-2x.png" alt="">
                    <i></i>
                </div>
                <div class="preview_container">

                    <ul class="post_imgs_preview" id="post_imgs_preview">

                    </ul>
                </div>
                <div class="post_box_actions">
                    <div class="actions_name">
                        Add to your post
                    </div>
                    <div class="actions_list">
                        <div class="post_action" id="add_photos">
                            <div class="post_icon1"></div>
                            <input type="file" class="hidden" id="post_photo" name="post_photo"
                                data-multiple-caption='{count} files selected' multiple="">
                        </div>
                        <div class="post_action">
                            <div class="post_icon2"></div>
                        </div>
                        <div class="post_action">
                            <div class="post_icon3"></div>
                        </div>
                        <div class="post_action">
                            <div class="post_icon4"></div>
                        </div>
                        <div class="post_action">
                            <div class="post_icon5"></div>
                        </div>
                        <div class="post_action">
                            <div class="post_icon6"></div>
                        </div>
                    </div>
                </div>
                <button class="post_button" id="post_btn_submit">Post</button>

            </div>


            <script src="assets/js/profile.js"></script>
            <script src="assets/js/jquery.js"></script>
            <script src="assets/dist/emojionearea.js"></script>
            <script>
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
                            $('.cover').css('background-image', 'url(' + data + ')');
                            $('.upload_menu').hide();
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

                $('.post_open').on('click', function() {
                    $('.post_box').css('display', 'flex');
                    /*    $('.profile_top_container').css('opacity', '0.1');
                        $('.profile_middle').css('opacity', '0.1'); */
                })
                $('.choice').on('click', function() {
                    $('.post_box').css('display', 'flex');
                    $('.profile_top_container').css('opacity', '0.1');
                    $('.profile_middle').css('opacity', '0.1');
                })
                $('#close_post').on('click', function() {
                    $('.post_box').css('display', 'none');
                    $('.profile_top_container').css('opacity', '1');
                    $('.profile_middle').css('opacity', '1');
                })
                var fileCollection = new Array();
                $(document).on('change', '#post_photo', function(e) {
                    var count = 0;
                    var files = e.target.files;
                    $(this).removeData();
                    var text = "";
                    $('#post_imgs_preview').css('max-height', '400px');
                    $('.preview_container').css('border', '1px solid #ced0d4');
                    $('#emoji_wrapper').css('display', 'none');
                    $('#post_box').css('min-height', '800px');
                    /* grid from preview*/


                    $.each(files, function(i, file) {
                        fileCollection.push(file);
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function(e) {
                            var name = document.getElementById("post_photo").files[i].name;
                            var template = '<li class="img_preview"> <img id = "' + name +
                                '" src="' + e.target.result + '" / > </li>';

                            $('#post_imgs_preview').append(template);
                        }
                    })
                    $('#post_imgs_preview').append(
                        '<div class="remove_img"><i class="fa-solid fa-xmark"></i></div>');


                })

                $('#post_textarea').emojioneArea({
                    pickPosition: "right",
                    spellcheck: true,
                })

                $('#post_btn_submit').on('click', function() {
                    var post_text = $('.textarea_post').html();
                    var formData = new FormData();
                    var images = [];
                    var errors = [];
                    var files = $('#post_photo')[0].files;

                    if (files.length != 0) {
                        if (files.length > 20) {
                            errors += "maximum 20 images is allowed.";

                        } else {
                            for (var i = 0; i < files.length; i++) {
                                var name = document.getElementById('post_photo').files[i].name;
                                images += '{\"imageName\":\"user/' + <?php echo $userid; ?> +
                                    '/postImages/' + name + '\"},';

                                var extension = name.split('.').pop().toLowerCase();
                                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    errors +=
                                        '<p>Invalid ' + i +
                                        ' File. Only gif,png,jpg,jpeg are allowed.</p>';
                                }
                                var ofReader = new FileReader();
                                ofReader.readAsDataURL(document.getElementById('post_photo').files[i]);
                                var f = document.getElementById('post_photo').files[i];
                                var file_size = f.size || f.fileSize;
                                if (file_size > 2000000) {
                                    errors += '<p>' + i + ' File Size is larger than 5mb</p>'
                                } else {
                                    formData.append('file[]', document.getElementById('post_photo')
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
                        if (errors == '') {
                            $.ajax({
                                url: 'http://localhost/facebook/core/ajax/uploadPostImage.php',
                                cache: false,
                                method: "post",
                                data: formData,
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $('#errors_post').html(
                                        '<br/><label>Uploading...</label>');
                                },
                                success: function(data) {
                                    $('#errors_post').html(data);
                                    $('#post_imgs_preview').empty();
                                }

                            })
                        } else {
                            $('#post_photo').val('');
                            $('#errors_post').html('<span>' + errors + '</span>');
                            return false;
                        }

                    } else {
                        var strImg = '';
                    }
                    if (strImg == '') {
                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
                            post_text_only: post_text,
                        }, function(data) {

                            location.reload();
                        })
                    } else {
                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
                            post_images: strImg,
                            post_text: post_text,
                        }, function(data) {

                            location.reload();
                        })

                    }




                })
                // react system 

                //
                $(document).on('click', '.like-action', function() {

                    var likeActionIcon = $(this).find('.like-action-icon img');
                    var likeReactParent = $(this).parents('.like-action-wrap');
                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
                    var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
                    var reactNumText = $(reactCount).text();
                    var postId = $(likeReactParent).data('postid');
                    var userId = $(likeReactParent).data('userid');
                    var typeText = $(this).find('.like-action-text span');
                    var typeR = $(typeText).text();
                    var spanClass = $(this).find('.like-action-text').find('span');

                    if ($(spanClass).attr('class') !== undefined) {

                        if ($(likeActionIcon).attr('src') == 'assets/images/like.svg') {

                            (spanClass).addClass('like-color');
                            $(likeActionIcon).attr('src', 'assets/images/react/like.svg').addClass(
                                'reactIconSize');
                            spanClass.text('like');
                            mainReactSubmit(typeR, postId, userId, nf_3);
                        } else {
                            $(likeActionIcon).attr('src', 'assets/images/like.svg');
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

                    var profileId = "<?php echo $profileId; ?>"
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

                    var profileId = "<?php echo $profileId; ?>"

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
                        $(likeActionIcon).attr('src', 'assets/images/like.svg');
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
                $('.comment-submit').keyup(function(e) {
                    if (e.keyCode == 13) {
                        var inputNull = $(this);
                        var comment = $(this).val();
                        var postid = $(this).data('postid');

                        var userid = $(this).data('userid');
                        var profileid = "<?php echo $profileId ?>";
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
                                },
                                cache: false,
                                success: function(html) {
                                    $(commentPlaceholder).append(html);
                                    $(inputNull).val('');
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
                    var profileid = "<?php echo $profileId; ?>";
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
                    var profileid = "<?php echo $profileId; ?>";
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
                    var profileid = "<?php echo $profileId ?>";
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

                    $('.friends_holder').find('.friends_btn').empty().removeClass().html(
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
                    container.push('.post_share_box');


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

                    container.push('.search_results');
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


            })
            </script>





</body>

</html>