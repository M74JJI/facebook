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



?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facebook</title>
    <link rel="stylesheet" href="assets/css/profile.css" />
    <link rel="stylesheet" href="assets/css/friends.css" />
    <link rel="stylesheet" href="assets/css/header_menu.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">
    <link rel="stylesheet" href="assets/css/home.css" />

</head>
<header>

    <div class="container">
        <div class="left" id="left">
            <a href="<?php echo BASE_URL ?>" class="logo">
                <img src="assets/images/icon.png" alt="" class="imglogo" id="imglogo" />
                <div id="arrowlogo" class="arrowlogo">

                    <svg viewBox="0 0 20 20" width="1rem" height="1rem" fill="#65676b">
                        <g fill-rule="evenodd" transform="translate(-446 -350)">
                            <g fill-rule="nonzero">
                                <path
                                    d="M100.249 201.999a1 1 0 0 0-1.415-1.415l-5.208 5.209a1 1 0 0 0 0 1.414l5.208 5.209A1 1 0 0 0 100.25 211l-4.501-4.501 4.5-4.501z"
                                    transform="translate(355 153.5)"></path>
                                <path d="M107.666 205.5H94.855a1 1 0 1 0 0 2h12.813a1 1 0 1 0 0-2z"
                                    transform="translate(355 153.5)"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </a>
            <div class="search_container">

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


                    <div class="search_results" id="search_results">
                    </div>

                </div>

            </div>
        </div>
        <div class="middle">
            <div class="active_border">

                <a href="<?php echo BASE_URL ?>" class="icon_container">
                    <svg viewBox="0 0 28 28" fill="#1b74e4" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 aaxa7vy3"
                        height="28" width="28">
                        <path
                            d="M25.825 12.29C25.824 12.289 25.823 12.288 25.821 12.286L15.027 2.937C14.752 2.675 14.392 2.527 13.989 2.521 13.608 2.527 13.248 2.675 13.001 2.912L2.175 12.29C1.756 12.658 1.629 13.245 1.868 13.759 2.079 14.215 2.567 14.479 3.069 14.479L5 14.479 5 23.729C5 24.695 5.784 25.479 6.75 25.479L11 25.479C11.552 25.479 12 25.031 12 24.479L12 18.309C12 18.126 12.148 17.979 12.33 17.979L15.67 17.979C15.852 17.979 16 18.126 16 18.309L16 24.479C16 25.031 16.448 25.479 17 25.479L21.25 25.479C22.217 25.479 23 24.695 23 23.729L23 14.479 24.931 14.479C25.433 14.479 25.921 14.215 26.132 13.759 26.371 13.245 26.244 12.658 25.825 12.29">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="">

                <a class="icon_container ">
                    <svg viewBox="0 0 28 28" fill="#65676b" height="28" width="28">
                        <path
                            d="M20.34 22.428c.077-.455.16-1.181.16-2.18 0-1.998-.84-3.981-2.12-5.41-.292-.326-.077-.838.36-.838h2.205C24.284 14 27 16.91 27 20.489c0 1.385-1.066 2.51-2.378 2.51h-3.786a.496.496 0 01-.495-.571zM20 13c-1.93 0-3.5-1.794-3.5-4 0-2.467 1.341-4 3.5-4s3.5 1.533 3.5 4c0 2.206-1.57 4-3.5 4zm-9.5-1c-2.206 0-4-2.019-4-4.5 0-2.818 1.495-4.5 4-4.5s4 1.682 4 4.5c0 2.481-1.794 4.5-4 4.5zm2.251 2A6.256 6.256 0 0119 20.249v1.313A2.44 2.44 0 0116.563 24H4.438A2.44 2.44 0 012 21.562v-1.313A6.256 6.256 0 018.249 14h4.502z">
                        </path>
                    </svg>
                </a>
            </div>
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
            <a href="<?php echo BASE_URL.'profile.php?id='.$userInfo->link ?>" class="profile_link"
                style="background:#fff;color:#111;font-size:14px">
                <img src="<?php echo BASE_URL.$userInfo->profile_picture ?>" alt="" style="width:30px;height:30px" />
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
            <div style="position:relative">
                <a class="rounded_link header_menu_link" id="open_thatmenu">
                    <svg style="font-size: larger" viewBox="0 0 20 20" width="1em" height="1em">
                        <path
                            d="M10 14a1 1 0 0 1-.755-.349L5.329 9.182a1.367 1.367 0 0 1-.205-1.46A1.184 1.184 0 0 1 6.2 7h7.6a1.18 1.18 0 0 1 1.074.721 1.357 1.357 0 0 1-.2 1.457l-3.918 4.473A1 1 0 0 1 10 14z">
                        </path>
                    </svg>
                </a>
                <div class="wrapper" id="menu_header">
                    <ul class="menu-bar">
                        <li class="menu_me_wrap">
                            <div class="menu_me">
                                <img src="<?php echo $userInfo->profile_picture ?>" alt="">
                                <div class="menu_me_name">
                                    <span><?php echo $userInfo->first_name.' '.$userInfo->last_name;?></span>
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
    </div>

