<?php 
//reset everything here
$loadUser->resetOnline($userid);
$loadUser->rdOnline0kamlin($userid);
$loadUser->resetCalls($userid);

?>
<header>
    <div class="h_left">
        <a href="<?php echo BASE_URL ?>">
            <img class="fb_logo" src="assets/images/fb_logo.png" alt="">
        </a>
        <div class="search" id="open_search">
            <svg viewBox="0 0 16 16" width="1em" height="1em" fill="#65676b">
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
            <input type="text" placeholder="Search Facebook" class="open_search">
        </div>
        <div class="search_results" id="search_results">
            <div class="s_h">
                <div class="backatit" id="close_search">
                    <svg viewBox="0 0 20 20" width="20px" height="20px" fill="#65676b"
                        class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv jnigpg78 odw8uiq3">
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
                <div class="search1">
                    <svg id="search_icon1" viewBox="0 0 16 16" width="1em" height="1em" fill="#65676b">
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
                    <input autocomplete="off" type="text" placeholder="Search Facebook" id="search_input">
                </div>
            </div>
            <div class="s_hhs">Recent searches
            </div>
            <ul class="h_resultos_hermanos">
                <?php
              foreach ($search_history as $search){ ?>
                <div class="history_item" data-profileid="<?php echo $search->searched_id ?>">
                    <a href="<?php echo BASE_URL.$search->link ?>" class="his_l">
                        <img src="<?php echo $search->profile_picture ?>" alt="">
                        <span><?php echo $search->first_name.' '.$search->last_name?></span>
                    </a>
                    <div class="rem_ic_h" id="delete_search">
                        <i class="rem_h_ic"></i>
                    </div>
                </div>

                <?php }
              ?>
            </ul>
            <ul class="h_resultos_hermanos1"></ul>
        </div>
    </div>
    <div class="h_middle">

        <a href="<?php echo BASE_URL ?>" class="active_middle">
            <svg viewBox="0 0 28 28" fill="#1b74e4" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 aaxa7vy3" height="28"
                width="28">
                <path
                    d="M25.825 12.29C25.824 12.289 25.823 12.288 25.821 12.286L15.027 2.937C14.752 2.675 14.392 2.527 13.989 2.521 13.608 2.527 13.248 2.675 13.001 2.912L2.175 12.29C1.756 12.658 1.629 13.245 1.868 13.759 2.079 14.215 2.567 14.479 3.069 14.479L5 14.479 5 23.729C5 24.695 5.784 25.479 6.75 25.479L11 25.479C11.552 25.479 12 25.031 12 24.479L12 18.309C12 18.126 12.148 17.979 12.33 17.979L15.67 17.979C15.852 17.979 16 18.126 16 18.309L16 24.479C16 25.031 16.448 25.479 17 25.479L21.25 25.479C22.217 25.479 23 24.695 23 23.729L23 14.479 24.931 14.479C25.433 14.479 25.921 14.215 26.132 13.759 26.371 13.245 26.244 12.658 25.825 12.29">
                </path>
            </svg>
        </a>

        <a href="<?php echo BASE_URL.'/friends' ?>" class=" a_middle">
            <svg viewBox="0 0 28 28" fill="#65676b" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv" height="28"
                width="28">
                <path
                    d="M10.5 4.5c-2.272 0-2.75 1.768-2.75 3.25C7.75 9.542 8.983 11 10.5 11s2.75-1.458 2.75-3.25c0-1.482-.478-3.25-2.75-3.25zm0 8c-2.344 0-4.25-2.131-4.25-4.75C6.25 4.776 7.839 3 10.5 3s4.25 1.776 4.25 4.75c0 2.619-1.906 4.75-4.25 4.75zm9.5-6c-1.41 0-2.125.841-2.125 2.5 0 1.378.953 2.5 2.125 2.5 1.172 0 2.125-1.122 2.125-2.5 0-1.659-.715-2.5-2.125-2.5zm0 6.5c-1.999 0-3.625-1.794-3.625-4 0-2.467 1.389-4 3.625-4 2.236 0 3.625 1.533 3.625 4 0 2.206-1.626 4-3.625 4zm4.622 8a.887.887 0 00.878-.894c0-2.54-2.043-4.606-4.555-4.606h-1.86c-.643 0-1.265.148-1.844.413a6.226 6.226 0 011.76 4.336V21h5.621zm-7.122.562v-1.313a4.755 4.755 0 00-4.749-4.749H8.25A4.755 4.755 0 003.5 20.249v1.313c0 .518.421.938.937.938h12.125c.517 0 .938-.42.938-.938zM20.945 14C24.285 14 27 16.739 27 20.106a2.388 2.388 0 01-2.378 2.394h-5.81a2.44 2.44 0 01-2.25 1.5H4.437A2.44 2.44 0 012 21.562v-1.313A6.256 6.256 0 018.25 14h4.501a6.2 6.2 0 013.218.902A5.932 5.932 0 0119.084 14h1.861z">
                </path>
            </svg>
        </a>
        <a class="a_middle">
            <svg viewBox="0 0 28 28" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 em6zcovv" height="28" width="28"
                fill="#65676b">
                <path
                    d="M25.5 14C25.5 7.649 20.351 2.5 14 2.5 7.649 2.5 2.5 7.649 2.5 14 2.5 20.351 7.649 25.5 14 25.5 20.351 25.5 25.5 20.351 25.5 14ZM27 14C27 21.18 21.18 27 14 27 6.82 27 1 21.18 1 14 1 6.82 6.82 1 14 1 21.18 1 27 6.82 27 14ZM7.479 14 7.631 14C7.933 14 8.102 14.338 7.934 14.591 7.334 15.491 6.983 16.568 6.983 17.724L6.983 18.221C6.983 18.342 6.99 18.461 7.004 18.578 7.03 18.802 6.862 19 6.637 19L6.123 19C5.228 19 4.5 18.25 4.5 17.327 4.5 15.492 5.727 14 7.479 14ZM20.521 14C22.274 14 23.5 15.492 23.5 17.327 23.5 18.25 22.772 19 21.878 19L21.364 19C21.139 19 20.97 18.802 20.997 18.578 21.01 18.461 21.017 18.342 21.017 18.221L21.017 17.724C21.017 16.568 20.667 15.491 20.067 14.591 19.899 14.338 20.067 14 20.369 14L20.521 14ZM8.25 13C7.147 13 6.25 11.991 6.25 10.75 6.25 9.384 7.035 8.5 8.25 8.5 9.465 8.5 10.25 9.384 10.25 10.75 10.25 11.991 9.353 13 8.25 13ZM19.75 13C18.647 13 17.75 11.991 17.75 10.75 17.75 9.384 18.535 8.5 19.75 8.5 20.965 8.5 21.75 9.384 21.75 10.75 21.75 11.991 20.853 13 19.75 13ZM15.172 13.5C17.558 13.5 19.5 15.395 19.5 17.724L19.5 18.221C19.5 19.202 18.683 20 17.677 20L10.323 20C9.317 20 8.5 19.202 8.5 18.221L8.5 17.724C8.5 15.395 10.441 13.5 12.828 13.5L15.172 13.5ZM16.75 9C16.75 10.655 15.517 12 14 12 12.484 12 11.25 10.655 11.25 9 11.25 7.15 12.304 6 14 6 15.697 6 16.75 7.15 16.75 9Z">
                </path>
            </svg>
            <span class="not_icon">6</span>
        </a>
    </div>

    </div>
    <div class="h_right">
        <a class="find_friends_btn hide_bicko">
            Find Friends
        </a>
        <a href="<?php echo BASE_URL.$userInfo->link ?>" class="pic_img_prf hide_bicko">
            <img src="<?php echo $userInfo->profile_picture ?>" alt="">
            <span><?php echo $userInfo->first_name ?></span>
        </a>
        <div style="position:relative;">
            <a class="ri_scx" id="open_all"> <svg viewBox="0 0 44 44" width="1.2rem" height="1.2rem">
                    <circle cx="7" cy="7" r="6"></circle>
                    <circle cx="22" cy="7" r="6"></circle>
                    <circle cx="37" cy="7" r="6"></circle>
                    <circle cx="7" cy="22" r="6"></circle>
                    <circle cx="22" cy="22" r="6"></circle>
                    <circle cx="37" cy="22" r="6"></circle>
                    <circle cx="7" cy="37" r="6"></circle>
                    <circle cx="22" cy="37" r="6"></circle>
                    <circle cx="37" cy="37" r="6"></circle>
                </svg></a>
            <div class="all_menu">
                <div class="all_h">Menu</div>
                <div class="full_fucking_menu">
                    <div class="all_left">
                        <div class="all_search">
                            <i class="amm_s_ic"></i>
                            <input type="text" placeholder="Search Menu">
                        </div>

                        <div class="m_ar231">
                            <div class="h2_13">Social</div>
                            <div class="xc748">
                                <img src="assets/images/home/campus.png" alt="">
                                <div class="xc748_2">
                                    <span>Campus</span>
                                    <span>A unique, exclusive space for college students on Facebook.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/events.png" alt="">
                                <div class="xc748_2">
                                    <span>Events</span>
                                    <span>Organize or find events and other things to do online and nearby.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/friends.png" alt="">
                                <div class="xc748_2">
                                    <span>Find Friends</span>
                                    <span>Search for friends or people you may know.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/groups.png" alt="">
                                <div class="xc748_2">
                                    <span>Groups</span>
                                    <span>Connect with people who share your interests.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/feed.png" alt="">
                                <div class="xc748_2">
                                    <span>News Feed</span>
                                    <span>See relevant posts from people and Pages you follow.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/pages.png" alt="">
                                <div class="xc748_2">
                                    <span>Pages</span>
                                    <span>Discover and connect with businesses on Facebook.</span>
                                </div>
                            </div>



                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Entertainment</div>
                            <div class="xc748">
                                <img src="assets/images/home/gaming.png" alt="">
                                <div class="xc748_2">
                                    <span>Gaming Video</span>
                                    <span>Watch and connect with your favorite games and streamers.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/play.png" alt="">
                                <div class="xc748_2">
                                    <span>Play Games</span>
                                    <span>Play your favorite games.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/watch.png" alt="">
                                <div class="xc748_2">
                                    <span>Watch</span>
                                    <span>A video destination personalized to your interests and connections.</span>
                                </div>
                            </div>



                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Shopping</div>
                            <div class="xc748">
                                <img src="assets/images/home/pay.png" alt="">
                                <div class="xc748_2">
                                    <span>Facebook Pay</span>
                                    <span>A seamless, secure way to pay on the apps you already use.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/marketplace.png" alt="">
                                <div class="xc748_2">
                                    <span>Marketplace</span>
                                    <span>Buy and sell in your community.</span>
                                </div>
                            </div>



                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Personal</div>

                            <div class="xc748">
                                <img src="assets/images/home/recent.png" alt="">
                                <div class="xc748_2">
                                    <span>Recent Ad Activity</span>
                                    <span>See all the ads you interacted with on Facebook.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/memories.png" alt="">
                                <div class="xc748_2">
                                    <span>Memories</span>
                                    <span>Browse your old photos, videos and posts on Facebook.</span>
                                </div>
                            </div>


                            <div class="xc748">
                                <img src="assets/images/home/saved.png" alt="">
                                <div class="xc748_2">
                                    <span>Saved</span>
                                    <span>Find posts, photos and videos that you saved for later.</span>
                                </div>
                            </div>

                            <div class="xc748">
                                <img src="assets/images/home/weather.png" alt="">
                                <div class="xc748_2">
                                    <span>Weather</span>
                                    <span>Check your local forecast and sign up for daily weather notifications.</span>
                                </div>
                            </div>




                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Professional</div>

                            <div class="xc748">
                                <img src="assets/images/home/ads.png" alt="">
                                <div class="xc748_2">
                                    <span>Ads</span>
                                    <span>Create, manage and track the performance of your ads.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/jobs.png" alt="">
                                <div class="xc748_2">
                                    <span>Jobs</span>
                                    <span>Find a job that's right for you.</span>
                                </div>
                            </div>
                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Community Resources
                            </div>

                            <div class="xc748">
                                <img src="assets/images/home/climate.png" alt="">
                                <div class="xc748_2">
                                    <span>Climate science center</span>
                                    <span>Learn about climate change and its effects.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/covid.png" alt="">
                                <div class="xc748_2">
                                    <span>COVID-19 Information Center</span>
                                    <span>See the latest prevention tips, community resources and updates from health
                                        organizations.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/community.png" alt="">
                                <div class="xc748_2">
                                    <span>Community Help</span>
                                    <span>Get involved in your community by creating a drive, requesting or offering
                                        help or volunteering.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/fundraisers.png" alt="">
                                <div class="xc748_2">
                                    <span>Fundraisers</span>
                                    <span>Donate and raise money for nonprofits and personal causes.</span>
                                </div>
                            </div>

                        </div>
                        <div class="m_ar231">
                            <div class="h2_13">Community Resources
                            </div>

                            <div class="xc748">
                                <img src="assets/images/home/messenger.png" alt="">
                                <div class="xc748_2">
                                    <span>Messenger</span>
                                    <span>Chat instantly with your friends and connections.</span>
                                </div>
                            </div>
                            <div class="xc748">
                                <img src="assets/images/home/messkids.png" alt="">
                                <div class="xc748_2">
                                    <span>Messenger Kids</span>
                                    <span>Let kids message with close friends and family.</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="all_right">
                        <div class="r_tit">Create</div>
                        <div class="a7aton" id="full_open_post">
                            <div class="m_b217">
                                <i class="m_post_icon"></i>
                            </div>
                            Post
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_story_icon"></i>
                            </div>
                            Story
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_post_icon"></i>
                            </div>
                            Room
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_page_icon"></i>
                            </div>
                            Page
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_ad_icon"></i>
                            </div>
                            Ad
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_group_icon"></i>
                            </div>
                            Group
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_event_icon"></i>
                            </div>
                            Event
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_post_mar"></i>
                            </div>
                            Marketplace Listing
                        </div>
                        <div class="a7aton">
                            <div class="m_b217">
                                <i class="m_post_job"></i>
                            </div>
                            Job
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="position:relative;">
            <a class="ri_scx" id="open_messages"> <svg class="svgmsg" viewBox="0 0 28 28" alt="" height="20" width="20">
                    <path
                        d="M14 2.042c6.76 0 12 4.952 12 11.64S20.76 25.322 14 25.322a13.091 13.091 0 0 1-3.474-.461.956 .956 0 0 0-.641.047L7.5 25.959a.961.961 0 0 1-1.348-.849l-.065-2.134a.957.957 0 0 0-.322-.684A11.389 11.389 0 0 1 2 13.682C2 6.994 7.24 2.042 14 2.042ZM6.794 17.086a.57.57 0 0 0 .827.758l3.786-2.874a.722.722 0 0 1 .868 0l2.8 2.1a1.8 1.8 0 0 0 2.6-.481l3.525-5.592a.57.57 0 0 0-.827-.758l-3.786 2.874a.722.722 0 0 1-.868 0l-2.8-2.1a1.8 1.8 0 0 0-2.6.481Z">
                    </path>
                </svg></a>
            <div class="messages_popup">
                <div class="messg_header">
                    Messenger
                    <div class="rtt4458">
                        <div class="wtfakinho">
                            <i class="pointa74"></i>
                        </div>
                        <div class="wtfakinho">
                            <i class="a5455551"></i>
                        </div>
                        <div class="wtfakinho">
                            <i class="b545845"></i>
                        </div>
                        <div class="wtfakinho">
                            <i class="v54545"></i>
                        </div>
                    </div>
                </div>
                <div class="s15145_searchives">
                    <svg viewBox="0 0 16 16" fill="#65676b" width="1em" height="1em"
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
                    </svg>
                    <input type="text" placeholder="Search Facebook">
                </div>
                <div class="ms74g">
                    <div class="ty415" style="width: 65px;">
                        <i class="b454"></i>
                    </div>
                    <div class="tx45">
                        <span>New message Requests</span>
                        <span style="font-size:12px;color:#1876f2">No message requests for now</span>
                    </div>
                    <i class="a5a4d"></i>
                </div>
                <div class="cont_user_msg_list">

                    <?php
