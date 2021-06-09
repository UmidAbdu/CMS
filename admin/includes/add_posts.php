<?php
if(isset($_POST['create_post'])){

    $title = $_POST['title'];
    $post_category = $_POST['post_category_id'];
    $author = $_POST['author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,
                  post_image, post_content, post_tags, post_comment_count, post_status)";

    $query .= "VALUES ({$post_category}, '{$title}', '{$author}', now(), '{$post_image}', '{$post_content}',
     '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

    $send_query = mysqli_query($connection, $query);

    if(!$send_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

?>





<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category ID</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <input type="text" class="form-control" name="post_content">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="create_post" value="Publish post">
    </div>
</form>