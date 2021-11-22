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
<li>
    <a class="search_ind" href="<?php echo BASE_URL.'/profile.php?id='.$result->link ?>">
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
?>