foreach ($allusers as $last){ 
    if($last->seqnum==1){
    if($last->receiver != $userid){ 
     $infos= $loadUser->getUserInfo($last->receiver);
    }
     else{ 

         $infos= $loadUser->getUserInfo($last->sender);
     }
     ?>
                    <div class="ms74g" data-userid="<?php echo $userid ?>" data-chat="<?php echo $infos->user_id ?>">
                        <div class="ty415">
                            <img src="<?php echo $infos->profile_picture ?>" alt="">
                        </div>
                        <div class="tx45">
                            <span
                                style="font-size:14px;font-weight:400;color:#000"><?php echo $infos->first_name.' '.$infos->last_name ?></span>
                            <span
                                style="font-size:12px;color:#65676b;display:flex;align-items:center"><?php echo $loadUser->timeAgoAlt($last->messageAt) ?>
                                <div style="color:#000;padding:2px;font-weight:600"> . </div>
                                <?php echo $last->message ?>
                            </span>
                        </div>

                    </div>

                    <?php }
       
    }


                    
                    ?>
                </div>

            </div>

        </div>
        <div style="position:relative">
            <a class="ri_scx" id="open_notif"> <svg viewBox="0 0 28 28" alt=""
                    class="a8c37x1j ms05siws hwsy1cff b7h9ocf4 fzdkajry" height="20" width="20">
                    <path
                        d="M7.847 23.488C9.207 23.488 11.443 23.363 14.467 22.806 13.944 24.228 12.581 25.247 10.98 25.247 9.649 25.247 8.483 24.542 7.825 23.488L7.847 23.488ZM24.923 15.73C25.17 17.002 24.278 18.127 22.27 19.076 21.17 19.595 18.724 20.583 14.684 21.369 11.568 21.974 9.285 22.113 7.848 22.113 7.421 22.113 7.068 22.101 6.79 22.085 4.574 21.958 3.324 21.248 3.077 19.976 2.702 18.049 3.295 17.305 4.278 16.073L4.537 15.748C5.2 14.907 5.459 14.081 5.035 11.902 4.086 7.022 6.284 3.687 11.064 2.753 15.846 1.83 19.134 4.096 20.083 8.977 20.506 11.156 21.056 11.824 21.986 12.355L21.986 12.356 22.348 12.561C23.72 13.335 24.548 13.802 24.923 15.73Z">
                    </path>
                </svg></a>
            <div class="not_numbr">
                <?php echo count($notificationsTotal)  ?>
            </div>
            <div class="notifications">
                <div class="not_header">
                    <span>Notifications</span>
                    <div class="notic_p">
                        <i class="not_poin"></i>
                    </div>
                </div>
                <ul>
                    <?php
                        if(!empty($notifications)){
                            foreach($notifications as $notif){
                                if($notif->status=='0'){
                                    
                                    if($notif->type=="postReact"){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" src="<?php echo $notif->profile_picture ?>" alt="">
                            <img class="sec_img" src="<?php echo 'assets/images/not/'.$notif->icon.'.png' ?>" alt="">
                        </div>
                        <div class="not_infos">
                            <div class="not_who">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> reacted to your
                                post
                            </div>
                            <div class="not_time">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                        </div>
                        <div class="not_dot">

                        </div>
                    </a>




                    <?php  }else if($notif->type=="commentReact"){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" src="<?php echo $notif->profile_picture ?>" alt="">
                            <img class="sec_img" src="<?php echo 'assets/images/not/'.$notif->icon.'.png' ?>" alt="">
                        </div>
                        <div class="not_infos">
                            <div class="not_who">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> reacted to your
                                comment
                            </div>
                            <div class="not_time">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>

                        </div>
                        <div class="not_dot">

                        </div>
                    </a>
                    <?php }else if($notif->type =="request" && $notif->friendStatus =='0'){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" src="<?php echo $notif->profile_picture ?>" alt="">
                            <i class="req_iconn"></i>
                        </div>
                        <div class="not_infos">
                            <div class="not_who">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> send you a
                                friend request
                            </div>
                            <div class="not_time">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                            <div class="not_requesto">
                                <button>Confirm</button>
                                <button>Delete</button>
                            </div>
                        </div>
                        <div class="not_dot">

                        </div>
                    </a>
                    <?php }else if($notif->type =='request' && $notif->friendStatus =='1'){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" src="<?php echo $notif->profile_picture ?>" alt="">
                            <i class="req_iconn1"></i>
                        </div>
                        <div class="not_infos">
                            <div class="not_who">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> accepted your
                                friend request
                            </div>
                            <div class="not_time">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                        </div>
                        <div class="not_dot">

                        </div>
                    </a>

                    <?php    }else if($notif->type=='postMention'){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" src="<?php echo $notif->profile_picture ?>" alt="">
                            <i class="tag1_icon"></i>
                        </div>
                        <div class="not_infos">
                            <div class="not_who">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> tagged you
                                in a post
                            </div>
                            <div class="not_time">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>

                        </div>
                        <div class="not_dot">

                        </div>
                    </a>
                    <?php }
                    
                    
                    
                    }else{
                                        
                        if($notif->type=="postReact"){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" style="-webkit-filter: invert(15%);"
                                src="<?php echo $notif->profile_picture ?>" alt="">
                            <img class="sec_img" src="<?php echo 'assets/images/not/'.$notif->icon.'.png' ?>" alt="">
                        </div>
                        <div class="not_infos" style="color:#65676b">
                            <div class="not_who" style="color:#65676b">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> reacted to your
                                post
                            </div>
                            <div class="not_time" style="color:#65676b">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                        </div>

                    </a>




                    <?php  }else if($notif->type=="commentReact"){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" style="-webkit-filter: invert(15%);"
                                src="<?php echo $notif->profile_picture ?>" alt="">
                            <img class="sec_img" src="<?php echo 'assets/images/not/'.$notif->icon.'.png' ?>" alt="">
                        </div>
                        <div class="not_infos" style="color:#65676b">
                            <div class="not_who" style="color:#65676b">
                                <span><?php echo $notif->first_name.' '.$notif->last_name ?></span> reacted to your
                                comment
                            </div>
                            <div class="not_time" style="color:#65676b">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>

                        </div>

                    </a>
                    <?php }else if($notif->type =="request" && $notif->friendStatus =='0'){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" style="-webkit-filter: invert(15%);"
                                src="<?php echo $notif->profile_picture ?>" alt="">
                            <i class="req_iconn"></i>
                        </div>
                        <div class="not_infos" style="color:#65676b">
                            <div class="not_who" style="color:#65676b">
                                <span
                                    style="color:#65676b"><?php echo $notif->first_name.' '.$notif->last_name ?></span>
                                send you a
                                friend request
                            </div>
                            <div class="not_time" style="color:#65676b">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                            <div class="not_requesto">
                                <button id="not_accept">Confirm</button>
                                <button id="not_delete">Delete</button>
                            </div>
                        </div>

                    </a>
                    <?php }else if($notif->type =='request' && $notif->friendStatus =='1'){ ?>
                    <a class="notification" data-notid="<?php echo $notif-> not_id?>"
                        data-postid="<?php echo $notif->postid ?>" data-profileid="<?php echo $notif->not_from ?>">
                        <div class="not_image">
                            <img class="GreyImg" style="-webkit-filter: invert(15%);"
                                src="<?php echo $notif->profile_picture ?>" alt="">
                            <i class="req_iconn1"></i>
                        </div>
                        <div class="not_infos" style="color:#65676b">
                            <div class="not_who">
                                <span
                                    style="color:#65676b"><?php echo $notif->first_name.' '.$notif->last_name ?></span>
                                accepted your
                                friend request
                            </div>
                            <div class="not_time" style="color:#65676b">
                                <?php echo $loadUser->timeAgo($notif->createdAt) ?>
                            </div>
                        </div>

                    </a>

                    <?php    }
                        
                         }
                            }
                        }
                        ?>


                </ul>
            </div>

        </div>
        <div style="position: relative">
            <a class="ri_scx" id="open_thatmenu"> <svg style="font-size: larger" viewBox="0 0 20 20" width="1em"
                    height="1em">
                    <path
                        d="M10 14a1 1 0 0 1-.755-.349L5.329 9.182a1.367 1.367 0 0 1-.205-1.46A1.184 1.184 0 0 1 6.2 7h7.6a1.18 1.18 0 0 1 1.074.721 1.357 1.357 0 0 1-.2 1.457l-3.918 4.473A1 1 0 0 1 10 14z">
                    </path>
                </svg></a>

            <div class="wrapper" id="menu_header">
                <div class="h_settings">
                    <div class="h_s_head" id="back_menu">
                        <div class="backiintio"><i class="bacibitcho"></i> </div> Settings & privacy
                    </div>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="sett_ik"></i>
                        </div>
                        <span>Settings</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="pr_2401"></i>
                        </div>
                        <span>Privacy Checkup</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="pr_ic15789"></i>
                        </div>
                        <span>Privacy Shortcuts</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="logger_icon"></i>
                        </div>
                        <span>Activity Log</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="news_iccc"></i>
                        </div>
                        <span>News Feed Preferences</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="languego_icon"></i>
                        </div>
                        <span>Language</span>
                    </a>
                </div>
                <div class="h_helpSupp">
                    <div class="h_s_head" id="back_menu">
                        <div class="backiintio"><i class="bacibitcho"></i> </div> Help & Support
                    </div>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="helpikino_icon"></i>
                        </div>
                        <span>Help Center</span>
                    </a>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="supporitnhi_icon"></i>
                        </div>
                        <span>Support Inbox</span>
                    </a> <a class="capoutchinho_haha">
                        <div class="cpi7412">
                            <i class="reeporinho_icon"></i>
                        </div>
                        <span>Report a Problem</span>
                    </a>

                </div>
                <div class="h_displayaccess">
                    <div class="h_s_head" id="back_menu">
                        <div class="backiintio"><i class="bacibitcho"></i> </div>
                        Display & Accessibility
                    </div>
                    <a class="capoutchinho_haha">
                        <div class="cpi7412-3">
                            <i class="darkinho_icon"></i>
                        </div>

                        <div class="kasamino_21">
                            <span>Dark Mode</span>
                            <span>Adjust the appearance of Facebook to reduce glare and give your eyes a break.</span>
                        </div>
                    </a>
                    <label class="change_someshitos" for="off_dark">
                        <span>Off</span>
                        <input type="radio" name="dark" id="off_dark" checked>
                    </label>
                    <label class="change_someshitos" for="on_dark">
                        <span>On</span>
                        <input type="radio" name="dark" id="on_dark">
                    </label>

                    <a class="capoutchinho_haha">
                        <div class="cpi7412-3" style="width:60px">
                            <i class="compactinho_icon"></i>
                        </div>

                        <div class="kasamino_21">
                            <span>Compact Mode</span>
                            <span>Make your font size smaller so more content can fit on the screen.</span>
                        </div>
                    </a>
                    <label class="change_someshitos" for="off_compact">
                        <span>Off</span>
                        <input type="radio" name="compact" id="off_compact" checked>
                    </label>
                    <label class="change_someshitos" for="on_compact">
                        <span>On</span>
                        <input type="radio" name="compact" id="on_compact">
                    </label>
                    <div class="menu_me_wrap1" style="cursor:pointer;padding:15px 5px;margin-top:5px">
                        <a href="#" class="header_feedback">
                            <div class="feddback_left"><i class="keyboardinho_icon"></i></div>
                            <div class="feedback_right">
                                <span class="text-blacko">Keyboard</span>
                            </div>
                        </a>
                        <div class="arrow_right"><i class="arrow_img"></i></div>
                    </div>

                </div>
                <ul class="menu-bar">
                    <li class="menu_me_wrap">
                        <a href="<?php echo BASE_URL.$userInfo->link ?>" class="menu_me">
                            <img src="<?php echo $userInfo->profile_picture ?>" alt="">
                            <div class="menu_me_name">
                                <span><?php echo $userInfo->first_name.' '.$userInfo->last_name;?></span>
                                <span>See your profile</span>
                            </div>
                        </a>
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
                    <li class="menu_me_wrap1" style="margin-top:10px" id="open_settings">
                        <a class="header_feedback">
                            <div class="feddback_left"><i class="setting_img"></i></div>
                            <div class="feedback_right">
                                <span class="text-blacko">Setting & Privacy</span>
                            </div>
                        </a>
                        <div class="arrow_right" style="margin-top:2px"><i class="arrow_img"></i></div>
                    </li>
                    <li class="menu_me_wrap1" id="open_help">
                        <a href="#" class="header_feedback">
                            <div class="feddback_left"><i class="help_img"></i></div>
                            <div class="feedback_right">
                                <span class="text-blacko">Help & Support</span>
                            </div>
                        </a>
                        <div class="arrow_right"><i class="arrow_img"></i></div>
                    </li>
                    <li class="menu_me_wrap1" id="open_display">
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
</header>
<div class="popin_dem_chats">

