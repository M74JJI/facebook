<?php

include'../load.php';
include'../../connect/login.php';

$userid=login::isLoggedIn();


if(isset($_POST['searchTerm'])){
$searchTerm=($_POST['searchTerm']);

$searchResults = $loadPost->search($searchTerm);

echo '<ul style="background-color:white;padding:10px;">';

    foreach ($searchResults as $result){

 
   
    ?>
<li data-profileid="<?php echo $result->user_id ?>" id="searched_user">
    <a class="search_ind" href="<?php echo BASE_URL.$result->link ?>">
        <img src="<?php echo BASE_URL.$result->profile_picture ?>"
            style="width:40px;height:40px;border-radius:50%;cursor:ponter;object-fit:cover;" alt="">
        <span><?php echo $result->first_name.' '.$result->last_name ?></span>
        <?php
  
       if($userid==$result->user_id){
        echo '<span class="sugg_search">You</span>';
       }else{
           echo '<span class="sugg_search">Friend</span>';
       }

       ?>
    </a>
</li>
<?php
} }
echo '</ul>';

if(isset($_POST['searchTerm1'])){
$searchTerm=($_POST['searchTerm1']);

$searchResults = $loadPost->search($searchTerm);

echo '<ul style="background-color:white;padding:10px;">';

    foreach ($searchResults as $result){

 
   
    ?>
<li class="result_user" data-profileid="<?php echo $result->user_id?>">
    <a class="search_ind">
        <img src="<?php echo BASE_URL.$result->profile_picture ?>" class="s_img"
            style="width:40px;height:40px;border-radius:50%;cursor:ponter;object-fit:cover;" alt="">
        <span class="s_name"><?php echo $result->first_name.' '.$result->last_name ?></span>
        <?php
  
       if($userid==$result->user_id){
        echo '<span class="sugg_search">You</span>';
       }else{
           echo '<span class="sugg_search">Friend</span>';
       }

       ?>
    </a>
</li>
<?php
} }
echo '</ul>';


if(isset($_POST['search_id'])){
    $search_id=($_POST['search_id']);
    $userid=($_POST['userid']);
    $loadUser->create('search',array('searched_id'=>$search_id, 'user_idd'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));
}
if(isset($_POST['updatesearchdate'])){
    $search_id=($_POST['updatesearchdate']);
    $userid=($_POST['userid']);
    $loadUser->updateSearchDate($search_id,$userid);
}

?>