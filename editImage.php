<?php

$img = imagecreatefromjpeg('assets/images/profile.jpg');
$white=imagecolorallocate($img,255,255,255);
$font="assets/fonts/ayar.ttf";
$txt="hajji is the man for the job";
imagettftext($img,24,0,55,64,$white,$font,$txt);


header('Content-Type:image/jpeg');
imagejpeg($img);

?>