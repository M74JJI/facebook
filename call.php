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
    
}
if(isset($_GET['chat'])==true && empty($_GET['chat']===false)){
    $chatid =$loadUser->checkInput($_GET['chat']);
    $chat=$loadUser->getUserInfo($chatid);
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/call.css">
</head>




<body class="call">
    <div class="call_header" id="call_full_screen">
        <svg viewBox="0 0 50 50" height="40px" width="40px" fill="#fff">
            <defs>
                <filter height="28" id="ZenonDropShadowFilter.0" width="28" x="-2" y="-1">
                    <feGaussianBlur in="SourceAlpha" result="blur" stdDeviation="2"></feGaussianBlur>
                    <feOffset dx="0" dy="1" in="blur" result="offsetBlur"></feOffset>
                    <feFlood flood-color="#000" flood-opacity="0.2"></feFlood>
                    <feComposite in2="offsetBlur" operator="in" result="shadow"></feComposite>
                    <feMorphology in="SourceAlpha" operator="dilate" radius="1" result="outline"></feMorphology>
                    <feFlood flood-color="#000" flood-opacity="0.1"></feFlood>
                    <feComposite in2="outline" operator="in" result="stroke"></feComposite>
                    <feMerge>
                        <feMergeNode in="shadow"></feMergeNode>
                        <feMergeNode in="stroke"></feMergeNode>
                        <feMergeNode in="SourceGraphic"></feMergeNode>
                    </feMerge>
                </filter>
            </defs>
            <g filter="url(#ZenonDropShadowFilter.0)">
                <path
                    d="M19.8645508,30.7263399 L21.7498841,32.6112288 C22.2516619,33.1130065 21.990773,33.9716732 21.294773,34.1112288 L15.0632174,35.3156732 C14.4414397,35.4401176 13.8929952,34.8925621 14.0178841,34.2707843 L15.222773,28.041451 C15.3623285,27.345451 16.2218841,27.0850065 16.7236619,27.5867843 L18.6081063,29.4707843 L22.2649952,25.8116732 C22.6121063,25.4650065 23.1743285,25.4650065 23.5214396,25.8116732 C23.8681063,26.1587843 23.8681063,26.7205621 23.5214396,27.0676732 L19.8645508,30.7263399 Z M35.3150413,15.0632288 L34.1106878,21.2921176 C33.9709881,21.9885621 33.1123246,22.2490065 32.6104735,21.7472288 L30.7263076,19.8632288 L27.0705363,23.5218954 C26.7239566,23.8685621 26.1615987,23.8685621 25.8150189,23.5218954 C25.4684392,23.1752288 25.4684392,22.6130065 25.8150189,22.2663399 L29.4707902,18.6072288 L27.5861794,16.7223399 C27.0843283,16.2205621 27.3450417,15.3623399 28.0408706,15.2223399 L34.2695183,14.0178954 C34.8919382,13.8930065 35.4396143,14.4410065 35.3150413,15.0632288 Z">
                </path>
            </g>
        </svg>
    </div>
    <div class="call_header" id="call_exit_full_screen" style="display:none">
        <svg viewBox="0 0 50 50" height="40px" width="40px" fill="#fff">
            <defs>
                <filter height="28" id="ZenonDropShadowFilter.2" width="28" x="-2" y="-1">
                    <feGaussianBlur in="SourceAlpha" result="blur" stdDeviation="2"></feGaussianBlur>
                    <feOffset dx="0" dy="1" in="blur" result="offsetBlur"></feOffset>
                    <feFlood flood-color="#000" flood-opacity="0.2"></feFlood>
                    <feComposite in2="offsetBlur" operator="in" result="shadow"></feComposite>
                    <feMorphology in="SourceAlpha" operator="dilate" radius="1" result="outline"></feMorphology>
                    <feFlood flood-color="#000" flood-opacity="0.1"></feFlood>
                    <feComposite in2="outline" operator="in" result="stroke"></feComposite>
                    <feMerge>
                        <feMergeNode in="shadow"></feMergeNode>
                        <feMergeNode in="stroke"></feMergeNode>
                        <feMergeNode in="SourceGraphic"></feMergeNode>
                    </feMerge>
                </filter>
            </defs>
            <g filter="url(#ZenonDropShadowFilter.2)">
                <path
                    d="M22.5556037,32.8445769 C22.4159041,33.5402914 21.5572405,33.800629 21.0553895,33.2990571 L19.1716684,31.41583 L15.5158971,35.07344 C15.1688725,35.4199645 14.6069595,35.4199645 14.2599348,35.07344 C13.9133551,34.7264713 13.9133551,34.164924 14.2599348,33.8179553 L17.9157061,30.1607895 L16.0310953,28.2766738 C15.5292442,27.7751019 15.7899576,26.9167874 16.4857866,26.7772891 L22.7144343,25.5733388 C23.3368541,25.4489454 23.8845302,25.9962763 23.7599573,26.617799 L22.5556037,32.8445769 Z M35.0734279,15.5153814 L31.4178685,19.1723165 L33.3029607,21.0568392 C33.8041118,21.5582219 33.543762,22.4164005 32.8475708,22.5560936 L26.6187251,23.759946 C25.9967291,23.8845131 25.4489283,23.3373075 25.5733275,22.7153616 L26.7777784,16.4887846 C26.9172832,15.7929882 27.7765262,15.5327318 28.2781216,16.0341145 L30.1618809,17.9173026 L33.8178845,14.2599227 C34.1644252,13.9133591 34.7268873,13.9133591 35.0734279,14.2599227 C35.4199685,14.6069311 35.4199685,15.168373 35.0734279,15.5153814 Z">
                </path>
            </g>
        </svg>
    </div>
    <div class="user_video">
        <img src="assets/images/arrow-right.png" alt="" class="hide_user_video">
        <img src="assets/images/arrow-left.png" alt="" class="show_user_video">

        <video muted id="user-stream" autoplay></video>
    </div>

    <video id="chat-stream" class="chat_video" autoplay></video>
    <div class="chat_bg_bg">
        <img src="<?php echo BASE_URL.$chat->profile_picture ?>" alt="" class="called_image_mate">
    </div>

    <div class="call_actions">
        <button>
            <svg class="svg_colored" width="30" height="30" viewBox="0 0 16-8 -8 52 52">
                <path
                    d="M26.21 26.284a.999.999 0 010 1.414c-.39.39-1.024.39-1.416 0l-3.797-3.791-3.796 3.79c-.391.391-1.024.391-1.416.001a.999.999 0 010-1.414l3.797-3.791-3.797-3.792a.998.998 0 010-1.413 1.002 1.002 0 011.416 0l3.796 3.791 3.797-3.791a1.002 1.002 0 011.416 0 .998.998 0 010 1.413l-3.797 3.792 3.797 3.791zM28 14.998H14a2 2 0 00-2 2v11a2 2 0 002 2h14a2 2 0 002-2v-11a2 2 0 00-2-2zm-5-2a1 1 0 001-1v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v11a2 2 0 002 2h1a1 1 0 001-1v-3a4 4 0 014-4h9z">
                </path>
            </svg>
        </button>
        <button><svg class="svg_colored" viewBox="-11 -14 50 50">
                <path
                    d="M7.111 11.999H4.89v2.222a.89.89 0 0 1-1.778 0V12H.89a.89.89 0 0 1 0-1.778H3.11V7.998a.89.89 0 0 1 1.778 0v2.223H7.11a.89.89 0 0 1 0 1.778zm17.333 8.055c0 .707-.6 1.28-1.266 1.28H8.822a1.295 1.295 0 0 1-1.266-1.28c0-3.532 3.778-6.396 8.444-6.396s8.444 2.864 8.444 6.396zm-3.95-8.535c-.643 0-1.31-.097-1.825-.307-.692.711-1.618 1.16-2.699 1.16a3.943 3.943 0 0 1-2.653-1.024c-.129.017-.262.03-.402.03-1.65 0-2.826-2.246-2.826-4.98 0-2.854 2.59-5.974 4.072-5.974.412 0 .778.096 1.099.29.41-.346.847-.714 1.875-.714 1.961 0 5.168 3.202 5.168 6.398 0 1.423-.452 1.867-.452 2.56 0 1.171.911 1.11.911 1.577 0 .388-.872.984-2.268.984z">
                </path>
            </svg></button>
        <button class="mute_video svg_colored" onclick="muteVideo()">
            <svg viewBox="0 0 48 48" fill="#fff">
                <path
                    d="M26.5 33a4 4 0 004-4V19a4 4 0 00-4-4h-11a4 4 0 00-4 4v10a4 4 0 004 4h11l10.553-3.6-3.724-1.864a1.501 1.501 0 01-.829-1.343v-4.385c0-.569.321-1.089.829-1.343l3.724-1.863a1 1 0 011.447.895v9.007a1 1 0 01-1.447.895">
                </path>
            </svg>
        </button>
        <button class="unmute_video" onclick="muteVideo()" style="display:none;background-color:#fff">
            <svg viewBox="0 0 48 48">
                <path
                    d="M13.022 29.736c-.514.514-1.514.266-1.514-.724V19.007a4 4 0 013.999-4.002h10.112c.787 0 1.182.953.625 1.51l-13.222 13.22zm20.675-15.029l-2.608 2.61a1.998 1.998 0 00-.585 1.412l-.002 10.283a3.992 3.992 0 01-3.996 3.995h-10.27c-.53 0-1.039.21-1.414.585l-3.116 3.117a.999.999 0 11-1.413-1.414l21.99-22.002a.999.999 0 111.414 1.414zm3.356 14.704l-3.722-1.864a1.503 1.503 0 01-.83-1.343v-4.388c0-.569.322-1.089.83-1.343l3.722-1.864a1 1 0 011.447.895v9.012a1 1 0 01-1.447.895z">
                </path>
            </svg></button>
        <button class="mute_audio svg_colored" onclick="muteAudio()">
            <svg viewBox="0 0 48 48" fill="#fff">
                <path
                    d="M20 34h8a1 1 0 0 1 0 2h-8a1 1 0 0 1 0-2m4-5.5a5 5 0 0 1-5-5V17a5 5 0 0 1 10 0v6.5a5 5 0 0 1-5 5m0 4a9 9 0 0 1-9-9 1 1 0 0 1 2 0 7 7 0 1 0 14 0 1 1 0 0 1 2 0 9 9 0 0 1-9 9">
                </path>
            </svg>
        </button>
        <button class="unmute_audio" onclick="muteAudio()" style="display:none;background-color:#fff">
            <svg viewBox="0 0 48 48">
                <path
                    d="M20.01 34h8a1 1 0 1 1 0 2h-8a1 1 0 1 1 0-2m-5-10.498a1 1 0 0 1 1.999 0c0 .75.119 1.47.337 2.147a.989.989 0 0 1-.246 1c-.52.522-1.424.326-1.652-.374a8.952 8.952 0 0 1-.439-2.773m14.002 0a5 5 0 0 1-5 5 4.93 4.93 0 0 1-2.026-.435.713.713 0 0 0-.795.149l-.496.495c-.303.304-.236.824.146 1.02.951.49 2.026.77 3.17.77a7 7 0 0 0 7.002-6.999 1 1 0 0 1 2 0c0 4.97-4.03 8.999-9.002 8.999a8.902 8.902 0 0 1-4.708-1.344.969.969 0 0 0-1.196.14l-4.399 4.398a1 1 0 0 1-1.414-1.414l22-21.988a1 1 0 0 1 1.414 1.413l-6.11 6.107a1.998 1.998 0 0 0-.586 1.414v2.275zm-.721-8.036L19.9 23.85a.527.527 0 0 1-.899-.373l.008-6.474a5 5 0 0 1 9.403-2.37.704.704 0 0 1-.122.832z">
                </path>
            </svg></button>
        <button class="call_btn" style="background: red;"><svg fill="#fff" width="40" height="40" viewBox="0 0 48 48">
                <path
                    d="M12.054 24.58C12.52 19.102 24.34 19.002 24.54 19c.202 0 12.024-.1 12.408 5.37.284 4.048-1.092 3.74-1.56 3.778-.41.033-4.823-.767-5.452-1.19-.63-.422-.785-2.703-1.293-3.094-.507-.39-3.092-.51-4.134-.502-1.043.01-3.63.174-4.143.572-.513.4-.702 2.683-1.337 3.117-.636.434-5.062 1.31-5.47 1.283-.47-.03-1.85.3-1.506-3.753">
                </path>
            </svg></button>
    </div>
</body>

</html>
<script src="assets/js/jquery.js"></script>
<script>
$(document).on('click', '#call_full_screen', function() {
    var elem = document.documentElement;
    openFullscreen(elem)
    $(this).hide();
    $('#call_exit_full_screen').show()

})
$(document).on('click', '#call_exit_full_screen', function() {
    closeFullscreen()
    $(this).hide();
    $('#call_full_screen').show()

})
$(document).on('click', '.hide_user_video', function() {
    $('.user_video').css('transform', 'translateX(90%)');
    $(this).hide();
    $('.show_user_video').show();


})
$(document).on('click', '.show_user_video', function() {
    $('.user_video').css('transform', 'translateX(0)');
    $(this).hide();
    $('.hide_user_video').show();


})

function openFullscreen(elem) {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
    }
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
    }
}

