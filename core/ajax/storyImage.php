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
    
    $text = wordwrap($_POST['text'],26, "\n",true);
    $text_position=$_POST['text_position'];
    $position=explode(',',$text_position);
    $countLines=strlen($text)/26;
    $img = imagecreatefromjpeg('http://localhost/facebook/'.$image);
    $font_name="";
    $color=imagecolorallocate($img,255,255,255);
     if($font_name =="Bold"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/bold.ttf";
     }else  if($font_name =="Italic"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/italic.ttf";
     }else  if($font_name =="Neon"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/neon.ttf";
     }else{ 
       $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/clean.ttf";
     }
    $angle = 0;
    $font_size=18;
    
    $width = imagesx($img);
    $height = imagesy($img);
  // Get center coordinates of image
    $centerX = $width / 2;
    $centerY = $height / 2;
  // Get size of text
    list($left, $bottom, $right, , , $top) = imageftbbox($font_size, $angle, $font, $text);
  // Determine offset of text
    $left_offset = ($right - $left) / 2;
    $top_offset = ($bottom - $top) / 2;
  // Generate coordinates
    $x = $centerX - $left_offset;
    $y = $centerY + $top_offset;
    $yy = $y-($countLines * 50);
  // Add text to image
  imagettftext($img, $font_size, $angle, $x, $yy, $color, $font, $text);

    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
    mkdir($path_directory,0777,true);
    }
    $path =$_SERVER['DOCUMENT_ROOT']."/facebook/";

    imagejpeg($img,$path.$image,100);

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