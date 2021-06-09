
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
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_content'];
        $post_date = $row['post_date'];

        ?>
    <tr>
        <td><?=$post_id?> </td>
        <td><?=$post_author?> </td>
        <td><?=$post_title?></td>
        <td><?=$post_category?></td>
        <td><?=$post_status?></td>
        <td><img width="100" src="../images/<?=$post_image?>"></td>
        <td><?=$post_tags?></td>
        <td><?=$post_comments?></td>
        <td><?=$post_date?></td>
    </tr>
    <?php
    }
    ?>
    </tr>
    </tbody>
</table>