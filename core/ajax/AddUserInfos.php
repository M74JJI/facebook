<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['company'])){
    $company = $_POST['company'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $position = $_POST['position'];
    $userid= $_POST['userid'];
 

$loadUser->update('profile',$userid,array('workplace_company' => $company, 'workplace_city' => $city, 'workplace_description'=>$description,'workplace_position'=>$position));

 $data =$loadAbout->checkWorkplace('workplace_company',$userid,$userid);
 return $data;

}



?>