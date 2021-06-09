<?php
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];

$query = "SELECT * FROM posts";
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
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?=$post_title?>" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        if(!$select_categories){
            die('QUERY FAILED' . mysqli_error($connection));
        }
        ?>

        <option value="<?=$cat_id?>"><?=$cat_title?></option>
            <?php

    }


            ?>




        </select>
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" value="<?=$post_author?>" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?=$post_status?>" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <img width="100" src="../../images/<?=$post_image?>">
    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?=$post_tags?>" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control"  name="post_content" id="" cols="30" rows="10"><?=$post_content?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Update post">
    </div>
</form>

<?php  } ?>