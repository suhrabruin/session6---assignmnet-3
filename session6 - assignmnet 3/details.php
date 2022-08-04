<?php
require_once 'includes/header.php';

Authentication::is_auth();


$id = (int)$_GET['id'];
$user = User_Database::find_user_by_id($id);

?>
<h2>User Details</h2>
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
