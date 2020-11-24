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
                        <div class="col-xs-6">
                            <?php insert_cat(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                <label for="cat-title">Add Category </label>
                                <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                                </div>


                            </form>
                            <?php
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include("includes/update_category.php");
                            }

                            ?>

                        </div>
                        <div class="col-xs-6">
                          
                            <table class="table table-bordered table-hoverd">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- FIND all  CATEGOEIES -->
                                <?php finsAllCategories(); ?>

                                <!-- DELETE CATEGORIES -->
                                <?php deleteCategories();?>
                                  
                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include("includes/footer.php") ?>