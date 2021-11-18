<?php

require 'core/load.php';
require 'connect/DB.php';
$errors=[];

$first_name='';
$last_name='';
$email_phone='';
$birthday='';
$gender='';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email_phone = $_POST['email_phone'];
  $password = $_POST['password'];
  $birth_day = $_POST['birth_day']; 
  $birth_month = $_POST['birth_month'];
  $birth_year = $_POST['birth_year'];
  if(!empty($_POST['gender'])){
      $gender = $_POST['gender'];
  }
  $birthday=''.$birth_year.'-'.$birth_month.'-'.$birth_day.'';

 if(empty($first_name)){
     $errors[]="Please provide your first name";
    }else if(strlen($first_name)<2 || strlen($first_name)>30){
        $errors[]="First name must be between 2 and 30 characters";
    }
   else if(empty($last_name)){
    $errors[]="Please provide your last name";
   }else if(strlen($last_name)<2 || strlen($last_name)>30){
       $errors[]="Last name must be between 2 and 30 characters";

   }
   else{
    $username =''.$first_name.''.$last_name.'';
    if(DB::query('SELECT username FROM users WHERE username=:username',
    array(':username' => $username)
    )){
        $usernameRand = rand();
        $link =''.$username.''.$usernameRand.'';
    }else{
     $link =$username;
    }
   }
  
  
 if(empty($email_phone)){
    $errors[]="Please provide your email or phone number";
   }
   else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email_phone)){
       if(!preg_match("^[0-9]{10}^",$email_phone)){
          $errors[]="Email or phone number is not valid.";
       }else{
           $mobile = strlen((string)$email_phone);
           if($mobile>10 || $mobile<10){
               $errors[]="Mobile Number is not valid.";
           }else{
            if(empty($password)){
               $errors[]="Please provide your password";
              }
               else if(strlen($password)<6 || strlen($password)>=30){
                  $errors[]="Password must be between 6-30 characters";
              }else{
                  if(DB::query('SELECT mobile FROM users WHERE mobile=:mobile',
                  array(':mobile'=>$email_phone))){
                      $errors[]="Phone number already in use";
                  }else{
                  
                    $user_id = $loadUser->create('users',array( 
                      'first_name'=>$first_name,
                      'last_name'=>$last_name,
                      'mobile'=>$email_phone,
                      'password'=>password_hash($password,PASSWORD_BCRYPT),
                      'username'=>$username,
                      'link'=>$link,
                      'birthday'=>$birthday,
                      'gender'=>$gender
                    ));



                    $loadUser->create('profile',array(
                        'user_id'=>$user_id,
                        'birthday'=>$birthday,
                        'first_name'=>$first_name,
                        'last_name'=>$last_name,
                        'profile_picture'=>'assets/images/defaultProfile.png',
                        'cover'=>'assets/images/defaultCover.png',
                        'gender'=>$gender,


                    ));




                    $tstrong=true;
                    $token =bin2hex(openssl_random_pseudo_bytes(64,$tstrong));
                    $loadUser->create('token',array('token'=>sha1($token),'user_id'=>$user_id));
                    setcookie('USERID',$token,time()+60*60*24*7,'/',NULL,NULL,true);
                    header('Location:index.php');
                  }
              }
          }
       }
   }else {if(!filter_var($email_phone)){
      $errors[]="Invalid Email Format";
   }else if(filter_var($email_phone,FILTER_VALIDATE_EMAIL) 
   && $loadUser->checkEmail($email_phone)===true){
       $errors[]="Email alreay in use"; 
   }
   else if(empty($password)){
    $errors[]="Please provide your password";
   }
   else if(strlen($password)<6 || strlen($password)>=30){
       $errors[]="Password must be between 6-30 characters";
   }
   else{
   
    $password = $loadUser->checkInput(($password));
    $first_name = $loadUser->checkInput(($first_name));
    $last_name = $loadUser->checkInput(($last_name));
    $email_phone = $loadUser->checkInput(($email_phone));

        
         $user_id = $loadUser->create('users',array(
    'first_name'=>$first_name,
    'last_name'=>$last_name,
    'email'=>$email_phone,
    'password'=>password_hash($password,PASSWORD_BCRYPT),
    'username'=>$username,
    'link'=>$link,
    'birthday'=>$birthday,
    'gender'=>$gender
    ));
     
    $loadUser->create('profile',array(
        'user_id'=>$user_id,
        'birthday'=>$birthday,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'profile_picture'=>'assets/images/defaultProfile.png',
        'cover'=>'assets/images/defaultCover.png',
        'gender'=>$gender,


    ));


    $tstrong=true;
    $token =bin2hex(openssl_random_pseudo_bytes(64,$tstrong));
    $loadUser->create('token',array('token'=>sha1($token),'user_id'=>$user_id));
    setcookie('USERID',$token,time()+60*60*24*7,'/',NULL,NULL,true);
    header('Location:index.php');
    
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
    <div class="container" id="containerr">
        <div class="left">
            <img src="assets/images/logo.svg" alt="" class="icon" />
            <p class="desc">
                Facebook helps you connect and <br />
                share with the people in your life.
            </p>
        </div>
        <form action="sign.php" method="post" class="right">
            <input type="text" class="input_login" placeholder="Email or phone Number" />
            <input type="password" class="input_login" placeholder="Password" />
            <input type="submit" name="submit_login" class="btn_login" value="Log in" />
            <a class="pf">Forget password?</a>
            <a class="openRegister" id="open">
                Create New account
            </a>
        </form>
    </div>
    <form data-backdrop="static" action="signup.php" method="post" class="register_container" id="register_form">
        <a href="login.php">
            <i class="closeBtn fa fa-times" id="closeBtn" aria-hidden="true"></i>
        </a>
        <div class="heading_container">
            <p class="heading">Sign Up</p>
            <p class="heading_desc">It's quick and easy</p>
            <?php if(!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="input_div">
            <input type="text" value="<?php echo $first_name ?>" name="first_name" id='first_name'
                class="register_input" placeholder="First name" />
            <input type="text" name="last_name" value="<?php echo $last_name ?>" id='last_name' class="register_input"
                placeholder="last name" />
        </div>
        <input class="register_input" name="email_phone" value="<?php echo $email_phone ?>" id='email_phone'
            placeholder="Email address" />
        <input type="password" name="password" id="password" class="register_input" placeholder="Password" />
        <div>
            <p class="date_of">Date of birth</p>
            <div class="flex">
                <select name="birth_day" id="days">

                </select>
                <select name="birth_month" id="months">

                </select>
                <select name="birth_year" id="years">

                </select>
            </div>
        </div>
        <div>
            <p class="date_of">Gender</p>
            <div class="flex">
                <label for="female" class="gender_felx">
                    <label for="female">Female</label>
                    <input type="radio" value="female" id="female" name="gender" />
                </label>
                <label for="male" class="gender_felx">
                    <label for="male">Male</label>
                    <input type="radio" value="male" id="male" name="gender" />
                </label>
                <label for="gay" class="gender_felx" style="width: 40%">
                    <label for="gay">why are you gay</label>
                    <input type="radio" value="why are you gay" id="gay" name="gender" />
                </label>
            </div>
        </div>
        <p class="clicking">
            By clicking Sign Up, you agree to our Terms, Data Policy and
            Cookie Policy. You may receive SMS notifications from us and can
            opt out at any time.
        </p>
        <input class="openRegister md" name="submit_register" type="submit" value="Sign Up" />
    </form>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script>
    for (i = new Date().getFullYear(); i > 1900; i--) {

        $("#years").append($('<option/>').val(i).html(i));

    }
    for (i = 1; i < 13; i++) {
        $("#months").append($('<option/>').val(i).html(i));
    }
    updateDays();

    function updateDays() {
        $('#days').html('');
        month = $('#months').val();
        year = $('#years').val();
        days = daysInMonth(month, year);
        for (i = 1; i < days + 1; i++) {
            $('#days').append($('<option/>').val(i).html(i));
        }
    }

    $('#years,#months').on('change', function() {
        updateDays();
    })

    function daysInMonth() {
        return new Date(year, month, 0).getDate();
    }
    </script>
</body>

</html>