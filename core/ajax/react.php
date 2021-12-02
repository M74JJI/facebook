<?php
include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();

if(isset($_POST['reactType'])){
  
    $reactType = $_POST['reactType'];
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];
    $profileId = $_POST['profileId'];
    
    
    
    $loadUser->delete('react',
    array('reactedBy' => $userId,
    'reactedOn'=>$postId,
    'reactCommentOn'=>'0',
    'reactReplyOn'=>'0',
      ));
    
    
    $loadUser->create('react',
    array('reactedBy' => $userId,
    'reactedOn'=>$postId,
    'reactType'=>$reactType,
    'reactedAt'=>date('Y-m-d H:i:s'),

    
    ));
if($profileId != $userId){
    $loadUser->create('notifications',
    array('not_from' => $userId,
    'user'=>$profileId,
    'postid'=>$postId,
    'total'=>'0',
    'type'=>'postReact',
    'status'=>'0',
    'icon'=>$reactType,
    'createdAt'=>date('Y-m-d H:i:s'),

    
));

}


        $react_max_show = $loadPost->react_max_show($postId);
        $main_react_count = $loadPost->main_react_count($postId);
        

        ?>
<div class="nf-3-react-icon">
    <div class="react-inst-img align-middle">
        <?php
                foreach ($react_max_show as $react_max){
                    echo '<img class="'.$react_max->reactType.'-max-show"
                    src="assets/images/react/'.$react_max->reactType.'.png" alt=""
                    style="height:20px;width:20px;cursor: pointer;"
                    >';
                }
               ?>
    </div>
</div>
<div class="nf-3-react-username">
    <?php 
    if($main_react_count->maxreact =='0'){

    }else{
        echo $main_react_count->maxreact;
    }
    ?>
</div>

<?php

}

if(isset($_POST['deleteReactType'])){
    $deleteReactType = $_POST['deleteReactType'];
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];
    $profileId = $_POST['profileId'];
    $loadUser->delete('react',
    array('reactedBy' => $userId,
    'reactedOn'=>$postId,
    'reactCommentOn'=>'0',
    'reactReplyOn'=>'0'
      ));
   
      $react_max_show = $loadPost->react_max_show($postId);
      $main_react_count = $loadPost->main_react_count($postId);
      

      ?>
<div class="nf-3-react-icon">
    <div class="react-inst-img align-middle">
        <?php
              foreach ($react_max_show as $react_max){
                  echo '<img class="'.$react_max->reactType.'-max-show"
                  src="assets/images/react/'.$react_max->reactType.'.svg" alt=""
                  style="height:20px;width:20px;cursor: pointer;"
                  >';
              }
             ?>
    </div>
</div>
<div class="nf-3-react-username">
    <?php 
  if($main_react_count->maxreact =='0'){

  }else{
      echo $main_react_count->maxreact;
  }
  ?>
</div>

<?php

       
}


?>