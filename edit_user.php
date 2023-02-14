<?php
require_once("./includes/header.php");
//this variable will be used in user_form.php to set values for user with id in query string
//setting it true means user user_data from id to fill form and false will keep it empty
$is_edit = true;
//This variable will specify value of btn text in user_form.php
$btn_text = "Update";
if (isset($_GET["user_id"])) :
    require_once("./app/User.php");
    $user = new User();
    //Getting id from query string
    $user_id = $_GET["user_id"];
    //Getting user data based on id in query string
    $user_data = $user->search_by_id('invoice_user', 'id', $user_id);
    if ($user_data) :
        //It will run to update data of user once form is submitted
        if (!empty($_POST)) {
            $status = $user->edit_user(
                $user_id,
                $_POST['user_fname'],
                $_POST['user_lname'],
                $_POST['user_email'],
                $_POST['user_password'],
                $_POST['admin']
            );
            if ($status) {
                echo '<div class="alert alert-success" role="alert">
                User ' . $user_data["first_name"] . " " . $user_data["last_name"] . ' is updated successfully!
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
                    <?php
                    require_once("./includes/user_form.php");
                    ?>
                </form>
            </div>
        </div>
<?php
    else :
        echo '<div class="d-flex vh-100 text-center justify-content-center align-items-center">
    <h1 class="alert alert-danger" role="alert">
    No User with this ID is available.
    </h1>
    </div>';
    endif;
else :
    echo '<div class="d-flex vh-100 text-center justify-content-center align-items-center">
    <h1 class="alert alert-danger" role="alert">
    No User ID is available to edit
    </h1>
    </div>';
endif;
require_once("./includes/footer.php");
?>