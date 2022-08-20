<?php
require_once('./app/User.php');
session_start();
if(isset($_SESSION['user_id'])){
  header("Location:dashboard.php");
}
$db=new User();
if(!empty($_POST)){
  if($db->login($_POST['email'],$_POST['pwd']))
  {
      header("Location:dashboard.php");
  }
  else{
    echo '<div class="alert alert-danger" role="alert">
      Incorrect Email or password!
  </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Invoice Generator</title>
</head>
<body>
<div class="container vh-100">
  <div class="row d-flex align-items-center justify-content-center vh-100">
        <form name="login_form" class="my-auto col-md-6" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="submit" id="login-btn" class="btn btn-primary mt-3">Log In</button>
          </form>
          </div>
    </div>
    <!-- <form name="login_form" action="authentication.php" method="post" onsubmit="return validation()">
        <input name="email" id="email" type="email" placeholder="Enter Email" required/>
        <input name="pwd" id="pwd" type="password" placeholder="Enter password" required/>
        <input type="submit" id="login-btn" value="Log In"/>
    </form> -->
<?php
require_once("./includes/footer.php");
?>