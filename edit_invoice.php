<?php
require_once("./includes/header.php");
//this variable will be used in invoice_form.php to set values for invoice with id in query string
//setting it true means invoice invoice_data from id to fill form and false will keep it empty
$is_edit = true;
//This variable will specify value of btn text in invoice_form.php
$btn_text = "Update";
if (isset($_GET["invoice_id"])) :
    require_once("./app/Invoice.php");
    $invoice = new Invoice();
    //Getting id from query string
    $invoice_id = $_GET["invoice_id"];
    //Getting invoice data based on id in query string
    $invoice_data = $invoice->search_by_id('invoice', 'invoice_id', $invoice_id);
    $invoice_items_data = $invoice->search_by_single_condition('invoice_item', 'invoice_id', $invoice_id);
    if ($invoice_data) :
        //Converting string from database to date to fill in invoice_form.php value
        $due_date = strtotime($invoice_data["invoice_due_date"]);
        //It will run to update data of invoice once form is submitted
        if (!empty($_POST)) {
            $status = $invoice->edit_invoice(
                $invoice_id,
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
                $_POST['invoice_currency']
            );
            //Will display msg based on the return from edit invoice function
            $invoice->status_msg($status, 'edit', 'Invoice');
        }
?>
        <!-- Edit form -->
        <div class="container">
            <div class="container vh-100">
                <h1 class="my-5 text-center">Edit Invoice Form</h1>
                <div class="row d-flex align-items-center vh-100">
                    <form class="d-flex flex-column gap-3" method="post" action="">
                        <?php
                        require_once("./includes/invoice_form.php");
                        ?>
                    </form>
                </div>
            </div>
    <?php
    else :
        echo '<div class="d-flex vh-100 text-center justify-content-center align-items-center">
        <h1 class="alert alert-danger" role="alert">
        No invoice with this ID is available.
        </h1>
        </div>';
    endif;
else :
    echo '<div class="d-flex vh-100 text-center justify-content-center align-items-center">
        <h1 class="alert alert-danger" role="alert">
        No invoice ID is available to edit
        </h1>
        </div>';
endif; //end of invoice id if at top
require_once("./includes/footer.php");
    ?>