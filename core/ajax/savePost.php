<?php

include '../load.php';       
include '../../connect/login.php';
$userid=login::isLoggedIn();

if(isset($_POST['col_name'])){
     $name=$loadUser->checkInput($_POST['col_name']);
     $userid=$_POST['userid'];
   
    if($loadUser->checkNameExist($name)==true){
        echo'<p class="col_err">Name already exists</p>';

    }else{

     $loadUser->create('collection',array('name'=>$name,'user_id'=>$userid));
     $id= $loadUser->getCollectionId($name);


     ?>

<label for="<?php echo $id->col_id ?>">
    <div style="display:flex;align-items:center;gap:8px"><img src="assets/images/later.jpg"
            style="width:50px;height:50px;border-radius:10px" alt="">
        <div class="col"><span> <?php echo $name ;?> </span>
            <div style="display:flex;align-items:center;font-weight:400;color:#65676b;font-size:14px;gap:5px">
                <div class="only_icon"></div>Only me
            </div>
        </div>
    </div>
    <input type="radio" name="save" id="<?php echo $id->col_id ?>" checked>
</label>
<?php
    }

}

if(isset($_POST['col'])){
     $col=$_POST['col'];
     $userid=$_POST['userid'];
     $postid=$_POST['postid']; 
     $loadUser->create('saved',array('user_id'=>$userid, 'post_id'=>$postid,'collection_id'=>$col));
}

                        
?>