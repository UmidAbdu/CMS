<?php include "includes/admin_header.php";
include "../includes/db.php";

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
                        if(isset($_POST['submit'])){
                            $cat_title = $_POST['cat_title'];
                            if($cat_title == "" or empty($cat_title)){

                                echo "This field should not be empty";

                            } else{

                                $query = "INSERT INTO categories(cat_title) ";
                                $query .= "VALUE('{$cat_title}') ";
                                $create_category = mysqli_query($connection, $query);

                                if(!$create_category){

                                    die('QUERY FAILED' . mysqli_error($connection));

                                }
                            }
                        }

                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Categories">
                            </div>
                        </form>
                    </div> <!-- Add Category Form -->
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $query)
                    ?>

                    <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($select_categories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            ?>
                                    <tr>
                            <td><?=$cat_id?></td>
                            <td><?=$cat_title?></td>
                        </tr>
                            <?php
} //closing tag
?>
                        </tr>
                        </tbody>
                    </table>
                    </div>



                </div>
            </div>
<?php include "includes/admin_footer.php";

