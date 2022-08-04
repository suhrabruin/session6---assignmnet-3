<?php
require_once 'user_database.php';

class Authentication{
    public static function authenticate($username,$password){        
        //fetch data from database
        
        //find_user method returns an object of user type
        $found_user = User_Database::find_user($username,$password);        
        if($found_user){                      
            $found_user->login();
            return true;            
        }else{
            set_message('error','Invalid Username or Password');            
            return false;
        }
    }

    public static function is_auth(){
        if(!User::is_login()){
            redirect('index.php');
        }
    }
    
}