</div>
<div class="nicknames_popup">

</div>
<div class="forward_popup">
    <div class="exit_forward">
        <i class="zfzfzfzfkzpofgj"></i>
    </div>
    <div class="forward_header">
        Forward
    </div>
    <div class="forward_body">
        <div class="forward_search">
            <svg viewBox="0 0 16 16" width="1em" height="1em" fill="#65676b">
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
            <input type="text" placeholder="Search for people and groups" id="forward_search">
        </div>
        <div class="forward_list">

            <div class="yaweddi_forwards">

            </div>
        </div>
    </div>
</div>

<div class="fixed_opacity"></div>
<div class="errors_popup">

</div>
<div class="call_incoming">

</div>

<script>
//-----Check For calls-->
setInterval(function() {
    $.post('http://localhost/facebook/core/chat/calls.php', {
        check_for_calls: "<?php echo $userid ?>",
    }, function(data) {
        $('.call_incoming').html(data);

    })
}, 10000000)

$(document).on('click', '#accept_call', function() {
    var username = $(this).data('username')
    window.open('respond.php?id=' + username + '', "_blank",
        "resizable=yes, scrollbars=yes, titlebar=yes, width=1200, height=800, top=10, left=10");
})

//-----Check For calls-->

$(document).ready(function() {


    $('#divOutside').click(function() {
        $('.emojionearea-button').click()
    })


});

