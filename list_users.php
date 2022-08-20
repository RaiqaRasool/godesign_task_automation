<?php
require_once("./includes/header.php");
require_once("./app/User.php");
$User = new User();
$user_list=$User->list_users();

if (!empty($_POST['delete-btn'])) {
    $user_id = $_POST['delete-btn'];
    if ($User->delete_user($user_id)) {
      echo '<div class="alert alert-primary" role="alert">
      User is deleted successfully!
    </div>';
    } else {
      echo '<div class="alert alert-danger" role="alert">
      Some issue occured while deleting
    </div>';
    };
  }

?>

<div class="container-fluid d-flex flex-column align-items-stretch h-100">
  <h1 class="my-5 text-center">List of all Users</h1>
  <div class="row d-flex align-items-stretch h-100">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($user_list as $row) :
        ?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><?= $row["first_name"] ?></td>
            <td><?= $row["last_name"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["admin"]==1?"Admin":"Normal User" ?></td>
            <td><?= '<a class="btn btn-success" href="./edit_user.php?user_id=' . $row["id"] . '"><i class="fa-solid fa-pen-to-square"></i></a>' ?></td>
            <td><?= '<form action="" method="post"><button type="submit" class="btn btn-danger" name="delete-btn" id="delete-btn" value="' . $row['id'] . '"><i class="fa-solid fa-trash"></i></button></form>' ?></td>
          </tr>
        <?php
          $i++;
        endforeach;
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php
require_once("./includes/footer.php");
?>