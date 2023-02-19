<?php
require_once("./includes/header.php");
require_once("./app/Workscope.php");
$workscope = new Workscope();
$data = $workscope->list_all('workscope');

if (isset($_POST['delete-btn'])) {
    $status = $workscope->delete_item('workscope', 'workscope_id', $_POST['delete-btn']);
    $workscope->status_msg($status, 'delet', 'Workscope');
}
?>
<div class="container-fluid d-flex flex-column align-items-stretch h-100">
    <h1 class="my-5 text-center">List of Workscopes</h1>
    <div class="row d-flex align-items-stretch h-100">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client</th>
                    <th scope="col">Company</th>
                    <th scope="col">City</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Initial Amount</th>
                    <th scope="col">Created by</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data as $row) :
                    $user_data = $workscope->search_by_id('invoice_user', 'id', $row[8]);
                ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $row[1] ?></td>
                        <td><?= $row[2] ?></td>
                        <td><?= $row[3] ?></td>
                        <td><?= "Rs. " . strval($row[4]) ?></td>
                        <td><?= "Rs. " . strval(ceil(($row[4] * $row[5]) / 100)) ?></td>
                        <td><?= $user_data['first_name'] . ' ' . $user_data['last_name'] ?></td>
                        <td><?= '<a class="btn btn-success" href="./workscope_form.php?mode=e&id=' . $row[0] . '"><i class="fa-solid fa-pen-to-square"></i></a>' ?></td>
                        <td><?= '<form action="" method="post"><button type="submit" class="btn btn-danger" name="delete-btn" id="delete-btn" value="' . $row[0] . '"><i class="fa-solid fa-trash"></i></button></form>' ?></td>
                        <td><?= '<a class="btn btn-warning" href="./pdf_templates/workscope_pdf.php?mode=d&id=' . $row[0] . '"> <i class="fa-solid fa-download"></i></a>' ?></td>
                        <td><?= '<a class="btn btn-primary" href="./pdf_templates/workscope_pdf.php?mode=p&id=' . $row[0] . '"> <i class="fa-solid fa-eye"></i></a>' ?></td>
                    </tr>
                <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>