<?php
include '../connect/login.php';
include '../core/load.php';

if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
   $userInfo= $loadUser->getUserInfo($userid);
  
}else{
    header('Location:login.php');
}
if(!empty($_GET["uuid"])){
    $mol_story=$_GET["uuid"];
   
}else{
    $mol_story=$userid;
 
}

$userStories = $loadUser->getUserStories($mol_story);
if(!empty($_GET["uid"])){
    if($_GET["uid"]>0 && $_GET["uid"]<count($userStories)){
        $num_story=$_GET["uid"];
    }else{ 
        $num_story=0; 
    }
}else{
    $num_story=0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories</title>
    <link rel="stylesheet" href="../assets/css/stories.css">
</head>

<body>
    <div class="watch_story">
        <div class="story_player">
            <div class="story_bar_container"
                style="grid-template-columns: repeat(<?php echo count($userStories)  ?>,1fr);">
                <?php
               for($i=0;$i<count($userStories);$i++){
                   ?>
                <div class="story_bar"></div>
                <?php
               }
               ?>
            </div>
            <img class="story_bg_img"
                src="<?php echo 'http://localhost/facebook/'.$userStories[$num_story]->story_bg ?>" alt="">
        </div>
    </div>
</body>

</html>