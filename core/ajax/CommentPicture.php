<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(0 < $_FILES['file']['error']){
    echo 'Error: '. $_FILES['file']['error'].'<br>';
}else{

    $path_directory=$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/comment/";
 
    if(!file_exists($path_directory) && !is_dir($path_directory)){
      mkdir($path_directory,0777,true); 
  } 
  move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
   
}?>

<img src="<?php echo BASE_URL.'user/'.$userid.'/comment/'.$_FILES['file']['name'] ?>" alt="">

<?php

?>