$('#lala').click(function() {
    alert($("#emojionearea1").val());
    $("#nnnnn").append($("#emojionearea1").val());
})

$(document).on('click', '#start_video_call', function() {

    window.open('call.php?id=<?php echo $userInfo->link ?>', "_blank",
        "resizable=yes, scrollbars=yes, titlebar=yes, width=1200, height=800, top=10, left=10");

})





$(document).on('click', '#open_search', function() {
    $('#search_results').show();
    $('#search_input').focus()
    $('.notifications').hide();
    $('.menu_header').hide();
    $('.all_menu').hide();
})
$(document).on('focus', '#search_input', function() {
    $('#search_icon1').hide();
})
$(document).on('blur', '#search_input', function() {
    $('#search_icon1').show();
})

$(document).on('keyup', '#search_input', function() {
    var searchTerm = $(this).val();

    if (searchTerm == '') {
        $('.s_hhs').show()
        $('.h_resultos_hermanos').show()
        $('.h_resultos_hermanos1').hide()



    } else {
        $('.s_hhs').hide()
        $('.h_resultos_hermanos').hide()
        $('.h_resultos_hermanos1').show()


        $.post('http://localhost/facebook/core/ajax/search.php', {
            searchTerm: searchTerm,

        }, function(data) {

            if (data == '') {

                $('.h_resultos_hermanos1').html('no results found');
            } else {
                $('.h_resultos_hermanos1').html(data);

            }
        })
    }

})



//-----Search History--->
$(document).on('click', '#searched_user', function() {
    var userid = "<?php echo $userid ?>"
    var search_id = $(this).data('profileid');
    $.post('http://localhost/facebook/core/ajax/search.php', {
        search_id: search_id,
        userid: userid
    }, function(data) {

    })
})

//---update date-->
$(document).on('click', '.his_l', function() {
    var profileid = $(this).parents('.history_item').data('profileid');
    var userid = "<?php echo $userid ?>";



    $.post('http://localhost/facebook/core/ajax/search.php', {
        updatesearchdate: profileid,
        userid: userid
    }, function(data) {


    })
})
//---update date -->

//---remove from search -->
$(document).on('click', '#delete_search', function() {
    var This = $(this)
    var search = $(this).parents('.history_item').data('profileid')
    var userid = "<?php echo $userid ?>";

    $.post('http://localhost/facebook/core/ajax/search.php', {
        delete_search: search,
        userid: userid
    }, function(data) {
        $(This).parents('.history_item').hide();
    })

})
//---remove from search -->

//--Menu->
$(document).on('click', '#open_thatmenu', function() {
    $('#menu_header').toggle();
    $('.notifications').hide();
    $('.all_menu').hide();
    if ($('#menu_header').is(":visible")) {
        $('#open_thatmenu').css('background', '#e7f3ff');
        $('#open_thatmenu').find('svg').css('fill', '#1876f1');
    } else {
        $(this).css('background', '#e4e6eb')
        $(this).find('svg').css('fill', '#000000')
    }

})
//--Menu->


//---->notifications->
$(document).on('click', '#not_accept', function() {
    var This = $(this);
    var userid = "<?php echo $userid ?>";
    var profileid = $(this).parents('.notification').data('profileid')

    $.post('http://localhost/facebook/core/ajax/request.php', {
        Confirmrequest: profileid,
        userid: userid
    }, function(data) {

        $(This).parents('.notification').hide();
    })
})
$(function() {

    //-----------Mnetion--->



    function updateNotifications(userid) {
        $.post('http://localhost/facebook/core/ajax/notifications.php', {
            userupdateNotifications: userid
        }, function(data) {
            if (data.trim() == '0') {
                $('.not_numbr').empty()
                $('.not_numbr').css('background', 'transparent');

            } else {
                $('.not_numbr').html(data);
                $('.not_numbr').css('background', '#e41e3f');

            }
        })
    }
    var notificationDelay;
    var userid = "<?php echo $userid; ?>"
    notificationDelay = setInterval(function() {
        updateNotifications(userid);
    }, 1000)
})

$(document).on('click', '#open_notif', function() {
    $('.notifications').toggle();
    $('.menu_header').hide();
    $('.all_menu').hide();
    if ($('.notifications').is(":visible")) {
        $('#open_notif').css('background', '#e7f3ff');
        $('#open_notif').find('svg').css('fill', '#1876f1');
    } else {
        $(this).css('background', '#e4e6eb')
        $(this).find('svg').css('fill', '#000000')
    }

    var userid = "<?php echo $userid; ?>";
    $.post('http://localhost/facebook/core/ajax/notifications.php', {
        notifications: userid,
    }, function(data) {})
})



