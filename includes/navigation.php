<?php require_once("includes/db.php"); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Chan's Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->




            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                      $cat_title = $row['cat_title'];
                      $cat_id = $row['cat_id'];
                      echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                ?>


                  <?php if(isset($_SESSION['user_role']) == 'admin'){ ?>
                    <li>
                        <a href="admin">Admin pannel</a>
                    </li>

                    <?php if(isset($_GET['p_id'])){ ?>
                        <li>
                        <a href="admin/posts.php?source=edit_post&p_id=<?php echo $_GET['p_id']; ?>">Edit this post</a>
                    </li>
                  <?php }} ?>

                    <!-- <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
                
                <?php

                if(isset($_SESSION['username'])){?>
                <ul class="nav navbar-right top-nav">                
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                    </li>
                </ul>

                    
                <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
