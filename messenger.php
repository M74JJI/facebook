<?php
include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
}else{
    header('Location:login.php');
}
if(isset($_GET['id'])==true && empty($_GET['id']===false)){
    $username =$loadUser->checkInput($_GET['id']);
    $profileId =$loadUser->getUserId($username);
}else{
    $profileId=$userid;
}
$profileInfos = $loadUser->getUserInfo($profileId);
$requestCheck=$loadPost->requestCheck($userid,$profileId);
$requestConfirm=$loadPost->requestConfirm($profileId,$userid);
$followCheck=$loadPost->followCheck($profileId,$userid);
$allusers = $loadPost->lastmessages($userid);
$lastMsgReceived=$loadPost->lastPersonMsg($userid);

if(!empty($lastMsgReceived)){
    $lastMsgUserid = $lastMsgReceived->user_id;
}

?>


<!DOCTYPE html>
<html lang="en">


<?php include 'components/HeaderMessenger.php'?>

<body>
    <div class="messenger">
        <div class="messenger_left">
            <div class="bright">
                <div class="msger_left-header">
                    <span class="chata">Chats</span>
                    <div class="flexo">
                        <div class="msg_icon_gray"><i class="points_three"></i></div>
                        <div class="msg_icon_gray"><i class="vid_ic"></i></div>
                        <div class="msg_icon_gray"><i class="wr_ic"></i></div>
                    </div>
                </div>
                <div class="msg_search">
                    <svg viewBox="0 0 16 16" width="1em" height="1em" fill="#65676b">
                        <g fill-rule="evenodd" transform="translate(-448 -544)">
                            <g fill-rule="nonzero">
                                <path
                                    d="M10.743 2.257a6 6 0 1 1-8.485 8.486 6 6 0 0 1 8.485-8.486zm-1.06 1.06a4.5 4.5 0 1 0-6.365 6.364 4.5 4.5 0 0 0 6.364-6.363z"
                                    transform="translate(448 544)"></path>
                                <path
                                    d="M10.39 8.75a2.94 2.94 0 0 0-.199.432c-.155.417-.23.849-.172 1.284.055.415.232.794.54 1.103a.75.75 0 0 0 1.112-1.004l-.051-.057a.39.39 0 0 1-.114-.24c-.021-.155.014-.356.09-.563.031-.081.06-.145.08-.182l.012-.022a.75.75 0 1 0-1.299-.752z"
                                    transform="translate(448 544)"></path>
                                <path
                                    d="M9.557 11.659c.038-.018.09-.04.15-.064.207-.077.408-.112.562-.092.08.01.143.034.198.077l.041.036a.75.75 0 0 0 1.06-1.06 1.881 1.881 0 0 0-1.103-.54c-.435-.058-.867.018-1.284.175-.189.07-.336.143-.433.2a.75.75 0 0 0 .624 1.356l.066-.027.12-.061z"
                                    transform="translate(448 544)"></path>
                                <path
                                    d="m13.463 15.142-.04-.044-3.574-4.192c-.599-.703.355-1.656 1.058-1.057l4.191 3.574.044.04c.058.059.122.137.182.24.249.425.249.96-.154 1.41l-.057.057c-.45.403-.986.403-1.411.154a1.182 1.182 0 0 1-.24-.182zm.617-.616.444-.444a.31.31 0 0 0-.063-.052c-.093-.055-.263-.055-.35.024l.208.232.207-.206.006.007-.22.257-.026-.024.033-.034.025.027-.257.22-.007-.007zm-.027-.415c-.078.088-.078.257-.023.35a.31.31 0 0 0 .051.063l.205-.204-.233-.209z"
                                    transform="translate(448 544)"></path>
                            </g>
                        </g>
                    </svg>
                    <input type="text" placeholder="Search Facebook">
                </div>
                <ul class="msg-user-add"></ul>
                <div class="down_msg">
                    <i class="down_ic"></i>
                    Install Messenger app
                </div>
            </div>
        </div>
        <div class="messenger_middle">
            <div class="msg_middle_header">
                <div style="display: flex;align-items:center">
                    <img src="<?php if(!empty($lastMsgReceived)){ echo $lastMsgReceived->profile_picture; } ?>" alt="">
                    <div class="h_3_msg">
                        <?php if(!empty($lastMsgReceived)){ echo "$lastMsgReceived->first_name $lastMsgReceived->last_name"; } ?>
                    </div>
                </div>
                <div class="svgs_msg">
                    <div class="svg_msg"><svg role="presentation" width="34px" height="34px" viewBox="-5 -5 30 30">
                            <path
                                d="M10.952 14.044c.074.044.147.086.22.125a.842.842 0 001.161-.367c.096-.195.167-.185.337-.42.204-.283.552-.689.91-.772.341-.078.686-.105.92-.11.435-.01 1.118.174 1.926.648a15.9 15.9 0 011.713 1.147c.224.175.37.43.393.711.042.494-.034 1.318-.754 2.137-1.135 1.291-2.859 1.772-4.942 1.088a17.47 17.47 0 01-6.855-4.212 17.485 17.485 0 01-4.213-6.855c-.683-2.083-.202-3.808 1.09-4.942.818-.72 1.642-.796 2.136-.754.282.023.536.17.711.392.25.32.663.89 1.146 1.714.475.808.681 1.491.65 1.926-.024.31-.026.647-.112.921-.11.35-.488.705-.77.91-.236.17-.226.24-.42.336a.841.841 0 00-.368 1.161c.04.072.081.146.125.22a14.012 14.012 0 004.996 4.996z"
                                fill="#0084FF"></path>
                            <path
                                d="M10.952 14.044c.074.044.147.086.22.125a.842.842 0 001.161-.367c.096-.195.167-.185.337-.42.204-.283.552-.689.91-.772.341-.078.686-.105.92-.11.435-.01 1.118.174 1.926.648.824.484 1.394.898 1.713 1.147.224.175.37.43.393.711.042.494-.034 1.318-.754 2.137-1.135 1.291-2.859 1.772-4.942 1.088a17.47 17.47 0 01-6.855-4.212 17.485 17.485 0 01-4.213-6.855c-.683-2.083-.202-3.808 1.09-4.942.818-.72 1.642-.796 2.136-.754.282.023.536.17.711.392.25.32.663.89 1.146 1.714.475.808.681 1.491.65 1.926-.024.31-.026.647-.112.921-.11.35-.488.705-.77.91-.236.17-.226.24-.42.336a.841.841 0 00-.368 1.161c.04.072.081.146.125.22a14.012 14.012 0 004.996 4.996z"
                                stroke="#0084FF" fill="none"></path>
                        </svg></div>
                    <div class="svg_msg"><svg role="presentation" width="34px" height="34px" viewBox="-5 -5 30 30">
                            <path
                                d="M19.492 4.112a.972.972 0 00-1.01.063l-3.052 2.12a.998.998 0 00-.43.822v5.766a1 1 0 00.43.823l3.051 2.12a.978.978 0 001.011.063.936.936 0 00.508-.829V4.94a.936.936 0 00-.508-.828zM10.996 18A3.008 3.008 0 0014 14.996V5.004A3.008 3.008 0 0010.996 2H3.004A3.008 3.008 0 000 5.004v9.992A3.008 3.008 0 003.004 18h7.992z"
                                fill="#0084FF"></path>
                        </svg></div>
                    <div class="svg_msg1">
                        <svg viewBox="0 0 36 36">
                            <g transform="translate(18,18)scale(1.2)translate(-18,-18)">
                                <path fill="#0084FF" stroke="#0084FF"
                                    d="M18,10 C16.6195,10 15.5,11.119 15.5,12.5 C15.5,13.881 16.6195,15 18,15 C19.381,15 20.5,13.881 20.5,12.5 C20.5,11.119 19.381,10 18,10 Z M16,25 C16,25.552 16.448,26 17,26 L19,26 C19.552,26 20,25.552 20,25 L20,18 C20,17.448 19.552,17 19,17 L17,17 C16.448,17 16,17.448 16,18 L16,25 Z M18,30 C11.3725,30 6,24.6275 6,18 C6,11.3725 11.3725,6 18,6 C24.6275,6 30,11.3725 30,18 C30,24.6275 24.6275,30 18,30 Z">
                                </path>
                            </g>
                        </svg>
                    </div>

                </div>
            </div>
            <div class="messaging_area">
                <div class="msg_hello_info">
                    <img src="<?php if(!empty($lastMsgReceived)){ echo $lastMsgReceived->profile_picture ; } ?>" alt="">
                    <div style="margin-top:5px" class="h_3_msg">
                        <?php if(!empty($lastMsgReceived)){ echo "$lastMsgReceived->first_name $lastMsgReceived->last_name"; } ?>
                    </div>
                    <div class="span_sm_txt">You're friends on Facebook</div>
                    <div class="span_sm_txt">Lives in Branes, Tanger, Morocco
                    </div>
                    <div class="span_sm_txt">Studied Cybersecurity & Cybercrime at ENSA de Tanger
                    </div>
                </div>

                <div class="messeges_wrap">
                    <div class="msg_box" data-userid="<?php echo $userid ?>"
                        data-chat="<?php echo $lastMsgReceived->user_id ?>">

                    </div>

                </div>
                <div class="msg_send_area">
                    <div class="svg_msg">
                        <svg viewBox="0 0 24 24" height="20px" width="20px"
                            class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji tftn3vyl">
                            <g fill-rule="evenodd">
                                <polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon>
                                <path
                                    d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12"
                                    fill="#0084FF"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="svg_img" style="cursor: pointer;">
                        <svg viewBox="0 -1 17 17" height="20px" width="20px"
                            class="a8c37x1j ms05siws hr662l2t b7h9ocf4">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="M2.882 13.13C3.476 4.743 3.773.48 3.773.348L2.195.516c-.7.1-1.478.647-1.478 1.647l1.092 11.419c0 .5.2.9.4 1.3.4.2.7.4.9.4h.4c-.6-.6-.727-.951-.627-2.151z"
                                    fill="#0084FF"></path>
                                <circle fill="#0084FF" cx="8.5" cy="4.5" r="1.5"></circle>
                                <path
                                    d="M14 6.2c-.2-.2-.6-.3-.8-.1l-2.8 2.4c-.2.1-.2.4 0 .6l.6.7c.2.2.2.6-.1.8-.1.1-.2.1-.4.1s-.3-.1-.4-.2L8.3 8.3c-.2-.2-.6-.3-.8-.1l-2.6 2-.4 3.1c0 .5.2 1.6.7 1.7l8.8.6c.2 0 .5 0 .7-.2.2-.2.5-.7.6-.9l.6-5.9L14 6.2z"
                                    fill="#0084FF"></path>
                                <path
                                    d="M13.9 15.5l-8.2-.7c-.7-.1-1.3-.8-1.3-1.6l1-11.4C5.5 1 6.2.5 7 .5l8.2.7c.8.1 1.3.8 1.3 1.6l-1 11.4c-.1.8-.8 1.4-1.6 1.3z"
                                    stroke="#0084FF" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="svg_img" style="cursor: pointer;">
                        <svg x="0px" y="0px" viewBox="0 0 17 16" height="20px" width="20px"
                            class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji">
                            <g fill-rule="evenodd">
                                <circle fill="none" cx="5.5" cy="5.5" r="1"></circle>
                                <circle fill="none" cx="11.5" cy="4.5" r="1"></circle>
                                <path
                                    d="M5.3 9c-.2.1-.4.4-.3.7.4 1.1 1.2 1.9 2.3 2.3h.2c.2 0 .4-.1.5-.3.1-.3 0-.5-.3-.6-.8-.4-1.4-1-1.7-1.8-.1-.2-.4-.4-.7-.3z"
                                    fill="none"></path>
                                <path
                                    d="M10.4 13.1c0 .9-.4 1.6-.9 2.2 4.1-1.1 6.8-5.1 6.5-9.3-.4.6-1 1.1-1.8 1.5-2 1-3.7 3.6-3.8 5.6z"
                                    fill="#0084FF"></path>
                                <path
                                    d="M2.5 13.4c.1.8.6 1.6 1.3 2 .5.4 1.2.6 1.8.6h.6l.4-.1c1.6-.4 2.6-1.5 2.7-2.9.1-2.4 2.1-5.4 4.5-6.6 1.3-.7 1.9-1.6 1.9-2.8l-.2-.9c-.1-.8-.6-1.6-1.3-2-.7-.5-1.5-.7-2.4-.5L3.6 1.5C1.9 1.8.7 3.4 1 5.2l1.5 8.2zm9-8.9c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1zm-3.57 6.662c.3.1.4.4.3.6-.1.3-.3.4-.5.4h-.2c-1-.4-1.9-1.3-2.3-2.3-.1-.3.1-.6.3-.7.3-.1.5 0 .6.3.4.8 1 1.4 1.8 1.7zM5.5 5.5c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1z"
                                    fill="#0084FF" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="svg_img" style="cursor: pointer;"><svg x="0px" y="0px" viewBox="0 0 16 16" height="20px"
                            width="20px" class="a8c37x1j ms05siws hr662l2t b7h9ocf4 crt8y2ji">
                            <path
                                d="M.783 12.705c.4.8 1.017 1.206 1.817 1.606 0 0 1.3.594 2.5.694 1 .1 1.9.1 2.9.1s1.9 0 2.9-.1 1.679-.294 2.479-.694c.8-.4 1.157-.906 1.557-1.706.018 0 .4-1.405.5-2.505.1-1.2.1-3 0-4.3-.1-1.1-.073-1.976-.473-2.676-.4-.8-.863-1.408-1.763-1.808-.6-.3-1.2-.3-2.4-.4-1.8-.1-3.8-.1-5.7 0-1 .1-1.7.1-2.5.5s-1.417 1.1-1.817 1.9c0 0-.4 1.484-.5 2.584-.1 1.2-.1 3 0 4.3.1 1 .2 1.705.5 2.505zm10.498-8.274h2.3c.4 0 .769.196.769.696 0 .5-.247.68-.747.68l-1.793.02.022 1.412 1.252-.02c.4 0 .835.204.835.704s-.442.696-.842.696H11.82l-.045 2.139c0 .4-.194.8-.694.8-.5 0-.7-.3-.7-.8l-.031-5.631c0-.4.43-.696.93-.696zm-3.285.771c0-.5.3-.8.8-.8s.8.3.8.8l-.037 5.579c0 .4-.3.8-.8.8s-.8-.4-.8-.8l.037-5.579zm-3.192-.825c.7 0 1.307.183 1.807.683.3.3.4.7.1 1-.2.4-.7.4-1 .1-.2-.1-.5-.3-.9-.3-1 0-2.011.84-2.011 2.14 0 1.3.795 2.227 1.695 2.227.4 0 .805.073 1.105-.127V8.6c0-.4.3-.8.8-.8s.8.3.8.8v1.8c0 .2.037.071-.063.271-.7.7-1.57.991-2.47.991C2.868 11.662 1.3 10.2 1.3 8s1.704-3.623 3.504-3.623z"
                                fill="#0084FF" fill-rule="nonzero"></path>
                        </svg></div>
                    <textarea id="msgInput" class="msg_textarea" autofocus placeholder="Aa" rows="1"></textarea>
                    <div class="send_like">
                        <svg viewBox="0 0 16 16" height="20" width="20" class="crt8y2ji">
                            <path fill="#0084FF"
                                d="M16,9.1c0-0.8-0.3-1.1-0.6-1.3c0.2-0.3,0.3-0.7,0.3-1.2c0-1-0.8-1.7-2.1-1.7h-3.1c0.1-0.5,0.2-1.3,0.2-1.8 c0-1.1-0.3-2.4-1.2-3C9.3,0.1,9,0,8.7,0C8.1,0,7.7,0.2,7.6,0.4C7.5,0.5,7.5,0.6,7.5,0.7L7.6,3c0,0.2,0,0.4-0.1,0.5L5.7,6.6 c0,0-0.1,0.1-0.1,0.1l0,0l0,0L5.3,6.8C5.1,7,5,7.2,5,7.4v6.1c0,0.2,0.1,0.4,0.2,0.5c0.1,0.1,1,1,2,1h5.2c0.9,0,1.4-0.3,1.8-0.9 c0.3-0.5,0.2-1,0.1-1.4c0.5-0.2,0.9-0.5,1.1-1.2c0.1-0.4,0-0.8-0.2-1C15.6,10.3,16,9.9,16,9.1z">
                            </path>
                            <path fill="#0084FF"
                                d="M3.3,6H0.7C0.3,6,0,6.3,0,6.7v8.5C0,15.7,0.3,16,0.7,16h2.5C3.7,16,4,15.7,4,15.3V6.7C4,6.3,3.7,6,3.3,6z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="messenger_right">
            <div class="msg_r_imgtext">
                <img class="imgtaxta"
                    src="<?php if(!empty($lastMsgReceived)){ echo $lastMsgReceived->profile_picture; } ?>" alt="">
                <div style="margin-top:10px" class="h_3_msg">
                    <?php if(!empty($lastMsgReceived)){ echo "$lastMsgReceived->first_name $lastMsgReceived->last_name"; } ?>
                </div>
            </div>
            <div class="edit_chat_menu">
                <div class="chat_men_item">Customize chat <i class="chat_ardown"></i></div>
                <div class="chat_men_item">Privacy & support <i class="chat_ardown"></i></div>
            </div>
        </div>
    </div>

</body>

</html>