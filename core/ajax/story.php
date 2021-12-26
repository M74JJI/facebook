<?php
include '../load.php';
include '../../connect/login.php';
require_once '../../assets/addons/lineBreaker.php';

$userid = login::isLoggedIn();
function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
if(isset($_POST['add_story'])){
    $userid = $_POST['add_story'];
    $background = $_POST['background'];
    $font_name = $_POST['font'];
    $text = wordwrap($_POST['text'],26, "\n",true);
    $countLines=strlen($text)/26;
    $img = imagecreatefromjpeg('http://localhost/facebook/'.$background.'');

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
  

    $path =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    $nm =generateRandomString().".jpg";
    imagejpeg($img,$path.$nm,100);
    $img_path="user/".$userid."/stories/".$nm;
 
    $loadUser->create('stories',array('story_bg'=>$img_path,'story_user'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));
}
if(isset($_POST['get_all_stories'])){
    $userid = $_POST['get_all_stories'];
    $stories= $loadUser->getAllStories($userid);
    echo json_encode($stories);
}