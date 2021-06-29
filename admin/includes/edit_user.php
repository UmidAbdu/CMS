<?php
if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users_id)) {

        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];

    }
}


if(isset($_POST['update_user'])){

    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}',";
    $query .= "user_firstname = '{$user_firstname}',";
    $query .= "user_lastname = '{$user_lastname}',";
    $query .= "user_role = '{$user_role}',";
    $query .= "user_email = '{$user_email}',";
    $query .= "user_password = '{$user_password}'";
    $query .= "WHERE user_id = {$the_user_id}";

    $update_user = mysqli_query($connection, $query);

    if(!$update_user){
        die('QUERY FAILED ' . mysqli_error($connection));
    }

    echo "User edited";
}
?>

<form action="" method="post" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?=$user_firstname?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?=$user_lastname?>" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="admin"><?=$user_role?></option>
            <?php
            if ($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?=$username?>" class="form-control" name="username">
    </div>


    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?=$user_email?>" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?=$user_password?>" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
    </div>
</form>
