<?php
require_once("./includes/header.php");
require_once("./app/User.php");
$user = new User();
$user_id = $_GET["user_id"];
$user_data = $user->get_user($user_id);
if (!empty($_POST)) {
    $status=$user->edit_user(
        $user_id,
        $_POST['user_fname'],
        $_POST['user_lname'],
        $_POST['user_email'],
        $_POST['user_password'],
        $_POST['admin']
    );
    if ($status) {
        echo '<div class="alert alert-success" role="alert">
        User ' . $user_data["first_name"]." ". $user_data["last_name"] . ' is updated successfully!
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Some issue occured while updating
      </div>';
    }
}
?>
<div class="container vh-100">
    <h1 class="my-5 text-center">Edit user Form</h1>
    <div class="row d-flex align-items-center vh-100">
        <form class="d-flex flex-column gap-3" name="create_user_form" action="" method="post">
            <div class="form-group">
                <label for="user_fname">User's First Name</label>
                <input class="form-control" type="text" id="user_fname" value="<?=$user_data["first_name"]?>" name="user_fname" placeholder="Enter User First Name" required />
            </div>
            <div class="form-group">
                <label for="user_lname">User's Last Name</label>
                <input class="form-control" type="text" id="user_lname" value="<?=$user_data["last_name"]?>" name="user_lname" placeholder="Enter User Last Name" required />
            </div>
            <div class="form-group">
                <label for="user_email">User's Email</label>
                <input class="form-control" type="email" id="user_email" value="<?=$user_data["email"]?>" name="user_email" placeholder="Enter User's Email" required />
            </div>
            <div class="form-group">
                <label for="user_password">User's Password</label>
                <input class="form-control" type="text" id="user_password" name="user_password" placeholder="Enter User's Password" required />
            </div>
            <div class="form-group">
                <label for="user_role">Choose User Role</label>
                <select class="form-control form-control-sm" id="user_role" name="admin">
                    <?php if($user_data["admin"]==1):?>
                    <option value="1" selected>Admin</option>
                    <option value="0">Normal User</option>
                    <?php else:
                    ?>
                    <option value="1">Admin</option>
                    <option value="0" selected>Normal User</option>
                    <?php
                    endif;
                    ?>
                </select>
            </div>
            <div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'>Update</button></div>
        </form>
    </div>
</div>
    <?php

   require_once("./includes/footer.php");
    ?>