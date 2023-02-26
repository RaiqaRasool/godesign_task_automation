<?php
session_start();
//redirecting user to login page if user is not logged in
$root_path = explode('/', $_SERVER['DOCUMENT_ROOT'])[0];
if (!isset($_SESSION['user_id'])) {
    header("Location:" . $root_path . "/index.php");
    // production code ------
    //     $root_path = explode('/', $_SERVER['DOCUMENT_ROOT'])[0] . '/godesign_dashboard';
    //     if (!isset($_SESSION['user_id'])) {
    //     header("Location:" . $root_path . "/index.php");
    // }
    // ------------
}
//logging out
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['REQUEST_URI']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- tiny mce script -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Invoice Generator</title>
</head>

<body>

    <header>
        <nav class="px-4 navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?= $root_path . "/dashboard.php" ?>">GODESIGN TECHNOLOGIES LLP</a>
            <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $root_path . "/dashboard.php" ?>">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if ($_SESSION['admin'] == 1) :
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= $root_path . '/list_users.php' ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= $root_path . '/list_users.php' ?>">List All</a>
                                <a class="dropdown-item" href="<?= $root_path . '/create_user.php' ?>">Create New</a>
                            </div>
                        </li>
                    <?php
                    endif;
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= $root_path . '/list_invoice.php' ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Invoice
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?= $root_path . '/list_invoice.php' ?>">List All</a>
                            <a class="dropdown-item" href="<?= $root_path . '/create_invoice.php' ?>">Create New</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= $root_path . '/list_workscope.php' ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Workscope
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?= $root_path . '/list_workscope.php' ?>">List All</a>
                            <a class="dropdown-item" href="<?= $root_path . '/workscope_form.php?mode=c' ?>">Create New</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $root_path . '/pdf_templates/dataEdit_form.php' ?>">Edit Company Data</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post"><button type="submit" name="logout" class="btn btn-warning">Logout</button></form>
            </div>
        </nav>
    </header>