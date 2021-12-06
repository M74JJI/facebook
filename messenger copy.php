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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>





    <input type="text" id="message">
    <button id="send">send</button>
    <script src="assets/js/jquery.js"></script>
    <script>
    $(document).ready(function() {
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };

        $(document).on('click', '#send', function() {
            var msg = $('#message').val();
            var userid = "<?php echo $profileInfos->user_id ?>"
            var chat = 26
            var data = {
                userid: userid,
                chat: chat,
                msg: msg
            }
            conn.send(JSON.stringify(data));
        })
    })
    </script>

</body>

</html>