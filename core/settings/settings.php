<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['change_name'])){
    $change_name=$_POST['change_name'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $loadUser->updateName($userid,$first_name,$middle_name,$last_name);
    $loadUser->updateNameDateChange($userid);
    echo 'updated';
}
if(isset($_POST['checkforusername'])){
    $username=$_POST['checkforusername'];
   $check= $loadUser->checkifUsernameExist($username);
    if($check->total >0){
        echo 'true';
    }else{
        echo 'false';
    }
}
if(isset($_POST['change_username'])){
    $userid=$_POST['change_username'];
    $username=$_POST['username'];
    $loadUser->updateUsername($userid,$username);
}