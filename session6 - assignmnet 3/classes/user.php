<?php

require_once 'session.php';
require_once 'includes/core.php';
require_once 'classes/file_handle.php';

class User{

    public static function is_login(){
        return Session::isset('login');
    }
    public function login(){        
        Session::set_session('auth_user',$this);
        Session::set_session('login',true);
    }

    public static function logout(){        
        Session::destroy_session('login');
        redirect('index.php');
    }
    public static function get_auth_user(){
        return Session::get_session('auth_user');
    }

    public function upload_profile_image($file){        
        $old_path = $this->image_path;
        $this->image_path = get_default_image();
        
        if(isset($file['tmp_name']) && !empty($file['tmp_name'])){            
            $extension = substr($file['name'],strpos($file['name'],".")+1);
            $this->image_path = get_default_path().$this->id."_".$this->username.".".$extension;
            File_Handle::delete($old_path);
            if(File_Handle::upload($file,$this->image_path)){
                User_Database::edit_user($this);
            }
        }else{
            echo "error: upload_profile_image";
            die;
        }
    }

}