const webSocket = new WebSocket('ws://127.0.0.1:3000');

webSocket.onmessage = (event) => {
    handleSignallingData(JSON.parse(event.data));
};

function handleSignallingData(data) {
    switch (data.type) {
        case 'answer':
            peerConn.setRemoteDescription(data.answer);
            break;
        case 'candidate':
            peerConn.addIceCandidate(data.candidate);
    }
}

$(document).ready(function() {
    setTimeout(function() {
        sendUsername();
    }, 500)
    startCall()
})
var username;

function sendUsername() {
    username = "<?php echo $username ?>"
    sendData({
        type: 'store_user',
    });
}

function sendData(data) {
    data.username = username;
    webSocket.send(JSON.stringify(data));
}

let localStream;
let peerConn;

function startCall() {
    var constraints = {
        audio: true,
        video: {
            width: 1280,
            height: 720,
        },
    };
    navigator.mediaDevices.getUserMedia(constraints).then(
        function(mediaStream) {
            localStream = mediaStream;
            var video = document.getElementById('user-stream');
            video.srcObject = mediaStream;
            video.onloadedmetadata = function(e) {
                video.play();
            };

            let configuration = {
                iceServers: [{
                    urls: [
                        'stun:stun.l.google.com:19302',
                        'stun:stun1.l.google.com:19302',
                        'stun:stun2.l.google.com:19302',
                    ],
                }, ],
            };

            peerConn = new RTCPeerConnection(configuration);
            peerConn.addStream(localStream);

            peerConn.onaddstream = (e) => {
                document.getElementById('chat-stream').srcObject = e.stream;
                $('.chat_bg_bg').hide();
            };

            peerConn.onicecandidate = (e) => {
                if (e.candidate == null) return;
                sendData({
                    type: 'store_candidate',
                    candidate: e.candidate,
                });
            };

            createAndSendOffer();
        },
        (error) => {
            console.log(error);
        }
    );
}

function createAndSendOffer() {
    peerConn.createOffer(
        (offer) => {
            sendData({
                type: 'store_offer',
                offer: offer,
            });

            peerConn.setLocalDescription(offer);
        },
        (error) => {
            console.log(error);
        }
    );
}

let isAudio = true;

function muteAudio() {
    isAudio = !isAudio;
    localStream.getAudioTracks()[0].enabled = isAudio;
}

let isVideo = true;

function muteVideo() {
    isVideo = !isVideo;
    localStream.getVideoTracks()[0].enabled = isVideo;
    $('.chat_bg_bg').toggle();
}
$(document).on('click', '.mute_audio', function() {
    $(this).hide();
    $('.unmute_audio').show();
})
$(document).on('click', '.unmute_audio', function() {
    $(this).hide();
    $('.mute_audio').show();
})
$(document).on('click', '.unmute_video', function() {
    $(this).hide();
    $('.mute_video').show();
})
$(document).on('click', '.mute_video', function() {
    $(this).hide();
    $('.unmute_video').show();
})
</script>