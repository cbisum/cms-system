<?php

if(isset($_POST['checkBoxArray'])){
   foreach($_POST['checkBoxArray'] as $postValueId){
       $bulk_options = $_POST['bulk_options'];
       
       switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= $postValueId";
                $update_published_query = mysqli_query($conn, $query);
                confirm($update_published_query);
            break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= $postValueId";
                $update_draft_query = mysqli_query($conn, $query);
                confirm($update_draft_query);
            break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id= $postValueId";
                $update_delete_query = mysqli_query($conn, $query);
                confirm($update_delete_query);
            break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '$postValueId'";
                $select_post_query = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($select_post_query)){
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_img'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
                $query ="INSERT INTO posts(post_category_id,post_title, post_author, post_date, post_img, post_content, post_tags, post_status)";
                $query .= "VALUES($post_category_id, '$post_title', '$post_author',now(),'$post_image', '$post_content','$post_tags','$post_status')";
                $copy_query = mysqli_query($conn, $query);
                if(!$copy_query){
                    die("QUERY FAILED".mysqli_error($conn));
                }
                
            break;
            default:
                return null;

       }

   }
}


?>


<form action="" method='post'>
<table class="table table-bordered table-hover">
                    <div id="bulkOptionsContainer" class='col-xs-4' style='padding:0px'>
                        <select class='form-control' name="bulk_options" id="">
                            <option value="">Select Options</option>
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>
                            <option value="clone">Clone</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                    <input type="submit" name='submit' class='btn btn-success' value='apply'>
                    <a href="posts.php?source=add_post" class='btn btn-primary'>Add New</a>
                    </div><br ><br >
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id='selectAllBoxes'></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Dates</th>
                                    <th>View</th>
                                    <th>Actions</th>
                                    <th>Views Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getAllPosts(); ?>
                                
                                    
                                
                            </tbody>
                        </table>
<?php
    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = $the_post_id";
        $delete_query = mysqli_query($conn, $query);
        header("Location:posts.php");
        confirm($delete_query);
    }

?>

</form>