<?php

include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();

if(isset($_POST['post_text_only'])){
    $post_text= $_POST['post_text_only'];
    $mention=$_POST['mention'];
    $user = str_replace('@','',$mention);
    $ment =$user[0];
    $details=$loadUser->mentionUser($ment);

    $mention_profileid = $details->id;

 $postid = $loadUser->create('post',array(
        'user_id'=>$userid,
        'post'=>$post_text,
        'postedBy'=>$userid,
        'postedAt'=>date('Y-m-d H:i:s'),

    ));

    $loadUser->create('notifications',
    array('not_from' => $userid,
    'user'=>$mention_profileid,
    'postid'=>$postid,
    'total'=>'0',
    'type'=>'postMention',
    'status'=>'0',
    'icon'=>'post',
    'friendStatus'=>'0',
    'createdAt'=>date('Y-m-d H:i:s'),

    
));
    
}
if(isset($_POST['post_images'])){
   $post_images=$_POST['post_images'];
   $post_text=$_POST['post_text'];
   $mention=$_POST['mention'];
   $user = str_replace('@','',$mention);
   $ment =$user[0];
   $details=$loadUser->mentionUser($ment);

   $mention_profileid = $details->id;

$postid = $loadUser->create('post',array(
       'user_id'=>$userid,
       'post'=>$post_text,
       'postedBy'=>$userid,
       'postImages'=>$post_images,
       'postedAt'=>date('Y-m-d H:i:s'),

   ));

   $loadUser->create('notifications',
   array('not_from' => $userid,
   'user'=>$mention_profileid,
   'postid'=>$postid,
   'total'=>'0',
   'type'=>'postMention',
   'status'=>'0',
   'icon'=>'post',
   'friendStatus'=>'0',
   'createdAt'=>date('Y-m-d H:i:s'),

   
));
 


}


?>