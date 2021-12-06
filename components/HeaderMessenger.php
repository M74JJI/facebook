<?php
if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
 }else{
     header('Location:login.php');
 }
 
 $userInfo = $loadUser->getUserInfo($userid);



?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="assets/css/profile.css" />
    <link rel="stylesheet" href="assets/css/about.css" />
    <link rel="stylesheet" href="assets/css/about_forms.css" />
    <link rel="stylesheet" href="assets/css/header_menu.css" />
    <link rel="stylesheet" href="assets/css/header.css" />

    <title>Messenger</title>
    <link rel="stylesheet" href="assets/css/messenger.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/dist/emojionearea.css">

</head>

<script src="assets/js/jquery.js"></script>
<script src="assets/dist/emojionearea.js"></script>
<script src="assets/js/header.js"></script>
<script>
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
$(document).on('blur', '#search_input', function() {
    $('.search_results').hide();

})

//menu bar

$(document).on('click', '#open_thatmenu', function() {

    $('#menu_header').css('display', 'block');
})
$(document).mouseup(function(e) {
    var container = new Array();


    container.push('#menu_header');

    $.each(container, function(key, value) {
        if (!$(value).is(e.target) && $(value).has(e.target)
            .length === 0) {
            $(value).css('display', 'none');

        }
    })
})
//messe,ger

