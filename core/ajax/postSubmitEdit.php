<?php

include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();

if(isset($_POST['post_text_only_edit'])){
    $post_text= $_POST['post_text_only_edit'];
    $postid= $_POST['postid'];
    $loadPost->updateTextPost($postid,$post_text);

    echo $post_text;
    
}
if(isset($_POST['post_images'])){
   $post_images=$_POST['post_images'];
   $post_text=$_POST['post_text'];
   $postid=$_POST['postid'];
 

  $loadPost->updatePostImages($postid,$post_images,$post_text);


}


?>