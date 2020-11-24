<?php include("includes/header.php") ?>
<?php
    if(isset($_SESSION['username'])){
    $the_username = $_SESSION['username'];
    $query  = "SELECT * FROM users WHERE username = '$the_username'";
    $user_fetch_result = mysqli_query($conn, $query);
    confirm($user_fetch_result);
    while($row= mysqli_fetch_assoc($user_fetch_result)){
        $username = $row['username'];
        $user_role = $row['user_role'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
}

if(isset($_POST['update_user'])){
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    

    $query = "UPDATE users  SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password= '{$user_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE username = '{$the_username}' ";


    $update_user = mysqli_query($conn, $query);
    confirm($update_user);
}



?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/navigation.php") ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

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
                <input type="submit" class="btn btn-primary" name='update_user' value='Update Profile' />
            </div>

        </form>
                    </div>

                   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include("includes/footer.php") ?>