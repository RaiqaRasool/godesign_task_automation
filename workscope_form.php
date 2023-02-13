<?php
require_once("./includes/header.php");
require_once("./app/Workscope.php");
$mode = $_GET['mode'];
$workscope = new Workscope();

if ($mode == 'c') {
    $is_edit = false;
    $btn_text = 'Create Workscope';
    if (!empty($_POST)) {
        $status = $workscope->create_workscope(
            $_POST['client_name'],
            $_POST['client_company'],
            $_POST['client_city'],
            $_POST['total_cost'],
            $_POST['initialAmt_percent'],
            $_POST['work_scope'],
            $_POST['work_notes'],
            $_SESSION['user_id']
        );
        $workscope->status_msg($status, 'creat', 'Workscope');
    }
} else if ($mode == 'e') {
    $is_edit = true;
    $btn_text = 'Edit Workscope';
    $workscope_id = $_GET['id'];
    $curr_workscope = $workscope->search_by_id('workscope', 'workscope_id', $workscope_id);
    if (!empty($_POST)) {
        $status = $workscope->edit_workscope(
            $workscope_id,
            $_POST['client_name'],
            $_POST['client_company'],
            $_POST['client_city'],
            $_POST['total_cost'],
            $_POST['initialAmt_percent'],
            $_POST['work_scope'],
            $_POST['work_notes'],
            $_SESSION['user_id']
        );
        $workscope->status_msg($status, 'edit', 'Workscope');
    }
}
?>
<div class="container vh-100">
    <h1 class="my-5 text-center">Workscope Form</h1>
    <div class="row d-flex align-items-center vh-100">
        <form class="d-flex flex-column gap-3" method="post" action="">
            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input class="form-control" maxlength="100" type="text" id="client_name" name="client_name" value="<?= $is_edit ? $curr_workscope['workscope_client'] : "" ?>" placeholder="Enter Client Name" required />
            </div>
            <div class="form-group">
                <label for="client_company">Company Name</label>
                <input class="form-control" maxlength="255" type="text" id="client_company" name="client_company" value="<?= $is_edit ? $curr_workscope['workscope_company'] : "" ?>" placeholder="Enter Company Name" required />
            </div>
            <div class="form-group">
                <label for="client_city">Client City</label>
                <input class="form-control" maxlength="255" type="text" id="client_city" name="client_city" value="<?= $is_edit ? $curr_workscope['workscope_city'] : "" ?>" placeholder="Enter City" required />
            </div>
            <div class="form-group">
                <label for="total_cost">Total Cost</label>
                <input class="form-control" min="0" type="number" id="total_cost" name="total_cost" value="<?= $is_edit ? $curr_workscope['workscope_totalCost'] : "" ?>" placeholder="Enter total cost" required />
            </div>
            <div class="form-group">
                <label for="initialAmt_percent">Initial Amount Percentage</label>
                <input class="form-control" min="0" max="100" type="number" id="initialAmt_percent" name="initialAmt_percent" value="<?= $is_edit ? $curr_workscope['workscope_initialAmtPercent'] : "" ?>" placeholder="Enter Initial Amount Percentage" required />
                <small id="intialAmt_help" class="form-text text-muted">Note: Total cost will be split into initial and remaining amount based on this percentage</small>
            </div>
            <div class="form-group">
                <label for="work_scope">Scope of Work</label>
                <textarea class="form-control tinymce_inputfield" type="text" id="work_scope" name="work_scope" placeholder="Write Scope of Work">
                <?= $is_edit ? $workscope->content_preparation($curr_workscope['workscope_scope']) : "" ?>
            </textarea>
            </div>
            <div class="form-group">
                <label for="work_notes">Work Notes</label>
                <textarea class="form-control tinymce_inputfield" type="text" id="work_notes" name="work_notes" value="" placeholder="Write Notes of Work">
                <?= $is_edit ? $workscope->content_preparation($curr_workscope['workscope_notes']) : "" ?>
                </textarea>
            </div>
            <div class="my-5">
                <button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'><?= $btn_text ?></button>
            </div>
        </form>
    </div>

    <?php
    require_once("./includes/footer.php")
    ?>