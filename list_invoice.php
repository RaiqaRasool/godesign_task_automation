<?php
require_once("./includes/header.php");
require_once("./app/Invoice.php");
require_once("./app/User.php");
$invoice = new Invoice();
$invoice_list = $invoice->list_all('invoice');
$user = new User();
$user_data = $user->search_by_id('invoice_user', 'id', $_SESSION['user_id']);


if (!empty($_POST['delete-btn'])) {
  $invoice_id = $_POST['delete-btn'];
  $status = $invoice->delete_by_single_condition('invoice_item', 'invoice_id', $invoice_id);
  if ($status) {
    $status = $invoice->delete_item('invoice', 'invoice_id', $invoice_id);
  }
  $invoice->status_msg($status, 'delet', 'invoice');
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
          $user_data = $user->search_by_id('invoice_user', 'id', $row[1]);
          $due_date = strtotime($row[3]);
          $invoice_date = strtotime($row[2]);

        ?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><?= $row[4] ?></td>
            <td><?= $row[5] ?></td>
            <td><?= $row[9] ?></td>
            <td><?= date("d-M-Y", $due_date) ?></td>
            <td><?= date("d-M-Y", $invoice_date) ?></td>
            <td><?= $user_data["first_name"] . " " . $user_data["last_name"] ?></td>
            <td><?= '<a class="btn btn-success" href="./edit_invoice.php?invoice_id=' . $row[0] . '"><i class="fa-solid fa-pen-to-square"></i></a>' ?></td>
            <td><?= '<form action="" method="post"><button type="submit" class="btn btn-danger" name="delete-btn" id="delete-btn" value="' . $row[0] . '"><i class="fa-solid fa-trash"></i></button></form>' ?></td>
            <td><?= '<a class="btn btn-warning" href="./pdf_templates/invoice_pdf.php?mode=d&id=' . $row[0] . '"> <i class="fa-solid fa-download"></i></a>' ?></td>
            <td><?= '<a class="btn btn-primary" href="./pdf_templates/invoice_pdf.php?mode=p&id=' . $row[0] . '"> <i class="fa-solid fa-eye"></i></a>' ?></td>
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