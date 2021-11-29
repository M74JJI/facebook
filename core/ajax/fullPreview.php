<?php
include '../load.php';
include '../../connect/login.php';
$userid = login::isLoggedIn();


if(isset($_POST['previewImg'])){
$userid =$_POST['previewImg'];
$postid =$_POST['postid'];
$src =$_POST['src']; 

$main_react =$loadPost->main_react($userid,$postid);
$react_max_show =$loadPost->react_max_show($postid);
$main_react_count =$loadPost->main_react_count($postid);
$commentDetails = $loadPost->commentFetch($postid);
$totalCommentCount=$loadPost->totalCommentCount($postid);
$totalShareCount =$loadPost->totalShareCount($postid);


$post=$loadPost->getPost($postid);
?>
<!------POST  FUNCTIONS DATA------>
<!------POST------>



<?php }

        ?>