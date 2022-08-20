<?php
require_once("./includes/header.php");
require_once("./app/Invoice.php");
require_once("./app/User.php");
$invoice = new Invoice();
$invoice_list = $invoice->list_invoice();
$user = new User();
$user_data = $user->get_user($_SESSION['user_id']);


if (!empty($_POST['delete-btn'])) {
  $invoice_id = $_POST['delete-btn'];
  if ($invoice->delete_invoice($invoice_id)) {
    echo '<div class="alert alert-primary" role="alert">
    Invoice of id ' . ($invoice_id + 2000) . ' is deleted successfully!
  </div>';
    header('Location: ' . $_SERVER['REQUEST_URI']);
  } else {
    echo '<div class="alert alert-danger" role="alert">
    Some issue occured while deleting
  </div>';
  };
}

?>
<div class="container-fluid d-flex flex-column align-items-stretch h-100">
  <h1 class="my-5 text-center">List of all Invoices</h1>
  <div class="row d-flex align-items-stretch h-100">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Customer Company</th>
          <th scope="col">Customer Country</th>
          <th scope="col">Due Date</th>
          <th scope="col">Created At</th>
          <th scope="col">Created By</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($invoice_list as $row) :
          $user_data = $user->get_user($row["user_id"]);
          $due_date = strtotime($row["invoice_due_date"]);
          $invoice_date = strtotime($row["invoice_date"]);

        ?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><?= $row["invoice_receiver_name"] ?></td>
            <td><?= $row["invoice_receiver_company"] ?></td>
            <td><?= $row["invoice_receiver_country"] ?></td>
            <td><?= date("d-M-Y", $due_date) ?></td>
            <td><?= date("d-M-Y", $invoice_date) ?></td>
            <td><?= $user_data["first_name"] . " " . $user_data["last_name"] ?></td>
            <td><?= '<a class="btn btn-success" href="./edit_invoice.php?invoice_id=' . $row["invoice_id"] . '"><i class="fa-solid fa-pen-to-square"></i></a>' ?></td>
            <td><?= '<form action="" method="post"><button type="submit" class="btn btn-danger" name="delete-btn" id="delete-btn" value="' . $row['invoice_id'] . '"><i class="fa-solid fa-trash"></i></button></form>' ?></td>
            <td><?= '<a class="btn btn-warning" href="./invoice_pdf.php?mode=d&invoice_id='.$row["invoice_id"].'"> <i class="fa-solid fa-download"></i></a>' ?></td>
            <td><?= '<a class="btn btn-primary" href="./invoice_pdf.php?mode=p&invoice_id='.$row["invoice_id"].'"> <i class="fa-solid fa-eye"></i></a>' ?></td>
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