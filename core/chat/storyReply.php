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


if(isset($_POST['autoPlay'])){
    $user_id = $_POST['autoPlay'];
    $story_user = $_POST['story_user'];
    $story_id = $_POST['story_id'];
    $stories= $loadUser->getAllStoriesRanked($user_id);
  
}
if(isset($_POST['getNextStory'])){
    $user_id = $_POST['getNextStory'];
    $order = $_POST['order'];
    $next_right = $_POST['next_right'];
    $next;
    $stories= $loadUser->getAllStoriesRanked($user_id);
    $userCount=count($loadUser->getUserStories($user_id));
    
    if($order < count($stories)-1){
        if($stories[$order]->story_user != $stories[$order+1]->story_user){
            $next=true;
        }
    }
 
    if($order == count($stories)-1){
        $mainStory=$stories[$userCount];
        $total=count($loadUser->getUserStories($mainStory->user_id));
    }else{
        if($next == true){
        $mainStory=$stories[$next_right];
        $total=count($loadUser->getUserStories($mainStory->user_id));
        }else{
            $mainStory=$stories[$order+1];
            $total=count($loadUser->getUserStories($mainStory->user_id));
        }
    }
    $lyrics ="0 | When I die, fuck it, I wanna go to hell
    2 | 'Cause I'm a piece of shit, it ain't hard to fuckin' tell
    5.5 | It don't make sense, goin' to heaven with the goodie-goodies
    8 | Dressed in white, I like black Timbs and black hoodies
    11 | God'll prob'ly have me on some real strict shit
    14 | No sleepin' all day, no gettin' my dick licked";
        ?>
<div class="story_player" data-order="<?php echo $mainStory->order ?>" data-total="<?php echo count($stories) ?>"
    data-mol_story="<?php echo $mainStory->first_name.' '.$mainStory->last_name ?>"
    data-count="<?php echo $mainStory->count ?>" data-id="<?php echo $mainStory->story_id ?>"
    data-uuid="<?php echo $mainStory->user_id ?>" data-src="<?php echo $mainStory->song ?>"
    data-lyrics="<?php echo $lyrics ?>">
    <div class="story_bar_container" style="grid-template-columns: repeat(<?php echo $total  ?>,1fr);">
        <?php
               for($i=0;$i<$total;$i++){
                   ?>
        <div class="story_bar" style="width:<?php echo 450/$total.'px' ?>">
            <div class="bar_progress" data-occ="<?php echo $i ?>"></div>
        </div>
        <?php
               }
               ?>
    </div>
    <img src=" <?php echo 'http://localhost/facebook/'.$mainStory->profile_picture ?>" alt=""
        class="story_rounded_blue">
    <img class="story_bg_img" src="<?php echo 'http://localhost/facebook/'.$mainStory->story_bg ?>" alt="">*
    <div class="lyricso" style="display: none">

    </div>
    <?php
               
                if($mainStory->story_user ==$userid){

               
                ?>
    <div class="story_viewer_btn">
        <i class="up_s_view"></i>
        <div class="total_um_viewers_story">
            <?php 
                    
                    if($mainStory->viewers != ''){
                        $tmp=explode(',',$mainStory->viewers);
                     array_pop($tmp);
                      $viewers=$loadUser->getStoryViewersInfosAndReacts($tmp); 
                    }
                    
                    ?>
            <?php if($mainStory->viewers == ''){
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
            <span> <?php if($mainStory->viewers == ''){
                        echo'No viewers';

                    }else if(count($tmp) ==1){
                        echo count($tmp).' viewer';
                    }else if(count($tmp) >1){
                        echo count($tmp).' viewers';
                    }
                     ?></span>
        </div>
        <ul class="list_infos_story_ul_infos">
            <?php 
                        if($viewers !=''){

                            foreach($viewers as $viewer){
                             

                                ?>
            <li>
                <div style="display: flex;align-items:center;gap:10px">
                    <img class="img_preinf14" src="<?php echo BASE_URL.$viewer->profile_picture ?>" alt="">
                    <div class="flex_col_preinf14">
                        <span><?php echo $viewer->first_name.' '.$viewer->last_name ?></span>
                        <!-- <span>Replied in mesenger</span> -->
                    </div>
                </div>
                <div></div>
            </li>
            <?php
                        }
                    }
                        ?>
        </ul>
    </div>
    <?php  } ?>
</div>
<?php
   

}
if(isset($_POST['checkIfNextHasSameUser'])){
    $user_id = $_POST['checkIfNextHasSameUser'];
    $order = $_POST['order'];
    $stories= $loadUser->getAllStoriesRanked($user_id);
   
    if($order == count($stories)-1){
        echo 'false';
    }else if( $stories[$order]->story_user != $stories[$order+1]->story_user){
            echo 'false';
     }
    
}