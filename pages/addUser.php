<?php 
session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
if(isset($_POST['addUser'])){
  include('../config/DbFunction.php');
  $obj=new DbFunction();
  extract($_POST);
  $status="active";
  $obj->addUser($firstName,$middleName,$lastName,$dateOfBirth,$gender,$caste,$religion,$nationality,$bloodGroup,$fatherName,$fatherMobile,$fatherEducation,$fatherProfession,$motherName,$motherMobile,$motherEducation,$motherProfession,$profession,$organization,$userPost,$hostelJoinDate,$roomNumber,$guardianName,$guardianPhone,$relationWithGuardian,$phone,$email,$district_id,$municipality,$wardNumber,$tole);
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
   .loader {
      display: flex;
      position: fixed;
      right: 50%;
      top: 50%;
      z-index: 9999;
      width: 40px;
      aspect-ratio: 1;
      --c: no-repeat linear-gradient(#046D8B 0 0);
      background:
        var(--c) 0 50%,
        var(--c) right 0 bottom 20px,
        var(--c) 100% 0,
        var(--c) 50% 0,
        var(--c) right 20px bottom 0,
        var(--c) 0 100%;
      animation: l5 1.5s infinite alternate;
    }

    @keyframes l5 {
      0% {
        background-size: 0 4px, 4px 0, 0 4px, 4px 0, 0 4px, 4px 0
      }

      16.67% {
        background-size: 100% 4px, 4px 0, 0 4px, 4px 0, 0 4px, 4px 0
      }

      33.33% {
        background-size: 100% 4px, 4px 50%, 0 4px, 4px 0, 0 4px, 4px 0
      }

      50% {
        background-size: 100% 4px, 4px 50%, 50% 4px, 4px 0, 0 4px, 4px 0
      }

      66.67% {
        background-size: 100% 4px, 4px 50%, 50% 4px, 4px 100%, 0 4px, 4px 0
      }

      83.33% {
        background-size: 100% 4px, 4px 50%, 50% 4px, 4px 100%, 50% 4px, 4px 0
      }

      95%,
      100% {
        background-size: 100% 4px, 4px 50%, 50% 4px, 4px 100%, 50% 4px, 4px 50%
      }
    }
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
                  <h2><i class="fa fa-user"></i> Add New Student</h2>
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
                              <input type="text" id="firstName" name="firstName" required="required" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Middle Name</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="middleName" name="middleName" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Last Name<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="lastName" name="lastName" required="required" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Date of Birth<span class="required" style="color: red">*</span></label>
                            <div class="col-md-4 col-sm-10 ">
                              <input id="dateOfBirth" name="dateOfBirth" class="date-picker form-control" placeholder="MM-DD-YYYY" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'">
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
                                  <select id="gender" name="gender" class="form-control" required>
                                    <option value="" disabled selected>---Select---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Caste</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="caste" name="caste" class="form-control">
                                    <option value="">---Select---</option>
                                    <option value="Kshetry">Kshetry</option>
                                    <option value="Brahman">Brahman</option>
                                    <option value="Magar">Magar</option>
                                    <option value="Tharu">Tharu</option>
                                    <option value="Janajati">Janajati</option>
                                    <option value="Dalit">Dalit</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Religion</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="religion" name="religion" class="form-control">
                                    <option value="" >---Select---</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Baudh">Baudh</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Christian">Christian</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Nationality</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="nationality" name="nationality" class="form-control">
                                    <option value="">---Select---</option>
                                    <option value="Nepali">Nepali</option>
                                    <option value="Foreign">Foreign</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Blood Group</label>
                                <div class="col-md-9 col-sm-10 ">
                                  <select id="bloodGroup" name="bloodGroup" class="form-control">
                                    <option value="">---Select---</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
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
                              <input type="text" id="fatherName" name="fatherName" class="form-control" autocomplete="off" required>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Father Mobile </label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="number" id="FatherMobile" name="fatherMobile" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Father Education</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="fatherEducation" name="fatherEducation" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Father Profession</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="fatherProfession" name="fatherProfession" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Mother Name</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherName" name="motherName" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 "> Mother Mobile</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="number" id="motherMobile" name="motherMobile" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Mother Education</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherEducation" name="motherEducation" class="form-control" autocomplete="off">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 ">Mother Profession</label>
                            <div class="col-md-4 col-sm-10 ">
                              <input type="text" id="motherProfession" name="motherProfession" class="form-control" autocomplete="off">
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
                              <input type="text" id="profession" name="profession" required="required" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-2 ">Organization<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input id="organization" name="organization" required="required" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-2 ">Post<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input id="post" name="userPost" class="form-control " autocomplete="off" type="text" required="required">
                            </div>
                          </div>
                        </fieldset>
                        <!--******************************professional Info End***************************************-->
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Hostel details</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-1 col-sm-2 ">Hostel Join Date<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input id="hostelJoinDate" name="hostelJoinDate" class="date-picker form-control " placeholder="mm/dd/yyyy" autocomplete="off" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'">
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
                              <input type="number" id="bedPerRoom" name="bedPerRoom" readonly class="form-control" autocomplete="off">

                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Rent Of Bed</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="number" id="rentPerBed" name="rentPerBed" readonly class="form-control" autocomplete="off">
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
                              <input type="text" id="guardian" name="guardianName" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Guardian Phone <span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="number" id="guardianPhone" name="guardianPhone" class="form-control" autocomplete="off" required="required">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-1 col-sm-2 ">Relation With Guardian<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="text" id="relationWithGuardian" name="relationWithGuardian" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Student's Phone<span class="required" style="color: red">*</span></label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="number" id="hostailerPhone" name="phone" class="form-control" autocomplete="off" required="required">
                            </div>
                            <label class="control-label col-md-1 col-sm-2 ">Student's Email</label>
                            <div class="col-md-3 col-sm-10 ">
                              <input type="email" id="hostailerEmail" name="email" class="form-control" autocomplete="off">
                            </div>
                          </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                          <legend class="scheduler-border">Student's Permanant Address</legend>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-2 ">Province<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="province" name="province_id" class="form-control" autocomplete="off" required>
                                <!--data auto fatching  -->

                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">District<span class="required" style="color: red">*</span></label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="district" name="district_id" class="form-control" autocomplete="off" required>
                                <!--data auto fatching  -->
                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Municipality</label>
                            <div class="col-md-5 col-sm-10 ">
                              <select id="municipality" name="municipality_id" class="form-control" autocomplete="off">
                                <!--data auto fatching  -->
                              </select>
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Ward No</label>
                            <div class="col-md-5 col-sm-10 ">
                              <input type="number" id="wardNo" name="wardNumber" class="form-control" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group row ">
                            <label class="control-label col-md-4 col-sm-12 ">Tole</label>
                            <div class="col-md-5 col-sm-10 ">
                              <textarea id="tole" name="tole" class="form-control" autocomplete="off">
                                    </textarea>
                            </div>
                          </div>
                        </fieldset>
                        <!--******************************cONTACT Info End***************************************-->
                        <button class="btn btn-primary" type="submit" name="addUser" style="float: right;">Add Student</button>
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
    $('#province').empty().append('<option value="" disabled selected>---Select Province---</option>');
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
          $('#province').append('<option value="" disabled>No provinces found</option>');
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
      $('#district').empty().append('<option value="" disabled selected>---Select District---</option>');
      $('#municipality').empty().append('<option value="" disabled selected>---Select Municipality---</option>');
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
      $('#municipality').empty().append('<option value="">---Select Municipality---</option>');
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
    $('#floor').empty().append('<option selected disabled>---Select Floor---</option>');
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
      $('#roomNumber').empty().append('<option value="" disabled selected>---Select Room Number---</option>');
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