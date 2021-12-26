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
    
    public function getSearchHistory($userid){
        $statement=$this->pdo->prepare("SELECT * FROM search LEFT JOIN profile ON profile.user_id=search.searched_id LEFT JOIN users ON users.id=search.searched_id WHERE user_idd=:userid
        ORDER BY createdAt DESC LIMIT 50
        ");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);                       
    }

    public function updateSearchDate($search_id,$userid){
        $date = date('Y-m-d H:i:s'); 
        $statement=$this->pdo->prepare("UPDATE search SET createdAt=:date WHERE searched_id=:search_id AND user_idd=:userid");
        $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':search_id',$search_id,PDO::PARAM_INT);
        $statement->bindValue(':date',$date);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);             
                  
    }
    public function checkSearchIfExists($search_id,$userid){

        $statement=$this->pdo->prepare("SELECT count(*) as total FROM search WHERE searched_id = :search_id AND user_idd=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':search_id',$search_id,PDO::PARAM_INT);
  
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);             
                  
    }

    public function checkifOpenChat($userid,$chatid){

        $statement=$this->pdo->prepare("SELECT um.* 
        from (select um.*,
                     row_number() over (partition by least(um.chat_id, um.user_id), greatest(um.chat_id, um.user_id) order by um.openAt desc) as seqnum
              from openchat um 
             ) um
             
        where seqnum = 1 AND chat_id=:userid AND user_id=:chatid LIMIT 1");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
  
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);             
                  
    }

    public function updateOnlineStatus($userid){
        $statement=$this->pdo->prepare("UPDATE users SET last_activity=NOW() WHERE id=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        
    }
    public function getLastMsgSendByUser($userid,$chatid){
        $statement=$this->pdo->prepare("SELECT * FROM messages WHERE sender=:userid AND receiver=:chatid ORDER BY messageAt DESC LIMIT 1");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
        
    }

   
    public function getChatList($userid){
        $statement=$this->pdo->prepare("SELECT DISTINCT messages.sender FROM messages WHERE sender!=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
        
    }
    public function getChatListWithCount($userid,$list){
        $listed=array();
        $i=0;
       foreach($list as $a){
        $statement=$this->pdo->prepare("SELECT count(*) as total FROM messages WHERE sender=:chatid AND receiver=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':chatid',$a->sender,PDO::PARAM_INT);
        $statement->execute();
        $res=$statement->fetch(PDO::FETCH_OBJ);
        $listed[$i]['chat']=$a->sender;
        $listed[$i]['count']=$res->total;
    $i++;
       }
       return $listed;
       
        
    }

    public function checkChatChanges($userid,$chatid){
        $statement=$this->pdo->prepare("SELECT count(*) as total FROM messages WHERE receiver=:userid AND sender=:chatid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
        
    }
    public function update0to1all($userid,$list){
       
        foreach($list as $l){
            $statement=$this->pdo->prepare("UPDATE messages SET status=1 WHERE receiver=:userid AND sender=:chat ORDER BY messageAt DESC
            LIMIT 1");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chat',$l->sender);
            $statement->execute();
        }
       
        
    }
    public function updateOnlinetoOffline($userid,$list){
       
        foreach($list as $l){
            $statement=$this->pdo->prepare("UPDATE online SET status=0 WHERE user_id=:userid AND chat_id=:chat ");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chat',$l->sender);
            $statement->execute();
        }
       
        
    }
    public function update1to2($msg){
       
      
            $statement=$this->pdo->prepare("UPDATE messages SET status=2 WHERE msg_id=:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);

            $statement->execute();
        
       
        
    }
    public function updateOnlineMsg($msg){
       
      
            $statement=$this->pdo->prepare("UPDATE messages SET online=1 WHERE msg_id=:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);

            $statement->execute();
        
       
        
    }
    public function updateOnlineMsg0($userid,$chatid){
       
      
            $statement=$this->pdo->prepare("UPDATE online SET status=0 WHERE  user_id=:userid AND chat_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);

            $statement->execute();
        
       
        
    }

    public function checkIfOnlineExist($userid,$chatid){
            $statement=$this->pdo->prepare("SELECT count(*) as total FROM online WHERE user_id=:userid AND chat_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
    }

    public function resetOnline($userid){
            $statement=$this->pdo->prepare("UPDATE online set status=0 WHERE user_id=:userid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->execute();
        
    }
    public function updateOnlinetoOnline($userid,$chatid){
            $statement=$this->pdo->prepare("UPDATE online set status=1 WHERE user_id=:userid AND chat_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
        
    }
    public function getOnlineStatus($userid,$chatid){
            $statement=$this->pdo->prepare("SELECT * FROM online  WHERE user_id=:userid AND chat_id=:chatid LIMIT 1");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function bdlOkfOnline($userid,$chatid){
            $statement=$this->pdo->prepare("UPDATE online set ok=1  WHERE user_id=:userid AND chat_id=:chatid LIMIT 1");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function bdlOkfOnlinel0($userid,$chatid){
            $statement=$this->pdo->prepare("UPDATE online set ok=0  WHERE user_id=:userid AND chat_id=:chatid LIMIT 1");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function rdOnline0kamlin($userid){
            $statement=$this->pdo->prepare("UPDATE online set ok=0  WHERE user_id=:userid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function checkNickname($userid,$chatid){
            $statement=$this->pdo->prepare("SELECT count(*) as total FROM nicknames WHERE user_id=:userid AND chat_id=:chatid ");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function getNicknames($userid,$chatid){
            $statement=$this->pdo->prepare("SELECT *  FROM nicknames WHERE user_id=:userid AND chat_id=:chatid LIMIT 1");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ); 
        
    }
    public function updateChatNickname($userid,$chatid,$chat_nickname){
            $statement=$this->pdo->prepare("UPDATE nicknames SET user_nickname=:chat_nickname  WHERE user_id=:userid AND chat_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->bindValue(':chat_nickname',$chat_nickname,PDO::PARAM_STR);
            $statement->execute();
 
            $statement=$this->pdo->prepare("UPDATE nicknames SET chat_nickname=:chat_nickname  WHERE user_id=:chatid AND chat_id=:userid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->bindValue(':chat_nickname',$chat_nickname,PDO::PARAM_STR);
            $statement->execute();
    
        
    }
    public function updateChatNickname2($userid,$chatid,$chat_nickname){
            $statement=$this->pdo->prepare("UPDATE nicknames SET chat_nickname=:chat_nickname  WHERE user_id=:userid AND chat_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->bindValue(':chat_nickname',$chat_nickname,PDO::PARAM_STR);
            $statement->execute();
 
            $statement1=$this->pdo->prepare("UPDATE nicknames SET user_nickname=:chat_nickname  WHERE user_id=:chatid AND chat_id=:userid");
            $statement1->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement1->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement1->bindValue(':chat_nickname',$chat_nickname,PDO::PARAM_STR);
            $statement1->execute();
    
        
    }
    public function deleteAllChat($userid,$chatid){
            $statement=$this->pdo->prepare("DELETE  FROM messages WHERE (sender=:userid AND receiver=:chatid) OR (receiver=:userid AND sender=:chatid)");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
 
        
    }
    public function getMessageById($msg){
            $statement=$this->pdo->prepare("SELECT * FROM messages WHERE msg_id=:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
 
        
    }
   
    public function checkIfForwardRecentExists($userid,$chatid){
            $statement=$this->pdo->prepare("SELECT count(*) as total FROM recentforward WHERE molchi_id=:userid AND recent_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        
    }
    public function getRecentForwards($userid){
            $statement=$this->pdo->prepare("SELECT * FROM recentforward LEFT JOIN profile ON profile.user_id =recentforward.recent_id LEFT JOIN users ON users.id=recentforward.recent_id
             WHERE molchi_id=:userid ORDER BY createdAt DESC LIMIT 5");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        
    }
    public function updateRecentForwards($userid,$chatid){
            $statement=$this->pdo->prepare("UPDATE recentforward SET createdAt=NOW() WHERE molchi_id=:userid AND recent_id=:chatid");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
            $statement->execute();
         
        
    }
    public function messageReactSender($msg,$react){
            $statement=$this->pdo->prepare("UPDATE messages SET sReact=:react WHERE msg_id =:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);
            $statement->bindValue(':react',$react,PDO::PARAM_STR);
            $statement->execute();
         
        
    }
   
    public function messageReactReceiver($msg,$react){
            $statement=$this->pdo->prepare("UPDATE messages SET rReact=:react WHERE msg_id =:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);
            $statement->bindValue(':react',$react,PDO::PARAM_STR);
            $statement->execute();
         
        
    }
   

   
    public function removeMessageUpdate($msg){
            $statement=$this->pdo->prepare("UPDATE messages SET message='You unsent a message',images='',sReact='',rReact='' WHERE msg_id =:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);
            $statement->execute();
         
        
    }
   
   
    public function removeMessage($msg){
            $statement=$this->pdo->prepare("DELETE FROM messages WHERE msg_id =:msg");
            $statement->bindValue(':msg',$msg,PDO::PARAM_INT);
            $statement->execute();
         
        
    }
   
    public function getProfilePictures($userid){
            $statement=$this->pdo->prepare("SELECT * FROM profilePictures WHERE p_user =:userid ORDER BY createdAt DESC");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
        
    }
   
    public function getCoverPictures($userid){
            $statement=$this->pdo->prepare("SELECT * FROM coverPictures WHERE p_user =:userid ORDER BY createdAt DESC");
            $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
         
        
    }
    public function getProfilePictureByImage($img,$userid){
        $statement=$this->pdo->prepare("SELECT * FROM profilePictures WHERE 
        p_user =:userid AND picture=:img LIMIT 1");
        $statement->bindValue(':img',$img,PDO::PARAM_STR);
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
     
    
}
public function getCoverPictureByImage($img,$userid){
    $statement=$this->pdo->prepare("SELECT * FROM coverpictures WHERE 
    p_user =:userid AND cover=:img LIMIT 1");
    $statement->bindValue(':img',$img,PDO::PARAM_STR);
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}
    public function updateprofilePicDate($img){
        $statement=$this->pdo->prepare("UPDATE profilePictures SET createdAt=NOW() WHERE pp=:img");
        $statement->bindValue(':img',$img,PDO::PARAM_INT);
        $statement->execute();
 
     
    
}
 
public function updatecoverPicDate($img){
    $statement=$this->pdo->prepare("UPDATE coverPictures SET createdAt=NOW() WHERE cover_id=:img");
    $statement->bindValue(':img',$img,PDO::PARAM_INT);
    $statement->execute();

 

}
 
public function resetCalls($userid){
    $statement=$this->pdo->prepare("UPDATE calls SET call_status=0 WHERE call_user=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();

 

}
public function checkForCalls($userid){
    $statement=$this->pdo->prepare("SELECT * FROM calls  WHERE call_chat=:userid AND call_status=1 LIMIT 1");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}
public function checkCallexist($userid,$chatid){
    $statement=$this->pdo->prepare("SELECT count(*) as total FROM calls WHERE call_user=:userid AND call_chat=:chatid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}

public function sendCall($userid,$chatid){
    $statement=$this->pdo->prepare("UPDATE calls SET call_status=1 WHERE call_user=:userid AND call_chat=:chatid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':chatid',$chatid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}

public function checkBeforeSendCall($userid){
    $statement=$this->pdo->prepare("SELECT count(*) as total WHERE call_user=:userid AND call_status=1 LIMIT 1");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}
public function updateNameDateChange($userid){
    $statement=$this->pdo->prepare("update users set changedNameAt=NOW() WHERE id=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();

 

}
public function updateName($userid,$first_name,$middle_name,$last_name){
    $statement=$this->pdo->prepare("

    UPDATE users SET first_name=:first_name, middle_name=:middle_name,last_name=:last_name WHERE id=:userid

    ");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':first_name',$first_name,PDO::PARAM_STR);
    $statement->bindValue(':middle_name',$middle_name,PDO::PARAM_STR);
    $statement->bindValue(':last_name',$last_name,PDO::PARAM_STR);
    $statement->execute();
    $statement1=$this->pdo->prepare("

    UPDATE profile SET first_name=:first_name, middle_name=:middle_name,last_name=:last_name WHERE user_id=:userid

    ");
    $statement1->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement1->bindValue(':first_name',$first_name,PDO::PARAM_STR);
    $statement1->bindValue(':middle_name',$middle_name,PDO::PARAM_STR);
    $statement1->bindValue(':last_name',$last_name,PDO::PARAM_STR);
    $statement1->execute();

 

}



public function checkifUsernameExist($username){
    $statement=$this->pdo->prepare("SELECT count(*) as total FROM users WHERE link=:username");
    $statement->bindValue(':username',$username,PDO::PARAM_STR);
    $statement->execute();
  return $statement->fetch(PDO::FETCH_OBJ);
 

}
public function updateUsername($userid,$username){
    $statement=$this->pdo->prepare("UPDATE users SET link=:username WHERE id=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':username',$username,PDO::PARAM_STR);
    $statement->execute();

 

}
public function updateSystems($userid,$systems){
    $statement=$this->pdo->prepare("UPDATE users SET systems=:systems WHERE id=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':systems',$systems,PDO::PARAM_STR);
    $statement->execute();

 

}
public function deleteToken($tusing){
    $statement=$this->pdo->prepare("DELETE FROM token WHERE id=:tusing");
    $statement->bindValue(':tusing',$tusing,PDO::PARAM_INT);
    $statement->execute();

 

}
public function getUserStories($userid){
    $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:userid ORDER BY createdAt");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 

}
public function getUserStoriesTotal($userid){
    $statement=$this->pdo->prepare("SELECT count(*) as total FROM stories WHERE story_user=:userid ORDER BY createdAt");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
 

}
public function getFollowingStories($userid,$mol_story){
    $tmp="";
    $occ=0;
    $stories=[];
    $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid AND follow.receiver!=:mol_story");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->bindValue(':mol_story',$mol_story,PDO::PARAM_INT);
    $statement->execute();
    $following = $statement->fetchAll(PDO::FETCH_OBJ);
   /*
    $statementme=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:userid ");
    $statementme->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statementme->execute();
    $myStories=$statementme->fetchAll(PDO::FETCH_OBJ);
    if($myStories !=''){
    for($i=0;$i<count($myStories);$i++){
        $myStories[$i]->order=$occ;
        $occ++;
        array_push($stories,$myStories[$i]);
    }    
    }
  */
    
    foreach($following as $f){
        $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:mol_story  ORDER BY createdAt ASC");
        $statement->bindValue(':mol_story',$f->receiver,PDO::PARAM_INT);
        $statement->execute();
        $data=$statement->fetchAll(PDO::FETCH_OBJ);
        for($i=0;$i<count($data);$i++){
            $data[$i]->order=$occ;
            $occ++;
            array_push($stories,$data[$i]);
        }
    }
    return $stories;
}
public function getAllStories($userid){
    $stories=[];
    $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
    $following= $statement->fetchAll(PDO::FETCH_OBJ);
    $statement2=$this->pdo->prepare("SELECT  * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user  WHERE story_user=:userid1");
    $statement2->bindValue(':userid1',$userid,PDO::PARAM_INT);
    $statement2->execute();
    $data=$statement2->fetchAll(PDO::FETCH_OBJ);
    array_push($stories,$data);
    foreach ($following as $f){
    $statement1=$this->pdo->prepare("SELECT  * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user  WHERE story_user=:userid1");
    $statement1->bindValue(':userid1',$f->receiver,PDO::PARAM_INT);
    $statement1->execute();
    $data=$statement1->fetchAll(PDO::FETCH_OBJ);
    array_push($stories,$data);
    } 
   return $stories;
}
public function myStory($userid){

    $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
   return $statement->fetchAll(PDO::FETCH_OBJ);
}

public function checkIfStory($userid){
    $statement=$this->pdo->prepare("SELECT count(*) as total FROM stories WHERE story_id=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
   return $statement->fetch(PDO::FETCH_OBJ);
}

public function checkIfStoryByUser($userid){
    $statement=$this->pdo->prepare("SELECT count(*) as total FROM stories WHERE story_user=:userid");
    $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
    $statement->execute();
   return $statement->fetch(PDO::FETCH_OBJ);
}
public function getStoryViewers($storyid){
    $statement=$this->pdo->prepare("SELECT stories.viewers FROM stories WHERE story_id=:storyid");
    $statement->bindValue(':storyid',$storyid,PDO::PARAM_INT);
    $statement->execute();
   return $statement->fetch(PDO::FETCH_OBJ);
}
public function updateStoryViewers($story_id,$viewers){
    $statement=$this->pdo->prepare("UPDATE stories SET viewers=:viewers WHERE story_id=:storyid");
    $statement->bindValue(':storyid',$story_id,PDO::PARAM_INT);
    $statement->bindValue(':viewers',$viewers,PDO::PARAM_STR);
    $statement->execute();
   
}
public function getStoryViewersInfosAndReacts($viewers){
    $infos=[];
    foreach($viewers as $viewer){
        $statement=$this->pdo->prepare("SELECT * FROM profile WHERE user_id=:viewer");
        $statement->bindValue(':viewer',$viewer,PDO::PARAM_INT);
        $statement->execute();
        $data =$statement->fetch(PDO::FETCH_OBJ);
        array_push($infos,$data);
    }
   return $infos;
}
public function getCurrentStory($story_id){
        $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile ON profile.user_id=stories.story_user WHERE story_id=:story_id LIMIT 1");
        $statement->bindValue(':story_id',$story_id,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
}

public function getNextUserStory_userid($userid){
        $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
}
public function getFollowingStories2($userid,$story_id){
        $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
}
public function getAllStoriesRanked($userid){
        $tmp="";
        $occ=0;
        $stories=[];
        $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        $following = $statement->fetchAll(PDO::FETCH_OBJ);
        
        $statementme=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:userid");
        $statementme->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statementme->execute();
        $myStories=$statementme->fetchAll(PDO::FETCH_OBJ);
        if($myStories !=''){
            for($i=0;$i<count($myStories);$i++){
                if($i==0){
                    $myStories[0]->main='yes';
                    $myStories[0]->order=$occ;
                    $myStories[0]->count=$i+1;
                    $occ++;
                    array_push($stories,$myStories[0]);
                }else{
                    
                    $myStories[$i]->order=$occ;
                    $myStories[$i]->main='no';
                    $myStories[$i]->count=$i+1;
                    $occ++;
                    array_push($stories,$myStories[$i]);
                }
            } 
        }
        
      
        
        foreach($following as $f){
            $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:mol_story ORDER BY createdAt ASC");
            $statement->bindValue(':mol_story',$f->receiver,PDO::PARAM_INT);
            $statement->execute();
            $data=$statement->fetchAll(PDO::FETCH_OBJ);
          
            
                for($i=0;$i<count($data);$i++){
                    if($i==0){
                        $data[0]->main='yes';
                        $data[0]->order=$occ;
                        $data[$i]->count=$i+1;
                        $occ++;
                        array_push($stories,$data[0]);
                    }else{

                        $data[$i]->order=$occ;
                        $data[$i]->main='no';
                        $data[$i]->count=$i+1;
                        $occ++;
                        array_push($stories,$data[$i]);
                    }
                }
            
        }
        return $stories;
        
}
public function getAllFollowingStories($userid){
        $tmp="";
        $occ=0;
        $stories=[];
        $statement=$this->pdo->prepare("SELECT DISTINCT follow.receiver FROM follow WHERE follow.sender=:userid");
        $statement->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statement->execute();
        $following = $statement->fetchAll(PDO::FETCH_OBJ);
        /*
        $statementme=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:userid");
        $statementme->bindValue(':userid',$userid,PDO::PARAM_INT);
        $statementme->execute();
        $myStories=$statementme->fetchAll(PDO::FETCH_OBJ);
        if($myStories !=''){
        for($i=0;$i<count($myStories);$i++){
            $myStories[$i]->order=$occ;
            $occ++;
            array_push($stories,$myStories[$i]);
        }    
        }
        */
      
        
        foreach($following as $f){
            $statement=$this->pdo->prepare("SELECT * FROM stories LEFT JOIN profile on profile.user_id=stories.story_user WHERE story_user=:mol_story ORDER BY createdAt DESC LIMIT 1");
            $statement->bindValue(':mol_story',$f->receiver,PDO::PARAM_INT);
            $statement->execute();
            $data=$statement->fetchAll(PDO::FETCH_OBJ);
            for($i=0;$i<count($data);$i++){
                $data[$i]->order=$occ;
                $occ++;
                array_push($stories,$data[$i]);
            }
        }
        return $stories;
        
}


                        
                    }
                    
    
       
    ?>