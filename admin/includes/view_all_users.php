
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Email</td>
        <td>Role</td>
        <td>Admin</td>
        <td>Subscriber</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <?php

        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        ?>
    <tr>
        <td><?=$user_id?> </td>
        <td><?=$username?> </td>
        <td><?=$user_firstname?></td>
        <?php
        //        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        //        $select_categories_id = mysqli_query($connection, $query);
        //
        //        while ($row = mysqli_fetch_assoc($select_categories_id)){
        //        $cat_id = $row['cat_id'];
        //        $cat_title = $row['cat_title'];
        //
        //        ?>



        <td><?=$user_lastname?></td>
        <td><?=$user_email?></td>
        <td><?=$user_role?></td>


<!--        --><?php
//        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
//        $select_post_id_query = mysqli_query($connection, $query);
//        while($row = mysqli_fetch_assoc($select_post_id_query)){
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//        }
//
//        ?>

        <td><a href="users.php?admin=<?=$user_id?>">Admin</a></td>
        <td><a href="users.php?subscriber=<?=$user_id?>">Subscriber</a></td>
        <td><a href="users.php?source=edit_user&u_id=<?=$user_id?>">Edit</a></td>
        <td><a href="users.php?delete=<?=$user_id?>">Delete</a></td>

    </tr>
    <?php
    }
    ?>
    </tr>
    </tbody>
</table>

<?php

if(isset($_GET['delete'])){

    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($connection, $query);

    header("Location:users.php");

    if(!$delete_user_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

if(isset($_GET['admin'])){

    $the_user_id = $_GET['admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
    $admin_user_query = mysqli_query($connection, $query);

    header("Location:users.php");

    if(!$admin_user_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

if(isset($_GET['subscriber'])){

    $the_user_id = $_GET['subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
    $subscriber_user_query = mysqli_query($connection, $query);

    header("Location:users.php");

    if(!$subscriber_user_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

?>
