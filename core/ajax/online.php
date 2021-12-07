<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['online'])){
    $userid=$_POST['online'];

    $loadUser->updateOnlineStatus($userid);


}

?>