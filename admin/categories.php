<?php include "includes/admin_header.php";
include "../includes/db.php";
include "../functions.php";
?>

<body>

<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">
                        <?php
                        inserting_categories(); //function to inserting data
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Categories">
                            </div>
                        </form> <!-- Add Category Form -->

                        <?php if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                        } ?>

                    </div>

                    <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_categories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            ?>
                                    <tr>
                            <td><?=$cat_id?></td>
                            <td><?=$cat_title?></td>
                            <td><a href='categories.php?delete=<?=$cat_id?>'>Delete</a></td>
                            <td><a href='categories.php?edit=<?=$cat_id?>'>Edit</a></td>
                        </tr>
                            <?php
} //closing tag
?>
                        <?php //Delete query
                        if(isset($_GET['delete'])){
                            $the_cat_id = $_GET['delete'];

                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                            $delete_query = mysqli_query($connection, $query);
                            header("Location: categories.php");

                        }


                        ?>
                        </tr>
                        </tbody>
                    </table>
                    </div>



                </div>
            </div>
<?php include "includes/admin_footer.php";?>

