<?php


include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();


if(isset($_POST['request'])){
    $profileid =$_POST['request'];
    $userid =$_POST['userid'];


    $loadUser->create('friendrequest',array('requestReceiver'=>$profileid, 'requestSender'=>$userid,'requestStatus'=>'0','requestedAt'=>date('Y-m-d H:i:s')));
    $loadUser->create('follow',array('receiver'=>$profileid,'sender'=>$userid,'followedAt'=>date('Y-m-d H:i:s')));

}

if(isset($_POST['Confirmrequest'])){
    $profileid =$_POST['Confirmrequest'];
    $userid =$_POST['userid'];


    $loadPost->ConfirmRequest($profileid,$userid);
    $loadUser->create('follow',array('receiver'=>$profileid,'sender'=>$userid,'followedAt'=>date('Y-m-d H:i:s')));

    
}
if(isset($_POST['Cancelrequest'])){
    $profileid =$_POST['Cancelrequest'];
    $userid =$_POST['userid'];


    $loadUser->delete('friendrequest',array('requestReceiver'=>$profileid,'requestSender'=>$userid));
    $loadUser->delete('follow',array('receiver'=>$profileid,'sender'=>$userid));
    
}
if(isset($_POST['deleteRequest'])){
    $profileid =$_POST['deleteRequest'];
    $userid =$_POST['userid'];
    $loadUser->delete('follow',array('receiver'=>$profileid,'sender'=>$userid));
    $loadUser->delete('follow',array('receiver'=>$userid,'sender'=>$profileid));

    $loadUser->delete('friendrequest',array('requestReceiver'=>$userid,'requestSender'=>$profileid));
    
    
}
if(isset($_POST['Unfriendrequest'])){
    $profileid =$_POST['Unfriendrequest'];
    $userid =$_POST['userid'];
    $loadUser->delete('follow',array('receiver'=>$profileid,'sender'=>$userid));
    $loadUser->delete('friendrequest',array('requestReceiver'=>$profileid,'requestSender'=>$userid));
    $loadUser->delete('friendrequest',array('requestReceiver'=>$userid,'requestSender'=>$profileid));
    
    
}


?>