
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>ID</td>
        <td>Author</td>
        <td>Content</td>
        <td>Email</td>
        <td>Status</td>
        <td>In response to</td>
        <td>Date</td>
        <td>Approve</td>
        <td>Unapprove</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <?php

        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        ?>
    <tr>
        <td><?=$comment_id?> </td>
        <td><?=$comment_author?> </td>
        <td><?=substr($comment_content, 0, 50) ?></td>
 <?php
//        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
//        $select_categories_id = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($select_categories_id)){
//        $cat_id = $row['cat_id'];
//        $cat_title = $row['cat_title'];
//
//        ?>



        <td><?=$comment_email?></td>
        <td><?=$comment_status?></td>


        <?php
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }

        ?>

        <td><?=$comment_date?></td>
        <td><a href="comments.php?approve=<?=$comment_id?>">Approve</a></td>
        <td><a href="comments.php?unapprove=<?=$comment_id?>">Unapprove</a></td>
        <td><a href="comments.php?delete=<?=$comment_id?>">Delete</a></td>

    </tr>
    <?php
    }
    ?>
    </tr>
    </tbody>
</table>

<?php

if(isset($_GET['delete'])){

    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_comment_query = mysqli_query($connection, $query);

    header("Location:comments.php");

    if(!$delete_comment_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

if(isset($_GET['approve'])){

    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
    $approve_comment_query = mysqli_query($connection, $query);

    header("Location:comments.php");

    if(!$approve_comment_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

if(isset($_GET['unapprove'])){

    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
    $unapprove_comment_query = mysqli_query($connection, $query);

    header("Location:comments.php");

    if(!$unapprove_comment_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

?>
