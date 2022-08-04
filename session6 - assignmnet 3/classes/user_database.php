<?php
require_once 'includes/core.php';
require_once 'file_handle.php';

class User_Database{
    private static $file_name= "database\users.txt";
    protected static $users_array;
    public function __construct(){
        
    }

    private static function initialize(){
        $user1 = new User();
        $user1->id = 1;
        $user1->name = 'suhrab';
        $user1->age=38;
        $user1->email='suhrab.ruin@gmail.com';
        $user1->username='suhrab';
        $user1->password='';
        $user1->image_path=get_default_path(); 
        $users = array($user1);
        File_Handle::write_file(self::$file_name,serialize($users));
    }

    public static function find_user($username,$password){
        if(empty(self::get_users())){
            self::initialize();
        }
        $users = self::get_users();
    
        foreach($users as $user){           
            if($username == $user->username && $password==$user->password){                        
                return $user;            
            }
        }
        return null;
    }

    public static function get_users(){                
       if(empty(self::$users_array)){        
            self::$users_array = unserialize(File_Handle::read_file(self::$file_name));
       }       
       return self::$users_array;
    }

    function add_user($user){
        $users = self::get_users();
        array_push($users,$user);
        File_Handle::write_file(self::$file_name,serialize($users));
    }

    public static function generate_id(){    
        $users = self::get_users();
        $last_user = end($users);   
        return (int)$last_user->id + 1;
    }

    public static function update_path($id,$path){
        $users = self::get_users();   
        foreach($users as $key => $value)
        {
            if($value->id == $id){            
                $users[$key]->image_path = $path;           
            }
        }
        File_Handle::write_file(self::$file_name,serialize($users));
    }

    public static function find_user_by_id($id){
        $users = self::get_users(); 
        
        foreach($users as $key => $value)
        {
            if($value->id == $id){            
                return $value;
            }
        }
        return null;    
    }

    public static function delete_user($id){    
        //don't delete first user
        if($id==1 || $id==User::get_auth_user()->id){ 
            set_message('error','You are not allowed to delete this user!');        
            return false;
        }
        $users = self::get_users();        
        foreach($users as $key => $value)
        {
            if($value->id == $id){            
            unset($users[$key]);
            }        
        }
        File_Handle::write_file(self::$file_name,serialize($users));
        return true;
    }

    public static function edit_user($user){
        $users = self::get_users();        
        foreach($users as $key => $value)
        {
            if($value->id == $user->id){            
            $users[$key] = $user;
            break;
            }            
        }
        File_Handle::write_file(self::$file_name,serialize($users));
    }
}