$(document).on('click', '.notification', function() {
    $(this).find('.not_image').find('.GreyImg')
        .css('-webkit-filter', 'invert(15%)');
    $(this).find('.not_infos').css('color', '#65676b');
    $(this).find('.not_infos').find('.not_time').css('color', '#65676b');
    $(this).find('.not_infos').find('.not_who span').css('color', '#65676b');

    var postid = $(this).data('postid');
    var profileid = $(this).data('profileid');
    var notificationid = $(this).data('notid');
    var userid = "<?php echo $userid; ?>";
    $.post('http://localhost/facebook/core/ajax/notifications.php', {
        updateNotifications: userid,
        profileid: profileid,
        postid: postid,
        notificationid: notificationid,
    }, function(data) {

    })
})

//---->notifications->

//-Open All menu--->
$(document).on('click', '#open_all', function() {
    $('.all_menu').toggle();
    $('.notifications').hide();
    $('#menu_header').hide();
    if ($('.all_menu').is(":visible")) {
        $('#open_all').css('background', '#e7f3ff');
        $('#open_all').find('svg').css('fill', '#1876f1');
    } else {
        $(this).css('background', '#e4e6eb')
        $(this).find('svg').css('fill', '#000000')
    }

})
//-Open All menu--->

//-open sub menus----->
$(document).on('click', '#open_settings', function() {
    $('.menu-bar').hide();
    $('.h_settings').show();
})

$(document).on('click', '#open_help', function() {
    $('.menu-bar').hide();
    $('.h_helpSupp').show();
})

$(document).on('click', '#open_display', function() {
    $('.menu-bar').hide();
    $('.h_displayaccess').show();
})
$(document).on('click', '#back_menu', function() {
    $('.h_settings').hide();
    $('.h_helpSupp').hide();
    $('.h_displayaccess').hide();
    $('.menu-bar').show();
})

//-open sub menus----->



//----Close ---->
$(document).on('click', '#close_search', function() {
    $('#search_results').hide()
})

$(document).mouseup(function(e) {
    var container = new Array();
    container.push('#search_results');

    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(value).hide()


        }
    })
})
/*
$(document).mouseup(function(e) {
    var container = new Array();
    container.push('.notifications');

    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(value).hide()
            $('#open_notif').css('background', '#e4e6eb')
            $('#open_notif').find('svg').css('fill', '#000')


        }
    })
})
*/

//update messages and users list->

//--open list->
$(document).on('click', '#open_messages', function(e) {
    $('.messages_popup').toggle();
    $('#menu_header').hide();
    $('.notifications').hide();
    $('.all_menu').hide();
    if ($('.messages_popup').is(":visible")) {
        $('#open_messages').css('background', '#e7f3ff');
        $('#open_messages').find('.svgmsg').css('fill', '#1876f1');
    } else {
        $(this).css('background', '#e4e6eb')
        $(this).find('svg').css('fill', '#000000')
    }
})
//--open list->

function updateList() {
    $.post('http://localhost/facebook/core/chat/updateHeaderList.php', {

    }, function(data) {

        $('.cont_user_msg_list').html(data);
    })
}
var t = setInterval(updateList, 1000);

//update messages and users list->

//----open chat -->
$(document).on('click', '.ms74g', function() {
    var This = $(this)
    var userid = "<?php echo $userid ?>"
    var chat = $(this).data('chat');
    $('.messages_popup').hide();


    $.post('http://localhost/facebook/core/ajax/chat.php', {
        popup_chat: chat,
        userid: userid
    }, function(data) {
        if ($('.popup_chat[data-chat=' + chat + ']').length > 0) {
            $(This).find('input#ligh_send[data-chat=' + chat + ']').focus();
        } else {
            $('.popin_dem_chats').append(data);
            $(This).find('input#ligh_send[data-chat=' + chat + ']').focus();
            $('#ligh_send[data-chat=' + chat + ']').emojioneArea({

            });
            /*$('#light_send').emojioneArea({
                position: 'right',
            })*/
            scrolla(chat);

        }

    })
})

//----open chat -->

//--->send messsage-->
$(document).on('keyup', '#light_send', function(e) {
    if (e.keyCode == 13) {

        var msg = $(this).val();
        var userid = $(this).data('userid');
        var chatid = $(this).data('chat');
        var This = $(this)

        $.post('http://localhost/facebook/core/ajax/message.php', {
            useridMsg: userid,
            chatid: chatid,
            msg: msg
        }, function(data) {

            $(This).val('')

            scrolla(chatid);

        })
    }

})


//---Scroll to last-->


function scrolla(chat) {

    var viewheight = $('.popup_chat_area[data-chat=' + chat + ']').height();

    var totalHeight = $('.popup_chat_area[data-chat=' + chat + ']')[0].scrollHeight;

    if (totalHeight > viewheight) {
        $('.popup_chat_area[data-chat=' + chat + ']').scrollTop(totalHeight - viewheight);
    }
}
//---Scroll to last--

$(document).on('click', '.ms74g', function() {
    var chatid = $(this).data('chat');
    listChat.push(chatid);


})
$(document).on('click', '.contact_tochat', function() {
    var chatid = $(this).data('chatid');
    listChat.push(chatid);


})



//update last activity to update online offlien status-->

function updateOnlineStatus() {
    var userid = "<?php echo $userid ?>";

    $.post('http://localhost/facebook/core/ajax/online.php', {
        online: userid,
    }, function(data) {

    })
}
var online = setInterval(updateOnlineStatus, 2000);

//update last activity to update online offlien status-->
var listChat = [];

function loadMessages() {


    for (let i = 0; i < listChat.length; i++) {
        var count = $('.messaging_popup[data-chat = ' + listChat[i] + ']').data('count');
        var reactChanged = $('.messaging_popup[data-chat = ' + listChat[i] + ']').data('changed');

        $.post('http://localhost/facebook/core/ajax/message.php', {
            dataCount: listChat[i],
            profileid: "<?php echo $userid ?>",
        }, function(data) {

            if (count == data && reactChanged == 'false') {
                $.post('http://localhost/facebook/core/chat/updateSeen.php', {
                    update_seen: listChat[i],
                    userid: "<?php echo $userid ?>"
                }, function(data) {

                    $('.update_seen_or[data-chat=' + listChat[i] + ']').html(data);
                })

            } else {
                $.post('http://localhost/facebook/core/ajax/refreshMessages.php', {
                    refreshmsgs: "<?php echo $userid ?>",
                    chatid: listChat[i],

                }, function(data) {
                    $('.popup_chat_area[data-chat=' + listChat[i] + ']').html(data);
                    /* scrolla(listChat[i]);*/

                    $('.messaging_popup[data-chat = ' + listChat[i] + ']').data('changed', 'false');

                })
            }
        })
    }

}


a = setInterval(function() {

    if (listChat.length > 0) {
        loadMessages();
    }
}, 1000)

a = setInterval(function() {

    if (listChat.length > 0) {
        updaet_online_tick();
    }
}, 1000)

function updaet_online_tick() {
    for (let i = 0; i < listChat.length; i++) {
        var time = $('.messaging_popup[data-chat=' + listChat[i] + ']').data('time');
        $.post('http://localhost/facebook/core/ajax/refreshMessages.php', {
            doiupdateOnline: listChat[i],
            time: time,
        }, function(data) {

            if (data == 'blach') {

            } else {
                $.post('http://localhost/facebook/core/ajax/refreshMessages.php', {
                    update_on_tick: listChat[i],
                }, function(data) {
                    $('.updatem_online[data-chat=' + listChat[i] + ']').html(
                        '<div class="active_now_wrap"> <div class="active_dot"></div></div>'
                    );
                })
            }
        })


    }
}





//---Update online in chat----->


//---Update online in chat----->


//-----Update Seen Status------->
function updateSeenOrNot() {

}
//-----Update Seen Status------->

//---->Delete Chat--->
$(document).on('click', '#delete_chat', function() {
    var userid = "<?php echo $userid ?>"
    var chatid = $(this).parents('.popup_chat').data('chat');
    $.post('http://localhost/facebook/core/chat/deleteChat.php', {
        delete_chat: chatid,
        userid: userid,
    }, function(data) {

    })
})
//---->Delete Chat--->

//---->get chat count on ready-------->
chatCount = [];
$(document).ready(function() {
    $.post('http://localhost/facebook/core/chat/chatCount.php', {
        chat_count: "<?php echo $userid ?>",
    }, function(data) {
        chatCount = JSON.parse(data);
    })




})
//---->get chat count on ready-------->


//aandk tnsa hna tzid reset dyalha


