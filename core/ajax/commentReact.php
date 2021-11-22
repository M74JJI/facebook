<?php

include '../load.php';
include '../../connect/login.php';


$userid= login::isLoggedIn();



if(isset($_POST['commentid'])){

    $commentid= $_POST['commentid'];
    $reactType= $_POST['reactType'];
    $postid= $_POST['postid'];

    $userid= $_POST['userid'];
    $profileid= $_POST['profileid'];

    $loadUser->delete('react',array('reactedBy'=>$userid,'reactedOn'=>$postid,'reactCommentOn'=>$commentid));
    
    $loadUser->create('react',array('reactedBy'=>$userid,'reactedOn'=>$postid,'reactCommentOn'=>$commentid,'reactType'=>$reactType,'reactedAt'=>date('Y-m-d H:i:s')));
    
    $com_react_max_show = $loadPost->com_react_max_show($postid,$commentid);
    $com_main_react_count = $loadPost->com_main_react_count($postid,$commentid);

    ?>
<div class="com-nf-3 align-middle ">
    <div class="nf-3-react-icon">
        <div class="align-middle react-inst-img">


            <?php 
            foreach($com_react_max_show as $reactmax){
                echo '<img class="'.$reactmax->reactType.'-max-show" id="'.$reactmax->reactType.'" src="assets/images/react/'.$reactmax->reactType.'.png" alt="" style="height:13px;width:13px;cursor:pointer">';
                
            }
            ?>
        </div>
    </div>
    <div class="nf-3-react-username" style="font-size:12px">

        <?php
if($com_main_react_count->maxreact =='0'){

}else{
    echo $com_main_react_count->maxreact;
}
?>

    </div>
</div>


<?php

if(isset($_POST['deleteReactType'])){
    $deleteReactType= $_POST['deleteReactType'];
    $deleteCommentid= $_POST['deleteCommentid'];
    $postid= $_POST['postid'];
    $userid= $_POST['userid'];
    $profileid= $_POST['profileid'];


    $loadUser->delete('react',array('reactedBy'=>$userid,'reactedOn'=>$postid,'reactType'=>$deleteReactType));


$com_react_max_show = $loadPost->com_react_max_show($postid,$deleteCommentid);
$com_main_react_count = $loadPost->com_main_react_count($postid,$deleteCommentid);

?>
<div class="com-nf-3 align-middle">
    <div class="nf-3-react-icon">
        <div class="align-middle react-inst-img">


            <?php 
            foreach($com_react_max_show as $reactmax){
                echo '<img class="'.$reactmax->reactType.'-max-show" id="'.$reactmax->reactType.'" src="assets/images/react/'.$reactmax->reactType.'.png" alt="" style="height:13px;width:13px;cursor:pointer">';
                
            }
            ?>
        </div>
    </div>
    <div class="nf-3-react-username" style="font-size:12px">

        <?php
if($com_main_react_count->maxreact =='0'){

}else{
    echo $com_main_react_count->maxreact;
}
?>

    </div>
</div>


<?php
}


}

?>