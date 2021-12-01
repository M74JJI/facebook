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

 $lastMsgReceived=$loadPost->lastPersonMsg($userid);
 
 if(!empty($lastMsgReceived)){
     $lastMsgUserid = $lastMsgReceived->user_id;
 }

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
    <link rel="stylesheet" href="assets/css/chat.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">
    <link rel="stylesheet" href="assets/css/home.css" />
    <script src="assets/js/jquery.js"></script>

</head>
<header class="header" style="position:fixed;top:0;width:100%;">

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
                    <svg viewBox="0 0 28 28" fill="#65676b" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv"
                        height="28" width="28">
                        <path
                            d="M10.5 4.5c-2.272 0-2.75 1.768-2.75 3.25C7.75 9.542 8.983 11 10.5 11s2.75-1.458 2.75-3.25c0-1.482-.478-3.25-2.75-3.25zm0 8c-2.344 0-4.25-2.131-4.25-4.75C6.25 4.776 7.839 3 10.5 3s4.25 1.776 4.25 4.75c0 2.619-1.906 4.75-4.25 4.75zm9.5-6c-1.41 0-2.125.841-2.125 2.5 0 1.378.953 2.5 2.125 2.5 1.172 0 2.125-1.122 2.125-2.5 0-1.659-.715-2.5-2.125-2.5zm0 6.5c-1.999 0-3.625-1.794-3.625-4 0-2.467 1.389-4 3.625-4 2.236 0 3.625 1.533 3.625 4 0 2.206-1.626 4-3.625 4zm4.622 8a.887.887 0 00.878-.894c0-2.54-2.043-4.606-4.555-4.606h-1.86c-.643 0-1.265.148-1.844.413a6.226 6.226 0 011.76 4.336V21h5.621zm-7.122.562v-1.313a4.755 4.755 0 00-4.749-4.749H8.25A4.755 4.755 0 003.5 20.249v1.313c0 .518.421.938.937.938h12.125c.517 0 .938-.42.938-.938zM20.945 14C24.285 14 27 16.739 27 20.106a2.388 2.388 0 01-2.378 2.394h-5.81a2.44 2.44 0 01-2.25 1.5H4.437A2.44 2.44 0 012 21.562v-1.313A6.256 6.256 0 018.25 14h4.501a6.2 6.2 0 013.218.902A5.932 5.932 0 0119.084 14h1.861z">
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
                            <li>
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
                            <li>
                                <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yI/r/bnvx9uLOEsq.png" alt="">
                                <div class="li-a7a">
                                    <span>Unfollow <?php echo $post->first_name.' '.$post->last_name ?></span>
                                    <span class="spanitto">Stop seeing posts from this user.</span>
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
               echo $post->post;
             
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
            class="post_img" data-userid="'.$userid.'" data-profileid="'.$profileId.'" data-postid="'.$post->post_id.'"></a>
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
                                class="" data-userid="'.$userid.'" data-profileid="'.$profileId.'"
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
                                class="" data-userid="'.$userid.'" data-profileid="'.$profileId.'"
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
                            data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId; ?>">

                            <i class="share_button"></i>Share
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
                        </div>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>

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
                <img style="width:40px;cursor:pointer"
                    src="https://www.facebook.com/images/composer/SATP_Aa_square-2x.png" alt="">

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
        <!-------EDIT POST POPUP----->
        <div class="post_box" id="post_box1">


        </div>
        <!-------CREATE POST POPUP----->

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

        <script src="assets/dist/emojionearea.js"></script>
        <script>
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
        $(document).on('click', '#open_thatmenu1', function() {
            $('#menu_header1').toggle()
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

        //--------Open Chat--------------------->
        //--------Change svg color->
        $(document).on('click', '.popup_chat', function() {

            $(this).find('.h_m_ic i').css('color', '#1437ef');
        })
        //--------Change svg color->
        $(document).on('click', '.contact_tochat', function() {
            var userid = "<?php echo $userid ?>"
            var chatid = $(this).data('chatid');

            $.post('http://localhost/facebook/core/ajax/chat.php', {
                popup_chat: chatid,
                userid: userid,
            }, function(data) {

                $('.chat_popup_container').append(data);

                $('#c-' + chatid + '').emojioneArea({

                })
            })

        })







        //--------Open Chat--------------------->

        //-------------Show POST POPU----------------->
        $(document).on('click', '.home_post_open', function() {
            $('#post_box').show();
            $('.facebook_left').css('opacity', '0.3');
            $('.facebook_middle').css('opacity', '0.3');
            $('.facebook_right').css('opacity', '0.3');
        })
        $(document).on('click', '#open-edit-post', function() {
            var postid = $(this).data('postid');
            var userid = "<?php echo $userid ?>";
            $.post('http://localhost/facebook/core/ajax/EditPost.php', {
                postidEdit: postid,
                userid: userid,
            }, function(data) {

                $('#post_box1').html(data);
                $('#post_textarea1').emojioneArea({

                })
                $('#post_box1').show();
                $('.facebook_left').css('opacity', '0.3');
                $('.facebook_middle').css('opacity', '0.3');
                $('.facebook_right').css('opacity', '0.3');
            });



        })
        $(document).on('click', '#close_post', function() {
            $('#post_box').hide();
            $('.facebook_left').css('opacity', '1');
            $('.facebook_middle').css('opacity', '1');
            $('.facebook_right').css('opacity', '1');
        })

        //-------------Show POST POPU----------------->

        //-------------LINK EMOJI TO CREATE POST----------------->
        $('#post_textarea').emojioneArea({

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
        //----------------Images edit--->

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

        //------------add more images->
        //----Add image preview--->

        //----Submit Post--->
        $('#post_btn_submit').on('click', function() {
            var post_text = $('.emojionearea-editor').html();

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
                        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                            errors +=
                                '<p>Invalid ' + i +
                                ' File. Only gif,png,jpg,jpeg are allowed.</p>';
                        }
                        var ofReader = new FileReader();
                        ofReader.readAsDataURL(document.getElementById('post_photo').files[i]);
                        var f = document.getElementById('post_photo').files[i];
                        var file_size = f.size || f.fileSize;
                        if (file_size > 7000000) {
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
                    console.log(data)
                })
            } else {
                $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
                    post_images: strImg,
                    post_text: post_text,
                }, function(data) {

                    console.log(data)
                })

            }




        })
        //----Submit Post--->


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
        $('.like-action-wrap').hover(function() {
            var mainReact = $(this).find('.react-bundle-wrap');
            setTimeout(function() {
                $(mainReact).html(
                    '<div style="height:50px; z-index: 9999999999999999999999999999999999999999999; display: flex; align-items: center; background-color: #fff; position: absolute; top: -4.3rem; padding: 0 5px; border-radius: 50px;"> <div class="like-react-click"> <img src="assets/images/gif/like.gif" alt="" class="react-icon"> </div> <div class="love-react-click"> <img src="assets/images/gif/love.gif" alt="" class="react-icon"> </div> <div class="heart-react-click"> <img src="assets/images/gif/heart.gif" alt="" class=" react-icon"> </div> <div class="haha-react-click"> <img src="assets/images/gif/haha.gif" alt="" class="react-icon"> </div> <div class="wow-react-click"> <img src="assets/images/gif/wow.gif" alt="" class="react-icon"> </div> <div class="sad-react-click"> <img src="assets/images/gif/sad.gif" alt="" class="react-icon"> </div> <div class="angry-react-click"> <img src="assets/images/gif/angry.gif" alt="" class="react-icon"> </div></div>'
                );
            }, 500)
        }, function() {
            $(this).find('.react-bundle-wrap').html('');

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
                var profileid = "<?php echo $profileId ?>";
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
                    console.log(useridd)
                    console.log(chatidd)
                    console.log(msg)
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
                            console.log(data)
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

        //------------Click Outside----------------->
        $(document).mouseup(function(e) {
            var container = new Array();

            container.push('#post_box');
            container.push('#post_box1');

            $.each(container, function(key, value) {
                if (!$(value).is(e.target) && $(value).has(e.target)
                    .length === 0) {
                    $(value).css('display', 'none');
                    $('.facebook_left').css('opacity', '1');
                    $('.facebook_middle').css('opacity', '1');
                    $('.facebook_right').css('opacity', '1');

                }
            })
        })

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
                    console.log(data)

                }


            })
        })
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


        $(document).mouseup(function(e) {
            var container = new Array();

            container.push('#menu_header1');
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
        </script>
</body>


</html>