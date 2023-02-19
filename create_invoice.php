<?php

require_once("./includes/header.php");
require_once("./app/Invoice.php");

//this variable will be used in invoice_form.php to set values for invoice with id in query string
//setting it true means invoice invoice_data from id to fill form and false will keep it empty
$is_edit = false;
//This variable will specify value of btn text in invoice_form.php
$btn_text = "Create";

if (!empty($_POST)) {
    $invoice = new Invoice();
    $insert_status = $invoice->create_invoice(
        $_POST['client_name'],
        $_POST['company_name'],
        $_POST['client_street'],
        $_POST['client_city'],
        $_POST['client_state'],
        $_POST['client_country'],
        $_POST['client_zipcode'],
        $_POST['due_date'],
        $_POST['desc'],
        $_POST['hours'],
        $_POST['hr_rate'],
        $_POST['amount'],
    );

    if ($insert_status) {
        echo '<div class="alert alert-success" role="alert">
    Invoice is created successfully!
            </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Some issue occured while creating invoice
          </div>';
    }
}
?>

<div class="container vh-100">
    <h1 class="my-5 text-center">Create Invoice Form</h1>
    <div class="row d-flex align-items-center vh-100">
        <form class="d-flex flex-column gap-3" name="create_invoice_form" action="" method="post">
            <?php
            require_once("./includes/invoice_form.php");
            ?>
        </form>
    </div>
</div>

<?php
require_once("./includes/footer.php");
?>