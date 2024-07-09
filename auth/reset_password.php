<?php 
if ((isset($_GET['token'])) && $_GET['token']!="") {
session_start();
include('../config/DbFunction.php');
$obj=new DbFunction();
if(isset($_POST['resetPassword'])){
  extract($_POST);
  $token = $_GET['token'];
  $obj->resetPassword($password,$confirmPassword,$token);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Kodinger">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TMH || Change Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/my-login.css">
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
          <?php  
              if(isset($_SESSION['error'])) {
                 echo '<h3 class="text-warning">' . $_SESSION['error'] . '</h3>';
              }else{?>
        <div class="card-wrapper">
          <div class="card fat">
            <div class="card-body">
              <div class="row">
                <div class="col col-lg-12 col-sm-12 text-center">
                  <img class="login-logo text-center" src="../public/logo.jpg">
                </div>
              </div>
               <form method="POST" class="my-login-validation">
                <div class="form-group">
                  <label for="password">New Password 
                  </label>
                  <input id="password" type="password" class="form-control" name="password" required placeholder="New Password" onkeyup="PasswordStrong()">
                  <span id="strengthMsg"></span>
                </div>
                <div class="form-group">
                  <label for="password">Confirm Password
                  </label>
                  <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required placeholder="Re-Password" onkeyup="validatePassword()">
                  <span id="matchMsg"></span>
                  
                </div>

                <div class="form-group m-0">
                  <button type="submit" name="resetPassword" id="resetPsw" class="btn btn-primary btn-block">
                    Change Password
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="footer">
            Copyright &copy; 2024-<?php echo date('Y') ?> &mdash;Trimurti Boys Hostel <span>Developed by <a href="https://www.facebook.com/jsmahara0810/" target="_blank">JM</a></span>
          </div>

        </div>
         <?php } ?>
      </div>
    </div>
  </section>
     <script>
      var resetBtn=document.getElementById("resetPsw");
            resetBtn.disabled=true;
        function PasswordStrong() {
            var password = document.getElementById("password").value;
            var strengthMsg = document.getElementById("strengthMsg");
            // Regular expressions to check for various criteria
            var lowerCaseLetters = /[a-z]/g;
            var upperCaseLetters = /[A-Z]/g;
            var numbers = /[0-9]/g;
            var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;

            // Initial strength level
            var strength = 0;

            // Check for lowercase letters
            if (password.match(lowerCaseLetters)) {
                strength++;
            }

            // Check for uppercase letters
            if (password.match(upperCaseLetters)) {
                strength++;
            }

            // Check for numbers
            if (password.match(numbers)) {
                strength++;
            }

            // Check for special characters
            if (password.match(specialCharacters)) {
                strength++;
            }

            // Update strength message based on strength level
            if (password.length < 8) {
                strengthMsg.innerHTML = "Password must be at least 8 characters long";
                strengthMsg.style.color = "red";
            } else if (strength < 3) {
                strengthMsg.innerHTML = "Weak password";
                strengthMsg.style.color = "orange";
            } else {
                strengthMsg.innerHTML = "Strong password";
                strengthMsg.style.color = "green";
            }
        }
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var matchMsg = document.getElementById("matchMsg");

            if (password === confirmPassword) {
                matchMsg.innerHTML = "Passwords match";
                matchMsg.style.color = "green";
                resetBtn.disabled=false;
            } else {
                matchMsg.innerHTML = "Passwords do not match";
                matchMsg.style.color = "red";
            }
        }
    </script>
</body>
</html>
<?php } ?>
