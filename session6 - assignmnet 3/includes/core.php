<?php
 require_once 'classes/user.php';
 require_once 'classes/session.php';
 require_once 'classes/user_database.php';
 require_once 'classes/authentication.php';


function set_message($name,$message){
    Session::set_session($name,$message);
}

function get_message($name){
    $msg =  Session::get_session($name);
    Session::set_session($name,null);    
    return $msg;
}

function redirect($redirect_to){      
    header('Location: '.$redirect_to);
}

function get_default_path(){
    return 'storage/images/';
}

function get_default_image(){
    return get_default_path().'profile-demo.png';
}