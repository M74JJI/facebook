<?php


include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['postid'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $commentid = $_POST['commentid'];
    $editedTextVal = $_POST['editedTextVal'];
    $profileid = $_POST['profileid'];

    $loadPost->commentUpdate($userid,$postid,$editedTextVal,$commentid);


    return $editedTextVal;

}

if(isset($_POST['deletePostid'])){
    $deletePostid=$_POST['deletePostid'];
    $userid=$_POST['userid'];
    $commentid=$_POST['commentid'];
   
    $loadUser->delete('comments',array('comment_id'=>$commentid,'commentedOn'=>$deletePostid,'commentedBy'=>$userid));
    $loadUser->delete('react',array('reactCommentOn'=>$commentid,'reactedOn'=>$postid,'reactedBy'=>$userid));

    
    
}

?>