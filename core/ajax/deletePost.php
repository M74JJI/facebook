<?php

include '../load.php';
include '../../connect/login.php';

$userid=login::isLoggedIn();


if(isset($_POST['delete_post'])){
    $postid=$_POST['delete_post'];

    $loadPost->deletePost($postid,$userid);
}










?>