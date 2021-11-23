<?php


include '../load.php';
include '../../connect/login.php';

$userid=login::isLoggedIn();


$workicon="https://static.xx.fbcdn.net/rsrc.php/v3/yt/r/Bo7x4xsiTje.png";
$studyicon="https://static.xx.fbcdn.net/rsrc.php/v3/yN/r/j-QTXcNyQBK.png";
$contacticon="https://static.xx.fbcdn.net/rsrc.php/v3/yb/r/Nxb0jln7NuU.png";
$instagramicon="https://static.xx.fbcdn.net/rsrc.php/v3/yZ/r/7B_R5-33_c3.png";
$maleicon="https://static.xx.fbcdn.net/rsrc.php/v3/yi/r/rodGQv9jZg5.png";
$birthdayicon="https://static.xx.fbcdn.net/rsrc.php/v3/yB/r/ODICuZSjkMe.png";
$menwomenicon="https://static.xx.fbcdn.net/rsrc.php/v3/y2/r/HfPKVWFQhA2.png";
$relationicon="https://static.xx.fbcdn.net/rsrc.php/v3/yg/r/qm5n1WSqkVV.png";
$familyicon="https://static.xx.fbcdn.net/rsrc.php/v3/y8/r/2g9_2GO5Jjy.png";
$abouticon="https://static.xx.fbcdn.net/rsrc.php/v3/yp/r/G3O_YCZDC0c.png";
$quoteicon="https://static.xx.fbcdn.net/rsrc.php/v3/yX/r/O9UvtDFKcnT.png";
$homeicon="https://static.xx.fbcdn.net/rsrc.php/v3/yS/r/poZ_P5BwYaV.png";
$phoneicon="https://www.facebook.com/rsrc.php/v3/yI/r/lzvufuLgbzd.png";
$icon="";

if(isset($_POST['workeducation'])){
    $userid=$_POST['workeducation'];
    $profileid=$_POST['profileid'];
    $userInfos=$loadUser->getUserInfo($profileid);
    ?>
<div class="menu_about_wrapthatshot">
    <?php $loadAbout->WorkEducation('workplace',$userid,$profileid,'Add a workplace',$workicon,"Work"); ?>
    <?php $loadAbout->WorkEducation('college',$userid,$profileid,'Add a college ',$studyicon,"College"); ?>
    <?php $loadAbout->WorkEducation('high_school',$userid,$profileid,'Add a high school',$studyicon,"High sChool"); ?>
</div>
<?php
    
}
if(isset($_POST['placeslived'])){
    $userid=$_POST['placeslived'];
    $profileid=$_POST['profileid'];
    $userInfos=$loadUser->getUserInfo($profileid);
    ?>
<div class="menu_about_wrapthatshot">
    <?php $loadAbout->overview('workplace',$userid,$profileid,'Add a workplace',$workicon); ?>
    <?php $loadAbout->overview('high_school',$userid,$profileid,'Add a high school',""); ?>

</div>
<?php
    
}
if(isset($_POST['contacts_basic'])){
    $userid=$_POST['contacts_basic'];
    $profileid=$_POST['profileid'];
    $userInfos=$loadUser->getUserInfo($profileid);
    ?>
<div class="menu_about_wrapthatshot">

    <?php $loadAbout->overview('high_school',$userid,$profileid,'Add a high school',""); ?>

</div>
<?php
    
}

?>