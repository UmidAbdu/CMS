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
//    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,
                  post_image, post_content, post_tags, post_status)";

    $query .= "VALUES ({$post_category}, '{$title}', '{$author}', now(), '{$post_image}', '{$post_content}',
     '{$post_tags}', '{$post_status}')";

    $send_query = mysqli_query($connection, $query);

    if(!$send_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }

    echo "Post successfully created: ". "<a href='posts.php'>View Posts</a>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post status</label>
        <select name="post_status" id="">

            <option value="draft">Select options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>

        </select>
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
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="20"></textarea>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>


    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="create_post" value="Publish post">
    </div>
</form>
