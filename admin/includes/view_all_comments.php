<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>comment</th>
                                    <th>Status</th>
                                    <th>In Response to </th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php getAllComments(); ?>
                                
                                    
                                
                            </tbody>
                        </table>
<?php
     if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = $comment_id";
        $deleted_data = mysqli_query($conn, $query);

        if(!$deleted_data){
            die("data deleted successfully".mysqli_error($conn));
        }
        header("Location:comments.php");
    }

    if(isset($_GET['approve'])){
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved'  WHERE comment_id = $comment_id";
        $updated_data = mysqli_query($conn, $query);

        if(!$updated_data){
            die("failed".mysqli_error($conn));
        }
        header("Location:comments.php");
    }
    if(isset($_GET['unapprove'])){
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved'  WHERE comment_id = $comment_id";
        $updated_data = mysqli_query($conn, $query);

        if(!$updated_data){
            die("failed".mysqli_error($conn));
        }
        header("Location:comments.php");
    }

?>