<?php include('includes/header.php'); ?>

<!-- Navigation -->
<?php include("includes/navigation.php"); ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->


        <div class="col-md-8">
            <?php

                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                    $post_author_name = $_GET['author'];
                }
                $query = "SELECT * FROM posts WHERE post_author = '$post_author_name'";
                $select_all_post_query = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($select_all_post_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_img'];
                    $post_content = $row['post_content'];
                   ?>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <?php echo $post_author; ?>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            
                    
          <?php      } ?>
                    <hr />


             <!-- Blog Comments -->
             <?php

             if(isset($_POST['create_comment'])){
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $post_id = $_GET['p_id'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content,comment_status, comment_date) ";
                    $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}','unapproved', now())";
                    $comment_insert = mysqli_query($conn, $query);
                    if(!$comment_insert){
                        die("QUERY FAILED".mysqli_error($conn));
                    }
   
   
                    $query = "UPDATE posts SET post_comment_count = post_comment_count+1 ";
                    $query .= "WHERE post_id = $post_id";
   
                    $update_comment_count = mysqli_query($conn, $query);
                }else{
                    echo "<script>alert('Fields cant be empty')</script>";
                }
                
                 
                 
             }

             ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action='' role="form" method='post'>
                        <div class="form-group">
                        <label for="Author">Name</label>
                           <input 
                            type="text"
                            placeholder="Enter your name"
                            class='form-control' name='comment_author'>
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                           <input 
                            type="email"
                            placeholder="Enter your Email address"
                            class='form-control' name='comment_email'>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea
                            name='comment_content'
                             class="form-control"
                            rows="3"
                            placeholder="Enter your Comment"
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name='create_comment'>Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
<?php
  $post_id = $_GET['p_id'];
 

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
$comment_select = mysqli_query($conn, $query);
if(!$comment_select){
    die("QUERY FAILED".mysqli_error($conn));
}
while($row = mysqli_fetch_assoc($comment_select)){
    $comment_author_name = $row['comment_author'];
    $commet_date = $row['comment_date'];
    $comment_content = $row['comment_content'];?>
     <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author_name; ?>
                            <small><?php echo $commet_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>



<?php } ?>

  

        </div>
        
        <hr />

        <!-- Blog Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include("includes/footer.php"); ?>
