<div class="col-md-4">
<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
   <form action="search.php" method="post">

   <div class="input-group">
        <input name='search' type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    <!-- formsearch -->
   </form>
    <!-- /.input-group -->
</div>

<!-- LOGIN -->

<?php if(!isset($_SESSION['username'])){ ?>
<div class="well">
    <h4>User Login</h4>
   <form action="includes/login.php" method="post">

   <div class="form-group">
        <input name='username' type="text" class="form-control" placeholder='Enter Username'>
    </div>
   <div class="input-group">
        <input name='password' type="password" class="form-control" placeholder='Enter Username'>
        <span class="input-group-btn">
        <button class="btn btn-primary" name='login' type='submit'>submit</button>
        </span>
    </div>
   
    <!-- formsearch -->
   </form>
   <span>Don't have an account please register <a href="registration.php">Here</a></span>
    <!-- /.input-group -->
</div>

<?php }?>


<!-- Blog Categories Well -->
<div class="well">


        <?php
        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($conn, $query);
        ?>
        
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php
                while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include('widget.php'); ?>

</div>