//--z3ma rah Online--->
$(document).on('click', '.popup_chat', function() {
    var lghaleblahchatid = $(this).data('chat');
    var userid = $(this).data('userid');
    $.post('http://localhost/facebook/core/chat/z3marahOnline.php', {
        lghaleblahchatid: lghaleblahchatid,
        userid: userid
    })

})



$(document).mouseup(function(e) {
    if (!$(e.target).closest('.popup_chat').length) {

        for (let i = 0; i < listChat.length; i++) {
            var lghaleblahchatid = listChat[i];
            var userid = "<?php echo $userid ?>"
            $.post('http://localhost/facebook/core/chat/z3marahOnline.php', {
                lghaleblahchatid2: lghaleblahchatid,
                userid: userid
            })
        }

    }
})
//--z3ma rah Online--->


//-----db nchofo ila tbdlat--->
function ftahkosomochat() {

    if (chatCount.length > 0) {
        for (var i = 0; i < chatCount.length; i++) {
            var chat = chatCount[i].chat;
            var totall = chatCount[i].count;
            var userid = "<?php echo $userid ?>";

            $.post('http://localhost/facebook/core/chat/chatCount.php', {
                checkChatChanges: userid,
                chat: chat,
                totall: totall
            }, function(data) {
                var datta = JSON.parse(data)
                var chat = datta[0].chat
                var totalt = datta[0].total
                var countt = datta[0].count

                /*/ console.log('total-->', total);
                 console.log('data-->', data);*/
                if (countt != totalt) {
                    $.post('http://localhost/facebook/core/ajax/chat.php', {
                        popup_chat: chat,
                        userid: userid
                    }, function(data) {
                        if ($('.popup_chat[data-chat=' + chat + ']').length > 0) {
                            $('.popup_chat[data-chat=' + chat + ']').find('input#ligh_send[data-chat=' +
                                chat + ']').focus();
                        } else {
                            $('.popin_dem_chats').append(data);
                            $('.popup_chat[data-chat=' + chat + ']').find('input#ligh_send[data-chat=' +
                                chat + ']').focus();
                            $('#ligh_send[data-chat=' + chat + ']').emojioneArea({

                            });
                            /*$('#light_send').emojioneArea({
                                position: 'right',
                            })*/
                            scrolla(chat);

                        }

                    })
                }

            })
        }
    }


}

//-----db nchofo ila tbdlat--->

a = setInterval(function() {
    ftahkosomochat();
}, 1000)

//---Open Chat Menu---->
$(document).on('click', '.left_popp', function() {
    $(this).parents('.chat_header').siblings('.chat_popup_menu').toggle();
})
/*
$(document).mouseup(function(e) {
    var container = new Array();
    container.push('.chat_popup_menu');
    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(value).hide()


        }
    })
})*/
$(document).mouseup(function(e) {
    if (!$(e.target).closest('.chat_popup_menu').length) {

    }
})
//---Open Chat Menu---->


//--->send messsage-->

//---close chat tab*-->
$(document).on('click', '#close_chat', function() {
    var chatid = $(this).data('chat');
    $('.popup_chat[data-chat=' + chatid + ']').remove();
    var ind = chatCount.findIndex(i => i.chat == chatid);
    if (ind > -1) {
        chatCount.splice(ind, 1)

    }
    var index = listChat.indexOf(chatid);
    if (index > -10) {
        listChat.splice(index, 1)
        $.post('http://localhost/facebook/core/chat/offline.php', {
            offlinechatid: chatid,
            userid: "<?php echo $userid ?>",
        }, function(data) {

        })
    }
})

//---close chat tab*-->


//---Blur Chqt Popup----->


//--->Nickanames------>
$(document).on('click', '#open_nicknames', function() {
    var userid = "<?php echo $userid ?>"
    var chat = $(this).parents('.popup_chat').data('chat');
    $.post('http://localhost/facebook/core/chat/nicknames.php', {
        nickname: chat,
        userid: userid
    }, function(data) {
        $('.popup_chat[data-chat=' + chat + ']').find('.chat_popup_menu').hide();
        $('.fixed_opacity').show();
        $('.nicknames_popup').html(data).show();


    })
})
$(document).on('click', '.exit_nickname', function() {
    $(this).parents('.nicknames_popup').hide();
    $('.fixed_opacity').hide();
})



//--->Nickanames------>

//--->Forwards------>
$(document).on('click', '#open_forward', function() {
    var userid = "<?php echo $userid ?>"
    var chat = $(this).parents('.popup_chat').data('chat');
    var msg = $(this).data('msg');

    $.post('http://localhost/facebook/core/chat/forward.php', {
        forward: chat,
        userid: userid,
        msg: msg
    }, function(data) {

        $('.fixed_opacity').show();
        $('.yaweddi_forwards').html(data);
        $('.forward_popup').show();

    })
})
$(document).on('click', '.exit_forward', function() {
    $(this).parents('.forward_popup').hide();
    $('.fixed_opacity').hide();
})
var chatundosent = [];
$(document).on('click', '#forward_sendd', function() {
    var This = $(this)
    var userid = "<?php echo $userid ?>";
    var chatid = $(this).parents('.forward_friend_item').data('chat');
    var msg = $(this).parents('.forward_friend_item').data('msg');
    $.post('http://localhost/facebook/core/chat/forward_msg.php', {
        forward_chat: chatid,
        chatid: chatid,
        msg: msg,
        userid: userid
    }, function(data) {
        $(This).attr('id', 'undo_forward');
        $(This).attr('data-msg', msg);
        $(This).text('Undo');
        $(This).attr('changed', 'yes');
        var rec = $('.forward_recent').find('.forward_friend_item[data-chat=' +
            chatid +
            '] button');
        $(rec).text('Undo');
        $(rec).attr('id', 'undo_forward1');
        $(rec).attr('data-msg', msg);

        setTimeout(function() {
            if ($(This).attr('changed') == 'yes') {
                $(This).attr('disabled', 'disabled');
                $(This).removeClass().addClass('sent_forward_btn')
                $(This).html('<i class="sentedtefde">/</i>Sent');
                var damn = $('.forward_recent').find('.forward_friend_item[data-chat=' +
                    chatid +
                    '] button');
                $(damn).attr('disabled', 'disabled').removeClass();
                $(damn).addClass('sent_forward_btn');
                $(damn).html('<i class="sentedtefde">/</i>Sent');
            }
        }, 4000)


    })

})
$(document).on('click', '#forward_sendd1', function() {
    var This = $(this)
    var userid = "<?php echo $userid ?>";
    var chatid = $(this).parents('.forward_friend_item').data('chat');
    var msg = $(this).parents('.forward_friend_item').data('msg');

    $.post('http://localhost/facebook/core/chat/forward_msg.php', {
        forward_chat: chatid,
        chatid: chatid,
        msg: msg,
        userid: userid
    }, function(data) {
        $(This).attr('id', 'undo_forward1');
        $(This).attr('data-msg', data);
        $(This).text('Undo');
        $(This).attr('changed', 'yes');
        var rec = $('.forward_friends').find('.forward_friend_item[data-chat=' + chatid +
            '] button');
        $(rec).attr('id', 'undo_forward');
        $(rec).attr('data-msg', data);
        $(rec).text('Undo');
        setTimeout(function() {
            if ($(This).attr('changed') == 'yes') {
                $(This).attr('disabled', 'disabled');
                $(This).removeClass().addClass('sent_forward_btn')
                $(This).html('<i class="sentedtefde">/</i>Sent');
                var damn = $('.forward_friends').find('.forward_friend_item[data-chat=' +
                    chatid +
                    '] button');
                $(damn).attr('disabled', 'disabled').removeClass();
                $(damn).addClass('sent_forward_btn');
                $(damn).html('<i class="sentedtefde">/</i>Sent');
            }

        }, 4000)

    })

})

$(document).on('click', '#undo_forward', function() {
    var delete_message = $(this).data('msg');
    var This = $(this);
    var chatid = $(this).parents('.forward_friend_item').data('chat');
    $.post('http://localhost/facebook/core/chat/forward_msg.php', {
        delete_message: delete_message,
        userid: "<?php echo $userid ?>"
    }, function(data) {
        $(This).attr('changed', 'no');
        $(This).attr('id', 'forward_sendd');
        $(This).text('Send');
        var rec = $('.forward_recent').find('.forward_friend_item[data-chat=' + chatid +
            '] button');
        $(rec).attr('id', 'forward_sendd1');
        $(rec).attr('data-msg', delete_message);
        $(rec).text('Send');
    })
})
$(document).on('click', '#undo_forward1', function() {
    var delete_message = $(this).data('msg');
    var This = $(this);
    var chatid = $(this).parents('.forward_friend_item').data('chat');
    $.post('http://localhost/facebook/core/chat/forward_msg.php', {
        delete_message: delete_message,
        userid: "<?php echo $userid ?>"
    }, function(data) {
        $(This).attr('changed', 'no');
        $(This).attr('id', 'forward_sendd1');
        $(This).text('Send');
        var rec = $('.forward_friends').find('.forward_friend_item[data-chat=' + chatid +
            '] button');
        $(rec).attr('id', 'forward_sendd');
        $(rec).attr('data-msg', delete_message);
        $(rec).text('Send');
    })
})

