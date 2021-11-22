<?php

include'../load.php';
include'../../connect/login.php';

$userid= login::isLoggedIn();


if(isset($_POST['shareText'])){
    $shareText=$_POST['shareText'];
    $profileid=$_POST['profileid'];
    $postid=$_POST['postid'];
    $userid=$_POST['userid'];

    $loadUser->create('post',array('user_id'=>$userid,'shareId'=>$postid,'sharedFrom'=>$profileid,'sharedBy'=>$userid,'shareText'=>$shareText,'postedBy'=>$profileid,'postedAt'=>date('Y-m-d H:i:s')));
    
    

}


?>