<?php

class User{
    protected $pdo;
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkInput($var){
        $var=htmlspecialchars($var);
        $var=trim($var);
        $var=stripslashes($var);
        return $var;
    }
    public function checkEmail($email_phone){
        $statement = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
        $statement->bindParam(':email',$email_phone,PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if($count>0){
            return true;
        }else{
            return false;
        }
        
    }
    public function create($table,$fields=array()){
        $columns=implode(',',array_keys($fields));
        $values=':'.implode(', :',array_keys($fields));

        $sql="INSERT INTO {$table} ({$columns}) VALUES({$values})";
        
        if($statement = $this->pdo->prepare($sql)){
            foreach($fields as $key => $data){
                $statement->bindValue(':'.$key,$data);
            }
            $statement->execute();
            return $this->pdo->lastInsertId();
        }
    }
    public function getUserId($username){
        $statement = $this->pdo->prepare('SELECT id FROM users WHERE link = :username');
        $statement->bindParam(':username',$username,PDO::PARAM_STR);
        $statement->execute();
        $user =$statement->fetch(PDO::FETCH_OBJ);
       if($user){
        return $user->id;
       }else{
           header('Location:profile.php');
       }
    }
    public function getUserInfo($id){

      $statement = $this->pdo->prepare('SELECT * from users LEFT JOIN profile ON users.id = profile.user_id WHERE users.id=:user_id');
      $statement->bindParam(':user_id',$id,PDO::PARAM_INT);
      $statement->execute();
      return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function update($table,$userid,$fields = array()){
        
        $columns="";
        $i=1;
        foreach($fields as $name => $value){
            $columns.="{$name}=:{$name}";
            if($i < count($fields)){
                $columns.=', ';
          }
          $i++;
        }
        $sql ="UPDATE {$table} SET {$columns} WHERE user_id = {$userid}";
        
          if($statement = $this->pdo->prepare($sql)){
              foreach($fields as $key => $value){
                  $statement->bindValue(':'.$key, $value);
                }
          }
          
          $statement->execute();
        }
        
        public function timeAgo($date){
            $time = strtotime($date);
            $current = time();
            $seconds = $current - $time;
            $minutes = round($seconds/60);
            $hours = round($seconds/3600); 
            $month = round($seconds/2600640);
            
            if($seconds <=60){
                if($seconds == 0){
                    return 'just now';
                }else{
                    return ''.$seconds.'s ago';
                }
            }else if($minutes <= 60){
                return ''.$minutes.' min ago';
            }else if ($hours <=24){
                return ''.$hours.' hours ago';
            }else if($month <=30){
                return ''.date('M j',$time);
            }else{
                return ''.date('J M Y',$time);
            }
        }
        
        public function timeAgoAlt($date){
            $time = strtotime($date);
            $current = time();
            $seconds = $current - $time;
            $minutes = round($seconds/60);
            $hours = round($seconds/3600); 
            $month = round($seconds/2600640);
            
            if($seconds <=60){
                if($seconds == 0){
                    return 'now';
                }else{
                    return ''.$seconds.'s ';
                }
            }else if($minutes <= 60){
                return ''.$minutes.'m ';
            }else if ($hours <=24){
                return ''.$hours.'h ';
            }else if($month <=30){
                return ''.date('M j',$time);
            }else{
                return ''.date('J M Y',$time);
            }
        }
        
        
        public function delete($table,$array){
            
            $sql ="DELETE FROM `{$table}`";
            $where = " WHERE ";
            foreach($array as $name => $value){
                $sql.= "{$where} `{$name}` = :{$name}";
                $where = " AND ";
            }
            if($stmt = $this->pdo->prepare($sql)){
                foreach($array as $name=>$value){
                    $stmt->bindValue(':'.$name,$value);
                }
            }
            
            $stmt->execute();
            
            
        }
        public function getFriendsRequestsTotal($userid){
    
          $statement = $this->pdo->prepare("SELECT count(*) as reqTotal FROM friendrequest WHERE requestStatus='0' AND requestReceiver=:userid ");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          return $statement->fetch(PDO::FETCH_OBJ);
        }
        public function friends_total($userid){
    
          $statement = $this->pdo->prepare("SELECT count(*) as total FROM friendrequest WHERE requestStatus='1' AND requestReceiver=:userid ");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          return $statement->fetch(PDO::FETCH_OBJ);
        }
        public function getFriendsRequests($userid){
          $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestStatus='0' AND requestReceiver=:userid ");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          $friend_requests = $statement->fetchAll(PDO::FETCH_OBJ);
          foreach($friend_requests as $req){
               $id= $req->requestSender;
                $infos=$this->getUserInfo($id); ?>
<div class="fri_req_card" data-userid="<?php echo $userid; ?>" data-profileid="<?php echo $infos->user_id; ?>"> <img
        src="<?php echo BASE_URL.$infos->profile_picture ?>" alt="" />
    <div class="p5"> <a href=""><?php echo $infos->first_name.' '.$infos->last_name ?></a> <button
            class="accept_req">Confirm</button>
        <button class="delete_req">Delete</button>
    </div>
</div>

<?php
                        }

                        }
        public function getFriendsRequestsAlt($userid){
          $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestStatus='0' AND requestReceiver=:userid ");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          $friend_requests = $statement->fetchAll(PDO::FETCH_OBJ);
          foreach($friend_requests as $req){
               $id= $req->requestSender;
                $infos=$this->getUserInfo($id); ?>
<div class="req_alt_card" data-userid="<?php echo $userid; ?>" data-profileid="<?php echo $infos->user_id; ?>"><a
        href="<?php echo BASE_URL.'friends/profile.php?id='.$infos->link ?>"> <img
            src="<?php echo BASE_URL.$infos->profile_picture ?>" alt=""></img></a>
    <div class="req_flexcol">
        <a href="<?php echo BASE_URL.'friends/profile.php?id='.$infos->link ?>"
            class="req_n"><?php echo $infos->first_name.' '.$infos->last_name ?></a>
        <div class="req_btnss"> <button class="accept_req">Confirm</button> <button class="delete_req">Delete</button>
        </div>
    </div>
</div>

<?php
                        }

                        }
        public function getAllFriends($userid){
          $statement = $this->pdo->prepare("          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestReceiver LEFT JOIN users ON users.id = friendrequest.requestReceiver WHERE friendrequest.requestSender =:userid AND friendrequest.requestStatus='1'
          UNION
          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestSender LEFT JOIN users ON users.id = friendrequest.requestSender WHERE friendrequest.requestReceiver =:userid AND friendrequest.requestStatus='1'");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          return $statement->fetchAll(PDO::FETCH_OBJ);
                 
                        }
        public function getAllFriends_profile($userid){
          $statement = $this->pdo->prepare("          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestReceiver LEFT JOIN users ON users.id = friendrequest.requestReceiver WHERE friendrequest.requestSender =:userid AND friendrequest.requestStatus='1'
          UNION
          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestSender LEFT JOIN users ON users.id = friendrequest.requestSender WHERE friendrequest.requestReceiver =:userid AND friendrequest.requestStatus='1'");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          $friends= $statement->fetchAll(PDO::FETCH_OBJ);
                 
         foreach($friends as $friend){?>
<div class="f_card">
    <a href="<?php echo $friend->link ?>"><img class="img" src="<?php echo $friend->profile_picture ?>" alt=""></a>
    <div class="f_crad_col">
        <span><?php echo $friend->first_name.' '.$friend->last_name ?></span>
        <span>
            <?php 
            
            if($friend->current_city!='' && $friend->country !=''){
                echo $friend->current_city.', '.$friend->country;
            }
            else if($friend->current_city!=''){
                echo $friend->current_city;
            }
            else if($friend->workplace_company!='' && $friend->workplace_position){
                echo "works as $friend->workplace_position at $friend->workplace_company";
            }
            ?>
        </span>
    </div>
    <div class="f_33"><i class="fa-solid fa-ellipsis"></i></div>
    <div class="f_popup" data-userid="<?php echo $userid?>" data-profileid="<?php echo $friend->user_id ?>">
        <div class="motalatbyad">
        </div>
        <div class="f_popup_area">
            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yU/r/oIIZ26adGMr.png" alt="">
            <span>Favorites</span>
        </div>
        <div class="f_popup_area">
            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/y_/r/y302a2iLPfV.png" alt="">
            <span> Edit Friend List</span>
        </div>
        <div class="f_popup_area">
            <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yI/r/bnvx9uLOEsq.png" alt="">
            <span> Unfollow</span>
        </div>
        <div class="f_popup_area" id="unfriendo">
            <i class="lkher">
            </i>
            <span>Unfriend</span>
        </div>

    </div>



</div>
<?php
         }




                        }
        public function getAllFriends_profileAlt($userid,$you){
          
          $statement = $this->pdo->prepare("
          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestReceiver LEFT JOIN users ON users.id = friendrequest.requestReceiver WHERE friendrequest.requestSender =:userid AND friendrequest.requestStatus='1'
          UNION
          SELECT * FROM friendrequest LEFT JOIN profile ON profile.user_id = friendrequest.requestSender LEFT JOIN users ON users.id = friendrequest.requestSender WHERE friendrequest.requestReceiver =:userid AND friendrequest.requestStatus='1'

          ");
          $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
          $statement->execute();
          $friends= $statement->fetchAll(PDO::FETCH_OBJ);
           
         foreach($friends as $friend){?>
<div class="f_card">
    <a href="<?php echo $friend->link ?>"><img class="img" src="<?php echo $friend->profile_picture ?>" alt=""></a>
    <div class="f_crad_col">
        <span><?php echo $friend->first_name.' '.$friend->last_name ?></span>
        <span class="breakthat" style="font-size:13px">
            <?php 
            
            if($friend->current_city!='' && $friend->country !=''){
                echo $friend->current_city.', '.$friend->country;
            }
            else if($friend->current_city!=''){
                echo $friend->current_city;
            }
            else if($friend->workplace_company!='' && $friend->workplace_position){
                echo "works as $friend->workplace_position at $friend->workplace_company";
            }
            ?>
        </span>

        <span><?php if($friend->user_id == $you){ echo '(You)'; } ?></span>
    </div>

    <?php 
   
      $requestCheck=$this->requestCheck($you,$friend->user_id);
      $requestConfirm=$this->requestConfirm($friend->user_id,$you);
      ?>

    <?php if($friend->user_id  == $you){ ?>

    <?php }else{ ?>
    <!------------------------------>
    <div class="request_wrap">
        <?php if(empty($requestCheck)){
                        if(empty($requestConfirm)){ ?>
        <div class="profile_add_friend1" data-userid="<?php echo $you ?>"
            data-profileid="<?php echo $friend->user_id  ?>">

            <div class="profile_add_friend_text">Add Friend</div>
        </div>
        <?php
                        }else if($requestConfirm->requestStatus=='0'){ ?>
        <div style="position: relative;" class="confirm_requests">
            <div class="profile_confirm_friend1" id="show_popup_respond">

                <div class="profile_add_friend_text">Respond</div>
            </div>
            <div class="confirm_request_popup" id="confirm_request_popup">
                <div class="confirm_request_alt1" data-userid="<?php echo $you ?>"
                    data-profileid="<?php echo $friend->user_id  ?>">Confirm</div>
                <div class="delete_request_alt1" data-userid="<?php echo $you ?>"
                    data-profileid="<?php echo $friend->user_id  ?>">Delete</div>
            </div>
        </div>


        <?php
                        }else if($requestConfirm->requestStatus=='1'){

    
                        }else{

                            
                        }
                    }else if($requestCheck->requestStatus =='0'){?>

        <div class="cancel_request_btn1" data-userid="<?php echo $you ?>"
            data-profileid="<?php echo $friend->user_id ?>">

            <div class="profile_add_friend_text">Cancel Request</div>
        </div>
        <?php 
                    }else if($requestCheck->requestStatus =='1'){ 
       
      }else{} ?>


    </div>
    <!------------------------------>

    <?php } ?>




</div>
<?php
         }





                        }
                        
                        public function CheckIfFriend($profileId,$userid){
                            $statement=$this->pdo->prepare("
                            SELECT count(*) as total FROM friendrequest WHERE friendrequest.requestReceiver=:profileid AND friendrequest.requestSender=:userid AND friendrequest.requestStatus='1' OR friendrequest.requestReceiver=:userid AND friendrequest.requestSender=:profileid AND friendrequest.requestStatus='1'");
                            $statement->bindParam(':profileid',$profileId,PDO::PARAM_INT);
                            $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
                            $statement->execute();
                            return $statement->fetch(PDO::FETCH_OBJ);
                            
                            
                        }
                        public function requestCheck($userid,$profileId){
                            $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestReceiver=:profileid AND requestSender=:userid");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
                             $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
                             $statement->execute();
                             return $statement->fetch(PDO::FETCH_OBJ);
                        }
                        public function requestConfirm($profileId,$userid){
                            $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestReceiver =:userid AND requestSender=:profileid");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
                             $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
                             $statement->execute();
                             return $statement->fetch(PDO::FETCH_OBJ);
                        }

                        public function getSavedCollections($userid){
                            $statement = $this->pdo->prepare("SELECT * FROM collection WHERE user_id=:userid");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
                             $statement->execute();
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }
                        public function getCollectionId($name){
                            $statement = $this->pdo->prepare("SELECT * FROM collection WHERE name=:name");
                             $statement->bindValue(':name',$name,PDO::PARAM_STR);
                             $statement->execute();
                             return $statement->fetch(PDO::FETCH_OBJ);
                        }
                        public function checkNameExist($name){
                            $statement=$this->pdo->prepare("SELECT name FROM collection WHERE name=:namee");
                            $statement->bindParam(':namee',$name,PDO::PARAM_STR);
                            $statement->execute();
                            $counts=$statement->rowCount();
                            if($counts>0){
                                return true;
                            } else{
                                return false;
                            }
                        }
                        public function notifications($userid){
                            $statement = $this->pdo->prepare("SELECT * FROM notifications LEFT JOIN
                             profile ON notifications.not_from = profile.user_id
                              LEFT JOIN users ON profile.user_id=users.id WHERE 
                              notifications.user=:userid  

                              ORDER BY notifications.createdAt DESC;");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
                             $statement->execute();
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }
                        public function notificationsTotal($userid){
                            $statement = $this->pdo->prepare("SELECT * FROM notifications LEFT JOIN
                             profile ON notifications.not_from = profile.user_id
                              LEFT JOIN users ON profile.user_id=users.id WHERE 
                              notifications.user=:userid AND notifications.total='0' 

                              ORDER BY notifications.createdAt DESC;");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
                             $statement->execute();
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }

                       
                        public function notificationsReset($userid){
                            $statement = $this->pdo->prepare("
                            UPDATE notifications SET total = '1' WHERE user=:userid AND total='0'
                            ");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
                             $statement->execute();
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }

                       
                        public function updateNotificationStatus($userid,$notificationid){
                            $statement = $this->pdo->prepare("
                            UPDATE notifications SET status = '1' 
                            WHERE user=:userid
                            AND not_id =:notificationid
                            AND status='0'
                            ");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
                             $statement->bindValue(':notificationid',$notificationid,PDO::PARAM_INT);
                             $statement->execute();
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }
                       
                        public function updateRequestNot($profileid,$userid){
                            $statement = $this->pdo->prepare("
                            UPDATE notifications SET friendStatus = '1', total = '0',user=:profileid,not_from=:userid
                            WHERE not_from=:profileid
                            AND user=:userid
                            
                            AND type='request'
                            ");
                             $statement->bindValue(':userid',$userid,PDO::PARAM_INT);                             
                             $statement->bindValue(':profileid',$profileid,PDO::PARAM_INT);         
                             $statement->execute();                    
                             return $statement->fetchAll(PDO::FETCH_OBJ);
                        }
                     

                       

   public function getMentions($mention,$userid){
    $stmt = $this->pdo->prepare("SELECT * FROM users
      LEFT JOIN profile  ON profile.user_id = users.id 
     WHERE 
     (users.first_name LIKE :mention OR users.last_name LIKE :mention OR users.link LIKE :mention AND user_id !=:userid)");
    $stmt->bindValue(":mention", $mention.'%');
    $stmt->bindParam(":userid", $userid,PDO::PARAM_INT);
        $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function mentionUser($ment){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE link=:ment");
    $stmt->bindParam(":ment", $ment,PDO::PARAM_STR);
        $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
    }
    




                        
                    }
                    
    
       
    ?>