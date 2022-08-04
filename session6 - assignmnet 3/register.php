<?php
require_once 'includes/header.php';
require_once 'classes/file_handle.php';

Authentication::is_auth();

if(isset($_POST['register'])){    
    //get user id from database the last entry    
    $user = new User();
    $user->id =User_Database::generate_id();
    $user->name = $_POST['name'];
    $user->age = $_POST['age'];
    $user->email = $_POST['email'];
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $c_password = $_POST['c_password'];

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
    if(empty($user->password)){
        $errors['password'] = 'Password field is required!';
    }
    if(empty($c_password)){
        $errors['c_password'] = 'Confirm Password field is required!';
    }
    if($user->password !==$c_password){
        $errors['c_password'] = 'Password and Confirm Password fields do not match!';
    }
    set_message('error',$errors);
    if(empty($errors)){

        $user->image_path = get_default_image();
        if(isset($_FILES['profile_image']['tmp_name']) && !empty($_FILES['profile_image']['tmp_name'])){
            $file = $_FILES['profile_image'];            
            $extension = substr($file['name'],strpos($file['name'],".")+1);
            $user->image_path = get_default_path().$user->id."_".$user->username.".".$extension;

            File_Handle::upload($file,$user->image_path);
        }
        User_Database::add_user($user);
        redirect('users.php');
    }
}

    echo "<h2>Register</h2>";

?>
<div id="register-div">
        <h3>User Registration Form</h3>
        <?php 
        $error[] = get_message('error');
        $error = $error[0];                
        ?>
        <form action="register.php" method="post" id="register_form" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input class="user-input" type="text" name="name" id="name" placeholder="Name" 
            value="<?php echo isset($_POST['name'])?$_POST['name']:"";?>"/>
            <span class="error"><?php echo isset($error['name'])?$error['name']:"";?></span><br/>

            <label for="age">Age:</label>
            <input class="user-input" type="text" name="age" id="age" placeholder="Age"
            value="<?php echo isset($_POST['age'])?$_POST['age']:"";?>"/>
            <span class="error"><?php echo isset($error['age'])?$error['age']:"";?></span><br/>

            <label for="email">Email:</label>
            <input class="user-input" type="email" name="email" id="email" placeholder="Email"
            value="<?php echo isset($_POST['email'])?$_POST['email']:"";?>"/>
            <span class="error"><?php echo isset($error['email'])?$error['email']:"";?></span><br/>
            
            <label for="username">Username:</label>            
            <input class="user-input" type="username" name="username" placeholder="Username"
            value="<?php echo isset($_POST['username'])?$_POST['username']:"";?>"/>
            <span class="error"><?php echo isset($error['username'])?$error['username']:"";?></span><br/>
            
            <label for="password">Password:</label>            
            <input class="user-input" type="password" name="password" placeholder="Password"
            value="<?php echo isset($_POST['password'])?$_POST['password']:"";?>"/>
            <span class="error"><?php echo isset($error['password'])?$error['password']:"";?></span><br/>
            
            <label for="c_password">Confirm Password:</label>
            <input class="user-input" type="password" name="c_password" id="c_password" placeholder="Confirm your password"
            value="<?php echo isset($_POST['c_password'])?$_POST['c_password']:"";?>"/>
            <span class="error"><?php echo isset($error['c_password'])?$error['c_password']:"";?></span><br/>
            
            <label for="profile_image">Upload Your Photo</label>
            <input class="user-input" type="file" name="profile_image" id="profile_image" /><br/>


            <input type="submit" name="register" id="btn-register" value="Register"/>            
        </form>                
        <p class="error"><?php print_r(get_message('error'));?></p>
    </div>



<?php
//}//end else
require_once 'includes/footer.php';
