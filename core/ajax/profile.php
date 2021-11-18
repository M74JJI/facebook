<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['image_name'])){
    $image_name=$loadUser->checkInput(($_POST['image_name']));
    $userid=$loadUser->checkInput(($_POST['userid']));
  
    $loadUser->update('profile',$userid,array('cover'=>$image_name));
    
  echo 'Cover found and set'; 
}else{
    echo 'Cover photo not found';
}

?>