<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();



if(0<$_FILES['file']['error']){
    echo "Errror: ". $_FILES['file']['error'].'';
}else{
    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/cover/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
    mkdir($path_directory,0777,true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
}
$name= 'user/'.$userid.'/cover/'.$_FILES['file']['name'];
$loadUser->create('stories',array('story_bg'=>$name,'story_user'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));


?>