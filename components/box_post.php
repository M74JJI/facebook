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
             <ul class="mention_someone">

             </ul>
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
     <!-------EDIT POST POPUP----->
     <div class="post_box1" id="post_box1">


     </div>



     <script>
//--------Open Chat--------------------->



//-------------Show POST POPU----------------->
var regex = /[#|@](\w+)$/ig;
$(document).on('keyup', '.emojionearea-editor', function() {
    let status_text = $.trim($(this).text());
    let regex_text = status_text.match(regex);

    if (regex_text != null) {
        $.post('http://localhost/facebook/core/ajax/mention.php', {
            regex: regex_text,
        }, function(data) {
            $('.mention_someone').html(data);
            $('.a7a_mention').click(function() {
                var mention_link = $(this).find('.mention_name').data(
                    'link');
                console.log('->', mention_link)
                var mention_profileid = $(this).find('.mention_name').data(
                    'profileid');
                var old_status = $('.emojionearea-editor').text();
                var new_status = old_status.replace(regex, '');
                $('.emojionearea-editor').text('' + new_status + '@' +
                    mention_link + '');
                $('.mention_someone').empty();
            })
        })
    } else {
        $('.mention_someone').empty();
    }
})


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
        $('.facebook_left').css('opacity', '0.3');
        $('.facebook_middle').css('opacity', '0.3');
        $('.facebook_right').css('opacity', '0.3');
        $('#post_box1').show();
    });



})
$(document).on('click', '#close_post', function() {
    $('#post_box').hide();
    $('.facebook_left').css('opacity', '1');
    $('.facebook_middle').css('opacity', '1');
    $('.facebook_right').css('opacity', '1');
})
$(document).on('click', '#close_post1', function() {
    $('#post_box1').hide();
    $('.facebook_left').css('opacity', '1');
    $('.facebook_middle').css('opacity', '1');
    $('.facebook_right').css('opacity', '1');
})

//-------------Show POST POPU----------------->

//-------------LINK EMOJI TO CREATE POST----------------->

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
            if (filaes.length == 4) {
                $('.post_imgs_preview').css('grid-template-columns', '1fr 1fr');
                $('.post_imgs_preview').css('grid-template-rows', '1fr 1fr');
                $('.prevv_img').css('width', '250px');
                $('.prevv_img').css('height', '250px');
                $('.prevv_img:first-of-type').css('grid-column', '1/2');
                $('.prevv_img:first-of-type').css('grid-row', '1/2');
                $('.prevv_img:first-of-type').css('height', '250px');
                $('.prevv_img:nth-child(1)').css('grid-column', '2/3');
                $('.prevv_img:first-of-type').css('grid-row', '1/2');
                $('.prevv_img:nth-child(1)').css('height', '250px');
                $('.prevv_img:nth-child(1)').css('grid-column', '1/2');
                $('.prevv_img:first-of-type').css('grid-row', '2/3');
                $('.prevv_img:nth-child(1)').css('height', '250px');
                $('.prevv_img:nth-child(1)').css('grid-column', '2/3');
                $('.prevv_img:nth-child(1)').css('height', '250px');
                $('.prevv_img:first-of-type').css('grid-row', '2/3');
            }
            if (filaes.length > 4) {
                $('.post_imgs_preview').css('grid-template-columns', '1fr 1fr');
                $('.prevv_img').css('width', '250px');
                $('.prevv_img').css('height', '250px');
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
    var post_text = $(this).siblings('.box_area').children('.emojionearea.textarea_post')
        .find(
            '.emojionearea-editor').html();

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
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -
                    1) {
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

    let mention = post_text.match(regex);


    if (strImg == '') {
        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
            post_text_only: post_text,
            mention: mention
        }, function(data) {
            console.log(data)
        })
    } else {
        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
            post_images: strImg,
            post_text: post_text,
            mention: mention,
        }, function(data) {

        })

    }




})
//----Submit Post--->
     </script>