
<?php
//Database connection
include "includes/db.php";

//header
include "includes/header.php";
?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
            }

            //querying database
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)){

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content']
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?=$post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?=$post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?=$post_image?>" alt="">
                <hr>
                <p><?=$post_content?></p>

                <hr>

            <?php } ?>



            <!-- Blog Comments -->

            <?php
            if(isset($_POST['create_comment'])){


                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) and !empty($comment_email) and !empty($comment_content)){

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, 
                     comment_content, comment_status, comment_date )";

                    $query .= "VALUES ($the_post_id, '$comment_author', '$comment_email',
               '$comment_content', 'unapproved', now())";

                    $create_comment_query = mysqli_query($connection, $query);

                    if(!$create_comment_query){
                        die('QUERY FAILED' . mysqli_error($connection));
                    }


                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                    $update_comment_count = mysqli_query($connection, $query);
                } else {
                    echo "<script>alert('Fields cannot be empty')</script>";
                }


            }


            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->




            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);

            if(!$select_comment_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];

                ?>

                <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?=$comment_author?>
                        <small><?=$comment_date?></small>
                    </h4>
                    <?=$comment_content?>
                </div>
            </div>
<?php
            }
            ?>




            <!-- Comment -->

            <hr>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->

    <?php include "includes/footer.php"; ?>
