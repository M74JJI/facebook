<?php

include '../load.php';
include '../../connect/login.php';



$userid = login::isLoggedIn();

if(isset($_POST['comment'])){
    $comment =$loadUser->checkInput($_POST['comment']);
    $userid =$_POST['userid'];
    $postid =$_POST['postid'];
    $profileid =$_POST['profileid'];


  $commentid=  $loadUser->create('comments',array('commentedBy'=>$userid,'comment_parent_id'=>$postid,'comment'=>$comment,'commentedOn'=>$postid,'commentedAt'=>date('Y-m-d H:i:s')));
 

  $commentDetails = $loadPost->FetchLastComment($commentid);


                        
                                            if(!empty($commentDetails)){

                                            foreach ($commentDetails as $comment){
                                            
                                                $com_react_max_show =$loadPost->com_react_max_show($comment->commentedOn,$comment->id);
                                                $com_main_react_count =$loadPost->com_main_react_count($comment->commentedOn,$comment->id);
                                                $com_reactCheck =$loadPost->com_reactCheck($userid,$comment->commentedOn,$comment->id);
                                           ?>

<li class="new-comment">
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
                                    data-userid="<?php echo $userid ?>" data-commentid="<?php echo $comment->id ?>"
                                    data-profilepic="<?php echo $comment->profile_picture  ?>">

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
                                        <div class=" align-middle react-inst-img">
                                            <?php
                                                                 foreach($com_react_max_show as $react_max){
                                                                     echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                     
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
                            data-userid="<?php echo $userid  ?>" data-commentid="<?php echo $comment->id ?>">
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="com-option-details-container">

                        </div>
                    </div>
                    <?php
                                                        }else{}
                                                        ?>
                </div>
                <div class="com-react">
                    <div class="com-rlike-react" data-postid="<?php echo $comment->commentedOn ?>"
                        data-userid="<?php echo $userid  ?>" data-commentid="<?php echo $comment->id ?>">
                        <div class="com-react-bundle-wrap" data-commentid="<?php echo $comment->id ?>">

                        </div>
                        <?php
                                                            if(empty($com_reactCheck)){
                                                                echo '<div class="com-like-action-text"><b>Like</b></div>';
                                                            }else{
                                                                
                                                                echo '<div class="com-like-action-text"><span class="'.$com_reactCheck->reactType.'-color">'.$com_reactCheck->reactType.'</span></div>';
                                                                
                                                            }
                                                            ?>
                    </div>
                    <b class="com-reply-action" data-postid="<?php echo $comment->commentedOn ?>"
                        data-profilepic="<?php echo $comment->profile_picture ?>">
                        Reply
                    </b>
                    <div class="com-time">
                        <?php echo $loadUser->timeAgo($comment->commentedAt) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</li>


<?php }}} 




?>