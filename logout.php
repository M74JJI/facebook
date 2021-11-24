<?php

include 'connect/login.php';
include 'core/load.php';
if(login::isLoggedIn()){
  $userid = login::isLoggedIn();
}else{
    header('Location:login.php');
}
$loadUser->delete('token',array('user_id'=>$userid));
if(isset($_COOKIE['USERID'])){
    unset($_COOKIE['USERID']);
    setcookie('USERID', null, time() - 3600, "/");

    header('Refresh:0');
}

?>