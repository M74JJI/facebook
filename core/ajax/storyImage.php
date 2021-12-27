<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['song'])){
    $song=$_POST['song'];
    $image=$_POST['image'];
    $lyrics_type=$_POST['lyrics_type'];
    $lyrics=$_POST['lyrics'];
    $song_infos=$_POST['song_infos'];
    $picked_time=$_POST['picked_time'];
    $lyrics_position=$_POST['lyrics_position'];
    $cover_color=$_POST['cover_color'];

    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    $loadUser->create('stories',array('story_bg'=>$image,'song'=>$song,'song_starts'=>$picked_time,'cover_color'=>$cover_color,'lyrics_position'=>$lyrics_position,'lyrics'=>$lyrics,'song_infos'=>$song_infos,'lyrics_type'=>$lyrics_type,'story_user'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));

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