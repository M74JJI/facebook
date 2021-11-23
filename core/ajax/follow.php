<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['follow'])){
    $profileid=$_POST['follow'];
    $userid=$_POST['userid'];
    $loadUser->create('follow',array('receiver'=>$profileid,'sender'=>$userid,'followedAt'=>date('Y-m-d H:i:s')));
}
if(isset($_POST['unfollow'])){
    $profileid=$_POST['unfollow'];
    $userid=$_POST['userid'];
    $loadUser->delete('follow',array('receiver'=>$profileid,'sender'=>$userid));
    $loadUser->delete('follow',array('receiver'=>$userid,'sender'=>$profileid));

}




?>