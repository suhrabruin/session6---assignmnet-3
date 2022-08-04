<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php 
  require_once 'includes/core.php';   
  Authentication::is_auth();
  ?>
    <div class="main-wrapper">
        <div class="header-menu">
            <ul>
                <li class="btn-home"><a href="dashboard.php">Home</a></li>
                <li class="btn-post"><a href="posts.php">Posts</a></li>
                <li class="btn-user"><a href="users.php">Users</a></li>                
                <li class="btn-profile"><a href="profile.php">Profile</a></li>
                <li class="btn-logout"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
          <?php if(User::is_login()){ ?>
            <p style="text-align:right;"><span >Dear <em><?php echo ucwords(User::get_auth_user()->name);?></em> please logout once done!</span></p>
          <?php } ?>        
        <div class="content-wrapper">
        <h1 style="text-align:center;">Session 6 - Assignment 3</h1>
        <p class="error"><?php echo get_message('error');?></p>
