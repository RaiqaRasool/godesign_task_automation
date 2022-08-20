<?php
require_once("./includes/header.php");
require_once("./app/User.php");

if (!empty($_POST)) {
    $User = new User();
    $insert_status = $User->create_user(
        $_POST['user_email'],
        $_POST['user_password'],
        $_POST['user_fname'],
        $_POST['user_lname'],
        $_POST['admin']   
    );

    if ($insert_status) 
        {
            echo '<div class="alert alert-success" role="alert">
    User is created successfully!
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Some issue occured while creating User
          </div>';
        }
}
?>
<div class="container vh-100">
    <h1 class="my-5 text-center">Create user Form</h1>
    <div class="row d-flex align-items-center vh-100">
        <form class="d-flex flex-column gap-3" name="create_user_form" action="" method="post">
            <div class="form-group">
                <label for="user_fname">User's First Name</label>
                <input class="form-control" type="text" id="user_fname" name="user_fname" placeholder="Enter User First Name" required />
            </div>
            <div class="form-group">
                <label for="user_lname">User's Last Name</label>
                <input class="form-control" type="text" id="user_lname" name="user_lname" placeholder="Enter User Last Name" required />
            </div>
            <div class="form-group">
                <label for="user_email">User's Email</label>
                <input class="form-control" type="email" id="user_email" name="user_email" placeholder="Enter User's Email" required />
            </div>
            <div class="form-group">
                <label for="user_password">User's Password</label>
                <input class="form-control" type="text" id="user_password" name="user_password" placeholder="Enter User's Password" required />
            </div>
            <div class="form-group">
                <label for="user_role">Choose User Role</label>
                <select class="form-control form-control-sm" id="user_role" name="admin">
                    <option value="1">Admin</option>
                    <option value="0" selected>Normal User</option>
                </select>
            </div>
            <div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'>Create</button></div>
        </form>
    </div>
</div>

<?php
require_once("./includes/footer.php");
?>