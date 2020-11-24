<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Profile Image</th>
                                    <th>Role</th>
                                    <th>Make Admin</th>
                                    <th>Make Default User</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php getAllUsers(); ?>
                                
                                    
                                
                            </tbody>
                        </table>
<?php
     if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $user_id";
        $deleted_data = mysqli_query($conn, $query);

        if(!$deleted_data){
            die("User Delete Failed".mysqli_error($conn));
        }
        header("Location:users.php");
    }

    if(isset($_GET['change_to_admin'])){
        $user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin'  WHERE user_id = $user_id";
        $updated_data = mysqli_query($conn, $query);

        if(!$updated_data){
            die("failed".mysqli_error($conn));
        }
        header("Location:users.php");
    }
    if(isset($_GET['change_to_default'])){
        $user_id = $_GET['change_to_default'];
        $query = "UPDATE users SET user_role = 'default'  WHERE user_id = $user_id";
        $updated_data = mysqli_query($conn, $query);

        if(!$updated_data){
            die("failed".mysqli_error($conn));
        }
        header("Location:users.php");
    }

?>