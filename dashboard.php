<?php

require_once("./includes/header.php");
?>
<h1 class="text-center my-5">
    Godesign dashboard
</h1>
<div class="container d-flex flex-column align-items-center">
<div class="row d-flex justify-content-center align-items-start h-auto gap-5">
  <div class="col-sm-12 col-lg-6 ">
    <div class="card bg-danger text-white">
      <div class="card-body">
        <h5 class="card-title">All Invoices List</h5>
        <p class="card-text">To see all invoices click the button below</p>
        <a href="./list_invoice.php" class="btn btn-warning">List Invoices</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-lg-6 ">
    <div class="card bg-success text-white">
      <div class="card-body">
        <h5 class="card-title">Create New Invoice</h5>
        <p class="card-text">To create new invoices click the button below</p>
        <a href="./create_invoice.php" class="btn btn-warning">Create Invoice</a>
      </div>
    </div>
  </div>
  <?php if($_SESSION['admin']==1):?>
  <div class="col-sm-12 col-lg-6 ">
    <div class="card bg-danger text-white">
      <div class="card-body">
        <h5 class="card-title">All Users List</h5>
        <p class="card-text">To see all users click the button below</p>
        <a href="./list_users.php" class="btn btn-warning">List Users</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-lg-6 ">
    <div class="card bg-success text-white">
      <div class="card-body">
        <h5 class="card-title">Create New User</h5>
        <p class="card-text">To create new invoice click the button below</p>
        <a href="./create_user.php" class="btn btn-warning">Create User</a>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>

<?php
require_once("./includes/footer.php");
?>