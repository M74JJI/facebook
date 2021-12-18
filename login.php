<?php
require 'core/load.php';
require 'connect/DB.php';
$errors=[];
$email_phone='';
function getOS($user_agent = null)
{
    if(!isset($user_agent) && isset($_SERVER['HTTP_USER_AGENT'])) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    }

    
    $os_array = [
        'windows nt 10'                              =>  'Windows 10',
        'windows nt 6.3'                             =>  'Windows 8.1',
        'windows nt 6.2'                             =>  'Windows 8',
        'windows nt 6.1|windows nt 7.0'              =>  'Windows 7',
        'windows nt 6.0'                             =>  'Windows Vista',
        'windows nt 5.2'                             =>  'Windows Server 2003/XP x64',
        'windows nt 5.1'                             =>  'Windows XP',
        'windows xp'                                 =>  'Windows XP',
        'windows nt 5.0|windows nt5.1|windows 2000'  =>  'Windows 2000',
        'windows me'                                 =>  'Windows ME',
        'windows nt 4.0|winnt4.0'                    =>  'Windows NT',
        'windows ce'                                 =>  'Windows CE',
        'windows 98|win98'                           =>  'Windows 98',
        'windows 95|win95'                           =>  'Windows 95',
        'win16'                                      =>  'Windows 3.11',
        'mac os x 10.1[^0-9]'                        =>  'Mac OS X Puma',
        'macintosh|mac os x'                         =>  'Mac OS X',
        'mac_powerpc'                                =>  'Mac OS 9',
        'ubuntu'                                     =>  'Linux - Ubuntu',
        'iphone'                                     =>  'iPhone',
        'ipod'                                       =>  'iPod',
        'ipad'                                       =>  'iPad',
        'android'                                    =>  'Android',
        'blackberry'                                 =>  'BlackBerry',
        'webos'                                      =>  'Mobile',
        'linux'                                      =>  'Linux',

        '(media center pc).([0-9]{1,2}\.[0-9]{1,2})'=>'Windows Media Center',
        '(win)([0-9]{1,2}\.[0-9x]{1,2})'=>'Windows',
        '(win)([0-9]{2})'=>'Windows',
        '(windows)([0-9x]{2})'=>'Windows',

        // Doesn't seem like these are necessary...not totally sure though..
        //'(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'Windows NT',
        //'(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'=>'Windows NT', // fix by bg

        'Win 9x 4.90'=>'Windows ME',
        '(windows)([0-9]{1,2}\.[0-9]{1,2})'=>'Windows',
        'win32'=>'Windows',
        '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})'=>'Java',
        '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}'=>'Solaris',
        'dos x86'=>'DOS',
        'Mac OS X'=>'Mac OS X',
        'Mac_PowerPC'=>'Macintosh PowerPC',
        '(mac|Macintosh)'=>'Mac OS',
        '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'SunOS',
        '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'BeOS',
        '(risc os)([0-9]{1,2}\.[0-9]{1,2})'=>'RISC OS',
        'unix'=>'Unix',
        'os/2'=>'OS/2',
        'freebsd'=>'FreeBSD',
        'openbsd'=>'OpenBSD',
        'netbsd'=>'NetBSD',
        'irix'=>'IRIX',
        'plan9'=>'Plan9',
        'osf'=>'OSF',
        'aix'=>'AIX',
        'GNU Hurd'=>'GNU Hurd',
        '(fedora)'=>'Linux - Fedora',
        '(kubuntu)'=>'Linux - Kubuntu',
        '(ubuntu)'=>'Linux - Ubuntu',
        '(debian)'=>'Linux - Debian',
        '(CentOS)'=>'Linux - CentOS',
        '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - Mandriva',
        '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - SUSE',
        '(Dropline)'=>'Linux - Slackware (Dropline GNOME)',
        '(ASPLinux)'=>'Linux - ASPLinux',
        '(Red Hat)'=>'Linux - Red Hat',
        // Loads of Linux machines will be detected as unix.
        // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
        //'X11'=>'Unix',
        '(linux)'=>'Linux',
        '(amigaos)([0-9]{1,2}\.[0-9]{1,2})'=>'AmigaOS',
        'amiga-aweb'=>'AmigaOS',
        'amiga'=>'Amiga',
        'AvantGo'=>'PalmOS',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'=>'Linux',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'=>'Linux',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'=>'Linux',
        '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}'=>'Linux',
        '(webtv)/([0-9]{1,2}\.[0-9]{1,2})'=>'WebTV',
        'Dreamcast'=>'Dreamcast OS',
        'GetRight'=>'Windows',
        'go!zilla'=>'Windows',
        'gozilla'=>'Windows',
        'gulliver'=>'Windows',
        'ia archiver'=>'Windows',
        'NetPositive'=>'Windows',
        'mass downloader'=>'Windows',
        'microsoft'=>'Windows',
        'offline explorer'=>'Windows',
        'teleport'=>'Windows',
        'web downloader'=>'Windows',
        'webcapture'=>'Windows',
        'webcollage'=>'Windows',
        'webcopier'=>'Windows',
        'webstripper'=>'Windows',
        'webzip'=>'Windows',
        'wget'=>'Windows',
        'Java'=>'Unknown',
        'flashget'=>'Windows',

        // delete next line if the script show not the right OS
        //'(PHP)/([0-9]{1,2}.[0-9]{1,2})'=>'PHP',
        'MS FrontPage'=>'Windows',
        '(msproxy)/([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
        '(msie)([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
        'libwww-perl'=>'Unix',
        'UP.Browser'=>'Windows CE',
        'NetAnts'=>'Windows',
    ];

    // https://github.com/ahmad-sa3d/php-useragent/blob/master/core/user_agent.php
    $arch_regex = '/\b(x86_64|x86-64|Win64|WOW64|x64|ia64|amd64|ppc64|sparc64|IRIX64)\b/ix';
    $arch = preg_match($arch_regex, $user_agent) ? '64' : '32';

    foreach ($os_array as $regex => $value) {
        if (preg_match('{\b('.$regex.')\b}i', $user_agent)) {
            return $value.' x'.$arch;
        }
    }

    return 'Unknown';
}
$os=getOS();
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
if ($query && $query['status'] == 'success') {
$location =$query;
}else{
    $location ='';
}

