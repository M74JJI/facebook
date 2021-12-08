<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['resetOnline'])){
    $userid = $_POST['resetOnline'];

    $loadUser->resetOnline($userid);


}