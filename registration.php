<?php  include "includes/header.php"; ?>
<?php  require_once "includes/db.php"; ?>


<?php

    $message = '';
    if(isset($_POST['submit'])){
       $username =$_POST['username'];
       $email =$_POST['email'];
       $password =$_POST['password'];
      
    

       $username = mysqli_real_escape_string($conn, $username);
       $email = mysqli_real_escape_string($conn,$email);
       $password =  mysqli_real_escape_string($conn,$password);

       if(empty($username) || empty($password) || empty($email)){
           $message ="All Fields are mandetory";
       }else{
        $query = "SELECT randSalt From users";
        $select_randSalt_query = mysqli_query($conn, $query);
        if(!$select_randSalt_query){
            die("Query Failed".mysqli_error($conn));
        }
         $row = mysqli_fetch_array($select_randSalt_query);
          $salt = $row['randSalt'];
          $password = crypt($password, $salt);
 
          $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
          $query.= "VALUES('$username', '$email', '$password' ,'default') ";
 
          $register_user_query = mysqli_query($conn, $query);
         
             if(!$register_user_query){
                 $message = "Something went wrong please Try again";
                 die("QUERY FAILED".mysqli_error($conn));
             }else{
                $message = "Your registration has been submitted";
             }
             
       
       }

       
       

       
    }

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <?php
                   if(!empty($message)){
                       echo "<h4 class ='alert alert-danger txt-center'>$message</h4>";
                   }
                ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