if(isset($_POST['email_phone']) && !empty($_POST['email_phone'])){
$email_phone =$_POST['email_phone'];
$password =$_POST['password'];
if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email_phone)){
if(!preg_match("^[0-9]{10}^",$email_phone)){
$errors[]="Email or phone number is invalid";
}else{
if(DB::query("SELECT mobile FROM users WHERE mobile=:mobile",
array('mobile'=>$email_phone))){
if(password_verify($password,
DB::query("SELECT password FROM users WHERE mobile=:mobile",
array('mobile'=>$email_phone))[0]['password'])){
$user_id =DB::query("SELECT id FROM users WHERE mobile=:mobile",array('mobile'=>$email_phone))[0]['id'];
$tstrong=true;
$token =bin2hex(openssl_random_pseudo_bytes(64,$tstrong));
$loadUser->create('token',array('token'=>sha1($token),'user_id'=>$user_id));
$infos=$loadUser->getUserInfo($user_id);
$data = $infos->systems;
$devices = "";
$data .= '{os:'.$os.',time:'.Date('Y-m-d H:i:s').',location:'.$location['city'].','.$location['country'].'},';
$devices = '['.$data.']';
$loadUser->updateSystems($user_id,$devices);
setcookie('USERID',$token,time()+60*60*24*7,'/',NULL,NULL,true);
header('Location:index.php');

}else{
$errors[]="Password is incorrect.";
}

}else{
$errors[]="Account does not exist";
}
}
}else{
if(DB::query("SELECT email FROM users WHERE email=:email",
array('email'=>$email_phone))){
if(password_verify($password,
DB::query("SELECT password FROM users WHERE email=:email",
array('email'=>$email_phone))[0]['password'])){
$user_id =DB::query("SELECT id FROM users WHERE email=:email",array('email'=>$email_phone))[0]['id'];
$tstrong=true;
$token =bin2hex(openssl_random_pseudo_bytes(64,$tstrong));
$loadUser->create('token',array('token'=>sha1($token),'user_id'=>$user_id));
$infos=$loadUser->getUserInfo($user_id);
$data = $infos->systems;
$devices = "";
$data .= '{os:'.$os.',time:'.Date('Y-m-d H:i:s').',location:'.$location['city'].','.$location['country'].'},';
$devices = '['.$data.']';
$loadUser->updateSystems($user_id,$devices);
setcookie('USERID',$token,time()+60*60*24*7,'/',NULL,NULL,true);
header('Location:index.php');

}else{
$errors[]="Password is incorrect.";
}

}else{
$errors[]="Account does not exist";
}
}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facebook - sign up</title>
    <link rel="icon" href="assets/images/icon.png" />
    <link rel="stylesheet" href="assets/css/register.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container" id="container">
        <div class="left">
            <img src="assets/images/logo.svg" alt="" class="icon" />
            <p class="desc">
                Facebook helps you connect and <br />
                share with the people in your life.
            </p>
        </div>
        <form action="login.php" method="post" class="right">
            <?php if(!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <input type="text" name="email_phone" value="<?php echo $email_phone ?>" class="input_login"
                placeholder="Email or phone Number" />
            <input type="password" class="input_login" name="password" placeholder="Password" />
            <input type="submit" name="submit_login" class="btn_login" value="Log in" />
            <a class="pf">Forget password?</a>
            <a href="signup.php" class="openRegister" id="open">
                Create New account
            </a>
        </form>
    </div>

    </script>
</body>

</html>