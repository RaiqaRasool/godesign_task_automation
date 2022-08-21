<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Invoice Generator</title>
</head>

<body>
    <?php
    session_start();
    //redirecting user to login page if user is not logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location:index.php");
    }
    ?>

    <header>
        <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container bg-blue h-20 vw-100 d-flex justify-content-between align-items-center">
                <a class="navbar-brand text-center text-white" href="./dashboard.php">GODESIGN TECHNOLOGIES LLP</a>
                <form method="post"><button type="submit" name="logout" class="btn btn-warning">Logout</button></form>
            </div>
        </nav>
    </header>

<?php
//logging out
if(!empty($_POST)){
session_destroy();
header("Location: ".$_SERVER['REQUEST_URI']);
}
?>