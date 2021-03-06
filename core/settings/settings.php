<?php 

include '../load.php';
include '../../connect/login.php';
if(login::isLoggedIn()){
    $userid=login::isLoggedIn();
}



if(isset($_POST['change_name'])){
    $change_name=$_POST['change_name'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $loadUser->updateName($userid,$first_name,$middle_name,$last_name);
    $loadUser->updateNameDateChange($userid);
    echo 'updated';
}
if(isset($_POST['checkforusername'])){
    $username=$_POST['checkforusername'];
   $check= $loadUser->checkifUsernameExist($username);
    if($check->total >0){
        echo 'true';
    }else{
        echo 'false';
    }
}
if(isset($_POST['change_username'])){
    $userid=$_POST['change_username'];
    $username=$_POST['username'];
    $loadUser->updateUsername($userid,$username);
}
if(isset($_POST['show_more_os'])){
    $userid=$_POST['show_more_os'];
    $infos=$loadUser->getUserInfo($userid);
    $systems=json_decode($infos->systems);
    foreach($systems as $system){
        ?>
<div class="headed_menu_item" style="border-bottom:1px solid #dddfe2" data-tusing="<?php echo $system->tusing ?>">
    <?php 
                    if (stripos($system->os, "Windows") !== false) {
                        echo '<img src="../assets/images/settings/device-windows.png" style="width:40px">';
                    }
                    ?>
    <div class="headed_coll">
        <div class="headed_col_1">
            <?php echo $system->os ?> · <?php echo $system->location ?>
            <div class="headed_col_2"><?php echo $system->browser ?> .
                <?php echo $loadUser->timeAgo($system->time) ?></div>
        </div>
        <div class="headed_link" style="background:transparent;border:none" id="open_os_menu"><i
                class="fas fa-ellipsis-v" style="color:#90949c;font-size:15px"></i>
            <div class="logout_os_menu">
                <div class="motal_men_ous"></div>
                <a>Not You ?</a>
                <a id="log_other_os">Log out</a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<div class="headed_menu_item_èmore" id="show_less_os" style="border-bottom:1px solid #dddfe2">
    <i class="motalat_grey_m9lob"></i> Show Less
</div>
<?php
}

if(isset($_POST['show_less_os'])){
    $userid=$_POST['show_less_os'];
    $infos=$loadUser->getUserInfo($userid);
    $systems=json_decode($infos->systems);
    $i=0;
    for($i;$i<2;$i++){
        ?>
<div class="headed_menu_item" style="border-bottom:1px solid #dddfe2" data-tusing="<?php echo $systems[$i]->tusing ?>">
    <?php 
    if (stripos($systems[$i]->os, "Windows") !== false) {
        echo '<img src="../assets/images/settings/device-windows.png" style="width:40px">';
    }
    ?>
    <div class="headed_coll">
        <div class="headed_col_1">
            <?php echo $systems[$i]->os ?> · <?php echo $systems[$i]->location ?>
            <div class="headed_col_2"><?php echo $systems[$i]->browser ?> .
                <?php echo $loadUser->timeAgo($systems[$i]->time) ?></div>
        </div>
        <div class="headed_link" style="background:transparent;border:none" id="open_os_menu"><i
                class="fas fa-ellipsis-v" style="color:#90949c;font-size:15px"></i>
            <div class="logout_os_menu">
                <div class="motal_men_ous"></div>
                <a>Not You ?</a>
                <a id="log_other_os">Log out</a>
            </div>
        </div>
    </div>
</div>

<?php
    }
    ?>
<div class="headed_menu_item_èmore" id="show_more_os" style="border-bottom:1px solid #dddfe2">
    <i class="motalat_grey"></i> See More
</div>
<?php
}

if(isset($_POST['logout_other'])){
    $tusing=$_POST['logout_other'];
    $loadUser->deleteToken($tusing);
}

if(isset($_POST['check_if_loged'])){
    if(login::isLoggedIn()){
       exit;
    }else{
       echo 'logout';
    }
}