$(document).ready(function() {

    $('#text_area_msg').emojioneArea({

        spellcheck: true,

    })


    function loadUser() {
        var userid = "<?php echo $userid ?>";
        $.post('http://localhost/facebook/core/ajax/messages.php', {
            getuserid: userid
        }, function(data) {
            $('.msg-user-add').html(data);


        })
    }
    loadUser();
    var lastPersonId = '<?php if(!empty($lastMsgUserid)){echo $lastMsgUserid;} ?>';
    if (lastPersonId != '') {
        var userid = '<?php echo $userid ?>';
        $.post('http://localhost/facebook/core/ajax/messages.php', {
            lastPersonId: lastPersonId,
            userid: userid

        }, function(data) {
            $('.msg_box').html(data);

        })
    }
    var userid2;
    var chatid;

    function undef(name, surname, callback) {
        if (typeof callback == 'function') {
            callback(name, surname);
        } else {
            alert('Argument is not function type')
        }
    }
    var useridd = $('.messeges_wrap').data('userid');
    var chatidd = $('.messeges_wrap').data('chatid');

    function check(v1, v2) {
        if (v1 == undefined || v2 == undefined) {
            return userid2 = useridd, chatid = chatidd;
        } else {
            return userid2 = v1, chatid = v2;
        }
    }

    setTimeout(function() {
        $(document).on('keyup', '.emojionearea-editor', function(e) {

            if (e.keyCode == 13) {
                var This = $(this);
                var msg = $(this).html();
                if (userid2 == undefined) {
                    undef(userid2, chatid, check);
                }
                var msgg = msg.slice(0, -15);

                $.ajax({
                    type: 'POST',
                    url: "http://localhost/facebook/core/ajax/message.php",
                    data: {
                        useridMsg: userid2,
                        chatid: chatid,
                        msg: msgg,
                    },
                    success: function(data) {
                        loadUser();
                        console.log(data);
                        $('.msg_box').html(data);
                        $('.messeges_wrap').html(data);
                        $(This).text('');

                        scrolla();
                    }
                })
            }
        })
    }, 500);

    function scrolla() {

        var viewheight = $('.messaging_area').height();
        console.log(viewheight)
        var totalHeight = $('.messaging_area')[0].scrollHeight;
        console.log(totalHeight)
        if (totalHeight > viewheight) {
            $('.messaging_area').scrollTop(totalHeight - viewheight);
        }
    }
    scrolla();

    function loadMessage() {
        var pastDataCount = $('.past-data-count').data('datacount');
        $.ajax({
            type: 'POST',
            url: "http://localhost/facebook/core/ajax/message.php",
            data: {
                showmsg: chatidd,
                yourid: useridd

            },
            success: function(data) {
                $('.msg_box').html(data);
            }
        })
        $.post('http://localhost/facebook/core/ajax/message.php', {
            dataCount: chatidd,
            profileid: useridd
        }, function(data) {
            if (pastDataCount == data) {

            } else {
                scrolla();
            }
        })
    }
    var laodTimer = setInterval(function() {
        loadMessage();
    }, 1000);


    $(document).on('keyup', '.input_contact', function() {
        var searchTerm = $(this).val();

        if (searchTerm == '0') {
            $('.contacts_list').empty();
        } else {
            $.post('http://localhost/facebook/core/ajax/search.php', {
                searchTerm1: searchTerm,
                userid: useridd

            }, function(data) {
                if (data == '') {
                    console.log('No user found');
                } else {
                    $('.msg-user-add').html(data);
                    console.log(data)
                }
            })
        }

    })
    var intervalid;
    var intervalid2;
    $(document).on('click', '.result_user', function() {
        clearInterval(laodTimer);
        var chatidSearch = $(this).data('profileid');
        var searchImage = $(this).find('img.s_img').attr('src');
        var searchName = $(this).find('.s_name').text();
        $('.contacto_msg').attr('src', searchImage);
        $('.imgtaxta').attr('src', searchImage);
        $('.mid_img').attr('src', searchImage);
        $('.h_3_msg').text(searchName);

        $('.messeges_wrap').attr("data-chatid", chatidSearch);
        undef(userid, chatidSearch, check);
        $.post('http://localhost/facebook/core/ajax/message.php', {
            showmsg: chatidSearch,
            yourid: userid,

        }, function(data) {
            $('.messeges_wrap').html(data);
            loadUser();
        })
        if (!intervalid) {
            intervalid = setInterval(function() {
                loadMessage2(userid, chatidSearch);
            }, 1000);
            clearInterval(intervalid2);
            intervalid2 = null;
        } else if (!intervalid2) {
            clearInterval(intervalid);
            intervalid = null;
            intervalid2 = setInterval(function() {
                loadMessage2(userid, chatidSearch);
            }, 1000)
        } else {
            alert('nothing found');
        }
    })
    var intervalid;
    var intervalid2;
    $(document).on('click', '.msg_username', function() {
        clearInterval(laodTimer);
        var chatidSearch = $(this).data('profileid');
        var searchImage = $(this).find('img.l3adab_asahbi_img').attr('src');
        var searchName = $(this).find('.contact_name').text();
        $('.contacto_msg').attr('src', searchImage);
        $('.imgtaxta').attr('src', searchImage);
        $('.mid_img').attr('src', searchImage);
        $('.h_3_msg').text(searchName);

        $('.messeges_wrap').attr("data-chatid", chatidSearch);
        undef(userid, chatidSearch, check);
        $.post('http://localhost/facebook/core/ajax/message.php', {
            showmsg: chatidSearch,
            yourid: userid,

        }, function(data) {
            $('.messeges_wrap').html(data);
            loadUser();
        })
        if (!intervalid) {
            intervalid = setInterval(function() {
                loadMessage2(userid, chatidSearch);
            }, 1000);
            clearInterval(intervalid2);
            intervalid2 = null;
        } else if (!intervalid2) {
            clearInterval(intervalid);
            intervalid = null;
            intervalid2 = setInterval(function() {
                loadMessage2(userid, chatidSearch);
            }, 1000)
        } else {
            alert('nothing found');
        }
    })

    function loadMessage2(userid, chatidSearch) {
        var pastDataCount = $('.past-data-count').data('datacount');
        $.ajax({
            type: 'POST',
            url: "http://localhost/facebook/core/ajax/message.php",
            data: {
                showmsg: chatidSearch,
                yourid: userid

            },
            success: function(data) {
                $('.msg_box').html(data);
            }
        })
        $.post('http://localhost/facebook/core/ajax/message.php', {
            dataCount: chatidSearch,
            profileid: userid
        }, function(data) {
            if (pastDataCount == data) {

            } else {
                scrolla();
            }
        })
    }

})
</script>
</header>