<?php

include '../load.php';
include '../../connect/login.php';

$userid=login::isLoggedIn();

if(isset($_POST['slicer'])){
    $slicer=$_POST['slicer'];
    $postid=$_POST['postid'];
    $userInfo=$loadUser->getUserInfo($userid);

    $commentDetails = $loadPost->commentFetch($postid);
    
    ?>
<ul class="add-comment">
    <div class="comment-write">
        <div class="com-pro-pick">
            <a href="#">
                <div class="top-pic">
                    <img src="<?php echo $userInfo->profile_picture ?>" alt="">
                </div>
            </a>
        </div>


        <div class="com-input">
            <div class="comment-input" data-postid="<?php echo $postid ?>" data-userid="<?php echo $userid  ?>">
                <input type="text" class="comment-input-style comment-submit" id="comment-inputt"
                    placeholder="Write a comment..." />
                <div class="comment_toolss">
                    <input type="file" id="comment_imggg" class='hidden'>
                    <div class="m_tool" id="camera_m">
                        <i class="camera_m"></i>
                    </div>
                    <div class="m_tool">
                        <i class="m_gif"></i>
                    </div>
                    <div class="m_tool">
                        <i class="m_sticker"></i>
                    </div>

                </div>
            </div>
            <div class="comment_img_preview"></div>
        </div>
    </div>
    <?php 

if(!empty($commentDetails)){

foreach (array_slice($commentDetails,0,$slicer) as $comment){


$com_react_max_show =$loadPost->com_react_max_show($comment->commentedOn,$comment->comment_id);
$com_main_react_count =$loadPost->com_main_react_count($comment->commentedOn,$comment->comment_id);
$com_reactCheck =$loadPost->com_reactCheck($userid,$comment->commentedOn,$comment->comment_id);

?>
    <!-------COMMENT------>
    <li class="new-comment" style="margin-top:10px">
        <div class="com-details">
            <div class="com-profile-pic">
                <a href="#">
                    <span class="top-pic">
                        <img src="<?php echo $comment->profile_picture ?>" class="pdp_comment" alt="">
                    </span>
                </a>
            </div>
            <div class="com-pro-wrap">
                <div class="com-text-react-wrap">
                    <div class="com-text-option-wrap align-middle">
                        <div class="com-pro-text align-middle">

                            <div class="com-react-placeholder-wrap align-middle">
                                <div class="flex_col">
                                    <span class="nf-pro-name">
                                        <a href="#" class="nf-pr-name">
                                            <?php echo ''.$comment->first_name.' '.$comment->last_name.'' ?>
                                        </a>
                                    </span>
                                    <span class="com-text" style="margin-left:5px"
                                        data-postid="<?php echo $comment->commentedOn ?>"
                                        data-userid="<?php echo $userInfo->id ?>"
                                        data-commentid="<?php echo $comment->comment_id ?>"
                                        data-profilepic="<?php echo $userInfo->profile_picture ?>">

                                        <?php echo $comment->comment ?>

                                    </span>
                                </div>
                                <div class="com-nf-3-wrap">
                                    <?php 
                    if($com_main_react_count->maxreact =='0'){ 
                    }else{
                ?>
                                    <div class="com-nf-3 align-middle">
                                        <div class="nf-3-react-icon">
                                            <div class="align-middle react-inst-img">
                                                <?php
                 foreach($com_react_max_show as $react_max){
                     echo '<img class="'.$react_max->reactType.'-max-show"
                      src="assets/images/react/'.$react_max->reactType.'.svg" alt=""
                       style="height:17px;width:17px;cursor:pointer;">';
                     
                 }
                 ?>
                                            </div>
                                        </div>
                                        <div class="nf-3-react-username">
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
            
                  ?>

                                </div>
                            </div>
                        </div>

                        <?php 
      
        if($userid == $comment->commentedBy){
            ?>
                        <div class="com-dot-option-wrap">
                            <div class="com-dot" data-postid="<?php echo $comment->commentedOn ?>"
                                data-userid="<?php echo $userid  ?>"
                                data-commentid="<?php echo $comment->comment_id ?>">
                                <i class="fa-solid fa-ellipsis"></i>
                            </div>
                            <div class="com-option-details-container" id="com-option-details-container">
                            </div>

                        </div>
                        <?php
        }else{}
        ?>
                    </div>
                    <?php 
if($comment->image !=''){
$imgs=json_decode($comment->image);
$count = 0;
for($i=0;$i<count($imgs);$i++){
    echo'
    <img src="'.BASE_URL.$imgs[''.$count++.'']->imageName.'" 
    class="comment_img_plz" >
    ';   
}

}
?>
                    <div class="com-react">

                        <div class="com-rlike-react" data-postid="<?php echo $comment->commentedOn ?>"
                            data-userid="<?php echo $userid  ?>" data-commentid="<?php echo $comment->comment_id ?>">
                            <div class="com-react-bundle-wrap" data-commentid="<?php echo $comment->comment_id ?>">

                            </div>
                            <?php
            if(empty($com_reactCheck)){
                echo '<div class="com-like-action-text"><span>Like</span></div>';

            }else{
                 
              
             echo '<div class="com-like-action-text"><span class="'.$com_reactCheck->reactType.'-color">'.$com_reactCheck->reactType.'</span></div>'; 
                
            }
            ?>
                        </div>
                        <b class="com-reply-action" data-postid="<?php echo $comment->commentedOn ?>"
                            data-profilepic="<?php echo $userInfo->profile_picture ?>">
                            Reply
                        </b>
                        <div class="com-time">
                            <?php echo $loadUser->timeAgoAlt($comment->commentedAt) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </li>
</ul>
<!-------COMMENT------>
<?php }}

if($slicer < count($commentDetails)){
    echo ' <div class="show_more_com" data-postid="<?php echo $post->post_id ?>">
<a>View more comments
</a>
</div>';
}

?>

<?php
}


?>