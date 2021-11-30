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
    <input type="file" class="input_tamara" id="post_photo" name="post_photo"
        data-multiple-caption='{count} files selected' multiple="">
    <div class="plussit_dvc">
        <i class="plucit_icon"></i>
    </div>
    Add Photos/Videos
    <span>or drag and drop</span>
</div>





<div class="post_imgs_preview1">
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

<button class="post_button" id="post_btn_submit">Save</button>


<script>
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
</script>
<?php

}

?>