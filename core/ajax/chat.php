<?php 

include '../load.php';
include '../../connect/login.php';


$userid=login::isLoggedIn();


if(isset($_POST['popup_chat'])){
    $chatid=$_POST['popup_chat'];
    $userid=$_POST['userid'];
    $chat=$loadUser->getUserInfo($chatid);   
    $messageData = $loadPost->messageData($userid,$chatid);
    $loadUser->create('openchat',array('user_id'=>$chatid,'chat_id'=>$userid,'openAt'=>date('Y-m-d H:i:s'))); 
    $full_name=$chat->first_name.' '.$chat->last_name; 
    $checkk=$loadUser->checkIfOnlineExist($userid,$chatid);
   if($checkk->total==0){
    $loadUser->create('online',array('user_id'=>$userid,'chat_id'=>$chatid,'status'=>1));
   }else{
    $loadUser->updateOnlinetoOnline($userid,$chatid);
   }
    $lastMessage = $loadUser->getLastMsgSendByUser($userid,$chatid);
    $checkkk=$loadUser->checkNickname($userid,$chatid);
    if($checkkk->total !=0){
        $nickname=$loadUser->getNicknames($userid,$chatid);
    }
 
 ?>
<div class="popup_chat" data-userid="<?php echo $userid; ?>" data-chat="<?php echo $chatid; ?>">
    <div class="chat_popup_menu" data-chat="<?php echo $chatid; ?>">
        <div class="motalinho_jnab"></div>
        <div class="chat_menu_a7a">
            <i class="messenger_icona"></i>
            Open in Messenger
        </div>
        <div class="chat_menu_a7a">
            <i class="get_icona"></i>
            Get the Messenger App
        </div>
        <a href="<?php echo BASE_URL.$chat->link; ?>" class="chat_menu_a7a">
            <i class="profile_icona"></i>
            View profile

        </a>
        <div class="line_br"></div>
        <div class="chat_menu_a7a">
            <i class="color_icona"></i>
            Color
        </div>
        <div class="chat_menu_a7a">
            <i class="emoji_icona"></i>
            Emoji
        </div>
        <div class="chat_menu_a7a" id="open_nicknames">
            <i class="nickc_icona"></i>
            Nicknames
        </div>
        <div class="line_br"></div>
        <div class="chat_menu_a7a">
            <i class="group_icona"></i>
            Create group
        </div>
        <div class="line_br"></div>
        <div class="chat_menu_a7a">
            <i class="not_icona"></i>
            Mute notifications
        </div>
        <div class="chat_menu_a7a">
            <i class="ign_icona"></i>
            Ignore messages

        </div>
        <div class="chat_menu_a7a">
            <i class="block_icona"></i>
            Block

        </div>
        <div class="line_br"></div>
        <div class="chat_menu_a7a" id="delete_chat">
            <i class="del_icona"></i>
            Delete chat
        </div>
        <div class="chat_menu_a7a">
            <i class="wr_icona"></i>
            Something's Wrong
        </div>

    </div>
    <div class="chat_header">
        <div class="left_popp" style="padding-right:1rem">
            <div style="position: relative;">
                <img src="<?php echo $chat->profile_picture ?>" alt="">
                <div class="updatem_online" data-chat="<?php echo $chatid; ?>">


                </div>
            </div>
            <?php 
              if($checkkk->total ==0){
            ?>
            <span style="word-break:keep-all;font-weight:500">
                <?php if(strlen($full_name)>13) {
                    echo substr($full_name,0,13).'...';
                } else{
                 echo $full_name;
                } ?>
            </span>
            <svg class="hnxzwevs" width="10px" height="10px" viewBox="0 0 18 10">
                <path fill="#050505" fill-rule="evenodd" clip-rule="evenodd"
                    d="M1 2.414A1 1 0 012.414 1L8.293 6.88a1 1 0 001.414 0L15.586 1A1 1 0 0117 2.414L9.707 9.707a1 1 0 01-1.414 0L1 2.414z">
                </path>
            </svg>
            <?php

              }else if($nickname != '' && $nickname->chat_nickname != NULL && $nickname->chat_nickname != ''){ ?>
            <span style="word-break:keep-all;font-weight:500;">
                <?php if(strlen($nickname->chat_nickname)>14) {
                    echo substr($nickname->chat_nickname,0,13).'...';
                } else{
                 echo $nickname->chat_nickname;
                } ?>
            </span>
            <svg class="hnxzwevs" width="10px" height="10px" viewBox="0 0 18 10">
                <path fill="#050505" fill-rule="evenodd" clip-rule="evenodd"
                    d="M1 2.414A1 1 0 012.414 1L8.293 6.88a1 1 0 001.414 0L15.586 1A1 1 0 0117 2.414L9.707 9.707a1 1 0 01-1.414 0L1 2.414z">
                </path>
            </svg>
            <?php }else{
          ?>
            <span style="word-break:keep-all;font-weight:500">
                <?php if(strlen($full_name)>13) {
                  echo substr($full_name,0,13).'...';
              } else{
               echo $full_name;
              } ?>
            </span>
            <svg class="hnxzwevs" width="10px" height="10px" viewBox="0 0 18 10">
                <path fill="#050505" fill-rule="evenodd" clip-rule="evenodd"
                    d="M1 2.414A1 1 0 012.414 1L8.293 6.88a1 1 0 001.414 0L15.586 1A1 1 0 0117 2.414L9.707 9.707a1 1 0 01-1.414 0L1 2.414z">
                </path>
            </svg>
            <?php
            }
            ?>


        </div>

        <div class="h_m_ic">
            <svg role="presentation" fill="#" width="26px" height="26px" viewBox="-5 -5 30 30">
                <path
                    d="M19.492 4.112a.972.972 0 00-1.01.063l-3.052 2.12a.998.998 0 00-.43.822v5.766a1 1 0 00.43.823l3.051 2.12a.978.978 0 001.011.063.936.936 0 00.508-.829V4.94a.936.936 0 00-.508-.828zM10.996 18A3.008 3.008 0 0014 14.996V5.004A3.008 3.008 0 0010.996 2H3.004A3.008 3.008 0 000 5.004v9.992A3.008 3.008 0 003.004 18h7.992z"
                    fill="#1437ef"></path>
            </svg>
        </div>
        <div class="h_m_ic"><svg role="presentation" width="26px" height="26px" viewBox="-5 -5 30 30">
                <path
                    d="M10.952 14.044c.074.044.147.086.22.125a.842.842 0 001.161-.367c.096-.195.167-.185.337-.42.204-.283.552-.689.91-.772.341-.078.686-.105.92-.11.435-.01 1.118.174 1.926.648a15.9 15.9 0 011.713 1.147c.224.175.37.43.393.711.042.494-.034 1.318-.754 2.137-1.135 1.291-2.859 1.772-4.942 1.088a17.47 17.47 0 01-6.855-4.212 17.485 17.485 0 01-4.213-6.855c-.683-2.083-.202-3.808 1.09-4.942.818-.72 1.642-.796 2.136-.754.282.023.536.17.711.392.25.32.663.89 1.146 1.714.475.808.681 1.491.65 1.926-.024.31-.026.647-.112.921-.11.35-.488.705-.77.91-.236.17-.226.24-.42.336a.841.841 0 00-.368 1.161c.04.072.081.146.125.22a14.012 14.012 0 004.996 4.996z"
                    fill="#1437ef"></path>
                <path class="strokesvg"
                    d="M10.952 14.044c.074.044.147.086.22.125a.842.842 0 001.161-.367c.096-.195.167-.185.337-.42.204-.283.552-.689.91-.772.341-.078.686-.105.92-.11.435-.01 1.118.174 1.926.648.824.484 1.394.898 1.713 1.147.224.175.37.43.393.711.042.494-.034 1.318-.754 2.137-1.135 1.291-2.859 1.772-4.942 1.088a17.47 17.47 0 01-6.855-4.212 17.485 17.485 0 01-4.213-6.855c-.683-2.083-.202-3.808 1.09-4.942.818-.72 1.642-.796 2.136-.754.282.023.536.17.711.392.25.32.663.89 1.146 1.714.475.808.681 1.491.65 1.926-.024.31-.026.647-.112.921-.11.35-.488.705-.77.91-.236.17-.226.24-.42.336a.841.841 0 00-.368 1.161c.04.072.081.146.125.22a14.012 14.012 0 004.996 4.996z"
                    stroke="#1437ef" fill="none"></path>
            </svg></div>
        <div class="h_m_ic"><svg width="26px" height="26px" viewBox="-4 -4 24 24">
                <line class="strokesvg" x1="2" x2="14" y1="8" y2="8" stroke-linecap="round" stroke-width="2"
                    stroke="#1437ef"></line>
            </svg></div>
        <div class="h_m_ic" id="close_chat" data-chat="<?php echo $chatid; ?>">
            <svg width="26px" height="26px" viewBox="-4 -4 24 24">
                <line class="strokesvg" x1="2" x2="14" y1="2" y2="14" stroke-linecap="round" stroke-width="2"
                    stroke="#1437ef"></line>
                <line class="strokesvg" x1="2" x2="14" y1="14" y2="2" stroke-linecap="round" stroke-width="2"
                    stroke="#1437ef"></line>
            </svg>

        </div>


    </div>
    <div class="popup_chat_area" data-chat="<?php echo $chatid; ?>">
        <div class="ar27_h">
            <img src="<?php echo $chat->profile_picture ?>" alt="">
            <div class="h27_name" style="word-break:keep-all"><?php echo $chat->first_name.' '.$chat->last_name ?></div>
            <div class="h23_det">
                You're friends on Facebook

            </div>
            <div class="h23_det">Lives in Branes, Tanger, Morocco
            </div>
            <div class="h23_det">Studied Cybersecurity & Cybercrime at ENSA de Tanger
            </div>

        </div>
        <div class="messaging_popup" data-count="<?php echo count($messageData) ?>" data-chat="<?php echo $chatid; ?>"
            data-changed="false" data-time="<?php echo $chat->last_activity ?>"> <?php foreach ($messageData as $i => $message){
        if($message->repliedTo !=''){
            $replied=$loadUser->getMessageById($message->repliedTo);
        }
                if($message->user_id == $userid){ ?>
            <div class="mess_right">
                <!---Start--------------------------------mssssg------>
                <?php 
         if($message->repliedTo !='' && $replied->images =='' && $replied->files ==''  && $replied->message !=''){
            echo "<div class='replied_messaage'>$replied->message</div>";
        }else if($message->repliedTo !='' && $replied->images !='' && $replied->files ==''){
            $imgs=json_decode($replied->images);
            $img=$imgs[0]->name;
        ?>
                <img src="<?php echo $img ?>" style="width:70px;border-radius:25px" alt="">
                <?php
        }else if($message->repliedTo !='' && $replied->images =='' && $replied->files !=''){
            $files=json_decode($replied->files);
            $name =substr($files[0]->name,14,strlen($files[0]->name));
            ?>
                <a href="<?php echo BASE_URL.$files[0]->name ?>" class="msg_file" download>
                    <div class="white_attach"> <i class="attahcfile_icon"></i> </div>
                    <?php echo $name; ?>
                </a>
                <?php 
        }
          if( $message->files != ''){
            $files=json_decode($message->files);
            if($message->message !=''){
            ?>
                <div class="mssssg"
                    style="margin-bottom:2px;<?php if($message->message=='You unsent a message'){echo 'background:transparent;color:#bcc0c4;border:1px solid #ced0d4;padding:10px;border-radius:50px';} ?>">
                    <?php echo $message->message ?></div>
                <?php
            }
                 ?>

                <div class="only_message_texto">

                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu"
                                    style="<?php if($message->message !='You unsent a message'){echo 'top:-6rem';} ?>">
                                    <div class="motalat_rem_menu"></div>
                                    <?php
                                    
                                        if($message->message !='You unsent a message' ){
                                            ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="open_forward"
                                        data-msg="<?php echo $message->msg_id ?>">Forward</button>
                                    <?php
                                            }else{
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                            }
                                   ?>
                                </div>
                            </div>
                            <?php 
                           if($message->message !='You unsent a message' ){
                               ?>
                            <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                                data-msg="<?php echo $message->message ?>"
                                data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">
                                <i class="fas fa-reply"></i>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" data-msg="<?php echo $message->msg_id ?>"
                                    style="transform:translateX(5rem)" data-sender="<?php echo $message->sender ?>"
                                    data-chat="<?php echo $message->user_id ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>

                            <?php
                           }
                           ?>



                        </div>

                    </div>
                    <?php 
          
            if($message->message!='You unsent a message'){
               echo '<div style=display:flex;flex-direction:column;gap:2px>';
             foreach($files as $file){
                 $name =substr($file->name,14,strlen($file->name));
                 ?>
                    <a href="<?php echo BASE_URL.$file->name ?>" class="msg_file" download>
                        <div class="white_attach"> <i class="attahcfile_icon"></i> </div>
                        <?php echo $name; ?>
                    </a>
                    <?php
            } 
            echo '</div>';
        }
            ?>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php
             
         }
               else if($message->images =='' && $message->message !=''){
                   
                      
                    ?>

                <div class="only_message_texto">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu"
                                    style="<?php if($message->message !='You unsent a message'){echo 'top:-6rem';} ?>">
                                    <div class="motalat_rem_menu"></div>
                                    <?php
                                    
                                        if($message->message !='You unsent a message' ){
                                            ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="open_forward"
                                        data-msg="<?php echo $message->msg_id ?>">Forward</button>
                                    <?php
                                            }else{
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                            }
                                   ?>
                                </div>
                            </div>
                            <?php 
                           if($message->message !='You unsent a message' ){
                               ?>
                            <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                                data-msg="<?php echo $message->message ?>"
                                data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">
                                <i class="fas fa-reply"></i>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper"
                                    style=" <?php if(strlen($message->message)>7 && strlen($message->message)<16){echo 'left:-6.5rem';}else if(strlen($message->message)>16){echo 'left:-2rem';} ?>"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-chat="<?php echo $message->user_id ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>

                            <?php
                           }
                           ?>



                        </div>

                    </div>
                    <div class="mssssg"
                        style="<?php if($message->message=='You unsent a message'){echo 'background:transparent;color:#bcc0c4;border:1px solid #ced0d4;padding:10px;border-radius:50px';} ?>">
                        <?php echo $message->message ?></div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php
                }else if($message->images != '' && $message->message==''){
                    $images=json_decode($message->images);
                    
                     
                    if(count($images)==1){
                        ?>
                <div class="images_in_messages_1">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>

                <?php 
                    }
                    else if(count($images)==2){
                        ?>
                <div class="images_in_messages_2">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==3){
                        ?>
                <div class="images_in_messages_3">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <img class="img" src="<?php echo $images[0]->name ?>" alt="" style="width:180px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==4){
                        ?>
                <div class="images_in_messages_4">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==5){
                        ?>
                <div class="images_in_messages_5">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[4]->name ?>" alt="" style="width:60px">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else {
                        ?>
                <div class="images_in_messages_6">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div class="gridm_6">

                        <?php 
          foreach ($images as $img){
            ?>
                        <img class="imgg" src="<?php echo $img->name ?>" alt="">
                        <?php
        }
                ?>

                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>

                </div>
                <?php 
                    }
                    
                }else if($message->message !='' && $message->images !=''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?>
                <div class="mssssg" style="width:fit-content;float:right;">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_1" style="margin-top:2px">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==2){
                        ?> <div class="mssssg" style="width:fit-content;float:right">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_2" style="margin-top:2px">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==3){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_3" style="margin-top:2px">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <img class="img" src="<?php echo $images[0]->name ?>" alt="" style="width:180px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==4){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_4" style="margin-top:2px">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">

                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==5){
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_5" style="margin-top:2px">
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div style="display:flex;flex-direction:column;gap:2px">

                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[4]->name ?>" alt="" style="width:60px">
                        </div>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else {
                        ?> <div class="mssssg" style="width:fit-content;float:right;margin-bottom:5px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_6" style="margin-top:2px">

                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <div class="dots_msg_rem" style="position:relative;" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-2.8rem) translateX(1px);">
                                    <div class="motalat_rem_menu"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(7rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>



                        </div>
                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>

                    </div>
                    <div class="gridm_6">
                        <?php 
                foreach ($images as $img){
                    ?>
                        <img class="imgg" src="<?php echo $img->name ?>" alt="">
                        <?php
                }
                ?>
                    </div>
                    <div class="msg_reactss">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>


                <!---End-------------------------------------->
                <?php



              /*  if($i<count($messageData)-1 && strtotime($message->messageAt) - strtotime($messageData[$i+1]->messageAt)>-5000){
                    ?>
                <div class="timeit"><?php echo $loadUser->timeAgoAlt($message->messageAt) ?></div>

                <?php }else{}*/
                    if($lastMessage->msg_id == $message->msg_id && $i==count($messageData)-1){
                ?>
                <div class="update_seen_or" data-chat="<?php echo $chatid ?>">
                    <?php
                    if($lastMessage->status ==0){
                        ?>
                    <div class="not_seen">
                        <svg fill="#cdd0d3" height="14px" width="14px" viewBox="2 2 20 20" role="img"
                            data-testid="message_delivery_state_sent" xmlns="http://www.w3.org/2000/svg">
                            <title>Sent</title>
                            <path
                                d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm0 18.5a8.5 8.5 0 1 1 8.5-8.5 8.51 8.51 0 0 1 -8.5 8.5z">
                            </path>
                            <path
                                d="m15.982 8.762-5.482 5.487-2.482-2.478a.75.75 0 0 0 -1.06 1.06l3.008 3.008a.748.748 0 0 0 1.06 0l6.016-6.016a.75.75 0 0 0 -1.06-1.061z">
                            </path>
                        </svg>

                    </div>
                    <?php
                    }else if($lastMessage->status==1){
                        ?>
                    <div class="not_seen">
                        <svg fill="#cdd0d3" height="14px" width="14px" viewBox="2 2 20 20" role="img"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Delivered</title>
                            <path
                                d="m12 2a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm5.219 8-6.019 6.016a1 1 0 0 1 -1.414 0l-3.005-3.008a1 1 0 1 1 1.419-1.414l2.3 2.3 5.309-5.31a1 1 0 1 1 1.41 1.416z">
                            </path>
                        </svg>
                    </div>
                    <?php
                    }else if($lastMessage->status==2){
                        ?>
                    <div class="not_seen">
                        <img class="seen_message" src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="">
                    </div>
                    <?php
                    }
                     
                     ?>
                </div>
                <?php } ?>
            </div>

            <?php  }else{ ?>

            <!---Left Side--------------------------------mssssg------>


            <div class="mess_left">
                <!---Start--------------------------------mssssg------>
                <?php 
         if($message->repliedTo !='' && $replied->images =='' && $replied->files ==''  && $replied->message !=''){
            echo "<div class='replied_messaage'>$replied->message</div>";
        }else if($message->repliedTo !='' && $replied->images !='' && $replied->files ==''){
            $imgs=json_decode($replied->images);
            $img=$imgs[0]->name;
        ?>
                <img src="<?php echo $img ?>" style="width:70px;border-radius:25px" alt="">
                <?php
        }else if($message->repliedTo !='' && $replied->images =='' && $replied->files !=''){
            $files=json_decode($replied->files);
            $name =substr($files[0]->name,14,strlen($files[0]->name));
            ?>
                <a href="<?php echo BASE_URL.$files[0]->name ?>" class="msg_file" style="margin-left:36px;" download>
                    <div class="white_attach"> <i class="attahcfile_icon"></i> </div>
                    <?php echo $name; ?>
                </a>
                <?php 
        }
        if( $message->files != ''){
            $files=json_decode($message->files);
            if($message->message !=''){
            ?>
                <div class="mssssg"
                    style="margin-bottom:2px;margin-left:36px;<?php if($message->message=='You unsent a message'){echo 'background:transparent;color:#bcc0c4;border:1px solid #ced0d4;padding:10px;border-radius:50px';} ?>">
                    <?php echo $message->message ?></div>
                <?php
            }
                 ?>

                <div class="only_message_texto">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img"
                        style="align-self:center" alt="">

                    <?php 
          
            if($message->message!='You unsent a message'){
               echo '<div style=display:flex;flex-direction:column;gap:2px>';
             foreach($files as $file){
                 $name =substr($file->name,14,strlen($file->name));
                 ?>
                    <a href="<?php echo BASE_URL.$file->name ?>" class="msg_file" download>
                        <div class="white_attach"> <i class="attahcfile_icon"></i> </div>
                        <?php echo $name; ?>
                    </a>
                    <?php
            } 
            echo '</div>';
        }
            ?>
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">

                            <?php 
                           if($message->message !='You unsent a message' ){
                               ?>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" data-msg="<?php echo $message->msg_id ?>"
                                    style="transform:translateX(1rem)" data-sender="<?php echo $message->sender ?>"
                                    data-chat="<?php echo $message->user_id ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                                data-msg="<?php echo $message->message ?>"
                                data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">
                                <i class="fas fa-reply"></i>
                            </div>


                            <?php
                           }
                           ?>
                            <div class="dots_msg_rem" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu"
                                    style="transform:translateX(-2rem);<?php if($message->message !='You unsent a message'){echo 'top:-6rem';} ?>">
                                    <div class="motalat_rem_menu_files"></div>
                                    <?php
                                    
                                        if($message->message !='You unsent a message' ){
                                            ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="open_forward"
                                        data-msg="<?php echo $message->msg_id ?>">Forward</button>
                                    <?php
                                            }else{
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                            }
                                   ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php
             
         }
                else if($message->images =='' && $message->message !=''){
                ?>
                <div class="only_message_texto">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img_bla_edn" alt="">
                    <div class="mssssg"
                        style="<?php if($message->message=='You unsent a message'){echo 'background:transparent;color:#bcc0c4;border:1px solid #ced0d4;padding:10px;border-radius:50px';} ?>">
                        <?php echo $message->message ?></div>
                    <div class="message_manipulation">
                        <div class="hidddem_bitch">
                            <?php 
                           if($message->message !='You unsent a message' ){
                               ?>
                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper"
                                    style=" <?php if(strlen($message->message)<8){echo 'left:-4rem';} else if(strlen($message->message)>8 && strlen($message->message)<16 ){echo 'left:-6rem';} else if(strlen($message->message)>16){echo 'left:-9rem';} ?>"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-chat="<?php echo $message->user_id ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                                data-msg="<?php echo $message->message ?>"
                                data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">
                                <i class="fas fa-reply"></i>
                            </div>


                            <?php
                           }
                           ?>
                            <div class="dots_msg_rem" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu"
                                    style="<?php if($message->message !='You unsent a message'){echo 'top:-6rem';} ?>">
                                    <div class="motalat_rem_menu"></div>
                                    <?php
                                    
                                        if($message->message !='You unsent a message' ){
                                            ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="open_forward"
                                        data-msg="<?php echo $message->msg_id ?>">Forward</button>
                                    <?php
                                            }else{
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                            }
                                   ?>
                                </div>
                            </div>




                        </div>

                    </div>
                    <div class="msg_reactss1" style="left:35px">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php
                }else if($message->images != '' && $message->message==''){
                    $images=json_decode($message->images);
                     
                    if(count($images)==1){
                        ?>
                <div class="images_in_messages_1">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <img class="img_left" src="<?php echo $images[0]->name ?>" alt="">
                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==2){
                        ?>
                <div class="images_in_messages_2">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==3){
                        ?>
                <div class="images_in_messages_3">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <img class="img" src="<?php echo $images[0]->name ?>" style="width:180px" alt="">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==4){
                        ?>
                <div class="images_in_messages_4">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==5){
                        ?>
                <div class="images_in_messages_5">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[4]->name ?>" alt="" style="width:60px">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                                if($message->message !='You unsent a message'){
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                                }else{
                                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                                }
                                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                        }else if($message->rReact != '' && $message->sReact==NULL){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                        }else if($message->rReact != '' && $message->sReact!=''){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else {
                        ?>
                <div class="images_in_messages_6">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div class="gridm_6">
                        <?php 
                foreach ($images as $img){
                    ?>
                        <img class="imgg" src=" <?php echo $img->name ?>" alt="">
                        <?php 

                }
                ?>

                    </div>



                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                                                if($message->message !='You unsent a message'){
                                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                                                }else{
                                                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                                                }
                                                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                                        }else if($message->rReact != '' && $message->sReact==NULL){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                                        }else if($message->rReact != '' && $message->sReact!=''){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                                                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    
                }else if($message->message !='' && $message->images !=''){
                    $images=json_decode($message->images);
                    
                    if(count($images)==1){
                        ?>
                <div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_1">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <img class="img_left" src="<?php echo $images[0]->name ?>" alt="">
                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==2){
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_2">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                    <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==3){
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_3">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <img class="img" src="<?php echo $images[0]->name ?>" style="width:180px" alt="">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==4){
                        ?> <div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_4">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                if($message->message !='You unsent a message'){
                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                }else{
                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact==NULL){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                        }else if($message->rReact != '' && $message->sReact!=''){
                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else if(count($images)==5){
                        ?><div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_5">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div style="display:flex;flex-direction:column;gap:2px">
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[0]->name ?>" alt="">
                            <img class="img" src="<?php echo $images[1]->name ?>" alt="">
                        </div>
                        <div style="display:flex;align-items:center;gap:2px">
                            <img class="img" src="<?php echo $images[2]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[3]->name ?>" alt="" style="width:60px">
                            <img class="img" src="<?php echo $images[4]->name ?>" alt="" style="width:60px">
                        </div>
                    </div>


                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                                if($message->message !='You unsent a message'){
                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                                }else{
                                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                                }
                                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                        }else if($message->rReact != '' && $message->sReact==NULL){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                        }else if($message->rReact != '' && $message->sReact!=''){
                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                                        } ?>
                    </div>
                </div>
                <?php 
                    }
                    else {
                        ?><div class="mssssg1" style="width:fit-content;float:left;margin-left:26px">
                    <?php echo $message->message ?></div>
                <div class="images_in_messages_6">
                    <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
                    <div class="gridm_6">
                        <?php 
                foreach ($images as $img){
                    ?>
                        <img class="imgg" src=" <?php echo $img->name ?>" alt="">
                        <?php 

                }
                ?>

                    </div>



                    <div class="message_manipulation">

                        <div class="msg_kk_hold" id="open_forward" data-msg="<?php echo $message->msg_id ?>">
                            <img class="a99a_mg" src="assets/svg/share-outline.png" alt="">
                        </div>
                        <div class="hidddem_bitch">

                            <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                                <div class="msg_kk_hold">
                                    <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                                </div>
                                <div class="react_msg_wrapper" style="transform:translateX(-2rem) translateY(-7px)"
                                    data-msg="<?php echo $message->msg_id ?>"
                                    data-sender="<?php echo $message->sender ?>"
                                    data-receiver="<?php echo $message->receiver ?>">
                                    <img class="react_msg_icon" src="assets/images/msg/love.png" alt=""
                                        id="click-msg-love">
                                    <img class="react_msg_icon" src="assets/images/msg/haha.png" alt=""
                                        id="click-msg-haha">
                                    <img class="react_msg_icon" src="assets/images/msg/wow.png" alt=""
                                        id="click-msg-wow">
                                    <img class="react_msg_icon" src="assets/images/msg/sad.png" alt=""
                                        id="click-msg-sad">
                                    <img class="react_msg_icon" src="assets/images/msg/angry.png" alt=""
                                        id="click-msg-angry">
                                    <img class="react_msg_icon" src="assets/images/msg/like.png" alt=""
                                        id="click-msg-like">
                                </div>
                            </div>
                            <div class="dots_msg_rem" style="position:relative;margin-left:4px" id="open_msg_ots">
                                <div class=" msg_kk_hold">
                                    <img class="a99a_mg" style="width:14px" src="assets/svg/dots.png" alt="">
                                </div>
                                <div class="msg_rem_menu" style="transform: translateY(-3.2rem) translateX(-3.8rem);">
                                    <div class="motalat_rem_menu1"></div>
                                    <?php 
                                                                if($message->message !='You unsent a message'){
                                                                ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="unsend_msg">Remove</button>
                                    <button data-msg="<?php echo $message->message ?>" id="reply_msg"
                                        data-msg_id="<?php echo $message->msg_id ?>"
                                        data-msg="<?php echo $message->message ?>"
                                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>">Reply</button>
                                    <?php
                                                                }else{
                                                                    ?>
                                    <button data-msg="<?php echo $message->msg_id ?>" id="remove_msg">Remove</button>
                                    <?php
                                                                }
                                                                ?>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="msg_reactss1">
                        <?php if($message->sReact != '' && $message->rReact==NULL){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                                        }else if($message->rReact != '' && $message->sReact==NULL){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  1</span>';
                                                        }else if($message->rReact != '' && $message->sReact!=''){
                                                            echo '<img src="'.BASE_URL.'assets/images/msg/'.$message->rReact.'.png" alt=""><img src="'.BASE_URL.'assets/images/msg/'.$message->sReact.'.png" alt=""><span style="font-size:11px;margin-left:5px;color:#222">  2</span>';
                                                        } ?>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>


                <!---End-------------------------------------->


            </div>

            <?php  }
                ?>


            <?php  } ?>

        </div>



    </div>
    <div class="more_plus_wrapper">
        <div class="more_plus_hold">
            <svg viewBox="0 -1 17 17" height="20px" width="20px" class="a8c37x1j ms05siws hr662l2t b7h9ocf4">
                <g fill="none" fill-rule="evenodd">
                    <path
                        d="M2.882 13.13C3.476 4.743 3.773.48 3.773.348L2.195.516c-.7.1-1.478.647-1.478 1.647l1.092 11.419c0 .5.2.9.4 1.3.4.2.7.4.9.4h.4c-.6-.6-.727-.951-.627-2.151z"
                        fill="#050505"></path>
                    <circle fill="#050505" cx="8.5" cy="4.5" r="1.5"></circle>
                    <path
                        d="M14 6.2c-.2-.2-.6-.3-.8-.1l-2.8 2.4c-.2.1-.2.4 0 .6l.6.7c.2.2.2.6-.1.8-.1.1-.2.1-.4.1s-.3-.1-.4-.2L8.3 8.3c-.2-.2-.6-.3-.8-.1l-2.6 2-.4 3.1c0 .5.2 1.6.7 1.7l8.8.6c.2 0 .5 0 .7-.2.2-.2.5-.7.6-.9l.6-5.9L14 6.2z"
                        fill="#050505"></path>
                    <path
                        d="M13.9 15.5l-8.2-.7c-.7-.1-1.3-.8-1.3-1.6l1-11.4C5.5 1 6.2.5 7 .5l8.2.7c.8.1 1.3.8 1.3 1.6l-1 11.4c-.1.8-.8 1.4-1.6 1.3z"
                        stroke="#050505" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
        </div>
        <div class="more_plus_hold"><svg x="0px" y="0px" viewBox="0 0 17 16" height="20px" width="20px"
                class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji">
                <g fill-rule="evenodd">
                    <circle fill="none" cx="5.5" cy="5.5" r="1"></circle>
                    <circle fill="none" cx="11.5" cy="4.5" r="1"></circle>
                    <path
                        d="M5.3 9c-.2.1-.4.4-.3.7.4 1.1 1.2 1.9 2.3 2.3h.2c.2 0 .4-.1.5-.3.1-.3 0-.5-.3-.6-.8-.4-1.4-1-1.7-1.8-.1-.2-.4-.4-.7-.3z"
                        fill="none"></path>
                    <path
                        d="M10.4 13.1c0 .9-.4 1.6-.9 2.2 4.1-1.1 6.8-5.1 6.5-9.3-.4.6-1 1.1-1.8 1.5-2 1-3.7 3.6-3.8 5.6z"
                        fill="#050505"></path>
                    <path
                        d="M2.5 13.4c.1.8.6 1.6 1.3 2 .5.4 1.2.6 1.8.6h.6l.4-.1c1.6-.4 2.6-1.5 2.7-2.9.1-2.4 2.1-5.4 4.5-6.6 1.3-.7 1.9-1.6 1.9-2.8l-.2-.9c-.1-.8-.6-1.6-1.3-2-.7-.5-1.5-.7-2.4-.5L3.6 1.5C1.9 1.8.7 3.4 1 5.2l1.5 8.2zm9-8.9c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1zm-3.57 6.662c.3.1.4.4.3.6-.1.3-.3.4-.5.4h-.2c-1-.4-1.9-1.3-2.3-2.3-.1-.3.1-.6.3-.7.3-.1.5 0 .6.3.4.8 1 1.4 1.8 1.7zM5.5 5.5c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1z"
                        fill="#050505" fill-rule="nonzero"></path>
                </g>
            </svg></div>
        <div class="more_plus_hold"><svg x="0px" y="0px" viewBox="0 0 16 16" height="20px" width="20px"
                class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji">
                <path
                    d="M.783 12.705c.4.8 1.017 1.206 1.817 1.606 0 0 1.3.594 2.5.694 1 .1 1.9.1 2.9.1s1.9 0 2.9-.1 1.679-.294 2.479-.694c.8-.4 1.157-.906 1.557-1.706.018 0 .4-1.405.5-2.505.1-1.2.1-3 0-4.3-.1-1.1-.073-1.976-.473-2.676-.4-.8-.863-1.408-1.763-1.808-.6-.3-1.2-.3-2.4-.4-1.8-.1-3.8-.1-5.7 0-1 .1-1.7.1-2.5.5s-1.417 1.1-1.817 1.9c0 0-.4 1.484-.5 2.584-.1 1.2-.1 3 0 4.3.1 1 .2 1.705.5 2.505zm10.498-8.274h2.3c.4 0 .769.196.769.696 0 .5-.247.68-.747.68l-1.793.02.022 1.412 1.252-.02c.4 0 .835.204.835.704s-.442.696-.842.696H11.82l-.045 2.139c0 .4-.194.8-.694.8-.5 0-.7-.3-.7-.8l-.031-5.631c0-.4.43-.696.93-.696zm-3.285.771c0-.5.3-.8.8-.8s.8.3.8.8l-.037 5.579c0 .4-.3.8-.8.8s-.8-.4-.8-.8l.037-5.579zm-3.192-.825c.7 0 1.307.183 1.807.683.3.3.4.7.1 1-.2.4-.7.4-1 .1-.2-.1-.5-.3-.9-.3-1 0-2.011.84-2.011 2.14 0 1.3.795 2.227 1.695 2.227.4 0 .805.073 1.105-.127V8.6c0-.4.3-.8.8-.8s.8.3.8.8v1.8c0 .2.037.071-.063.271-.7.7-1.57.991-2.47.991C2.868 11.662 1.3 10.2 1.3 8s1.704-3.623 3.504-3.623z"
                    fill="#050505" fill-rule="nonzero"></path>
            </svg></div>
        <input type="file" id="attach_file" multiple="multiple" style="display: none"
            data-chat="<?php echo $chatid; ?>">
        <div class="more_plus_hold" id="open_attach_files">
            <i class="attach_files_icon"></i>
        </div>
        <div class="more_plus_hold">
            <i class="video_icon_plus"></i>
        </div>
        <div class="more_plus_hold">
            <i class="microphone_icon_plus"></i>
        </div>
    </div>
    <div class="reply_wrapper">

    </div>
    <div class="chat_errors_container" data-chat="<?php echo $chatid; ?>">
        <svg class="unavailable_svg" viewBox="0 0 24 24" height="20px" width="20px" fill="#bcc0c4">
            <g fill-rule="evenodd">
                <polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                <path
                    d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12">
                </path>
            </g>
        </svg>
        <div class="preview_sender_bitch">
            <div class="overflowee">
                <div class="imginos_preview">
                    <div class="add_pc_i_more" id="open_send_file" data-chat="<?php echo $chatid; ?>">
                        <i class="a7atahona"></i>
                    </div>
                </div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0 5px;">
                <input type="text" class="input_img_text" data-chat="<?php echo $chatid; ?>" placeholder="Aa">
                <div class="round_cuck">
                    <i class="fas fa-smile"></i>
                </div>
            </div>
        </div>
        <div class="round_cuck" id="send_msg_and_img" data-chat="<?php echo $chatid; ?>">
            <svg fill="#00b2ff" width="20px" height="20px" viewBox="0 0 24 24">
                <path
                    d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 C22.8132856,11.0605983 22.3423792,10.4322088 21.714504,10.118014 L4.13399899,1.16346272 C3.34915502,0.9 2.40734225,1.00636533 1.77946707,1.4776575 C0.994623095,2.10604706 0.8376543,3.0486314 1.15159189,3.99121575 L3.03521743,10.4322088 C3.03521743,10.5893061 3.34915502,10.7464035 3.50612381,10.7464035 L16.6915026,11.5318905 C16.6915026,11.5318905 17.1624089,11.5318905 17.1624089,12.0031827 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z"
                    fill-rule="evenodd" stroke="none"></path>
            </svg>
        </div>

    </div>
    <div class="attach_files_wrapper" data-chat="<?php echo $chatid; ?>">

        <svg class="unavailable_svg" viewBox="0 0 24 24" height="20px" width="20px" fill="#bcc0c4">
            <g fill-rule="evenodd">
                <polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                <path
                    d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12">
                </path>
            </g>
        </svg>
        <div class="preview_sender_bitch">
            <div class="overflowee">
                <div class="imginos_preview">
                    <div class="add_pc_i_more" id="open_attach_files" data-chat="<?php echo $chatid; ?>">
                        <i class="a7atahona"></i>
                    </div>
                </div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0 5px;">
                <input type="text" class="input_img_text" data-chat="<?php echo $chatid; ?>" placeholder="Aa">
                <div class="round_cuck">
                    <i class="fas fa-smile"></i>
                </div>
            </div>
        </div>
        <div class="round_cuck" id="send_msg_and_files" data-chat="<?php echo $chatid; ?>">
            <svg fill="#00b2ff" width="20px" height="20px" viewBox="0 0 24 24">
                <path
                    d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 C22.8132856,11.0605983 22.3423792,10.4322088 21.714504,10.118014 L4.13399899,1.16346272 C3.34915502,0.9 2.40734225,1.00636533 1.77946707,1.4776575 C0.994623095,2.10604706 0.8376543,3.0486314 1.15159189,3.99121575 L3.03521743,10.4322088 C3.03521743,10.5893061 3.34915502,10.7464035 3.50612381,10.7464035 L16.6915026,11.5318905 C16.6915026,11.5318905 17.1624089,11.5318905 17.1624089,12.0031827 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z"
                    fill-rule="evenodd" stroke="none"></path>
            </svg>
        </div>

    </div>


    <input type="file" id="send_file" multiple="multiple" style="display: none" data-chat="<?php echo $chatid; ?>">
    <div class="popu_char_a7em" data-chat="<?php echo $chatid; ?>">
        <div class="m14_left">
            <div class="m24_icon hide_hid" id="close_plus_chat_menu" style="transform:rotate(44deg)">
                <svg viewBox="0 0 24 24" height="20px" width="20px"
                    class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji nrzfhe1q">
                    <g fill-rule="evenodd">
                        <polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                        <path
                            d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12">
                        </path>
                    </g>
                </svg>
            </div>
            <div class="m24_icon hide_plus" id="open_plus_chat_menu" data-chat="<?php echo $chatid; ?>">
                <svg viewBox="0 0 24 24" height="20px" width="20px">
                    <g fill-rule="evenodd">
                        <polygon class="strokesvg" fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                        <path
                            d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12">
                        </path>
                    </g>
                </svg>
            </div>

            <div class="m24_icon hide_plus" id="open_send_file" data-chat="<?php echo $chatid; ?>">
                <svg viewBox="0 0 24 24" width="20px" height="20px">
                    <g fill-rule="evenodd" transform="translate(-444 -156)">
                        <g>
                            <path
                                d="m96.968 22.425-.648.057a2.692 2.692 0 0 1-1.978-.625 2.69 2.69 0 0 1-.96-1.84L92.01 4.32a2.702 2.702 0 0 1 .79-2.156c.47-.472 1.111-.731 1.774-.79l2.58-.225a.498.498 0 0 1 .507.675 4.189 4.189 0 0 0-.251 1.11L96.017 18.85a4.206 4.206 0 0 0 .977 3.091s.459.364-.026.485m8.524-16.327a1.75 1.75 0 1 1-3.485.305 1.75 1.75 0 0 1 3.485-.305m5.85 3.011a.797.797 0 0 0-1.129-.093l-3.733 3.195a.545.545 0 0 0-.062.765l.837.993a.75.75 0 1 1-1.147.966l-2.502-2.981a.797.797 0 0 0-1.096-.12L99 14.5l-.5 4.25c-.06.674.326 2.19 1 2.25l11.916 1.166c.325.026 1-.039 1.25-.25.252-.21.89-.842.917-1.166l.833-8.084-3.073-3.557z"
                                transform="translate(352 156.5)"></path>
                            <path fill-rule="nonzero"
                                d="m111.61 22.963-11.604-1.015a2.77 2.77 0 0 1-2.512-2.995L98.88 3.09A2.77 2.77 0 0 1 101.876.58l11.603 1.015a2.77 2.77 0 0 1 2.513 2.994l-1.388 15.862a2.77 2.77 0 0 1-2.994 2.513zm.13-1.494.082.004a1.27 1.27 0 0 0 1.287-1.154l1.388-15.862a1.27 1.27 0 0 0-1.148-1.37l-11.604-1.014a1.27 1.27 0 0 0-1.37 1.15l-1.387 15.86a1.27 1.27 0 0 0 1.149 1.37l11.603 1.016z"
                                transform="translate(352 156.5)"></path>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="m24_icon hide_plus">
                <svg x="0px" y="0px" viewBox="0 0 17 16" height="20px" width="20px">
                    <g fill-rule="evenodd">
                        <circle fill="none" cx="5.5" cy="5.5" r="1"></circle>
                        <circle fill="none" cx="11.5" cy="4.5" r="1"></circle>
                        <path
                            d="M5.3 9c-.2.1-.4.4-.3.7.4 1.1 1.2 1.9 2.3 2.3h.2c.2 0 .4-.1.5-.3.1-.3 0-.5-.3-.6-.8-.4-1.4-1-1.7-1.8-.1-.2-.4-.4-.7-.3z"
                            fill="none"></path>
                        <path
                            d="M10.4 13.1c0 .9-.4 1.6-.9 2.2 4.1-1.1 6.8-5.1 6.5-9.3-.4.6-1 1.1-1.8 1.5-2 1-3.7 3.6-3.8 5.6z">
                        </path>
                        <path
                            d="M2.5 13.4c.1.8.6 1.6 1.3 2 .5.4 1.2.6 1.8.6h.6l.4-.1c1.6-.4 2.6-1.5 2.7-2.9.1-2.4 2.1-5.4 4.5-6.6 1.3-.7 1.9-1.6 1.9-2.8l-.2-.9c-.1-.8-.6-1.6-1.3-2-.7-.5-1.5-.7-2.4-.5L3.6 1.5C1.9 1.8.7 3.4 1 5.2l1.5 8.2zm9-8.9c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1zm-3.57 6.662c.3.1.4.4.3.6-.1.3-.3.4-.5.4h-.2c-1-.4-1.9-1.3-2.3-2.3-.1-.3.1-.6.3-.7.3-.1.5 0 .6.3.4.8 1 1.4 1.8 1.7zM5.5 5.5c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1z"
                            fill-rule="nonzero"></path>
                    </g>
                </svg>
            </div>
            <div class="m24_icon hide_plus">
                <svg x="0px" y="0px" viewBox="0 0 16 16" height="20px" width="20px">
                    <path
                        d="M.783 12.705c.4.8 1.017 1.206 1.817 1.606 0 0 1.3.594 2.5.694 1 .1 1.9.1 2.9.1s1.9 0 2.9-.1 1.679-.294 2.479-.694c.8-.4 1.157-.906 1.557-1.706.018 0 .4-1.405.5-2.505.1-1.2.1-3 0-4.3-.1-1.1-.073-1.976-.473-2.676-.4-.8-.863-1.408-1.763-1.808-.6-.3-1.2-.3-2.4-.4-1.8-.1-3.8-.1-5.7 0-1 .1-1.7.1-2.5.5s-1.417 1.1-1.817 1.9c0 0-.4 1.484-.5 2.584-.1 1.2-.1 3 0 4.3.1 1 .2 1.705.5 2.505zm10.498-8.274h2.3c.4 0 .769.196.769.696 0 .5-.247.68-.747.68l-1.793.02.022 1.412 1.252-.02c.4 0 .835.204.835.704s-.442.696-.842.696H11.82l-.045 2.139c0 .4-.194.8-.694.8-.5 0-.7-.3-.7-.8l-.031-5.631c0-.4.43-.696.93-.696zm-3.285.771c0-.5.3-.8.8-.8s.8.3.8.8l-.037 5.579c0 .4-.3.8-.8.8s-.8-.4-.8-.8l.037-5.579zm-3.192-.825c.7 0 1.307.183 1.807.683.3.3.4.7.1 1-.2.4-.7.4-1 .1-.2-.1-.5-.3-.9-.3-1 0-2.011.84-2.011 2.14 0 1.3.795 2.227 1.695 2.227.4 0 .805.073 1.105-.127V8.6c0-.4.3-.8.8-.8s.8.3.8.8v1.8c0 .2.037.071-.063.271-.7.7-1.57.991-2.47.991C2.868 11.662 1.3 10.2 1.3 8s1.704-3.623 3.504-3.623z"
                        fill-rule="nonzero"></path>
                </svg>
            </div>
        </div>
        <div class="m14_right">
            <input type="text" id="light_send" placeholder="Aa" data-userid="<?php echo $userid; ?>"
                data-chat="<?php echo $chatid; ?>">
        </div>

    </div>
</div>


<?php
}






?>