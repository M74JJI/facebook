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
    
}else{
    header('Location:index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">

</head>

<body>
    <header>

        <div class="container">
            <div class="left">
                <div class="logo">
                    <img src="assets/images/icon.png" alt="" />
                </div>
                <div class="search" id="search">
                    <svg viewBox="0 0 16 16" width="1em" height="1em" class="icon" id="search_icon" fill="#65676b">
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
                    </svg>

                    <input type="text" placeholder="Search facebook" id="search_input" />
                </div>
            </div>
            <div class="middle">
                <a class="icon_container">
                    <svg viewBox="0 0 28 28" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv" height="28" width="28"
                        class="middle_icon" fill="#65676b">
                        <path
                            d="M17.5 23.979 21.25 23.979C21.386 23.979 21.5 23.864 21.5 23.729L21.5 13.979C21.5 13.427 21.949 12.979 22.5 12.979L24.33 12.979 14.017 4.046 3.672 12.979 5.5 12.979C6.052 12.979 6.5 13.427 6.5 13.979L6.5 23.729C6.5 23.864 6.615 23.979 6.75 23.979L10.5 23.979 10.5 17.729C10.5 17.04 11.061 16.479 11.75 16.479L16.25 16.479C16.939 16.479 17.5 17.04 17.5 17.729L17.5 23.979ZM21.25 25.479 17 25.479C16.448 25.479 16 25.031 16 24.479L16 18.327C16 18.135 15.844 17.979 15.652 17.979L12.348 17.979C12.156 17.979 12 18.135 12 18.327L12 24.479C12 25.031 11.552 25.479 11 25.479L6.75 25.479C5.784 25.479 5 24.695 5 23.729L5 14.479 3.069 14.479C2.567 14.479 2.079 14.215 1.868 13.759 1.63 13.245 1.757 12.658 2.175 12.29L13.001 2.912C13.248 2.675 13.608 2.527 13.989 2.521 14.392 2.527 14.753 2.675 15.027 2.937L25.821 12.286C25.823 12.288 25.824 12.289 25.825 12.29 26.244 12.658 26.371 13.245 26.133 13.759 25.921 14.215 25.434 14.479 24.931 14.479L23 14.479 23 23.729C23 24.695 22.217 25.479 21.25 25.479Z">
                        </path>
                    </svg>
                </a>
                <a class="icon_container">
                    <svg viewBox="0 0 28 28" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv" height="28" width="28"
                        fill="#65676b">
                        <path
                            d="M10.5 4.5c-2.272 0-2.75 1.768-2.75 3.25C7.75 9.542 8.983 11 10.5 11s2.75-1.458 2.75-3.25c0-1.482-.478-3.25-2.75-3.25zm0 8c-2.344 0-4.25-2.131-4.25-4.75C6.25 4.776 7.839 3 10.5 3s4.25 1.776 4.25 4.75c0 2.619-1.906 4.75-4.25 4.75zm9.5-6c-1.41 0-2.125.841-2.125 2.5 0 1.378.953 2.5 2.125 2.5 1.172 0 2.125-1.122 2.125-2.5 0-1.659-.715-2.5-2.125-2.5zm0 6.5c-1.999 0-3.625-1.794-3.625-4 0-2.467 1.389-4 3.625-4 2.236 0 3.625 1.533 3.625 4 0 2.206-1.626 4-3.625 4zm4.622 8a.887.887 0 00.878-.894c0-2.54-2.043-4.606-4.555-4.606h-1.86c-.643 0-1.265.148-1.844.413a6.226 6.226 0 011.76 4.336V21h5.621zm-7.122.562v-1.313a4.755 4.755 0 00-4.749-4.749H8.25A4.755 4.755 0 003.5 20.249v1.313c0 .518.421.938.937.938h12.125c.517 0 .938-.42.938-.938zM20.945 14C24.285 14 27 16.739 27 20.106a2.388 2.388 0 01-2.378 2.394h-5.81a2.44 2.44 0 01-2.25 1.5H4.437A2.44 2.44 0 012 21.562v-1.313A6.256 6.256 0 018.25 14h4.501a6.2 6.2 0 013.218.902A5.932 5.932 0 0119.084 14h1.861z">
                        </path>
                    </svg>
                </a>
                <a class="icon_container">
                    <svg viewBox="0 0 28 28" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv" height="28" width="28"
                        fill="#65676b">
                        <path
                            d="M25.5 14C25.5 7.649 20.351 2.5 14 2.5 7.649 2.5 2.5 7.649 2.5 14 2.5 20.351 7.649 25.5 14 25.5 20.351 25.5 25.5 20.351 25.5 14ZM27 14C27 21.18 21.18 27 14 27 6.82 27 1 21.18 1 14 1 6.82 6.82 1 14 1 21.18 1 27 6.82 27 14ZM7.479 14 7.631 14C7.933 14 8.102 14.338 7.934 14.591 7.334 15.491 6.983 16.568 6.983 17.724L6.983 18.221C6.983 18.342 6.99 18.461 7.004 18.578 7.03 18.802 6.862 19 6.637 19L6.123 19C5.228 19 4.5 18.25 4.5 17.327 4.5 15.492 5.727 14 7.479 14ZM20.521 14C22.274 14 23.5 15.492 23.5 17.327 23.5 18.25 22.772 19 21.878 19L21.364 19C21.139 19 20.97 18.802 20.997 18.578 21.01 18.461 21.017 18.342 21.017 18.221L21.017 17.724C21.017 16.568 20.667 15.491 20.067 14.591 19.899 14.338 20.067 14 20.369 14L20.521 14ZM8.25 13C7.147 13 6.25 11.991 6.25 10.75 6.25 9.384 7.035 8.5 8.25 8.5 9.465 8.5 10.25 9.384 10.25 10.75 10.25 11.991 9.353 13 8.25 13ZM19.75 13C18.647 13 17.75 11.991 17.75 10.75 17.75 9.384 18.535 8.5 19.75 8.5 20.965 8.5 21.75 9.384 21.75 10.75 21.75 11.991 20.853 13 19.75 13ZM15.172 13.5C17.558 13.5 19.5 15.395 19.5 17.724L19.5 18.221C19.5 19.202 18.683 20 17.677 20L10.323 20C9.317 20 8.5 19.202 8.5 18.221L8.5 17.724C8.5 15.395 10.441 13.5 12.828 13.5L15.172 13.5ZM16.75 9C16.75 10.655 15.517 12 14 12 12.484 12 11.25 10.655 11.25 9 11.25 7.15 12.304 6 14 6 15.697 6 16.75 7.15 16.75 9Z">
                        </path>
                    </svg>
                    <span class="not_icon">6</span>
                </a>
            </div>
            <div class="right">
                <a href="#" class="find_friends">find friends</a>
                <a href="profile.php?id=<?php echo $userInfo->link ?>" class="profile_link">
                    <img src="<?php echo $userInfo->profile_picture ?>" alt="" />
                    <?php echo ucfirst($userInfo->first_name ) ?>
                </a>
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
                <a href="" class="rounded_link ">
                    <svg style="font-size: larger" viewBox="0 0 20 20" width="1em" height="1em">
                        <path
                            d="M10 14a1 1 0 0 1-.755-.349L5.329 9.182a1.367 1.367 0 0 1-.205-1.46A1.184 1.184 0 0 1 6.2 7h7.6a1.18 1.18 0 0 1 1.074.721 1.357 1.357 0 0 1-.2 1.457l-3.918 4.473A1 1 0 0 1 10 14z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

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
                    <a href="#" class="edit_profile_link">
                        <img src="https://www.facebook.com/rsrc.php/v3/yW/r/OR6SzrfoMFg.png" alt="">
                        Edit Profile</a>
                </div>
                <?php } ?>
            </div>
            <div class="profile_menu">
                <div class="menu">
                    <div class="menu_item1 active_menu_item">Posts</div>
                    <div class="menu_item1">About</div>
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
                        $POSTID = $post->id;
                    ?>
                    <!------POST  FUNCTIONS DATA------>
                    <!------POST------>
                    <div class="post">
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
                            <div class="post_header_right"><i class="fa-solid fa-ellipsis"></i></div>
                        </div>
                        <!------POST-HEADER------>

                        <!------POST-TEXT------>
                        <div class="post_text">
                            <?php echo $post->post ?>
                        </div>
                        <!------POST-TEXT------>

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
                                             src="assets/images/react/'.$react_max->reactType.'.png" alt=""
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
                                <span>15 comments</span>
                                <span>28 shares</span>
                            </div>

                        </div>

                        <!------POST-ACTIONS------>

                        <div class="nf-4">
                            <?php echo $post->id ?>
                            <div class="like-action-wrap" data-postid="<?php echo $post->id ?>"
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
                                            src="assets/images/react/<?php echo $main_react->reactType ?>.png" alt=""
                                            class="">
                                        <div class="like-action-text">
                                            <span><?php echo $main_react->reactType; ?></span>
                                        </div>
                                    </div>
                                    <?php  }?>
                                </div>
                                <div class="react_btn_wrapper">
                                    <i class="comment_button"></i>Comment
                                </div>
                                <div class="react_btn_wrapper">
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
                                            
                                                $com_react_max_show =$loadPost->com_react_max_show($comment->commentedOn,$comment->id);
                                                $com_main_react_count =$loadPost->com_main_react_count($comment->commentedOn,$comment->id);
                                                $com_reactCheck =$loadPost->com_reactCheck($userid,$comment->commentedOn,$comment->id);
                                            
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
                                                                        data-commentid="<?php echo $comment->id ?>"
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
                                                                            <div class=" align-middle react-inst-img">
                                                                                <?php
                                                                 foreach($com_react_max_show as $react_max){
                                                                     echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                     
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
                                                                dtata-postid="<?php echo $comment->commentedOn ?>"
                                                                data-userid="<?php echo $userid  ?>"
                                                                data-commentid="<?php echo $comment->id ?>">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </div>
                                                            <div class="com-option-details-container">

                                                            </div>
                                                        </div>
                                                        <?php
                                                        }else{}
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                    <!-------COMMENT------>
                                    <?php }} ?>
                                </ul>


                            </div>
                        </div>




                        <!------POST-INFOS------>


                    </div>
                    <!------POST------>



                    <?php } ?>
                    <!------POSTS------>
                </div>
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
            <img style="width:40px;cursor:pointer" src="https://www.facebook.com/images/composer/SATP_Aa_square-2x.png"
                alt="">
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
            $('.profile_top_container').css('opacity', '0.1');
            $('.profile_middle').css('opacity', '0.1');
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
                console.log('!==udefined');
                if ($(likeActionIcon).attr('src') == 'assets/images/like.png') {
                    console.log('!==udefined && == assets');
                    (spanClass).addClass('like-color');
                    $(likeActionIcon).attr('src', 'assets/images/react/like.png').addClass(
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
                $(likeActionIcon).attr('src', 'assets/images/react/like.png').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, nf_3);

            } else {
                (spanClass).addClass('like-color');
                $(likeActionIcon).attr('src', 'assets/images/react/like.png').addClass(
                    'reactIconSize');
                spanClass.text('like');
                mainReactSubmit(typeR, postId, userId, nf_3);
            }

        })

        function mainReactSubmit(typeR, postId, userId, nf_3) {

            var profileId = "<?php echo $profileId; ?>"

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
                ' <div class="like-react-click"> <img src="assets/images/gif/like.gif" alt="" class="react-icon"> </div> <div class="love-react-click"> <img src="assets/images/gif/love.gif" alt="" class="react-icon"> </div> <div class="heart-react-click"> <img src="assets/images/gif/heart.gif" alt="" class=" react-icon"> </div> <div class="haha-react-click"> <img src="assets/images/gif/haha.gif" alt="" class="react-icon"> </div> <div class="wow-react-click"> <img src="assets/images/gif/wow.gif" alt="" class="react-icon"> </div> <div class="sad-react-click"> <img src="assets/images/gif/sad.gif" alt="" class="react-icon"> </div> <div class="angry-react-click"> <img src="assets/images/gif/angry.gif" alt="" class="react-icon"> </div>'
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
            console.log('----------', likeReact);
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
                console.log('a7a mal9ina walo');
            }
        }

        function mainReactSub(typeR, color) {

            var reactColor = '' + typeR + '-color';
            var pClass = $('.' + typeR + '-react-click');
            var likeReactParent = $(pClass).parents('.like-action-wrap');
            console.log(likeReactParent);
            var nf4 = $(likeReactParent).parents('.nf-4');
            var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
            var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
            var reactNumberText = $(reactCount).text();
            var postId = $(likeReactParent).data('postid');
            var userId = $(likeReactParent).data('userid');
            console.log(postId);
            console.log(userId);
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
                    'assets/images/react/' + typeR + '.png').addClass('reactIconSize');
                mainReactSubmit(typeR, postId, userId, nf_3);
            } else {
                console.log('object');
                $(spanClass).addClass(reactColor);
                $(likeActionIcon).attr('src', 'assets/images/react/' + typeR + '.png').addClass(
                    'reactIconSize');
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src', 'assets/images/react/' + typeR + '.png')
                    .addClass('reactIconSize');

                mainReactSubmit(typeR, postId, userId, nf_3);

            }
        }
    })
    </script>





</body>

</html>