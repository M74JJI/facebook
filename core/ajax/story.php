<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['add_story'])){
    $userid = $_POST['add_story'];
    $background = $_POST['background'];
    $text = $_POST['text'];
    $loadUser->create('stories',array('story_bg'=>$background,'story_user'=>$userid,'story_text'=>$text,'createdAt'=>date('Y-m-d H:i:s')));
}