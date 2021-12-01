<?php

include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();

if(isset($_POST['post_text_only'])){
    $post_text= $_POST['post_text_only'];

    $loadUser->create('post',array(
        'user_id'=>$userid,
        'post'=>$post_text,
        'postedBy'=>$userid,
        'postedAt'=>date('Y-m-d H:i:s'),

    ));
    
}
if(isset($_POST['post_images'])){
   $post_images=$_POST['post_images'];
   $post_text=$_POST['post_text'];

   $loadUser->create('post',array(
    'user_id'=>$userid,
    'post'=>$post_text,
    'postImages'=>$post_images,
    'postedBy'=>$userid,
    'postedAt'=>date('Y-m-d H:i:s'),

));


}


?>