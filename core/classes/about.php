<?php
class About extends User{
 
    function __construct($pdo){

        $this->pdo = $pdo;

    }

    public function overview($section,$userid,$profileid,$text,$icon){
        $userInfos=$this->getUserInfo($profileid);
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><img src="'.$icon.'" alt=""><span class="about_show">'.$userInfos->$section.'</span></div>'));

        

    }
    public function WorkEducation($section,$userid,$profileid,$text,$icon,$heading){
        $userInfos=$this->getUserInfo($profileid);
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><img src="'.$icon.'" alt=""><span class="about_show">'.$userInfos->$section.'</span></div>'));

        

    }

    public function getAboutPhone($section,$userid,$profileid,$text,$icon,$type){
        $userInfos=$this->getUserInfo($profileid);
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="display:flex;align-items:center;"><img style="width:25px;height:25px;margin-right:10px" src="'.$icon.'" alt=""><div style="display:flex;flex-direction:column;width:100%; font-family:"Segoe UI", Helvetica, Arial, sans-serif;
         "><span class="about_show" style="font-size:15px">'.$userInfos->$section.'</span><span style="font-size:12px; color:#65676b;margin-top:10px">'.$type.'</span></div>
       <div class="flexit"> <div class="edit_privary_phone"> <img class="privacyçimg" src="https://www.facebook.com/rsrc.php/v3/yi/r/7wYk0RRj5-g.png" alt=""></div> <div class="edit_phone_holder"><i class="edit_phone_icon"></i></div>
       </div></div>'));

        

    }
    public function getGender($section,$userid,$profileid,$text,$type){
        $userInfos=$this->getUserInfo($profileid);
        $icon=$userInfos->gender=='male' ? 'https://static.xx.fbcdn.net/rsrc.php/v3/yi/r/rodGQv9jZg5.png' : 'https://static.xx.fbcdn.net/rsrc.php/v3/yo/r/wfYa2HPiNGU.png';
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="display:flex;align-items:center;"><img style="width:25px;height:25px;margin-right:10px" src="'.$icon.'" alt=""><div style="display:flex;flex-direction:column;width:100%; font-family:"Segoe UI", Helvetica, Arial, sans-serif;
         "><span class="about_show" style="font-size:15px">'.$userInfos->$section.'</span><span style="font-size:12px; color:#65676b;margin-top:10px">'.$type.'</span></div>
       <div class="flexit"> <div class="edit_privary_phone"> <img class="privacyçimg" src="https://www.facebook.com/rsrc.php/v3/yi/r/7wYk0RRj5-g.png" alt=""></div> <div class="edit_phone_holder"><i class="edit_phone_icon"></i></div>
       </div></div>'));

        

    }
    public function getBirthday($section,$userid,$profileid,$text,$icon,$type){
        $userInfos=$this->getUserInfo($profileid);
        $date=date('F, d', strtotime($userInfos->birthday));
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="display:flex;align-items:center;"><img style="width:25px;height:25px;margin-right:10px" src="'.$icon.'" alt=""><div style="display:flex;flex-direction:column;width:100%; font-family:"Segoe UI", Helvetica, Arial, sans-serif;
         "><span class="about_show" style="font-size:15px">'.$date.'</span><span style="font-size:12px; color:#65676b;margin-top:10px">'.$type.'</span></div>
       <div class="flexit"> <div class="edit_privary_phone"> <img class="privacyçimg" src="https://www.facebook.com/rsrc.php/v3/yi/r/7wYk0RRj5-g.png" alt=""></div> <div class="edit_phone_holder"><i class="edit_phone_icon"></i></div>
       </div></div>'));

        

    }
    public function getBirthYear($section,$userid,$profileid,$text,$icon,$type){
        $userInfos=$this->getUserInfo($profileid);
        $date=date('Y', strtotime($userInfos->birthday));
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<div class="about-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="display:flex;align-items:center;"><div style="padding-left:2.5rem; display:flex;flex-direction:column;width:100%; font-family:"Segoe UI", Helvetica, Arial, sans-serif;
         "><span class="about_show" style="font-size:15px">'.$date.'</span><span style="font-size:12px; color:#65676b;margin-top:10px">'.$type.'</span></div>
       <div class="flexit"> <div class="edit_privary_phone"> <img class="privacyçimg" src="https://www.facebook.com/rsrc.php/v3/yI/r/aL672GHWYd3.png" alt=""></div> 
       </div></div>'));

        

    }
    public function SocialLink($section,$userid,$profileid,$text,$icon){
        $userInfos=$this->getUserInfo($profileid);
        echo (($userid != $profileid)
         ? '<span class="about_show">'.$userInfos->$section.'</span>'
        : (($userInfos->$section == '') 
        ? '<div class="about-'.$section.' about_flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><div class="add_about_icon"></div><div>'.$text.'</div></div>'
         : '<a target="_blank" href="https://www.'.$section.'.com/'.$userInfos->$section.'" class="add-'.$section.' about-flex" data-userid="'.$userid.'" data-profileid="'.$profileid.'"><img src="'.$icon.'" style="margin-right:7px" alt=""><div style="display:flex;flex-direction:column"><span class="about_show">'.$userInfos->$section.'</span> <span style="font-size:12px">'.$section.'</span></div></a>'));

        

    }

    
}



?>