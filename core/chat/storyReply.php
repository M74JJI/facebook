<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['storyReply'])){
    $userid = $_POST['storyReply'];
    $chatid=$_POST['chatid'];
    $story_text=$_POST['story_text'];
    $reply_text=$_POST['reply_text'];
    $image=$_POST['image'];
    $a7a=$loadUser->getUserInfo($chatid);
    $online=$loadUser->getOnlineStatus($chatid,$userid);
    if(time()- strtotime($a7a->last_activity)<2 && $online->status==1){
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'images'=>$image,'isStory'=>1,'receiver'=>$chatid,'status'=>2,'messageAt'=>date('Y-m-d H:i:s')));
    }else if(time()- strtotime($a7a->last_activity)<2 && $online->status==0){
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'status'=>1,'images'=>$image,'isStory'=>1,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }else{
        
        $loadUser->create('messages',array('message'=>$reply_text,'sender'=>$userid,'images'=>$image,'isStory'=>1,'status'=>0,'receiver'=>$chatid,'messageAt'=>date('Y-m-d H:i:s')));
    }
    
  
}

if(isset($_POST['viewStory'])){
    $viewer = $_POST['viewStory'];
    $story_id=$_POST['story_id'];
    $viewers=$loadUser->getStoryViewers($story_id)->viewers;
    var_dump($viewers);
    if($viewers ==''){
        $viewerss=''.$viewer.'';
        $loadUser->updateStoryViewers($story_id,$viewerss);

    }else{
    if(str_contains($viewers, $viewer)) {
      
    }else{
        $viewerss=$viewers.''.$viewer;
        $loadUser->updateStoryViewers($story_id,$viewerss);
        
    }
    }

    
  
}

if(isset($_POST['getNextStory'])){
    $user_id = $_POST['getNextStory'];
    $occurence=$_POST['occurence'];
    $userStories=$loadUser->getUserStories($user_id);
  
    if(count($userStories)>$occurence){
        echo json_encode($userStories[$occurence+1]);
    }else{
         
         echo 'no-exist';
    }
     
}
if(isset($_POST['autoPlay'])){
    $user_id = $_POST['autoPlay'];
    $story_user = $_POST['story_user'];
    $story_id = $_POST['story_id'];
    $numStory;
    
    $userStories=$loadUser->getUserStories($story_user);
    $nextStories=$loadUser->getfollowingStories($user_id,$story_user);
    $totalOcc=$loadUser->getUserStoriesTotal($story_user);
    $total=$totalOcc->total;
    for($i= 0; $i < count($userStories); $i++){
        if($userStories[$i]->story_id == $story_id){
         $numStory=$i+1;
        }
    }


    if($numStory >= $total){
        /*echo json_encode($nextStories[$numStory]);*/
        echo 'laaaaaaaaaaaaaaaaaaaaaaaaaaaa';
     
     
    }else if($numStory < $total){
      /* echo json_encode($userStories[$numStory]);*/
        $story=$userStories[$numStory];
      ?>
<div class="story_player" data-mol_story="<?php echo $story->first_name.' '.$story->last_name ?>"
    data-id="<?php echo $story->story_id ?>" data-uuid="<?php echo $story->user_id ?>">
    <div class="story_bar_container" style="grid-template-columns: repeat(<?php echo $total  ?>,1fr);">
        <?php
               for($i=0;$i<$total;$i++){
                   ?>
        <div class="story_bar" style="width:<?php echo 450/$total.'px' ?>" data-occ="<?php echo $i ?>">
        </div>
        <?php
               }
               ?>
    </div>
    <img src=" <?php echo 'http://localhost/facebook/'.$story->profile_picture ?>" alt="" class="story_rounded_blue">
    <img class="story_bg_img" src="<?php echo 'http://localhost/facebook/'.$story->story_bg ?>" alt="">
    <?php
                if($story->story_text !=''){
                    ?>
    <div class="story_text_play"><?php echo $story->story_text ?></div>
    <?php
                }
                ?>
    <div class="story_viewer_btn">
        <i class="up_s_view"></i>
        <div class="total_um_viewers_story">
            <?php 
                    
                    if($story->viewers != ''){
                        $tmp=explode(',',$story->viewers);
                     array_pop($tmp);
                      $viewers=$loadUser->getStoryViewersInfosAndReacts($tmp); 
                    }
                    
                    ?>
            <?php if($story->viewers == ''){
                        echo'No viewers';

                    }else if(count($tmp) ==1){
                        echo count($tmp).' viewer';
                    }else if(count($tmp) >1){
                        echo count($tmp).' viewers';
                    }
                     ?>

        </div>
    </div>
    <div class="viewers_infos_whity">
        <div class="close_story_viewers">
            <i class="close_story_viewers_icon"></i>
        </div>
        <div class="close_story_viewers_header">Story Details
        </div>
        <div class="stories_infos_previews">
            <div class="story_3215">
                <img src="http://localhost/facebook/assets/images/stories/14.jpg" alt="" class="story_3215_bg">
            </div>
        </div>
        <div class="view_total_with_icon">
            <i class="view_icon_41545"></i>
            <span>2 Viewers</span>
        </div>
        <ul class="list_infos_story_ul_infos">
            <li>
                <div style="display: flex;align-items:center;gap:10px">
                    <img class="img_preinf14" src="http://localhost/facebook/assets/images/stories/14.jpg" alt="">
                    <div class="flex_col_preinf14">
                        <span>Abdel Dalo</span>
                        <span>Replied in mesenger</span>
                    </div>
                </div>
                <div></div>
            </li>
        </ul>
    </div>
</div>
<?php
       
    }
}