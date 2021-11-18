<?php
require 'core/load.php';
require 'connect/DB.php';
$errors=[];
$email_phone='';
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