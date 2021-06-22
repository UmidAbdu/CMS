
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>ID</td>
        <td>Author</td>
        <td>Title</td>
        <td>Category</td>
        <td>Status</td>
        <td>Image</td>
        <td>Tags</td>
        <td>Comments</td>
        <td>Date</td>
        <td>Edit</td>
        <td><Delete></Delete></td>
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
        <td><a href="posts.php?source=edit_posts&p_id=<?=$post_id?>">Edit</a></td>
        <td><a href="posts.php?delete=<?=$post_id?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
    </tr>
    </tbody>
</table>

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