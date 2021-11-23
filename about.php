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
    <div class="about_wrapper">

        <div class="about">
            <div class="about_section">
                <div class="about_menu">
                    <h3>About</h3>
                    <ul>
                        <li class="active_about_link overview_link" data-userid="<?php echo $userid ?>"
                            data-profileid="<?php echo $profileId ?>">
                            <span>Overview</span>
                        </li>
                        <li class="workeducation_link" data-userid="<?php echo $userid ?>"
                            data-profileid="<?php echo $profileId ?>">
                            <span>Work and Education</span>
                        </li>
                        <li class="placeslived_link" data-userid="<?php echo $userid ?>"
                            data-profileid="<?php echo $profileId ?>">
                            <span>Places Lived</span>
                        </li>
                        <li class="contacts_link" data-userid="<?php echo $userid ?>"
                            data-profileid="<?php echo $profileId ?>">
                            <span>Contact and Basic Info</span>
                        </li>
                        <li data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId ?>">
                            <span>Familly and Relationships</span>
                        </li>
                        <li data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId ?>">
                            <span>Details About You</span>
                        </li>
                        <li data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId ?>">
                            <span>Life Events</span>
                        </li>
                    </ul>
                </div>
                <div class="about_overview_filled">
                    <div class="overview_menu">
                        <?php $loadAbout->overview('workplace',$userid,$profileId,'Add a workplace',"https://static.xx.fbcdn.net/rsrc.php/v3/yt/r/Bo7x4xsiTje.png"); ?>
                        <?php $loadAbout->overview('high_school',$userid,$profileId,'Add a high school',"https://static.xx.fbcdn.net/rsrc.php/v3/yN/r/j-QTXcNyQBK.png"); ?>
                        <?php $loadAbout->overview('college',$userid,$profileId,'Add a college',"https://static.xx.fbcdn.net/rsrc.php/v3/yN/r/j-QTXcNyQBK.png"); ?>
                        <?php $loadAbout->overview('current_city',$userid,$profileId,'Add current city',"https://static.xx.fbcdn.net/rsrc.php/v3/yS/r/poZ_P5BwYaV.png"); ?>
                        <?php $loadAbout->overview('hometown',$userid,$profileId,'Add hometown',"https://static.xx.fbcdn.net/rsrc.php/v3/yS/r/poZ_P5BwYaV.png"); ?>
                        <?php $loadAbout->getAboutPhone('mobile',$userid,$profileId,'add a phone number',"https://www.facebook.com/rsrc.php/v3/yI/r/lzvufuLgbzd.png"); ?>

                    </div>

                    <div class="about_menu_data">

                    </div>
                </div>
            </div>
            <div class="friends_section"></div>
            <div class="photos_section"></div>
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


    <script src="assets/js/about.js"></script>
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

                if ($(likeActionIcon).attr('src') == 'assets/images/like.png') {

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
            var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
            var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
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
                    'assets/images/react/' + typeR + '.png').addClass('reactIconSize');
                mainReactSubmit(typeR, postId, userId, nf_3);
            } else {

                $(spanClass).addClass(reactColor);
                $(likeActionIcon).attr('src', 'assets/images/react/' + typeR + '.png').addClass(
                    'reactIconSize');
                spanClass.text(typeR);
                $(likeActionIcon).removeAttr('src').attr('src', 'assets/images/react/' + typeR + '.png')
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

        $(document).mouseup(function(e) {
            var container = new Array();

            container.push('.search_results');
            container.push('.confirm_request_popup');
            container.push('.friends_popup');

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