<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['check_for_calls'])){
    $userid=$_POST['check_for_calls'];
   $call= $loadUser->checkForCalls($userid);

   if($call !=''){
       $info=$loadUser->getUserInfo($call->call_chat);
      ?>
<button id="accept_call" data-username="<?php echo $info->link ?>">Answer</button>
<button>Refuse</button>
<?php
      
   }else{
       exit;
   }
}