<?php include("includes/header.php") ?>
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

                        
                      
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                        
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                        <div class='huge'>
                            <?php
                                $query = "SELECT * FROM posts";
                                $select_all_post = mysqli_query($conn, $query);
                                confirm($select_all_post);
                                $num_posts = mysqli_num_rows($select_all_post);
                                echo $num_posts;
                                


                            ?>
                        </div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'>

                            <?php
                                $query = "SELECT * FROM comments";
                                $select_all_comments = mysqli_query($conn, $query);
                                confirm($select_all_comments);
                                $num_comments = mysqli_num_rows($select_all_comments);
                                echo $num_comments;
                                


                            ?>
                            </div>
                            <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'>
                            <?php
                                $query = "SELECT * FROM users";
                                $select_all_users = mysqli_query($conn, $query);
                                confirm($select_all_users);
                                $num_users = mysqli_num_rows($select_all_users);
                                echo $num_users;
                                


                            ?>
                        
                        </div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                <?php
                                $query = "SELECT * FROM categories";
                                $select_all_categories = mysqli_query($conn, $query);
                                confirm($select_all_categories);
                                $num_categories = mysqli_num_rows($select_all_categories);
                                echo $num_categories;
                                


                            ?>
                                
                                </div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
                <!-- /.row -->

<?php 
 $query = "SELECT * FROM posts WHERE post_status ='published'";
 $select_all_published_post = mysqli_query($conn, $query);
 confirm($select_all_published_post);
 $num_published_posts = mysqli_num_rows($select_all_published_post);

 $query = "SELECT * FROM posts WHERE post_status ='draft'";
 $select_all_draft_post = mysqli_query($conn, $query);
 confirm($select_all_draft_post);
 $num_draft_posts = mysqli_num_rows($select_all_draft_post);


 $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
 $select_all_pending_comments = mysqli_query($conn, $query);
 confirm($select_all_pending_comments);
 $num_pedning_comments = mysqli_num_rows($select_all_pending_comments);


 $query = "SELECT * FROM users WHERE user_role = 'default'";
 $select_all_default_user = mysqli_query($conn, $query);
 confirm($select_all_default_user);
 $num_default_user = mysqli_num_rows($select_all_default_user);


?>

                <div class="row">
                            <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php
                        $elements_text = ['All Posts','Active Posts','Draft post','Comments', 'pedning comments' , 'Users','Suscriber', 'Categories'];
                        $elements_count = [$num_posts,$num_published_posts,$num_draft_posts,$num_comments,$num_pedning_comments,  $num_users,$num_default_user, $num_categories];
                        // $colors = ['fc8803','#8cfc03','#8cfc03','#03c6fc'];
                        for($i=0; $i<8; $i++){
                            echo "['{$elements_text[$i]}'".","."{$elements_count[$i]}],";
                      }

                        ?>
                    
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include("includes/footer.php") ?>