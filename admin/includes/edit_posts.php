<?php
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_id)) {

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_content = $row['post_content'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
}
}


if(isset($_POST['update_post'])){

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}',";
    $query .= "post_category_id = {$post_category_id},";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}',";
    $query .= "post_status = '{$post_status}',";
    $query .= "post_tags = '{$post_tags}',";
    $query .= "post_content = '{$post_content}',";
    $query .= "post_image = '{$post_image}'";
    $query .= "WHERE post_id = {$the_post_id}";

    $update_post = mysqli_query($connection, $query);

    if(!$update_post){
        die('QUERY FAILED ' . mysqli_error($connection));
    }

    echo "<p class='bg-success'>Post updated. <a href='../../post.php?p_id={$the_post_id}'>View Post</a></p>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?=$post_title?>" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            if(!$select_categories){
                die('QUERY FAILED' . mysqli_error($connection));
            }
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];


        ?>

        <option value="<?=$cat_id?>"><?=$cat_title?></option>
            <?php

    }
            ?>




        </select>
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" value="<?=$post_author?>" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post status</label>
        <select name="post_status" id="">
            <option value="published"><?=$post_status?></option>
            <?php
            if ($post_status == 'published'){
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../../images/<?=$post_image?>">

            <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?=$post_tags?>" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control"  name="post_content" id="editor" cols="30" rows="10"><?=$post_content?></textarea>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update post">
    </div>
</form>
