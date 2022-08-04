<?php
require_once 'includes/core.php';
require_once 'classes/file_handle.php';

Authentication::is_auth();

$id = (int)$_GET['id'];
if($user = User_Database::find_user_by_id($id)){
    $profile_image = $user->image_path;
    if(User_Database::delete_user($id)){
        File_Handle::delete($profile_image);
    }
}else{
    set_message("error","User not found!");
}
redirect('users.php');