</header>

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
                    <div class="home_choice">
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

            <!-------llah yster--------->
        </div>
        <div class="facebook_right"></div>

    </div>
    <!-------CREATE POST POPUP----->
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
            <textarea placeholder="What's on your mind, <?php echo $userInfo->first_name ?>?" class="textarea_post"
                id="post_textarea"></textarea>
        </div>
        <div class="preview_container">

            <div class="added_ikhe">
                <input type="file" class="input_tamara" id="post_photo" name="post_photo"
                    data-multiple-caption='{count} files selected' multiple="">
                <div class="plussit_dvc">
                    <i class="plucit_icon"></i>
                </div>
                Add Photos/Videos
                <span>or drag and drop</span>
            </div>
            <div class="post_imgs_preview" id="post_imgs_preview"></div>
        </div>
        <div class="emoji_wrapper" id="emoji_wrapper">
            <img style="width:40px;cursor:pointer" src="https://www.facebook.com/images/composer/SATP_Aa_square-2x.png"
                alt="">

        </div>


        <div class="post_box_actions">
            <div class="actions_name">
                Add to your post
            </div>
            <div class="actions_list">
                <div class="post_action post_icon11" id="add_photos">
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
    <!-------CREATE POST POPUP----->




    <script src="assets/js/header.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/dist/emojionearea.js"></script>
    <script>
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
    $(document).on('keyup', '#search_input', function() {
        var searchTerm = $(this).val();

        if (searchTerm == '') {


        } else {


            $.post('http://localhost/facebook/core/ajax/search.php', {
                searchTerm: searchTerm,

            }, function(data) {

                if (data == '') {

                    $('.search_results').html('no results found');
                } else {
                    $('.search_results').html(data);

                }
            })
        }

    })


    //cleaner
    $(document).on('blue', '#search_input', function() {
        $('.search_results').css('width', '0');
    })

    //menu bar

    $(document).on('click', '#open_thatmenu', function() {
        $('#menu_header').css('display', 'block');
    })
    $(document).mouseup(function(e) {
        var container = new Array();

        container.push('.search_results');

        container.push('#menu_header');

        $.each(container, function(key, value) {
            if (!$(value).is(e.target) && $(value).has(e.target)
                .length === 0) {
                $(value).css('display', 'none');

            }
        })
    })

    //-------------Show POST POPU----------------->
    $(document).on('click', '.home_post_open', function() {
        $('#post_box').show();
        $('.facebook').css('opacity', '0.3');
    })
    $(document).on('click', '#close_post', function() {
        $('#post_box').hide();
        $('.facebook').css('opacity', '1');
    })
    //-------------Show POST POPU----------------->

    //-------------LINK EMOJI TO CREATE POST----------------->
    $('#post_textarea').emojioneArea({

    })
    //-------------LINK EMOJI TO CREATE POST----------------->


    //------------POST----------------->
    $('.post_icon11').on('click', function() {
        $('.preview_container').show();
        $('#emoji_wrapper').css('display', 'none');
        $('.emojionearea-editor').css('max-height', '30px');
        $('.emojionearea-editor').css('overflow', 'auto');

    })
    $(document).on('click', '.added_ikhe', function() {
        $('#post_photo').click();
    })
    //----Add image preview--->
    var filaes;
    var fileCollection = new Array();
    $(document).on('change', '#post_photo', function(e) {
        var count = 0;
        var files = e.target.files;
        filaes = files;
        $(this).removeData();
        var text = "";
        $('#post_imgs_preview').css('max-height', '400px');
        $('.preview_container').css('border', '1px solid #ced0d4');
        $('#emoji_wrapper').css('display', 'none');
        $('.added_ikhe').hide();
        $('.preview_container').css('background', '#f7f8fa');


        /* grid from preview*/


        $.each(files, function(i, file) {
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function(e) {
                var name = document.getElementById("post_photo").files[i].name;
                var template = ' <img class="prevv_img" id = "' + name +
                    '" src="' + e.target.result + '" / >';

                $('#post_imgs_preview').append(template);
                if (filaes.length == 1) {
                    $('.prevv_img').css('width', '500px');
                    $('.prevv_img').css('height', '400px');
                }
                if (filaes.length == 2) {
                    $('.post_imgs_preview').css('grid-template-columns', '1fr 1fr');
                    $('.prevv_img').css('width', '250px');
                    $('.prevv_img').css('height', '400px');

                }
                if (filaes.length == 3) {
                    $('.post_imgs_preview').css('grid-template-columns', '1fr 1fr');
                    $('.prevv_img').css('width', '250px');
                    $('.prevv_img').css('height', '200px');
                    $('.prevv_img:first-of-type').css('grid-row', '1/3');
                    $('.prevv_img:first-of-type').css('height', '400px');
                }
            }
        })
        $('#post_imgs_preview').append(
            '<div class="remove_img"><i class="fa-solid fa-xmark"></i></div>');
        $('#post_imgs_preview').append(
            '<div class="add_more_imgs"><i class="azrbch"></i>Add Photos/Videos</div>');


    })

    //------------remove img->
    $(document).on('click', '.remove_img', function() {
        $('#post_photo').val('');
        $('.added_ikhe').show();

    })
    //------------remove img->

    //------------hover show add->
    $(document).on('mouseover', '.preview_container', function() {
        $('.add_more_imgs').show()
    })
    $(document).on('mouseout', '.preview_container', function() {
        $('.add_more_imgs').hide()
    })
    //------------hover show add->

    //------------add more images->
    $('.add_more_imgs').on('click', function() {
        $('#post_photo').click();

    })
    //------------add more images->
    //----Add image preview--->

    //----Submit Post--->
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
    //----Submit Post--->





    //------------POST----------------->
    //------------Click Outside----------------->
    $(document).mouseup(function(e) {
        var container = new Array();

        container.push('#post_box');

        $.each(container, function(key, value) {
            if (!$(value).is(e.target) && $(value).has(e.target)
                .length === 0) {
                $(value).css('display', 'none');
                $('.facebook').css('opacity', '1');

            }
        })
    })
    //------------Click Outside----------------->
    </script>
</body>


</html>