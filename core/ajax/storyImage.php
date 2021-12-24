<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['song'])){
    $song=$_POST['song'];
    $image=$_POST['image'];
    $video_name="";
    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
  echo shell_exec("ffmpeg -loop 1 -f image2 -i $image -i $song -vf crop=in_w:in_w*9/16,scale=1920:1080,fps=fps=30 -pix_fmt yuv420p -vcodec libx264 -shortest train_whistle_airplane.mp4");
    $loadUser->create('stories',array('story_bg'=>$image,'song'=>$song,'story_user'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));

}

if(0<$_FILES['file']['error']){
    echo "Errror: ". $_FILES['file']['error'].'';
}else{
    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
    mkdir($path_directory,0777,true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
}
echo 'user/'.$userid.'/stories/'.$_FILES['file']['name'];


?>