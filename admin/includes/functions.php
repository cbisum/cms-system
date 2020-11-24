<?php
function confirm($result){
    global $conn;
    if(!$result){
        die("QUERY FAILED".mysqli_error($conn));
    }

}

function insert_cat(){
    global $conn;
    if(isset($_POST["submit"])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "you need to provide category title";
        }else{
            $query = "INSERT INTO categories(cat_title)";
            $query.="VALUE('{$cat_title}')";
            $create_categories = mysqli_query($conn,$query);
            if(! $create_categories){
                die("unsuccessful");
            }
        }
      }
      
}


function finsAllCategories(){
        global $conn;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($conn, $query);
         while($row = mysqli_fetch_assoc($select_categories)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "  <tr>
            <td>$cat_id</td>

            <td>$cat_title</td>
            <td><a class='btn btn-danger' href='categories.php?delete=$cat_id'>Delete</a> <a class='btn btn-info'  href='categories.php?edit=$cat_id'>Update</a></td>
           
        </tr>";
            }
}


function deleteCategories(){
    global $conn;
    if(isset($_GET["delete"])){
        $the_cat_id =  $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
        $delete_query = mysqli_query($conn, $query);
        header("Location:categories.php");

        if(!$delete_query){
            die("unsuccessful");
        }
    }
}


function getAllPosts(){
    global $conn;
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $select_posts = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($select_posts)){
        $post_title = $row['post_title'];
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_category_id = $row['post_category_id'];
        $post_comment_count= $row['post_comment_count'];
        $post_img = $row['post_img']; 
        $post_views = $row['post_views_count']; 
        
        echo "<tr>";
        echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'  value=$post_id></td>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title </td>";

        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $select_categories = mysqli_query($conn, $query);
        while($row= mysqli_fetch_assoc($select_categories)){
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
        }
        echo "<td>$post_status</td>";
        echo  "<td><img  src='../images/$post_img' width='50px' height='50px' alt='image'/></td>";
        echo  "<td>$post_tags</td>";
        echo  "<td>$post_comment_count</td>";
        echo  "<td>$post_date</td>";
        echo "<td><a class='btn' href='../post.php?p_id=$post_id'>View</a></td>";
         echo  "<td>
                <a class='btn' href='posts.php?delete=$post_id'>Delete</a>
                <a class='btn' href='posts.php?source=edit_post&p_id={$post_id}'>edit</a>
                </td>";
        echo "<td>$post_views</td>";
        echo "</tr>";
     }
}



function getAllComments(){
    global $conn;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        
        echo "<tr>";
        echo "<td>$comment_id </td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_email</td>";
        echo  "<td>$comment_content</td>";
        echo  "<td>$comment_status</td>";
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post = mysqli_query($conn, $query);
        while($row= mysqli_fetch_assoc($select_post)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a target='_blank' class='btn' href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }
        echo  "<td>$comment_date</td>";
        echo  "<td><a class='btn' href='comments.php?approve=$comment_id'>approve</a></td>";
        echo "<td><a class='btn' href='comments.php?unapprove=$comment_id'>unapprove</a>
                </td>";
        echo "<td><a class='btn' href='comments.php?delete=$comment_id'>Delete</a>
                </td>";
        echo "</tr>";
     }
}
function getAllUsers(){
    global $conn;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
        
        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo  "<td>{$user_lastname}</td>";
        echo  "<td>{$user_email}</td>";
        echo  "<td>Your Image</td>";
        // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        // $select_post = mysqli_query($conn, $query);
        // while($row= mysqli_fetch_assoc($select_post)){
        //     $post_id = $row['post_id'];
        //     $post_title = $row['post_title'];
        //     echo "<td><a target='_blank' class='btn' href='../post.php?p_id=$post_id'>$post_title</a></td>";
        // }
        echo  "<td>{$user_role}</td>";
        echo  "<td><a class='btn' href='users.php?change_to_admin=$user_id'>Admin</a></td>";
        echo  "<td><a class='btn' href='users.php?change_to_default=$user_id'>Default</a></td>";
        echo "<td><a class='btn btn-danger' href='users.php?delete=$user_id'>Delete</a>
                </td>";
        echo "<td><a class='btn' href='users.php?source=edit_user&u_id={$user_id}'>Edit</a>
                </td>";
        echo "</tr>";
     }
}


function users_online_method(){
    global $conn;
    $session = session_id();
    $time = time();
    $time_out_in_second = 20;
    $time_out = $time-$time_out_in_second;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($conn, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL){
        mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    }else{
        mysqli_query($conn, "UPDATE users_online SET time ='$time' WHERE session = '$session'");
    }

    $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time>'$time_out'");

    $count_users = mysqli_num_rows($users_online_query);

    return $count_users;

}

users_online_method();


















?>