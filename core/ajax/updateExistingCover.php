<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['existing_cover'])){
    $existing_image=$loadUser->checkInput(($_POST['existing_cover']));
    $userid=$loadUser->checkInput(($_POST['userid']));
    $img=$loadUser->getCoverPictureByImage($existing_image,$userid);
   
    $loadUser->update('profile',$userid,array('cover'=>$existing_image));
    $loadUser->updatecoverPicDate($img->cover_id);
    echo $existing_image;
}    
  
if(isset($_POST['existing_cover_list'])){
    $userid=$_POST['existing_cover_list'];
    $profilePictures=$loadUser->getCoverPictures($userid);
    foreach ($profilePictures as $img){
        ?>
<img id="pick_existing_cover_picture" data-img="<?php echo BASE_URL.$img->cover ?>"
    src="<?php echo BASE_URL.$img->cover ?>" alt="">
<?php
    }
   
}    
  