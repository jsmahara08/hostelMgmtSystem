<?php
session_start();
if(isset($_SESSION["username"]) && !isset($_SESSION["user_id"])) {
   header('location:../index.php');
}
include('../config/DbFunction.php');
$obj=new DbFunction();
if (isset($_SESSION["username"]) ? $_SESSION["username"] : "") {
   $userId = $_SESSION['user_id'];
   $rs = $obj->showAdmin($userId);
   $res=$rs->fetch_object();
   if(isset($_POST["changeImage"])){
      $img_name=$_FILES['pic']['name'];
      $img_tmpName=$_FILES['pic']['tmp_name'];
      $obj->adminImage($img_name,$img_tmpName,$userId);
   }

   if(isset($_POST["changePassword"])){
      $username=$_SESSION['username'];
      extract($_POST);
      $password;
      $oldPassword;
      $obj->changePassword($oldPassword,password_hash($password, PASSWORD_DEFAULT),$username);
   }
   if(isset($_POST["updateProfile"])){
      extract($_POST);
      $obj->updateAdmin($name,$phone,$email,$userId);
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HMS || Trimurty Boys Hostel</title>
  <link rel="icon" type="image/x-icon" href="../public/favicon.ico">
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- jQuery custom content scroller -->
  <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="    stylesheet" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">
     .profile_img {
      position: relative;
      border: solid 2px var(--secondary);
      height: 130px;
      width: 110px;
      padding: 0;
      margin: 0;
  }

  .profile_img img {
      height: 127px;
      width: 106px;
  }
  .profile_img input {
    height: 127px;
    width: 106px;
    position: absolute;
    opacity: 0;
    }
  </style>
</head>

<body class="nav-md ">
  <div class="container body ">
    <div class="main_container">
      <!-- ===================TOPNAVBAR AND TOPHEADER START=============== -->
      <?php
      include 'include/sidebar.php'; 
      ?>
      <!-- ===================TOPNAVBAR AND TOPHEADER END================= -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-user" aria-hidden="true"></i> Admin Profile</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-3 col-sm-3  profile_left">
                  <?php
                    //success message 
                     if(isset($_SESSION['success'])){
                         echo '<script>';
                         echo 'swal({
                         title: "Success!",
                         text: "' . $_SESSION['success'] . '",
                         icon: "success",
                         button: "Ok",
                         }).then(function() {
                           window.location.href = "adminProfile.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['success']);
                     }
                     //error message
                      if(isset($_SESSION['error'])){
                         echo '<script>';
                         echo 'swal({
                         title: "Error!",
                         text: "' . $_SESSION['error'] . '",
                         icon: "warning",
                         button: "Try Next",
                         }).then(function() {
                           window.location.href = "adminProfile.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>

                    <!-- Current avatar -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="profile_img">
                        <input type="file" name="pic" id="pic" accept="image/*">
                        <img class="img-responsive avatar-view" src="../public/user/<?php echo$res->image?>" alt="Avatar" title="user image">
                        <br />
                      </div>
                      <button class="btn btn-primary" name="changeImage">Change Image</button>
                    </form>
                    <h3><?php echo $res->name; ?></h3>
                    <ul class="list-unstyled user_data">
                      <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="mailto:<?php echo $res->email; ?>" target="_blank"><?php echo $res->email; ?></a>
                      </li>
                      <li class="m-top-xs">
                        <i class="fa fa-phone user-profile-icon"></i>
                        <a href="tel:<?php echo $res->phone; ?>" target="_blank"><?php echo $res->phone; ?></a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-9 col-sm-9 ">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Change Password</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Update Profile</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                          <!-- change password -->
                          <form class="" action="" method="post">
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Old Password<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" name="oldPassword" required="required" />
                              </div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align"> New Password<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
                                <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                  <i id="slash" class="fa fa-eye-slash"></i>
                                  <i id="eye" class="fa fa-eye"></i>
                                </span>
                              </div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" name="password2" data-validate-linked='password' required='required' />
                              </div>
                            </div>
                            <div class="ln_solid">
                              <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                  <button type='submit' name="changePassword" class="btn btn-primary">Change Password</button>
                                  <button type='reset' class="btn btn-success">Reset</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <!-- update profile -->
                          <form method="post">
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" name="name" value="<?php echo $res->name; ?>" required='required' />
                              </div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" name="phone" value="<?php echo $res->phone; ?>" required='required' min="10" />
                              </div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="email" class='email' required="required" type="email" value="<?php echo $res->email; ?>" />
                              </div>
                            </div>
                            <div class="ln_solid">
                              <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                  <button type='submit' name="updateProfile" class="btn btn-primary">Update Profile</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
      <!-- ===================FOOTER START=============== -->
      <?php include "include/footer.php"; ?>
    </div>
  </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../vendors/validator/multifield.js"></script>
<script src="../vendors/validator/validator.js"></script>

<!-- Javascript functions -->
<script>
  function hideshow() {
    var password = document.getElementById("password1");
    var slash = document.getElementById("slash");
    var eye = document.getElementById("eye");
    if (password.type === 'password') {
      password.type = "text";
      slash.style.display = "block";
      eye.style.display = "none";
    } else {
      password.type = "password";
      slash.style.display = "none";
      eye.style.display = "block";
    }
  }
</script>