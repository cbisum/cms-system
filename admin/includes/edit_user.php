<?php

    if(isset($_GET['u_id'])){
       $user_id  = $_GET['u_id'];
    }
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $select_user_by_id = mysqli_query($conn, $query);
    confirm($select_user_by_id);
    while($row = mysqli_fetch_assoc($select_user_by_id)){
        $username = $row['username'];
        $user_id = $row['user_id'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        
        // $post_img = $row['post_img']; 
    }

    if(isset($_POST['update_user'])){
        $user_id  = $_GET['u_id'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];

        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        // move_uploaded_file($post_image_temp, "../images/$post_image");
        // if(empty($post_image)){
        //     $query ="SELECT * FROM posts WHERE post_id = $the_post_id";
        //     $select_image = mysqli_query($conn, $query);
            
        //     while($row = mysqli_fetch_array($select_image)){
        //         $post_image= $row['post_img'];
        //     }
        // }

        $query = "SELECT randSalt From users";
        $select_randSalt_query = mysqli_query($conn, $query);
        if(!$select_randSalt_query){
            die("Query Failed".mysqli_error($conn));
        }
         $row = mysqli_fetch_array($select_randSalt_query);
          $salt = $row['randSalt'];
          $hashed_password = crypt($user_password, $salt);

        $query = "UPDATE users  SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password= '{$hashed_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id} ";


        $update_user = mysqli_query($conn, $query);
        confirm($update_user);


       
    }



?>

<form action="" method='post' enctype='multipart/form-data'>
        <div class="form-group">
            <label for="username">Username</label>
            <input value="<?php echo $username; ?>" type="text" class='form-control' name='username' />
        </div>
       <div class="form-group">
            <label for="user_role">User Role</label><br >
            <select name="user_role" id="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
            if($user_role == 'admin'){
               echo "<option value='default'>Default</option>";
            }else{
                echo "<option value='admin'>Admin</option>"; 
            }
            ?>
            </select>
        </div>


        <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input value="<?php echo $user_firstname; ?>" type="text" class='form-control' name='user_firstname' />
        </div>
        <div class="form-group">
            <label for="user_lastname"> Last Name</label>
            <input value="<?php echo $user_lastname; ?>" type="text" class='form-control' name='user_lastname' />
        </div>
        <!-- <div class="form-group">
            <label for="post_image"> Profile Image</label>
            <input type="file"  name='image' />
        </div> -->
        <div class="form-group">
            <label for="user_email">Email</label>
            <input value="<?php echo $user_email; ?>" type="email" class='form-control'  name='user_email' />
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input value="<?php echo $user_password; ?>" type="password" class='form-control'  name='user_password' />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name='update_user' value='Update user' />
        </div>

</form>









     