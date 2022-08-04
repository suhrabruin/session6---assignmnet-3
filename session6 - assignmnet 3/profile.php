<?php
require_once 'includes/header.php';

Authentication::is_auth();
$auth_user = User::get_auth_user();
$user = User_Database::find_user_by_id($auth_user->id);
?>
<h2>My Profile</h2>
<span class="error"><?php echo get_message('error');?></span><br/>
<div class="profile">
    <div class="profile-img-div">
        <img class="profile-img" src="<?php
        
        if(isset($user->image_path)  && !empty($user->image_path) && file_exists($user->image_path)){
            echo $user->image_path;
        }else{
            echo get_default_image();
        }         
        ?>" alt="Profile Picture"/>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user->id;?>">            
            <input type="file" name="profile_image">
            <input class="btn" type="submit" name="upload" value="Upload"/>
        </form>
    </div>
    <div>
        <p class="profile-id"><span>ID:</span><?php echo $user->id;?></p>
        <p class="profile-name"><span>Name:</span><?php echo $user->name;?></p>
        <p class="profile-age"><span>Age:</span><?php echo $user->age;?></p>
        <p class="profile-username"><span>Username:</span><?php echo $user->username;?></p>
        <p class="profile-email"><span>Email:</span><?php echo $user->email;?></p>
    </div>
</div>


<?php

require_once 'includes/footer.php';
