<?php
include '../load.php';
include '../../connect/login.php';
require_once '../../assets/addons/lineBreaker.php';

$userid = login::isLoggedIn();

if(isset($_POST['add_story'])){
    $userid = $_POST['add_story'];
    $background = $_POST['background'];
    $text = wordwrap($_POST['text'],16, "\n",true);
   
    $countLines=strlen($text)/16;
 
    $img = imagecreatefromjpeg('http://localhost/facebook/'.$background.'');

    $color=imagecolorallocate($img,255,255,255);
    $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/ayar.ttf";
    $angle = 0;
    $font_size=24;
  
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
  

    imagejpeg($img,$path_directory.'a.jpg',100);
    exit;
    $loadUser->create('stories',array('story_bg'=>$background,'story_user'=>$userid,'story_text'=>$text,'createdAt'=>date('Y-m-d H:i:s')));
}
if(isset($_POST['get_all_stories'])){
    $userid = $_POST['get_all_stories'];
    $stories= $loadUser->getAllStories($userid);
    echo json_encode($stories);
}