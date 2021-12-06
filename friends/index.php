<?php
include '../connect/login.php';
include '../core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
 }else{
     header('Location:login.php');
 }
 
 $userInfo = $loadUser->getUserInfo($userid);
 $friends_requests_Total=$loadUser->getFriendsRequestsTotal($userid);
 $friends = $loadUser->getAllFriends($userid);
 $allusers = $loadPost->lastmessages($userid);
 $notifications=$loadUser->notifications($userid);
 $notificationsTotal=$loadUser->notificationsTotal($userid);
 $lastMsgReceived=$loadPost->lastPersonMsg($userid);
 $search_history=$loadUser->getSearchHistory($userid);

 if(!empty($lastMsgReceived)){
     $lastMsgUserid = $lastMsgReceived->user_id;
 }

?>


?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Friends Requests| Facebook</title>
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="../assets/css/friends.css" />
    <link rel="stylesheet" href="../assets/css/header_menu.css" />
    <link rel="stylesheet" href="../assets/css/header.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/dist/emojionearea.css">
    <script src="../assets/js/jquery.js"></script>

</head>
<?php include  '../components/header_friends.php' ?>

<body>

    <div class="friends_holder">
        <div class="friends_left">
            <div class="friends_settings">
                <h5>Friends</h5>
                <div class="sett_icni_holder">
                    <i class="sett_icon">
                    </i>
                </div>
            </div>
            <ul>
                <li>
                    <a href="#" class="frined_link frined_active_bg">
                        <div class="li_icon_friend frined_active"><i class="friend_home"></i></div>
                        <span class="friend_text">Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL.'/friends/requests.php'; ?>" class="frined_link ">
                        <div class="li_icon_friend "><i class="requests_icon"></i></div>
                        <span class="friend_text">Friend Requests</span>
                    </a> <i class="arr_icon"></i>

                </li>
                <li>
                    <a href="#" class="frined_link ">
                        <div class="li_icon_friend "><i class="sugg_icon"></i></div>
                        <span class="friend_text">Suggestions</span>
                    </a> <i class="arr_icon"></i>

                </li>
                <li>
                    <a href="<?php echo BASE_URL.'friends/allfriends.php' ?>" class="frined_link ">
                        <div class="li_icon_friend "><i class="all_icon"></i></div>
                        <span class="friend_text">All Friends</span>
                    </a> <i class="arr_icon"></i>

                </li>
                <li>
                    <a href="#" class="frined_link ">
                        <div class="li_icon_friend "><i class="birth_icon"></i></div>
                        <span class="friend_text">Birthdays</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="frined_link ">
                        <div class="li_icon_friend "><i class="cus_icon"></i></div>
                        <span class="friend_text">Custom Lists</span>
                    </a>
                    <i class="arr_icon"></i>

                </li>
            </ul>
        </div>
        <div class="friends_right">
            <h5>Friend Requests</h5>
            <div class="flex_wrap">
                <?php if($friends_requests_Total=='0'){?>
                no Friends Requests at the moment.
                <?php
                } else{ $loadUser->getFriendsRequests($userid); }
                 ?>
            </div>
        </div>

    </div>


    <script>
    //----------------Accepting Request------------------
    $(document).on('click', '.accept_req', function() {
        var userid = $(this).parents('.fri_req_card').data('userid');
        var profileid = $(this).parents('.fri_req_card').data('profileid');
        $(this).parents('.fri_req_card').empty().hide();
        console.log(userid)
        console.log(profileid)
        $.post('http://localhost/facebook/core/ajax/request.php', {
            Confirmrequest: profileid,
            userid: userid,
        }, function(data) {})


    })
    $(document).on('click', '.delete_req', function() {
        var userid = $(this).parents('.fri_req_card').data('userid');
        var profileid = $(this).parents('.fri_req_card').data('profileid');
        $(this).parents('.fri_req_card').empty().hide();
        $.post('http://localhost/facebook/core/ajax/request.php', {
            deleteRequest: profileid,
            userid: userid,
        }, function(data) {
            console.log(data)
        })


    })
    </script>
</body>


</html>