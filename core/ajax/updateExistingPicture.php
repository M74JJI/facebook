<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['existing_image'])){
    $existing_image=$loadUser->checkInput(($_POST['existing_image']));
    $userid=$loadUser->checkInput(($_POST['userid']));
    $img=$loadUser->getProfilePictureByImage($existing_image,$userid);
    $loadUser->update('profile',$userid,array('profile_picture'=>$existing_image));
    $loadUser->updateprofilePicDate($img->pp);
    echo $existing_image;
}    
  
if(isset($_POST['existing_image_list'])){
    $userid=$_POST['existing_image_list'];
    $profilePictures=$loadUser->getProfilePictures($userid);
    foreach ($profilePictures as $img){
        ?>
<img id="pick_existing_profile_picture" data-img="<?php echo $img->picture ?>"
    src="<?php echo BASE_URL.$img->picture ?>" alt="">
<?php
    }
   
}    
  