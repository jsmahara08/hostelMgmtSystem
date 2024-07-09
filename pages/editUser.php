<?php 
session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
if (!isset($_GET['user_id']) || $_GET['user_id'] === "") {
   header('Location:user.php');
   exit; // It's a good practice to exit after a header redirect
}
include('../config/DbFunction.php');
$obj=new DbFunction(); 
//fetch user detail
if($_REQUEST['user_id']!==""){
  $userId=$_REQUEST['user_id'];
  $rs=$obj->showUser1($userId);
  $res=$rs->fetch_object();
}
//edit user detail
if(isset($_POST['editUser'])){
   $Id=$_REQUEST['user_id'];
   extract($_POST);
   $obj->editUser($firstName,$middleName,$lastName,$dateOfBirth,$gender,$caste,$religion,$nationality,$bloodGroup,$fatherName,$fatherMobile,$fatherEducation,$fatherProfession,$motherName,$motherMobile,$motherEducation,$motherProfession,$profession,$organization,$userPost,$hostelJoinDate,$roomNumber,$guardianName,$guardianPhone,$relationWithGuardian,$phone,$email,$district_id,$municipality,$wardNumber,$tole,$Id);
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
  <!-- bootstrap-wysiwyg -->
  <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- starrr -->
  <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">
   .actionBar .buttonDisabled {
      display: none;
    }

   .stepContainer {
      height: auto !important;
    }

    fieldset.scheduler-border {
      border: 2px groove #ddd !important;
      padding: 0 1.4em 1.4em 1.4em !important;
      margin: 0 0 1.5em 0 !important;
      -webkit-box-shadow: 0px 0px 0px 0px #000;
      box-shadow: 0px 0px 0px 0px #000;
      margin-top: 30px !important;
      border-radius: 6px;
    }

   legend.scheduler-border {
      font-size: .9rem !important;
      text-align: left !important;
      width: auto;
      padding: 0 10px;
      border-bottom: none;
      margin-top: -15px;
      background-color: white;
      color: black;
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
                           window.location.href = "user.php";
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
                           window.location.href = "user.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>
          <div class="row" style="max-height: 1096px">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-user"></i>Update student's info</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                      <li>
                        <a href="#step-1">
                          <span class="step_no"><i class="fa fa-user"></i></span>
                          <small>Personal Information</small>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-2">
                          <span class="step_no"><i class="fa fa-users"></i></span>
                          <small>Parents Information</small>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-3">
                          <span class="step_no"><i class="fa fa-university"></i></span>
                          <small>Professional Information</small>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-4">
                          <span class="step_no"><i class="fa fa-map-marker"></i></span>
                          <small>Contact Information</small>
                          </span>
                        </a>
                      </li>
                    </ul>
                    <form class="demo-form" action="" method="post" data-parsley-validate>
                      <div id="step-1">
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Identity Data</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">First Name<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="firstName" value="<?php echo $res->firstName;?>" name="firstName" required="required" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Middle Name</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="middleName" value="<?php echo $res->middleName ;?>" name="middleName" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Last Name<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="lastName" value="<?php echo $res-> lastName;?>" name="lastName" required="required" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Date of Birth<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input id="dateOfBirth" value="<?php echo $res->dateOfBirth ;?>" name="dateOfBirth" class="date-picker form-control" placeholder="MM-DD-YYYY" type="text" required="required" type="text" onfocus="this.type='date'">
                            </div>
                          </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Additional Information</legend>
                          <div class=" row ">
                            <div class="col-md-8 col-sm-12">
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Gender<span class="required" style="color: red">*</span></label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="gender" name="gender" class="form-control" required="required">
                                    <option value="N/A">---Select---</option>
                                    <option value="Male" <?php if($res->gender=="Male"){
                                                echo " selected";
                                             } ?>>Male</option>
                                    <option value="Female" <?php if($res->gender=="Female"){
                                                echo " selected";
                                             } ?>>Female</option>
                                    <option value="Other" <?php if($res->gender=="Other"){
                                                echo " selected";
                                             } ?>>Other</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Caste</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="caste" name="caste" class="form-control">
                                    <option value="N/A">---Select---</option>
                                    <option value="Kshetry" <?php 
                                            if($res->caste=="Kshetry"){
                                              echo "selected";
                                             }
                                          ?>>Kshetry</option>
                                    <option value="Brahman" <?php 
                                            if($res->caste=="Brahman"){
                                              echo "selected";
                                             }
                                          ?>>Brahman</option>
                                    <option value="Magar" <?php 
                                            if($res->caste=="Magar"){
                                              echo "selected";
                                             }
                                          ?>>Magar</option>
                                    <option value="Tharu" <?php 
                                            if($res->caste=="Tharu"){
                                              echo "selected";
                                             }
                                          ?>>Tharu</option>
                                    <option value="Janajati" <?php 
                                            if($res->caste=="Janjati"){
                                              echo "selected";
                                             }
                                          ?>>Janajati</option>
                                    <option value="Dalit" <?php 
                                            if($res->caste=="Dalit"){
                                              echo "selected";
                                             }
                                          ?>>Dalit</option>
                                    <option value="Madeshi" <?php 
                                            if($res->caste=="Madeshi"){
                                              echo "selected";
                                             }
                                          ?>>Madeshi</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Religion</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="religion" name="religion" class="form-control">
                                    <option value="N/A">---Select---</option>
                                    <option value="Hindu" <?php 
                                            if($res->religion=="Hindu"){
                                              echo "selected";
                                             }
                                          ?>>Hindu</option>
                                    <option value="Baudh" <?php 
                                            if($res->religion=="Baudh"){
                                              echo "selected";
                                             }
                                          ?>>Baudh</option>
                                    <option value="Muslim" <?php 
                                            if($res->religion=="Muslim"){
                                              echo "selected";
                                             }
                                          ?>>Muslim</option>
                                    <option value="Christian" <?php 
                                            if($res->religion=="Christian"){
                                              echo "selected";
                                             }
                                          ?>>Christian</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Nationality</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="nationality" name="nationality" class="form-control">
                                    <option value="N/A">---Select---</option>
                                    <option value="Nepali" <?php 
                                            if($res->nationality=="Nepali"){
                                              echo "selected";
                                             }
                                          ?>>Nepali</option>
                                    <option value="Foreign" <?php 
                                            if($res->nationality=="Foreign"){
                                              echo "selected";
                                             }
                                          ?>>Foreign</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Blood Group</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="bloodGroup" name="bloodGroup" class="form-control">
                                    <option value="N/A">---Select---</option>
                                    <option value="A+" <?php 
                                            if($res->bloodGroup=="A+"){
                                              echo "selected";
                                             }
                                          ?>>A+</option>
                                    <option value="A-" <?php 
                                            if($res->bloodGroup=="A-"){
                                              echo "selected";
                                             }
                                          ?>>A-</option>
                                    <option value="B+" <?php 
                                            if($res->bloodGroup=="B+"){
                                              echo "selected";
                                             }
                                          ?>>B+</option>
                                    <option value="B-" <?php 
                                            if($res->bloodGroup=="B-"){
                                              echo "selected";
                                             }
                                          ?>>B-</option>
                                    <option value="O+" <?php 
                                            if($res->bloodGroup=="O+"){
                                              echo "selected";
                                             }
                                          ?>>O+</option>
                                    <option value="O-" <?php 
                                            if($res->bloodGroup=="O-"){
                                              echo "selected";
                                             }
                                          ?>>O-</option>
                                    <option value="AB+" <?php 
                                            if($res->bloodGroup=="AB+"){
                                              echo "selected";
                                             }
                                          ?>>AB+</option>
                                    <option value="AB-" <?php 
                                            if($res->bloodGroup=="AB-"){
                                              echo "selected";
                                             }
                                          ?>>AB-</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                        </fieldset>
                      </div>
                      <div id="step-2">
                        <!--************parents detail start****************-->
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Parents Details</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Father Name<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="fatherName" value="<?php echo $res->fatherName; ?>" name="fatherName" class="form-control" autocomplete="off" required>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Father Mobile </label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="FatherMobile" value="<?php echo $res->fatherMobile; ?>" name="fatherMobile" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Father Education</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="fatherEducation" value="<?php echo $res->fatherEducation; ?>" name="fatherEducation" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Father Profession</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="fatherProfession" value="<?php echo $res->fatherProfession; ?>" name="fatherProfession" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Mother Name</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherName" value="<?php echo $res->motherName; ?>" name="motherName" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 "> Mother Mobile</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherMobile" value="<?php echo $res->motherMobile; ?>" name="motherMobile" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Mother Education</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherEducation" value="<?php echo $res->motherEducation; ?>" name="motherEducation" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Mother Profession</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherProfession" value="<?php echo $res->motherProfession; ?>" name="motherProfession" class="form-control" autocomplete="off">
                            </div>
                          </div>
                        </fieldset>
                        <!--**********parents detail End*************-->
                      </div>
                      <div id="step-3">
                        <!--******************************professional Info Start***************************************-->
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Professional details</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-2 ">Profession<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="text" id="profession" value="<?php echo $res->profession; ?>" name="profession" required="required" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-2 ">Organization<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input id="organization" value="<?php echo $res->organization; ?>" name="organization" required="required" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-2 ">Post</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input id="post" value="<?php echo $res->userPost; ?>" name="userPost" class="form-control " autocomplete="off" type="text">
                            </div>
                          </div>
                        </fieldset>
                        <!--******************************professional Info End***************************************-->
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Hostel details</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-1 col-sm-2 ">Hostail Join Date<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input id="hostelJoinDate" value="<?php echo $res->hostelJoinDate; ?>" name="hostelJoinDate" class="date-picker form-control " placeholder="mm/dd/yyyy" autocomplete="off" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                              <script>
                                function timeFunctionLong(input) {
                                  setTimeout(function() {
                                    input.type = 'text';
                                  }, 60000);
                                }
                              </script>
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Floor<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <select id="floor" name="floor_id" class="form-control" required>
                                <!-- data auto fetching -->
                              </select>
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Room No <span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <select id="roomNumber" name="roomNumber" required="required" class="form-control">
                                <!-- data auto fetching -->

                              </select>
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Number of Bed</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="text" id="bedPerRoom" name="bedPerRoom" readonly class="form-control" autocomplete="off">

                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Rent Of Bed</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="text" id="rentPerBed" name="rentPerBed" readonly class="form-control" autocomplete="off">
                            </div>
                          </div>
                        </fieldset>
                      </div>
                      <div id="step-4">
                        <!--******************************cONTACT Info START***************************************-->
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Student's Contact</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-1 col-sm-2 ">Guardian<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="text" id="guardianName" value="<?php echo $res->guardianName; ?>" name="guardianName" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Guardian Phone <span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="number" id="guardianPhone" value="<?php echo $res->guardianPhone; ?>" name="guardianPhone" class="form-control" autocomplete="off" required="required">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-1 col-sm-2 ">Relation With Guardian<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="text" id="relationWithGuardian" value="<?php echo $res->relationWithGuardian; ?>" name="relationWithGuardian" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Student Phone<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="number" id="phone" value="<?php echo $res->phone; ?>" name="phone" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Student Email</label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="email" id="email" value="<?php echo $res->email; ?>" name="email" class="form-control" autocomplete="off">
                            </div>
                          </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Student's Permanant Address</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-2 ">Province<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="province" name="province" class="form-control" autocomplete="off">
                                <!--data auto fatching  -->

                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">District<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="district" name="district_id" class="form-control" autocomplete="off">
                                <!--data auto fatching  -->
                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Municipality</label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="municipality" name="municipality" class="form-control" autocomplete="off">
                                <!--data auto fatching  -->
                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Ward No</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="number" id="wardNumber" value="<?php echo $res->wardNumber; ?>" name="wardNumber" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Tole</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="text" id="tole" value="<?php echo $res->tole; ?>" name="tole" class="form-control" autocomplete="off">
                              </input>
                            </div>
                          </div>
                        </fieldset>
                        <!--******************************cONTACT Info End***************************************-->
                        <button class="btn btn-primary" type="submit" name="editUser" style="float: right;">Update</button>
                      </div>
                    </form>
                  </div>
                  <!-- End SmartWizard Content -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ===================FOOTER START=============== -->
      <?php include 'include/footer.php'; ?>
      <!-- ===================FOOTER END================= -->
    </div>
  </div>
</body>
</html>
<!-- Dropzone.js -->
<script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- validation js -->
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>

<!-- cascading dropdown provences, districts and municipalities -->

<script>
  $(document).ready(function() {
    $('#province').empty().append('<option value="">---Select Province---</option>');
    // AJAX request to fetch provinces
    $.ajax({
      url: '../config/autoFetching.php?type=provinces',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        // Check if response is not empty
        if (response.length > 0) {
          // Loop through the response and populate the select box
          $.each(response, function(index, province) {
            $('#province').append('<option value="' + province.id + '">' + province.name + '</option>');
          });
        } else {
          $('#province').append('<option value="">No provinces found</option>');
        }
      },
      error: function(xhr, status, error) {
        // Handle error if AJAX request fails
        console.error(xhr.responseText);
        alert('Error fetching provinces. Please check the console for details.');
      }
    });
    // Handle change event for provinces dropdown
    $('#province').on('change', function() {
      var provinceId = $(this).val();
      // Clear districts and municipalities dropdowns
      $('#district').empty().append('<option value="" selected disabled>---Select District---</option>');
      $('#municipality').empty().append('<option value="" selected disabled>---Select Municipality---</option>');
      // Fetch districts based on the selected province
      if (provinceId) {
        $.ajax({
          url: '../config/autoFetching.php?type=districts&province_id=' + provinceId,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response.length > 0) {
              $.each(response, function(index, district) {
                $('#district').append('<option value="' + district.id + '">' + district.name + '</option>');
              });
            } else {
              $('#district').append('<option value="" disabled>No districts found</option>');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching districts. Please check the console for details.');
          }
        });
      }
    });
    // Handle change event for districts dropdown
    $('#district').on('change', function() {
      var districtId = $(this).val();
      // Clear municipalities dropdown
      $('#municipality').empty().append('<option value="" selected>---Select Municipality---</option>');
      // Fetch municipalities based on the selected district
      if (districtId) {
        $.ajax({
          url: '../config/autoFetching.php?type=municipalities&district_id=' + districtId,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response.length > 0) {
              $.each(response, function(index, municipality) {
                $('#municipality').append('<option value="' + municipality.name + '">' + municipality.name + '</option>');
              });
            } else {
              $('#municipality').append('<option value="" disabled>No municipalities found</option>');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching municipalities. Please check the console for details.');
          }
        });
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#floor').empty().append('<option value="" selected disabled>---Select Floor---</option>');
    // AJAX request to fetch floor numbers
    $.ajax({
      url: '../config/autoFetching2.php?type=floor',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.length > 0) {
          // Populate floor select box
          $.each(response, function(index, floor) {
            $('#floor').append('<option value="' + floor.id + '">' + floor.name + '</option>');
          });
        } else {
          $('#floor').append('<option value="" disabled>No floor found</option>');
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        alert('Error fetching floor. Please check the console for details.');
      }
    });
    // Handle change event for floor dropdown
    $('#floor').on('change', function() {
      var floorId = $(this).val();
      // Clear municipalities dropdown
      $('#roomNumber').empty().append('<option value="" selected disabled>---Select Room Number---</option>');
      if (floorId) {
        $.ajax({
          url: '../config/autoFetching2.php?type=roomNumbers&floor_id=' + floorId,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response.length > 0) {
              // Populate room numbers select box
              $.each(response, function(index, room) {
                $('#roomNumber').append('<option value="' + room.roomId + '">' + room.roomNumber + '</option>');
              });
            } else {
              $('#roomNumber').append('<option value="" disabled>No rooms found</option>');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching room numbers. Please check the console for details.');
          }
        });
      }
    });
    // Handle change event for room number dropdown
    $('#roomNumber').on('change', function() {
      var roomId = $(this).val();
      // Clear bedPerRoom and rentPerBed inputs
      $('#bedPerRoom').val('');
      $('#rentPerBed').val('');
      // Fetch room details based on the selected room number
      if (roomNumber) {
        $.ajax({
          url: '../config/autoFetching2.php?type=roomDetails&roomId=' + roomId,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response) {
              // Populate bedPerRoom and rentPerBed inputs
              $('#bedPerRoom').val(response.bedPerRoom);
              $('#rentPerBed').val(response.rentPerBed);
            } else {
              alert('Room details not found.');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching room details. Please check the console for details.');
          }
        });
      }
    });
  });
</script>