//--->Forwards------>

//--Reply to msg-------->
$(document).on('click', '#reply_msg', function() {
    var msg_id = $(this).data('msg_id');
    var msg = $(this).data('msg');
    var name = $(this).data('name');
    var sender = $(this).data('sender');
    var userid = "<?php echo $userid ?>"
    var pr = $(this).parents('.popup_chat_area').siblings('.reply_wrapper');
    $(pr).attr('data-msg_id', msg_id);

    if (sender == true) {
        $(this).parents('.popup_chat_area').siblings('.reply_wrapper').html(
            ' <div class="reply_header"> <div class="reply_header_left"> Replying to yourself </div> <div class="close_reply-wrap"><i class="close_reply_icon"></i></div> </div><div class="reply_to_msg">' +
            msg + '</div>'
        ).show()
    } else {
        $(this).parents('.popup_chat_area').siblings('.reply_wrapper').html(
            ' <div class="reply_header"> <div class="reply_header_left"> Replying to ' + name +
            ' </div> <div class="close_reply-wrap"><i class="close_reply_icon"></i></div> </div> <div class="reply_to_msg">' +
            msg + '</div>'
        ).show()
    }
    $(this).parents('.popup_chat_area').siblings('.popu_char_a7em').find('#light_send').attr('id',
        'send_reply');
})
$(document).on('click', '.close_reply-wrap', function() {
    $(this).parents('.reply_wrapper').hide();
    $(this).parents('.popup_chat').find('#send_reply').attr('id', 'light_send');
})
$(document).on('keyup', '#send_reply', function(e) {

    if (e.keyCode == 13) {
        var This = $(this);
        var msg_id = $(this).parents('.popu_char_a7em').siblings('.reply_wrapper').data('msg_id');
        var message = $(this).val();
        var userid = "<?php echo $userid ?>"
        var chat = $(this).parents('.popup_chat').data('chat');

        if (message != '') {

            $.post('http://localhost/facebook/core/chat/reply.php', {
                replyMessage: msg_id,
                message: message,
                chat: chat,
                userid: userid
            }, function(data) {
                console.log(data)
                $(This).val('');
                $(This).parents('.popu_char_a7em').siblings('.reply_wrapper').hide();
                $(This).attr('id', 'light_send');
            })
        }

    }

})






//--Reply to msg-------->


//----Attahc Files----->
$(document).on('click', '#open_plus_chat_menu', function() {
    $(this).parents('.popu_char_a7em').siblings('.more_plus_wrapper').css('display', 'flex')
    $(this).parents('.m14_left').siblings('.m14_right').find('#light_send').css('width', '230px')
    $(this).siblings('.m24_icon.hide_plus').hide()
    $(this).hide()
    $(this).siblings('#close_plus_chat_menu').css('display', 'flex');
})
$(document).on('click', '#close_plus_chat_menu', function() {
    $(this).parents('.popu_char_a7em').siblings('.more_plus_wrapper').hide()
    $(this).parents('.m14_left').siblings('.m14_right').find('#light_send').css('width', '100%')
    $(this).siblings('.m24_icon.hide_plus').show()
    $(this).hide()
    $(this).siblings('#close_plus_chat_menu').hide();
})
$(document).on('click', '#open_attach_files', function() {
    $(this).siblings('#attach_file').click();


})

$(document).on('change', '#attach_file', function(e) {
    var attachs = e.target.files;
    var chat = $(this).data('chat')
    var This = $(this)
    files = Array.from(attachs);

    var formData = new FormData();
    if (files.length > 5) {
        $('.fixed_opacity').show();
        $('.errors_popup').html(
            '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading"> Unable to Attach File </div> <div class="error_texting">Maximum of 5 files are allowed per time,please try again.</div> <button id="close_erros_send" class="close_erros_send">Close</button>'
        ).show();
    } else {
        for (var i = 0; i < files.length; i++) {
            var name = files[i].name;
            var extension = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['zip', 'rar', 'pdf', 'docx', 'doc', 'ppt', 'pptx', 'txt']) == -1) {
                $('.fixed_opacity').show();
                $('.errors_popup').html(
                    '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading">Unable to Attach File</div><div class="error_texting">The type of file you are trying to attach is not allowed.Please try again with a different format. </div> <button id="close_erros_send" class="close_erros_send">Close</button > '
                ).show();
            } else {
                var reader = new FileReader();
                reader.readAsDataURL(files[i]);
                var file_size = files[i].size || files[i].fileSize;
                var size = (file_size / (1024 * 1024)).toFixed(2);
                if (size > 10) {
                    $('.fixed_opacity').show();
                    $('.errors_popup').html(
                        '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading"> Unable to Attach File </div> <div class="error_texting">Maximum file size allowed is 10mb,please try again.</div> <button id="close_erros_send" class="close_erros_send">Close</button>'
                    ).show();
                } else {


                    $('.popu_char_a7em[data-chat=' + chat + ']').hide();
                    $('.attach_files_wrapper[data-chat=' + chat + ']').css('display', 'flex');


                    reader.onload = function(e) {
                        if (name.length < 13) {
                            $('.attach_files_wrapper[data-chat=' + chat + ']').find(
                                    '.imginos_preview')
                                .append(
                                    '<div class="attach_preview"> <div class="remove_attached_file"> <i class="remove_attachxxxx"></i> </div> <div class="white_attach"> <i class="attahcfile_icon"></i> </div> <span class="atach_name">' +
                                    name + '.' + extension + '</span> </div>'
                                );
                        } else {
                            var namee = name.substring(0, 13);
                            $('.attach_files_wrapper[data-chat=' + chat + ']').find(
                                    '.imginos_preview')
                                .append(
                                    '<div class="attach_preview"> <div class="remove_attached_file"> <i class="remove_attachxxxx"></i> </div> <div class="white_attach"> <i class="attahcfile_icon"></i> </div> <span class="atach_name">' +
                                    namee + '.' + extension + '</span> </div>'
                                );
                        }

                    }

                }
            }


        }
    }
})
attachedfiles = "";
$(document).on('click', '#send_msg_and_files', function() {
    var chat = $(this).data('chat');
    var text = $(this).parents('.attach_files_wrapper').find('.input_img_text').val();
    var form_data = new FormData();
    var attachs = '';
    async function attachFiles() {
        for (var i = 0; i < files.length; i++) {
            form_data.append('file', files[i]);
            await $.ajax({
                url: 'http://localhost/facebook/core/ajax/uploadFiles.php',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data) {
                    var file_name = data;
                    attachedfiles += '{\"name\":\"' + file_name + '\"},';

                }
            })
        }
    }


    attachFiles().then(() => {
        strr = attachedfiles.replace(/,\s*$/, "");
        attached = '[' + strr + ']';
        $.post('http://localhost/facebook/core/chat/sendFiles.php', {
            sendFiles: attached,
            text: text,
            chat: chat,
            userid: "<?php echo $userid ?>"
        }, function(data) {
            $('.attach_files_wrapper[data-chat=' + chat + ']').hide();
            $('.popup_chat_area[data-chat=' + chat + ']').siblings('.more_plus_wrapper').hide();
            $('.popu_char_a7em[data-chat=' + chat + ']').find('.m24_icon.hide_plus').show()
            $('.popu_char_a7em[data-chat=' + chat + ']').find('#light_send').css('width',
                '100%')
            $('.popu_char_a7em[data-chat=' + chat + ']').show();
            scrolla(chat);
        })
    })
})

//----Attahc Files----->



//--react messages---->
$(document).on('click', '#open_msg_react', function() {
    $('.react_msg_wrapper').hide();
    $(this).find('.react_msg_wrapper').css('display', 'flex');
})

$(document).mouseup(function(e) {
    if (!$('.react_msg_wrapper').is(e.target) && $('.react_msg_wrapper').has(e.target)
        .length === 0) {
        $(this).find('.react_msg_wrapper').hide();
    }
})
$(document).mouseup(function(e) {
    if (!$('.msg_rem_menu').is(e.target) && $('.msg_rem_menu').has(e.target)
        .length === 0) {
        $(this).find('.msg_rem_menu').hide();
    }
})

$(document).on('click', '#open_msg_ots', function() {
    $(this).find('.msg_rem_menu').show();
})



