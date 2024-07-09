<?php 
session_start();
include('../config/DbFunction.php');
$obj=new DbFunction();
if(isset($_POST['reset'])){
	 extract($_POST);
  $expiration_time=time()+60*60;
  // Generate a unique token
  $token = bin2hex(random_bytes(16));
  $obj->resetPassRequest($email);
       exit();
   
     }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Kodinger">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TMH || Reset Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/my-login.css">
  <style type="text/css">
    .login-logo {
      height: 80px;
      widows: 80px;
      text-align: center;
    }
  </style>
</head>
<br><br>
<body class="my-login-page">
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-md-center h-100">
        <div class="card-wrapper">
          <?php if(isset($_SESSION['success'])){
           echo '<h3 class="text-success">'.$_SESSION['success'].'</h3>';
              }
           else{
          ?>
          <div class="card fat">
            <div class="card-body">
              <div class="row">
                <div class="col col-lg-12 col-sm-12 text-center">
                  <img class="login-logo text-center" alt="trimurti" src="../public/logo.jpg">
                </div>
              </div>

           <?php 
              if(isset($_SESSION['error'])) {
                 echo '<div class="alert alert-danger alert-dismissible" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                         <strong>' . $_SESSION['error'] . '</strong>
                       </div>';
              }?>

              <form method="POST" class="my-login-validation" novalidate="">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" value="" required autofocus placeholder="eg. admin@gmail.com">
                  <div class="invalid-feedback">
                    Email is invalid
                  </div>
                </div>

                <div class="form-group m-0">
                  <button type="submit" name="reset" class="btn btn-primary btn-block">
                    Reset Password
                  </button>
                </div>
                <div class="mt-4 text-center">
                  <a href="../index.php?" class="float-right">
                    go back login
                  </a>
                </div>
              </form>
            </div>
          </div>
        <?php } ?>
          <div class="footer">
            Copyright &copy; 2024-<?php echo date('Y') ?> &mdash;Trimurti Boys Hostel <span>Developed by <a href="https://www.facebook.com/jsmahara0810/" target="_blank">JM</a></span>
          </div>

        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="./js/login.js"></script>
</body>
</html>