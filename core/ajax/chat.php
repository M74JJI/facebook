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
 
 ?>
<div class="popup_chat" data-userid="<?php echo $userid; ?>" data-chat="<?php echo $chatid; ?>">
    <div class="chat_header">
        <div class="left_popp">
            <div style="position: relative;">
                <img src="<?php echo $chat->profile_picture ?>" alt="">
                <div class="updatem_online" data-chat="<?php echo $chatid; ?>">


                </div>
            </div>
            <span style="word-break:keep-all;font-weight:500">
                <?php if(strlen($full_name)>14) {
                    echo substr($full_name,0,13).'...';
                } else{
                 echo $full_name;
                } ?>
            </span>
            <svg class="hnxzwevs" width="10px" height="10px" viewBox="0 0 18 10">
                <path fill="var(--primary-text)" fill-rule="evenodd" clip-rule="evenodd"
                    d="M1 2.414A1 1 0 012.414 1L8.293 6.88a1 1 0 001.414 0L15.586 1A1 1 0 0117 2.414L9.707 9.707a1 1 0 01-1.414 0L1 2.414z">
                </path>
            </svg>
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

            <div class="h27_name" style="word-break:keep-all"><?php echo $chat->first_name.' '.$chat->last_name ?>
            </div>
            <div class="h23_det">
                You're friends on Facebook

            </div>
            <div class="h23_det">Lives in Branes, Tanger, Morocco
            </div>
            <div class="h23_det">Studied Cybersecurity & Cybercrime at ENSA de Tanger
            </div>

        </div>
        <div class="messaging_popup" data-count="<?php echo count($messageData) ?>" data-chat="<?php echo $chatid; ?>"
            data-time="<?php echo $chat->last_activity ?>"> <?php foreach ($messageData as $i => $message){
                if($message->user_id == $userid){ ?> <div class="mess_right">
                <div class="mssssg"><?php echo $message->message ?></div>
                <?php

                if($i<count($messageData)-1 && strtotime($message->messageAt) - strtotime($messageData[$i+1]->messageAt)>-5000){
                    ?>
                <div class="timeit"><?php echo $loadUser->timeAgoAlt($message->messageAt) ?></div>

                <?php }else{}
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

            <div class="mess_left">
                <img src="<?php echo $message->profile_picture ?>" alt="">
                <div class="mssssg1"><?php echo $message->message ?></div>
            </div>

            <?php  }
                ?>


            <?php  } ?>

        </div>

    </div>
    <div class="popu_char_a7em">
        <div class="m14_left">
            <div class="m24_icon">
                <svg viewBox="0 0 24 24" height="20px" width="20px">
                    <g fill-rule="evenodd">
                        <polygon class="strokesvg" fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                        <path
                            d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12">
                        </path>
                    </g>
                </svg>
            </div>
            <div class="m24_icon">
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
            <div class="m24_icon">
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
            <div class="m24_icon">
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