$(document).on('click', '#click-msg-love', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'love',
        userid: "<?php echo $userid ?>"
    })
})
$(document).on('click', '#click-msg-haha', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'haha',
        userid: "<?php echo $userid ?>"
    })
})
$(document).on('click', '#click-msg-wow', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'wow',
        userid: "<?php echo $userid ?>"
    })
})
$(document).on('click', '#click-msg-sad', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'sad',
        userid: "<?php echo $userid ?>"
    })
})
$(document).on('click', '#click-msg-angry', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'angry',
        userid: "<?php echo $userid ?>"
    })
})
$(document).on('click', '#click-msg-like', function() {
    var msg = $(this).parents('.react_msg_wrapper').data('msg');
    var chat = $(this).parents('.messaging_popup').data('chat');

    $('.messaging_popup[data-chat = ' + chat + ']').data('changed', 'true');
    $.post('http://localhost/facebook/core/chat/react.php', {
        reactmsg: msg,
        react: 'like',
        userid: "<?php echo $userid ?>"
    })
})

$(document).on('click', '#unsend_msg', function() {
    var msg = $(this).data('msg');

    $(this).parents('.msg_rem_menu').hide();
    $.post('http://localhost/facebook/core/chat/removemsg.php', {
        remove_msg: msg,


    })
})

$(document).on('click', '#remove_msg', function() {
    var msg = $(this).data('msg');

    $(this).parents('.msg_rem_menu').hide();
    $.post('http://localhost/facebook/core/chat/removemsg.php', {
        deletemsg: msg,


    })
})



//--react messages---->


//----Send Files+------->
$(document).on('click', '#open_send_file', function() {
    var chat = $(this).data('chat')
    $('#send_file[data-chat=' + chat + ']').click();
})
var files = [];
var imagess = [];

$(document).on('change', '#send_file', function(e) {
    var chat = $(this).data('chat')
    var This = $(this)

    var filess = e.target.files;
    files = Array.from(filess);
    var formData = new FormData();
    if (files.length > 10) {
        $('.fixed_opacity').show();
        $('.errors_popup').html(
            '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading"> Unable to Attach File </div> <div class="error_texting">Maximum of 5 files are allowed per time,please try again.</div> <button id="close_erros_send" class="close_erros_send">Close</button>'
        ).show();
    } else {
        for (var i = 0; i < files.length; i++) {
            var name = files[i].name;
            var extension = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['jpg', 'png', 'gif', 'webp', 'icon', 'jpeg']) == -1) {
                $('.fixed_opacity').show();
                $('.errors_popup').html(
                    '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading">Unable to Attach File</div><div class="error_texting">The type of file you are trying to attach is not allowed.Please try again with a different format. </div> <button id="close_erros_send" class="close_erros_send">Close</button > '
                ).show();
            } else {
                var reader = new FileReader();
                reader.readAsDataURL(files[i]);
                var file_size = files[i].size || files[i].fileSize;
                var size = (file_size / (1024 * 1024)).toFixed(2);
                if (size > 10) {
                    $('.fixed_opacity').show();
                    $('.errors_popup').html(
                        '<div class="exit_nickname" style="margin-top:10px" id="close_erros_send"> <i class="zfzfzfzfkzpofgj"></i> </div> <div class="errors_heading"> Unable to Attach File </div> <div class="error_texting">Maximum file size allowed is 10mb,please try again.</div> <button id="close_erros_send" class="close_erros_send">Close</button>'
                    ).show();
                } else {

                    $('.popu_char_a7em[data-chat=' + chat + ']').hide();
                    $('.chat_errors_container[data-chat=' + chat + ']').css('display', 'flex');
                    reader.onload = function(e) {

                        $('.chat_errors_container[data-chat=' + chat + ']').find(
                                '.imginos_preview')
                            .append(
                                '<div class="img_pazdad"><div class="remove_image_a7aton" data-i="' +
                                i +
                                '" data-chat="' + chat +
                                '"><i class="msa7_dik_pic"></i></div><img src="' +
                                e.target.result + '"></div>');
                    }

                }
            }


        }
    }

})
//-----remove specific image--->
$(document).on('click', '.remove_image_a7aton', function() {
    var chat = $(this).data('chat');
    var img = $(this).data('i');
    for (var i = 0; i < files.length; i++) {
        if (i == img) {
            files[i].splice(i, 1);
        }
    }

})
//-----remove specific image--->

//----Send Files+------->

$(document).on('click', '#close_erros_send', function() {
    $('.fixed_opacity').hide();
    $('.errors_popup').hide();
})

//------>upload to cloudinary and send msg--->
var imagesMessage = '';
var loading;
var str;
var a7aa = 0;
$(document).on('click', '#send_msg_and_img', function() {

    var chat = $(this).data('chat');
    var text = $('.input_img_text[data-chat=' + chat + ']').val();
    var CLOUDINARY_URL = 'https://api.cloudinary.com/v1_1/dmhcnhtng/upload';
    var PRESET = 'n9tyxxgb';

    async function uplaodIntoCloudinary() {
        for (var i = 0; i < files.length; i++) {

            var formData = new FormData();
            formData.append('file', files[i]);
            formData.append('upload_preset', PRESET);
            await axios({
                url: CLOUDINARY_URL,
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                data: formData,
            }).then(function(response) {
                var image = response.data.secure_url;
                imagess += '{\"name\":\"' + image + '\"},';


            }).catch(function(error) {
                console.log(error)
            })
        }


    }


    uplaodIntoCloudinary().then(() => {
        str = imagess.replace(/,\s*$/, "");
        imagesMessage = '[' + str + ']';
        $('#send_file').val(null);
        imagess = [];
        $('#send_file').attr('value', '');

        $.post('http://localhost/facebook/core/ajax/message.php', {
            messageImages: "<?php echo $userid ?>",
            chatid: chat,
            msg: text,
            images: imagesMessage
        }, function(data) {

            $('.chat_errors_container[data-chat=' + chat + ']').hide()
            $('.popu_char_a7em[data-chat=' + chat + ']').show();
            scrolla(chat);

            str = '';
            imagesMessage = '';
        })


    });




})


//------>upload to cloudinary--->




$(document).mouseup(function(e) {

    $(this).find('.chat_header').find('.h_m_ic svg').css('fill', '#bec2c9');
    $(this).find('.chat_header').find('.h_m_ic svg path').css('fill', '#bec2c9');
    $(this).find('.chat_header').find('.strokesvg').css('stroke', '#bec2c9');
    $(this).find('.popu_char_a7em').find('.m24_icon.hide_plus svg').css('fill', '#bec2c9');


})
$(document).on('click', '.popup_chat', function() {

    $(this).find('.chat_header').find('.h_m_ic svg').css('fill', '#1437ef');
    $(this).find('.chat_header').find('.h_m_ic svg path').css('fill', '#1437ef');
    $(this).find('.chat_header').find('.strokesvg').css('stroke', '#1437ef');
    $(this).find('.popu_char_a7em').find('.m24_icon.hide_plus svg').css('fill', '#00b2ff');


})
$(document).on('click', '.popup_chat_area', function() {

        $(this).siblings('.popu_char_a7em').find('.m14_right').find('#light_send').focus()
    })

    //---Blur Chqt Popup----->

    >







    //---->Open from full menu---->


    //---->Open from full menu---->


    $(document).mouseup(function(e) {
        if (!$(e.target).closest('.notifications, #open_notif').length) {
            $(".notifications").hide();
            $('#open_notif').css('background', '#e4e6eb')
            $('#open_notif').find('svg').css('fill', '#000')
        }
    })
$(document).mouseup(function(e) {
    if (!$(e.target).closest('.messages_popup, #open_messages').length) {
        $(".messages_popup").hide();
        $('#open_messages').css('background', '#e4e6eb')
        $('#open_messages').find('.svgmsg').css('fill', '#000')
    }
})

$(document).mouseup(function(e) {
    if (!$(e.target).closest('.all_menu, #open_all').length) {
        $(".all_menu").hide();
        $('#open_all').css('background', '#e4e6eb')
        $('#open_all').find('svg').css('fill', '#000')
    }
})
$(document).mouseup(function(e) {
    if (!$(e.target).closest('#post_box,#post_box1,.nicknames_popup,.errors_popup,.forward_popup').length) {
        $("#post_box").hide();
        $("#post_box1").hide();
        $(".errors_popup").hide();
        $(".nicknames_popup").hide();
        $(".forward_popup").hide();
        $('.fixed_opacity').hide();

    }
})
/*
$(document).mouseup(function(e) {
    if (!$(e.target).closest('#post_box1').length) {
        $("#post_box1").hide();
        $('.fixed_opacity').hide();
    }
})
*/
$(document).mouseup(function(e) {
    if (!$(e.target).closest('#menu_header, #open_thatmenu').length) {
        $("#menu_header").hide();
        $('#open_thatmenu').css('background', '#e4e6eb')
        $('#open_thatmenu').find('svg').css('fill', '#000')
    }
})

//----Close ---->
</script>