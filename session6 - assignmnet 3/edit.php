<?php
require_once 'includes/header.php';
require_once 'classes/file_handle.php';

Authentication::is_auth();
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $user = User_Database::find_user_by_id($id);
}

if(isset($_POST['edit']) && isset($_POST['id']) && !empty($_POST['id'])){

    //get user id from database the last entry    
   $user = User_Database::find_user_by_id($_POST['id']);
    $user->name = $_POST['name'];
    $user->age = $_POST['age'];
    $user->email = $_POST['email'];
    $user->username = $_POST['username'];    

    $errors = null;
    if(empty($user->name)){
        $errors['name'] = 'Name field is required!';
    }
    if(empty($user->age)){
        $errors['age'] = 'Age field is required!';
    }
    if(empty($user->email)){
        $errors['email'] = 'Email field is required!';
    }
    if(empty($user->username)){
        $errors['username'] = 'Username field is required!';
    }
  
    
    set_message('error',$errors);
    if(empty($errors)){
        $user->upload_profile_image($_FILES['profile_image']);
        redirect('users.php');       
    }
}

    echo "<h2>Edit</h2>";

?>
<div id="register-div">

        <h3>User Edit Form</h3>
        <span class="error"><?php echo get_message('error');?></span><br/>
        <?php 
        $error[] = get_message('error');
        $error = $error[0];                
        ?>
        <form action="edit.php" method="post" id="register_form" enctype="multipart/form-data">
        <input class="user-input" type="hidden" name="id" id="id" value="<?php echo isset($user->id)?$user->id:"";?>"/>
            <label for="name">Name:</label>
            <input class="user-input" type="text" name="name" id="name" placeholder="Name" 
            value="<?php echo isset($user->name)?$user->name:"";?>"/>
            <span class="error"><?php echo isset($error['name'])?$error['name']:"";?></span><br/>

            <label for="age">Age:</label>
            <input class="user-input" type="text" name="age" id="age" placeholder="Age"
            value="<?php echo isset($user->age)?$user->age:"";?>"/>
            <span class="error"><?php echo isset($error['age'])?$error['age']:"";?></span><br/>

            <label for="email">Email:</label>
            <input class="user-input" type="email" name="email" id="email" placeholder="Email"
            value="<?php echo isset($user->email)?$user->email:"";?>"/>
            <span class="error"><?php echo isset($error['email'])?$error['email']:"";?></span><br/>
            
            <label for="username">Username:</label>            
            <input class="user-input" type="username" name="username" placeholder="Username"
            value="<?php echo isset($user->username)?$user->username:"";?>"/>
            <span class="error"><?php echo isset($error['username'])?$error['username']:"";?></span><br/>
            
            <label for="profile_image">Upload Your Photo</label>
            <input class="user-input" type="file" name="profile_image" id="profile_image"
            value="<?php echo isset($user->username)?$user->username:"";?>"/>
            <br/>


            <input type="submit" name="edit" id="btn-register" value="Edit"/>            
        </form>                
        <p class="error"><?php print_r(get_message('error'));?></p>
    </div>



<?php
//}//end else
require_once 'includes/footer.php';
