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
                      <?php
                      if(isset($_GET['source'])){
                          $source = $_GET['source'];
                      }else{
                        $source ='';
                      }

                      switch($source){
                          case '100':
                            echo "Hello world";
                            break;
                          case 'add_post':
                            include("includes/add_post.php");
                            break;
                          case "edit_post":
                            include("includes/edit_post.php");
                           break;
                          default:
                          include("includes/view_all_comments.php");
                      }

                      

                
                    

                      ?>
                    
                     
                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include("includes/footer.php") ?>