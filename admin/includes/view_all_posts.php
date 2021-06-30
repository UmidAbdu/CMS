<?php
if(isset($_POST['checkboxArray'])){
    foreach ($_POST['checkboxArray'] as $postValueID) {
         $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options){
            case 'published':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueID}";

                $update_post_status = mysqli_query($connection, $query);

                if(!$update_post_status){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;

            case 'draft':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueID}";

                $update_post_draft_status = mysqli_query($connection, $query);

                if(!$update_post_draft_status){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;

            case 'delete':

                $query = "DELETE FROM posts WHERE post_id = {$postValueID}";

                $delete_posts = mysqli_query($connection, $query);

                if(!$delete_posts){
                    die("QUERY FAILED" . mysqli_error($connection));
                }



        }

    }
}

?>



<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4" style="padding-left: 0; padding-bottom: 5px;">
            <select class="form-control" name="bulk_options" id="">

                <option value="">Select option</option>
                <option value="published">Published posts</option>
                <option value="draft">Draft posts</option>
                <option value="delete">Delete</option>

            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>
        </div>

        <thead>
        <tr>
            <td><input id="selectAllBoxes" type="checkbox"></td>
            <td>ID</td>
            <td>Author</td>
            <td>Title</td>
            <td>Category</td>
            <td>Status</td>
            <td>Image</td>
            <td>Tags</td>
            <td>Comments</td>
            <td>Date</td>
            <td>View post</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        </thead>
        <tbody>

        <tr>
            <?php

            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_date = $row['post_date'];

            ?>
        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkboxArray[]"
                value="<?=$post_id?>"></td>
            <td><?=$post_id?> </td>
            <td><?=$post_author?> </td>
            <td><?=$post_title?></td>

            <?php
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            ?>


            <td><?=$cat_title;}?></td>





            <td><?=$post_status?></td>
            <td><img width="100" src="../images/<?=$post_image?>"></td>
            <td><?=$post_tags?></td>
            <td><?=$post_comments?></td>
            <td><?=$post_date?></td>
            <td><a href="../post.php?p_id=<?=$post_id?>">View post</a></td>
            <td><a href="posts.php?source=edit_posts&p_id=<?=$post_id?>">Edit</a></td>
            <td><a href="posts.php?delete=<?=$post_id?>">Delete</a></td>
        </tr>
        <?php
        }
        ?>
        </tr>
        </tbody>
    </table>

</form>

<?php

if(isset($_GET['delete'])){

    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_posts_query = mysqli_query($connection, $query);

    header("Location:posts.php");

    if(!$delete_posts_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}



?>