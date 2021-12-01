<?php
include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();

if(isset($_POST['postidEdit'])){
$postid=$_POST['postidEdit'];
$userid=$_POST['userid'];

$post = $loadPost->getPost($postid);
$length="";


    ?>

<div class="post_box_header">
    <h3>Edit Post</h3>
    <div class="header_icon" id="close_post1"><i class="fa-solid fa-xmark"></i></div>
</div>
<div class="post_user_infos">
    <img class="box_post_img" src=<?php echo $post->profile_picture ?> alt="">
    <div class="privacy_box_box">
        <h6><?php echo $post->first_name.' '. $post->last_name; ?></h6>
        <span><i class="fa-solid fa-user-group"></i>Friends<i class="fa-solid fa-sort-down"></i></span>
    </div>
</div>
<div class="errors_post" id="errors_post"></div>

<div class="box_area">
    <textarea class="textarea_post" id="post_textarea1"><?php echo $post->post ?></textarea>
</div>


<div class="added_ikhe1">
    <input type="file" class="input_tamara" id="post_photo1" name="post_photo"
        data-multiple-caption='{count} files selected' multiple="">
    <div class="plussit_dvc">
        <i class="plucit_icon"></i>
    </div>
    Add Photos/Videos
    <span>or drag and drop</span>
</div>





<div class="post_imgs_preview1" id="post_imgs_preview1">
    <?php
          if($post->postImages !=''){
            $imgs=json_decode($post->postImages);
            $length = count($imgs);
            $link = BASE_URL.'post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[0]->imageName;
            $count = 0;
            for($i=0;$i<count($imgs);$i++){
                echo'
                <a href="'.BASE_URL.'/post.php?id='.$post->post_id.'&image='.BASE_URL.$imgs[''.$count.'']->imageName.'"><img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
                class="prevv_img1" data-userid="'.$userid.'" data-profileid="'.$post->user_id.'" data-postid="'.$post->post_id.'"></a>
             ';   
            }
           ?>
    <div class="remove_img1"><i class="fa-solid fa-xmark"></i></div>
    <div class="add_more_imgs1"><i class="azrbch"></i>Add Photos/Videos</div>
    <?php
        }
        ?>
</div>

<div class="emoji_wrapper" id="emoji_wrapper">
    <img style="width:40px;cursor:pointer" src="https://www.facebook.com/images/composer/SATP_Aa_square-2x.png" alt="">

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

<button class="post_button" id="post_edit_submit" data-postid="<?php echo $post->post_id ?>">Save</button>


<script>
//----Add image preview--->
var filaes;
var fileCollection = new Array();
$(document).on('change', '#post_photo1', function(e) {
    console.log('change');
    var count = 0;
    var files = e.target.files;
    $(this).removeData();

    $('.post_imgs_preview1').empty().show();
    $('.added_ikhe1').hide();
    $('#emoji_wrapper').hide();
    /* grid from preview*/


    $.each(files, function(i, file) {
        fileCollection.push(file);
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function(e) {

            var name = document.getElementById("post_photo1").files[i].name;
            var template = ' <img class="prevv_img1" id = "' + name +
                '" src="' + e.target.result + '" / >';


            $('#post_imgs_preview1').append(template);
            console.log('mengh--->', files.length)
            if (files.length == 1) {
                $('.prevv_img1').css('width', '500px');
                $('.prevv_img1').css('height', '400px');
            }
            if (files.length == 2) {
                $('.post_imgs_preview1').css('grid-template-columns', '1fr 1fr');
                $('.prevv_img1').css('width', '250px');
                $('.prevv_im1g').css('height', '400px');

            }
            if (files.length == 3) {
                $('.post_imgs_preview1').css('grid-template-columns', '1fr 1fr');
                $('.prevv_img1').css('width', '250px');
                $('.prevv_img1').css('height', '200px');
                $('.prevv_img1:first-of-type').css('grid-row', '1/3');
                $('.prevv_img1:first-of-type').css('height', '400px');
            }
        }
    })
    $('#post_imgs_preview1').append(
        '<div class="remove_img1"><i class="fa-solid fa-xmark"></i></div>');
    $('#post_imgs_preview1').append(
        '<div class="add_more_imgs1"><i class="azrbch"></i>Add Photos/Videos</div>');


})
$('#post_edit_submit').on('click', function() {
    var post_text = $(this).siblings('.box_area').find('.emojionearea-editor').html();
    var postid = $(this).data('postid');
    console.log(post_text)
    console.log(postid)

    var formData = new FormData();
    var images = [];
    var errors = [];
    var files = $('#post_photo1')[0].files;


    if (files.length != 0) {
        if (files.length > 20) {
            errors += "maximum 20 images is allowed.";

        } else {
            for (var i = 0; i < files.length; i++) {
                var name = document.getElementById('post_photo1').files[i].name;
                images += '{\"imageName\":\"user/' + <?php echo $userid; ?> +
                    '/postImages/' + name + '\"},';

                var extension = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    errors +=
                        '<p>Invalid ' + i +
                        ' File. Only gif,png,jpg,jpeg are allowed.</p>';
                }
                var ofReader = new FileReader();
                ofReader.readAsDataURL(document.getElementById('post_photo1').files[i]);
                var f = document.getElementById('post_photo1').files[i];
                var file_size = f.size || f.fileSize;
                if (file_size > 2000000) {
                    errors += '<p>' + i + ' File Size is larger than 5mb</p>'
                } else {
                    formData.append('file[]', document.getElementById('post_photo1')
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
                url: 'http://localhost/facebook/core/ajax/uploadPostImageEdit.php',
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
                    $('#post_imgs_preview1').empty();
                }

            })
        } else {
            $('#post_photo1').val('');
            $('#errors_post').html('<span>' + errors + '</span>');
            return false;
        }

    } else {
        var strImg = '';
    }
    if (strImg == '') {

        $.post('http://localhost/facebook/core/ajax/postSubmitEdit.php', {
            post_text_only_edit: post_text,
            postid: postid,
        }, function(data) {
            $('#post_box1').hide();
            $("#post_text").find(`[data-postid='${postid}']`).html(data);




        })
    } else {
        $.post('http://localhost/facebook/core/ajax/postSubmitEdit.php', {
            post_images: strImg,
            post_text: post_text,
            postid: postid,
        }, function(data) {

            console.log(data)
        })

    }




})
$(document).on('click', '.remove_img1', function() {
    $('.post_imgs_preview1').empty().hide();
    $('.added_ikhe1').css('display', 'flex');

})
$(document).on('mouseover', '.preview_container1', function() {
    $('.add_more_imgs1').show()
})
$(document).on('mouseout', '.preview_container1', function() {
    $('.add_more_imgs1').hide()
})
$('.add_more_imgs1').on('click', function() {
    $('#post_photo').click();

})
$(document).on('click', '#close_post1', function() {
    $('#post_box1').hide();
    $('.facebook_left').css('opacity', '1');
    $('.facebook_middle').css('opacity', '1');
    $('.facebook_right').css('opacity', '1');
})
if (<?php echo $length; ?> == 1) {
    $('.prevv_img1').css('width', '500px');
    $('.prevv_img1').css('height', '400px');
}
if (<?php echo $length; ?> == 2) {
    $('.post_imgs_preview1').css('grid-template-columns', '1fr 1fr');
    $('.prevv_img1').css('width', '250px');
    $('.prevv_im1g').css('height', '400px');

}
if (<?php echo $length;  ?> == 3) {
    $('.post_imgs_preview1').css('grid-template-columns', '1fr 1fr');
    $('.prevv_img1').css('width', '250px');
    $('.prevv_img1').css('height', '200px');
    $('.prevv_img1:first-of-type').css('grid-row', '1/3');
    $('.prevv_img1:first-of-type').css('height', '400px');
}
$(document).on('click', '.added_ikhe1', function() {
    $('#post_photo1').click();
})
</script>
<?php

}

?>