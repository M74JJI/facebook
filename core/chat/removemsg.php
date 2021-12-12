<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();
if(isset($_POST['remove_msg'])){
 $msg=$_POST['remove_msg'];

  
 $loadUser->removeMessageUpdate($msg);

}