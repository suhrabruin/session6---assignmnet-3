<?php
require_once 'includes/core.php';
require_once 'classes/Authentication.php';
require_once 'classes/user_database.php';

Authentication::is_auth();


$id = (int)$_GET['id'];
$path = (string)$_GET['path'];


if($path =='storage/images/profile-demo.png'){
    set_message("error","Do not delete default image");
}else{  
    if(file_exists($path)){
        if(unlink($path)){
            // User_Database::update_path($id,null);
        }   
    }
    User_Database::update_path($id,null);
}
redirect('users.php');