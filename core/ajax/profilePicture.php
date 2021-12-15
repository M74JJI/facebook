<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['image_name'])){
 
    $image_name=$loadUser->checkInput($_POST['image_name']);
    $user_id = $loadUser->checkInput($_POST['user_id']);

    $loadUser->update('profile',$userid,array('profile_picture'=>$image_name));
    $loadUser->create('profilePictures',array('picture'=>$image_name,'p_user'=>$userid));

}
if(0 < $_FILES['file']['error']){

    echo 'Error: '. $_FILES['file']['error'].'<br>';
}else{

    $path_directory=$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/profilePicture/";
   
    if(!file_exists($path_directory) && !is_dir($path_directory)){
      mkdir($path_directory,0777,true); 
  } 
  move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
   
}
echo 'user/'.$userid.'/profilePicture/'.$_FILES['file']['name']; 
?>