<?php
include '../connect/login.php';
include '../core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
    $infos=$loadUser->getUserInfo($userid);
    $dateInSec=strtotime($infos->changedNameAt);
 }else{
     header('Location:login.php');
 }
 
$tab='';
$option='';
if(isset($_GET['tab']) && !empty($_GET['tab'])){
    $tab=$_GET['tab'];
}
if(isset($_GET['option']) && !empty($_GET['option'])){
    $option=$_GET['option'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Settings & Privacy | Facebook</title>
    <link rel="stylesheet" href="../assets/css/settings.css">
</head>

<body>
    <div class="settings">
        <div class="settings_left">
            <div class="setting_left_header">
                Settings
            </div>
            <ul class="settings_left_menu">
                <a href="<?php echo BASE_URL.'settings' ?>" class="settings_left_menu_item">
                    <img src="../assets/images/settings/general.png" alt="">
                    <span>General</span>
                </a>
                <a href="<?php echo BASE_URL.'settings?tab=security' ?>" class="settings_left_menu_item">
                    <img src="../assets/images/settings/security.png" alt="">
                    <span>Security and Login</span>
                </a>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/info.png" alt="">
                    <span>Your Facebook Information</span>
                </li>
                <div class="setting_line"></div>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/privacy.png" alt="">
                    <span>Privacy</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/face.png" alt="">
                    <span>Face Recognition</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/profile.png" alt="">
                    <span>Profile and Tagging</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/posts.png" alt="">
                    <span>Public Posts</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/bloking.png" alt="">
                    <span>Blocking</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/location.png" alt="">
                    <span>Location</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/lang.png" alt="">
                    <span>Language and Region</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/stories.png" alt="">
                    <span>Stories</span>
                </li>
                <div class="setting_line"></div>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/not.png" alt="">
                    <span>Botifications</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/mobile.png" alt="">
                    <span>Mobile</span>
                </li>
                <div class="setting_line"></div>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/apps.png" alt="">
                    <span>Apps and Websites</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/games.png" alt="">
                    <span>Games</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/bus.png" alt="">
                    <span>Business iNTEGRATIONS</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/ads.png" alt="">
                    <span>Ads</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/pay.png" alt="">
                    <span>Ads Payments</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/fpay.png" alt="">
                    <span>Facebook Pay</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/support.png" alt="">
                    <span>Support Ibox</span>
                </li>
                <li class="settings_left_menu_item">
                    <img src="../assets/images/settings/videos.png" alt="">
                    <span>Videos</span>
                </li>
            </ul>
        </div>
        <?php 
        if($tab=='' || $tab =='general'){
            ?>
        <div class="settings_right">
            <div class="s_r_header">
                General Account Settings
            </div>
            <div class="change_setting_wrapper">
                <?php
                if($tab =='general' && $option=='name'){
                   ?>
                <div class="settings_change_item_wrap">
                    <div class="settings_change_item">
                        <div class="left_s_item">Name</div>
                        <div class="middle_s_item">
                            <div class="settings_name_menu">
                                <div class="settings_inpu_label_item">
                                    <label for="">First</label>
                                    <input id="first_name" type="text" default
                                        value="<?php echo $infos->first_name; ?>">
                                </div>
                                <div class="settings_inpu_label_item">
                                    <label for="">Middle</label>
                                    <input id="middle_name" type="text" placeholder="Optional">
                                </div>
                                <div class="settings_inpu_label_item">
                                    <label for="">Last</label>
                                    <input id="last_name" type="text" value="<?php echo $infos->last_name; ?>">
                                </div>
                                <div class="note_name_wrap">
                                    <b>Please note:</b> If you change your name on Facebook, you can't change it again
                                    for
                                    60 days. Don't add any unusual capitalization, punctuation, characters or random
                                    words.<br>
                                    <a href=#>Learn more.</a>
                                </div>
                                <div class="note_wrap_line"></div>
                                <div class="other_names_sett">
                                    Other Names
                                    <a href="http://localhost/facebook/about.php?id=MOHAMEDHAJJI&sk=about_details">Add
                                        other names</a>
                                </div>
                                <div class="note_wrap_line" style="height:2px"></div>
                                <div class="settings_error"></div>
                                <div class="review_name_changes">
                                    <button class="review_changes_send" id="review_changes_send">Review
                                        Change</button>
                                    <a href="http://localhost/facebook/settings" class="calnce_s_changes">Cancel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                }else{
                 ?>
                <div class="aoihfdouhaf">

                    <div class="settings_change_item_wrap1">
                        <a href="http://localhost/facebook/settings?tab=general&option=name"
                            class="settings_change_item">
                            <div class="left_s_item">Name</div>
                            <div class="middle_s_item">
                                <span
                                    class="seetings_name_part"><?php echo $infos->first_name.' '.$infos->last_name; ?></span>
                            </div>
                            <div class="right_s_item" id="open_name">
                                <i class="fas fa-pencil-alt show_ii"></i>
                                Edit
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }
                
                if($tab =='general' && $option=='username'){
                ?>
                <div class="settings_change_item_wrap">
                    <div class="settings_change_item">
                        <div class="left_s_item">Username</div>
                        <div class="middle_s_item">
                            <div class="username_544">
                                Your public username is the same as your timeline address:

                            </div>
                            <div class="username_1251addad">
                                <div class="moraba3"></div> facebook.com/<b
                                    id="user_showdown"><?php echo $infos->link ?></b>
                            </div>
                            <div class="settings_name_menu">
                                <div class="settings_inpu_label_item">
                                    <label for="" style="width:90px">Username</label>
                                    <input id="username" type="text" default value="<?php echo $infos->link; ?>">
                                    <div class="username_errors"></div>

                                </div>
                                <div class="username_544">Note: Your username should include your authentic name. <i
                                        class="afdaf54af54af"></i> </div>

                                <div class="note_wrap_line" style="transform:translateX(0);margin-bottom:5px"></div>

                                <div class="settings_error"></div>
                                <div class="review_name_changes">
                                    <button class="review_changes_send" id="username_chane_send">Save Changes</button>
                                    <a href="http://localhost/facebook/settings" class="calnce_s_changes">Cancel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                }else{
                 ?>
                <div class="aoihfdouhaf">

                    <div class="settings_change_item_wrap1">
                        <a href="http://localhost/facebook/settings?tab=general&option=username"
                            class="settings_change_item">
                            <div class="left_s_item">Username</div>
                            <div class="middle_s_item">
                                <span class="seetings_name_part"><?php echo $infos->link; ?></span>
                            </div>
                            <div class="right_s_item" id="open_name">
                                <i class="fas fa-pencil-alt show_ii"></i>
                                Edit
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }
                
                if($tab =='general' && $option=='contact'){
                ?>
                <div class="settings_change_item_wrap">
                    <div class="settings_change_item">
                        <div class="left_s_item">Contact</div>
                        <div style="display:flex;flex-direction:column">
                            <?php 
                      if($infos->email !=''){
                          ?>

                            <div class="middle_s_item">
                                <div style="margin:7px 0 0 0">
                                    Current Emails
                                </div>
                                <div class="username_1251addaaaaad" style="margin-bottom: 10px;">
                                    <span style="font-weight:600"><?php echo $infos->email ?></span>
                                    <span style="color:#606770">Primary</span>
                                </div>

                            </div>
                            <div class="note_wrap_line" style="transform:translateX(0);margin:0"></div>

                            <?php
                      }
                      if($infos->email !=''){
                          ?>
                            <div class="middle_s_item">
                                <div style="margin:7px 0 0 0">
                                    Current Mobile Numbers
                                </div>
                                <div class="username_1251addaaaaad" style="margin-bottom: 10px;">
                                    <span style=" font-weight:600"><?php echo $infos->mobile ?></span>
                                    <span style="color:#606770">Primary</span>
                                </div>

                            </div>
                            <div class="note_wrap_line" style="transform:translateX(0);margin:0"></div>

                            <?php
                      }
                      ?>

                        </div>
                    </div>
                    <?php
                }else{
                 ?>
                    <div class="aoihfdouhaf">

                        <div class="settings_change_item_wrap1">
                            <a href="http://localhost/facebook/settings?tab=general&option=contact"
                                class="settings_change_item">
                                <div class="left_s_item">Contact</div>
                                <div class="middle_s_item">
                                    <span class="seetings_name_part"><span style="font-weight: normal">Primary</span>
                                        <?php echo $infos->email; ?></span>
                                </div>
                                <div class="right_s_item" id="open_name">
                                    <i class="fas fa-pencil-alt show_ii"></i>
                                    Edit
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                if($tab =='general' && $option=='memorilization'){
                    ?>
                    <div class="settings_change_item_wrap">

                    </div>
                    <?php
                    }else{
                     ?>
                    <div class="aoihfdouhaf">

                        <div class="settings_change_item_wrap1">
                            <a href="http://localhost/facebook/settings?tab=general&option=memorilization"
                                class="settings_change_item">
                                <div class="left_s_item">Memorialization Settings</div>
                                <div class="middle_s_item" style="font-weight:normal">
                                    Decide what happens to your account after you pass away.
                                </div>
                                <div class="right_s_item" id="open_name">
                                    <i class="fas fa-pencil-alt show_ii"></i>
                                    Edit
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    if($tab =='general' && $option=='identify'){
                    ?>
                    <div class="settings_change_item_wrap">

                    </div>
                    <?php
                    }else{
                     ?>
                    <div class="aoihfdouhaf">

                        <div class="settings_change_item_wrap1">
                            <a href="http://localhost/facebook/settings?tab=general&option=identify"
                                class="settings_change_item">
                                <div class="left_s_item">Identify confirmation</div>
                                <div class="middle_s_item" style="font-weight:normal;width:440px">
                                    Confirm your identity to do things like run ads about social issues, elections or
                                    politics.
                                </div>
                                <div class="right_s_item" id="open_name">
                                    <i class="fas fa-pencil-alt show_ii"></i>
                                    View
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                ?>


                </div>
            </div>
            <div class="settings_footer">
                <div class="footer_flex_row">
                    <div class="footer_s_link">About</div>
                    <div class="footer_s_link">Create Ad</div>
                    <div class="footer_s_link">Create Page</div>
                    <div class="footer_s_link">Developers</div>
                    <div class="footer_s_link">Careers</div>
                    <div class="footer_s_link">Privacy</div>
                    <div class="footer_s_link">Cookies</div>
                    <div class="footer_s_link">Ad choices <i class="oaifhoiahfohanonjhafk"></i></div>
                    <div class="footer_s_link">Terms</div>
                    <div class="footer_s_link">Help</div>
                </div>
                <div class="meta_at">
                    Meta © 2021
                </div>
                <div class="footer_flex_row">
                    <div class="footer_s_link" style="text-decoration:none;color:#737373">English(US)</div>
                    <div class="footer_s_link">العربية</div>
                    <div class="footer_s_link">Français (France)</div>
                    <div class="footer_s_link">ⵜⴰⵎⴰⵣⵉⵖⵜ
                    </div>
                    <div class="footer_s_link">Español (España)
                    </div>
                    <div class="footer_s_link">Italiano</div>
                    <div class="footer_s_link">Deutsch
                    </div>
                    <div class="footer_s_link">Português (Brasil)
                    </div>
                    <div class="footer_s_link">हिन्दी
                    </div>
                    <div class="footer_s_link">中文(简体)
                    </div>
                    <div class="footer_s_link">日本語
                    </div>
                    <button class="that_s_plus">
                        <i></i>
                    </button>

                </div>
            </div>
        </div>
        <?php
        }
        if( $tab =='security'){
            ?>
        <div class="settings_right">
            <div class="s_r_header" style="margin-bottom:25px">
                Security and Login
            </div>
            <div class="header_gray_menu">
                <div class="headed_gray_header">Recommended
                </div>
                <a href="#" class="headed_menu_item">
                    <i class="chekc_icoi54"></i>
                    <div class="headed_coll">
                        <div class="headed_col_1">
                            Check Your Important Security Settings</div>
                        <div class="headed_col_2">We'll take you through some steps to help protect your account.</div>
                    </div>
                    <div class="headed_link">View</div>
                </a>
            </div>
            <div class="header_gray_menu">
                <div class="headed_gray_header">Where You're Logged In
                </div>
                <?php 
               if($infos->systems != ''){
                   if(substr($infos->systems,0,1)!='['){
                   $systems=json_decode($infos->systems);

                   ?>
                <div class="headed_menu_item" data-tusing="<?php echo $systems->tusing ?>">
                    <?php 
                 if (stripos($systems->os, "Windows") !== false) {
                    echo '<img src="../assets/images/settings/device-windows.png" style="width:40px">';
                }
                    ?>
                    <div class="headed_coll">
                        <div class="headed_col_1">
                            <?php echo $systems->os ?> · <?php echo $systems->location ?>
                            <div class="headed_col_2"><?php echo $systems[$i]->browser ?> .
                                <?php echo $loadUser->timeAgo($systems[$i]->time) ?></div>
                        </div>
                        <div class="headed_link" style="background:transparent;border:none" id="open_os_menu"><i
                                class="fas fa-ellipsis-v" style="color:#90949c;font-size:15px"></i>
                            <div class="logout_os_menu">
                                <div class="motal_men_ous"></div>
                                <a>Not You ?</a>
                                <a id="log_other_os">Log out</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }else{
                    ?>
                <div class="list_of_last_os">
                    <?php
                    $systems=json_decode($infos->systems);
                    $i=0;
                 for($i;$i<2;$i++){
                        ?>
                    <div class="headed_menu_item" style="border-bottom:1px solid #dddfe2"
                        data-tusing="<?php echo $systems[$i]->tusing ?>">
                        <?php 
                    if (stripos($systems[$i]->os, "Windows") !== false) {
                        echo '<img src="../assets/images/settings/device-windows.png" style="width:40px">';
                    }
                    ?>
                        <div class="headed_coll">
                            <div class="headed_col_1">
                                <?php echo $systems[$i]->os ?> · <?php echo $systems[$i]->location ?>
                                <div class="headed_col_2"><?php echo $systems[$i]->browser ?> .
                                    <?php echo $loadUser->timeAgo($systems[$i]->time) ?></div>
                            </div>
                            <div class="headed_link" style="background:transparent;border:none" id="open_os_menu"><i
                                    class="fas fa-ellipsis-v" style="color:#90949c;font-size:15px"></i>
                                <div class="logout_os_menu">
                                    <div class="motal_men_ous"></div>
                                    <a>Not You ?</a>
                                    <a id="log_other_os">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    if(count($systems)>2){
                        ?>
                    <div class="headed_menu_item_èmore" id="show_more_os" style="border-bottom:1px solid #dddfe2">
                        <i class="motalat_grey"></i> See More
                    </div>
                    <?php
                    }
                   }
                   ?>
                </div>
                <?php
          
               }
               ?>
            </div>
            <?php
             if(($tab=='' || $tab =='security') && $option=="password"){
            ?>
            <div class="header_gray_menu">
                <div class="headed_gray_header">Login
                </div>
                <a href="#" class="headed_menu_item">
                    <i class="pass_icjznbfd"></i>
                    <div class="headed_coll">
                        <div class="headed_col_1">
                            Change password</div>
                        <div class="headed_col_2">It's a good idea to use a strong password that you're not using
                            elsewhere
                        </div>
                    </div>
                    <div class="headed_link">Close</div>
                </a>
            </div>
            <?php
            }else if(($tab=='' || $tab =='security') ){
                ?>
            <div class="header_gray_menu">
                <div class="headed_gray_header">Login
                </div>
                <a href="#" class="headed_menu_item">
                    <i class="pass_icjznbfd"></i>
                    <div class="headed_coll">
                        <div class="headed_col_1">
                            Change password</div>
                        <div class="headed_col_2">It's a good idea to use a strong password that you're not using
                            elsewhere
                        </div>
                    </div>
                    <div class="headed_link">Edit</div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        }
       ?>

        <script src="../assets/js/jquery.js"></script>
        <script>
        $(document).on('click', '#show_more_os', function() {
            $.post('http://localhost/facebook/core/settings/settings.php', {
                show_more_os: "<?php echo $userid ?>"
            }, function(data) {
                $('.list_of_last_os').html(data);
            })
        })
        $(document).on('click', '#show_less_os', function() {
            $.post('http://localhost/facebook/core/settings/settings.php', {
                show_less_os: "<?php echo $userid ?>"
            }, function(data) {
                $('.list_of_last_os').html(data);
            })
        })
        $(document).on('click', '#log_other_os', function() {
            var tusing = $(this).parents('.headed_menu_item').data('tusing');
            $.post('http://localhost/facebook/core/settings/settings.php', {
                logout_other: tusing,
            }, function(data) {
                console.log(data)
            })
        })
        $(document).on('click', '#open_os_menu', function() {
            $(this).find('.logout_os_menu').toggle();
        })
        $(document).on('keyup', '#username', function() {
            var text = $(this).val();
            $('#user_showdown').html(text);
            if (text.length < 3) {
                $(".username_errors").html(
                    '<img src="https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/e9MKv7IClnn.gif">Must be at least 5 characters'
                );
                $('#username_chane_send').attr('disabled', 'disabled');
                $('#username_chane_send').css('opacity', '0.4');
            } else {
                $(".username_errors").html('');
                $.post('http://localhost/facebook/core/settings/settings.php', {
                    checkforusername: text,
                }, function(data) {

                    if (data == 'true' && text != "<?php echo $infos->link ?>") {
                        $(".username_errors").html(
                            '<img src="https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/e9MKv7IClnn.gif">Username is not available'
                        );
                        $('#username_chane_send').attr('disabled', 'disabled');
                        $('#username_chane_send').css('opacity', '0.4');
                    } else if (badWordCatch(text) == true) {
                        $(".username_errors").html(
                            '<img src="https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/e9MKv7IClnn.gif">You cannot use this word as it not appropriate.'
                        );
                        $('#username_chane_send').attr('disabled', 'disabled');
                        $('#username_chane_send').css('opacity', '0.4');
                    } else if (checkForSpaces(text) == true) {
                        $(".username_errors").html(
                            '<img src="https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/e9MKv7IClnn.gif">You cannot have spaces in your username.'
                        );
                        $('#username_chane_send').attr('disabled', 'disabled');
                        $('#username_chane_send').css('opacity', '0.4');
                    } else if (data == 'false' && text != "<?php echo $infos->link ?>") {
                        $(".username_errors").html(
                            '<img style="width:15px" src="../assets/images/validation-valid.png">Username is available'
                        );
                        $('#username_chane_send').removeAttr('disabled');
                        $('#username_chane_send').css('opacity', '1');
                    } else if (text == "<?php echo $infos->link ?>") {
                        $('#username_chane_send').attr('disabled', 'disabled');
                        $('#username_chane_send').css('opacity', '0.4');
                    } else {
                        $('#username_chane_send').removeAttr('disabled');
                        $('#username_chane_send').css('opacity', '1');
                    }

                })
            }
        })
        $(document).on('click', '#username_chane_send', function() {
            var username = $('#username').val();
            if (username != "<?php echo $infos->link ?>") {
                $.post('http://localhost/facebook/core/settings/settings.php', {
                    change_username: "<?php echo $userid ?>",
                    username: username.toLowerCase(),
                }, function(data) {
                    window.location.href = "http://localhost/facebook/settings"
                })
            }
        })

        function badWordCatch(word) {


            wordInput = word.toLowerCase();

            // split the words by spaces (" ")
            var arr = wordInput.split(" ");
            // bad words to look for, keep this array in lowercase
            var badWords = ["sex",
                "horny",
                "sexy",
                "nigger",
                "nigga",
                "cunt",
                "fuck",
                "whore",
            ];

            // .toLowerCase will do the case insensitive match!
            var foundBadWords = arr.filter(el => badWords.includes(el));
            if (foundBadWords.length > 0) {
                return true;
            } else {
                return false;
            }


        }

        function checkForSpaces(word) {
            wordInput = word.toLowerCase();
            var arr = wordInput.split(" ");
            if (arr.length > 1) {
                return true;
            } else {
                return false;
            }
        }
        $(document).on('click', '#review_changes_send', function() {
            var dateInSec = "<?php echo $dateInSec ?>"
            const dd = new Date();
            let time = dd.getTime() / 1000;
            var timeNow = Math.floor(time / (3600 * 24));
            var UserTime = Math.floor(dateInSec / (3600 * 24));
            var diff = timeNow - UserTime;
            var diffChange = Math.abs(diff - 60);
            if (diff > 60) {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var middle_name = $('#middle_name').val();
                $('.settings_error').html('');

                if (first_name == '') {
                    $('.settings_error').html('').text("First name can't be empty.")
                } else if (first_name.length < 3) {
                    $('.settings_error').html('').text("First name must be between 3 and 30 characters.")
                } else if (badWordCatch(first_name) == true) {
                    $('.settings_error').html('').text("You can't use this word as it not appropriate.")
                } else if (checkForSpaces(first_name) == true) {
                    $('.settings_error').html('').text("You can't use spaces in your name.")
                } else if (middle_name != '' && middle_name.length < 3) {
                    $('.settings_error').html('').text("Middle name must be between 3 and 30 characters.")
                } else if (badWordCatch(middle_name) == true) {
                    $('.settings_error').html('').text("You can't use this word as it not appropriate.")
                } else if (checkForSpaces(middle_name) == true) {
                    $('.settings_error').html('').text("You can't use spaces in your name.")
                } else if (last_name == '') {
                    $('.settings_error').html('').text("Last name can't be empty.")
                } else if (last_name.length < 3) {
                    $('.settings_error').html('').text("First name must be between 3 and 30 characters.")
                } else if (badWordCatch(last_name) == true) {
                    $('.settings_error').html('').text("You can't use this word as it not appropriate.")
                } else if (checkForSpaces(last_name) == true) {
                    $('.settings_error').html('').text("You can't use spaces in your name.")
                }
                if (first_name != "<?php echo $infos->first_name; ?>" || middle_name !=
                    "<?php echo $infos->middle_name; ?>" || last_name != "<?php echo $infos->last_name; ?>"
                ) {
                    $.post('http://localhost/facebook/core/settings/settings.php', {
                        change_name: "<?php echo $userid ?>",
                        first_name: first_name,
                        middle_name: middle_name,
                        last_name: last_name,
                    }, function(data) {
                        console.log(data)
                        if (data == 'updated') {
                            window.location.href = "http://localhost/facebook/settings"
                        }
                    })
                }
            } else {
                $('.settings_error').html('').html('You have to wait ' + diffChange +
                    ' days then you can try again.');
            }


        })
        </script>

</body>

</html>