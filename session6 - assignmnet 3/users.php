<?php
require_once 'includes/header.php';

Authentication::is_auth();

$users = User_Database::get_users();

?>
<h2>Users</h2>
<span class="error"><?php echo get_message('error');?></span><br/>
<a href="register.php" class="btn-register btn">Register</a>
<div class="users">
    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Image Path</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($users as  $user):?>
            <tr>
                <td><?php echo $user->id;?></td>
                <td><?php echo $user->name;?></td>
                <td><?php echo $user->username;?></td>
                <td><?php echo $user->email;?></td>
                <td><?php 
                if(!empty($user->image_path)){
                    echo $user->image_path;
                    ?>
                    <a style="background:red;color:white; padding:2px 5px; border-radius:3px; text-decoration:none;" href="delete_image.php?id=<?php echo $user->id;?>&path=<?php echo $user->image_path;?>" onclick="return confirm('Are you sure to delete?')">Delete File</a>
                <?php
                }
                ?>
            
            </td>
                <td><a href="edit.php?id=<?php echo $user->id;?>">Edit</a>
                <a href="delete.php?id=<?php echo $user->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                <a href="details.php?id=<?php echo $user->id;?>">Details</a></td>                
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php
require_once 'includes/footer.php';
