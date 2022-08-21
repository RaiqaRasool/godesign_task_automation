<?php
require_once("./includes/header.php");
//this variable will be used in user_form.php to set values for user with id in query string
//setting it true means user user_data from id to fill form and false will keep it empty
$is_edit = false;
//This variable will specify value of btn text in user_form.php
$btn_text="Create";
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
          <?php
          require_once("./includes/user_form.php");
          ?>
        </form>
    </div>
</div>

<?php
require_once("./includes/footer.php");
?>