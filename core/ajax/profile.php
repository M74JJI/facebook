<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['image_name'])){
    $image_name=$loadUser->checkInput(($_POST['image_name']));
    $userid=$loadUser->checkInput(($_POST['userid']));
  
    $loadUser->update('profile',$userid,array('cover'=>$image_name));
    $loadUser->create('coverPictures',array('cover'=>$image_name,'p_user'=>$userid));
    
  
}else{
    
}


if(0<$_FILES['file']['error']){
    echo "Errror: ". $_FILES['file']['error'].'';
}else{
    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/cover/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
    mkdir($path_directory,0777,true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
}
echo 'user/'.$userid.'/cover/'.$_FILES['file']['name'];

?>