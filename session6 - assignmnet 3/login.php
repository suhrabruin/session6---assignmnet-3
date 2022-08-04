<?php
require_once 'classes/authentication.php';

if(isset($_POST['submit'])){
    $username = isset($_POST['username'])?$_POST['username']:null;
    $password = isset($_POST['password'])?$_POST['password']:null;    
    
    (Authentication::authenticate($username,$password))?redirect('dashboard.php'):redirect('index.php');
    
}else{
    header('Location:index.php');
}