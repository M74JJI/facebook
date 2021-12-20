<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['refreshmsgs'])){
    $userid = $_POST['refreshmsgs'];
    $chatid=$_POST['chatid'];
  
    $messageData = $loadPost->messageData($userid,$chatid);
    $chat=$loadUser->getUserInfo($chatid); 
    $lastMessage = $loadUser->getLastMsgSendByUser($userid,$chatid);
  
    ?>
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
                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>"> <i
                            class="fas fa-reply"></i>
                    </div>
                    <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                        <div class="msg_kk_hold">
                            <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                        </div>
                        <div class="react_msg_wrapper" data-msg="<?php echo $message->msg_id ?>"
                            style="transform:translateX(5rem)" data-sender="<?php echo $message->sender ?>"
                            data-chat="<?php echo $message->user_id ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>"> <i
                            class="fas fa-reply"></i>
                    </div>
                    <div class="react_messages_wrappp" style="position:relative;" id="open_msg_react">
                        <div class="msg_kk_hold">
                            <img class="a99a_mg" src="assets/svg/emoji_light.png" alt="">
                        </div>
                        <div class="react_msg_wrapper"
                            style=" <?php if(strlen($message->message)>7 && strlen($message->message)<16){echo 'left:-6.5rem';}else if(strlen($message->message)>16){echo 'left:-2rem';} ?>"
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-chat="<?php echo $message->user_id ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
        <div class="mssssg1"
            style="margin-bottom:2px;margin-left:36px;<?php if($message->message=='You unsent a message'){echo 'background:transparent;color:#bcc0c4;border:1px solid #ced0d4;padding:10px;border-radius:50px';} ?>">
            <?php echo $message->message ?></div>
        <?php
            }
                 ?>

        <div class="only_message_texto">
            <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" style="align-self:center"
                alt="">

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
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
                        </div>
                    </div>
                    <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                        data-msg="<?php echo $message->message ?>"
                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>"> <i
                            class="fas fa-reply"></i>
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
            <div class="mssssg1"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-chat="<?php echo $message->user_id ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
                        </div>
                    </div>
                    <div class="msg_kk_hold" id="reply_msg" data-msg_id="<?php echo $message->msg_id ?>"
                        data-msg="<?php echo $message->message ?>"
                        data-name="<?php if($message->sender != $userid){echo $message->first_name;} ?>"
                        data-sender="<?php if($message->sender ==$userid){ echo 'true';}else{echo 'false';} ?>"> <i
                            class="fas fa-reply"></i>
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                    
                    if(count($images)==1 && $message->isStory!=1){
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                    }else if(count($images)==1 && $message->isStory==1){
                        ?>

        <div class="images_in_messages_1">
            <img src="<?php echo BASE_URL.$message->profile_picture ?>" class="p45545_img" alt="">
            <div style='position:relative;'>
                <img class="img_left" src="<?php echo $images[0]->name ?>" alt="">
                <?php
                if($message->storyText !=''){
                    ?>
                <span class="story_texttto"><?php echo $message->storyText ?></span>
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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

        </div>
        <div class="mssssg1"
            style="width:fit-content;padding:7px;;float:left;margin-left:30px;margin-top:2px;position: relative;">
            <?php echo $message->message ?>

            <div class="msg_reactss1_story">
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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
                            data-msg="<?php echo $message->msg_id ?>" data-sender="<?php echo $message->sender ?>"
                            data-receiver="<?php echo $message->receiver ?>">
                            <img class="react_msg_icon" src="assets/images/msg/love.png" alt="" id="click-msg-love">
                            <img class="react_msg_icon" src="assets/images/msg/haha.png" alt="" id="click-msg-haha">
                            <img class="react_msg_icon" src="assets/images/msg/wow.png" alt="" id="click-msg-wow">
                            <img class="react_msg_icon" src="assets/images/msg/sad.png" alt="" id="click-msg-sad">
                            <img class="react_msg_icon" src="assets/images/msg/angry.png" alt="" id="click-msg-angry">
                            <img class="react_msg_icon" src="assets/images/msg/like.png" alt="" id="click-msg-like">
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
                                data-msg_id="<?php echo $message->msg_id ?>" data-msg="<?php echo $message->message ?>"
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


<?php
}

if(isset($_POST['update_on_tick'])){
    $update_on_tick=$_POST['update_on_tick'];
    $chat=$loadUser->getUserInfo($update_on_tick);   
    if(time() - strtotime($chat->last_activity)<2){ ?>

<?php }




}
if(isset($_POST['doiupdateOnline'])){
    $doiupdateOnline=$_POST['doiupdateOnline'];
    $time=$_POST['time'];
    $chat=$loadUser->getUserInfo($doiupdateOnline);   
    if(strtotime($time) - strtotime($chat->last_activity)>-2){ 
    echo 'blach';
}else{}




}

?>