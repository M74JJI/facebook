<?php

include 'DB.php';

class login{
    public static function isLoggedIn(){
        if(isset($_COOKIE['USERID'])){
            if(DB::query('SELECT user_id FROM token WHERE token=:token',
            array(':token'=>sha1($_COOKIE['USERID'])))){

               $user_id = DB::query('SELECT user_id FROM token WHERE token=:token',
                array(':token'=>sha1($_COOKIE['USERID'])))[0]['user_id'];
                return $user_id;
            }
        }
    }
}



?>