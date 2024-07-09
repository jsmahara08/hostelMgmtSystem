<?php 
session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
if(!isset($_GET['room_id']) || $_GET['room_id'] === ""){
   header('location:room.php');
   exit; // It's a good practice to exit after a header redirect
}
include('../config/DbFunction.php');
$obj=new DbFunction(); 
$roomId=$_REQUEST['room_id'];
$rs=$obj->showRoom1($roomId);
$res=$rs->fetch_object();

if(isset($_POST['editRoom'])){
   extract($_POST);
   $obj->editRoom($roomNumber,$bedPerRoom,$rentPerBed,$floorId,$roomId);
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
          <div class="row" style="min-height: 80vh">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
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
                           window.location.href = "room.php";
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
                           window.location.href = "room.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>
                  <h2><i class="fa fa-bed" aria-hidden="true"></i> Update Room</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- start form for validation -->
                  <form id="demo-form" data-parsley-validate method="post">
                    <div class="form-group row">
                      <div class="col-md-2 col-sm-12 ">
                        <label for="addFloor">Floor * :</label>
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <select id="addFloor" class="form-control" name="floorId" required autocomplete="off" />
                        <!-- auto fetch option -->
                        </select>
                      </div>

                    </div>
                    <div class="form-group row ">
                      <div class="col-md-2 col-sm-12 ">
                        <label for="roomNumber">Room Number * :</label>
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <input type="number" id="roomNumber" value="<?php echo $res->roomNumber;?>" class="form-control" name="roomNumber" required autocomplete="off" />
                      </div>
                      <div class="col-md-5 col-sm-12 ">
                        <label for="RoomNoSuggestion"><span style="color:red">*</span>Room numbers should follow a specific format or range, and there should be no duplicates. Additionally, consider any specific rules or criteria for assigning room numbers, such as building or floor numbers.</label>
                      </div>
                    </div>
                    <div class="form-group row ">
                      <div class="col-md-2 col-sm-12 ">
                        <label for="bedPerRoom">Bed per Room * :</label>
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <input type="number" id="bedPerRoom" value="<?php echo $res->bedPerRoom;?>" class="form-control" name="bedPerRoom" required autocomplete="off" />
                      </div>
                      <div class="col-md-5 col-sm-12 ">
                        <label for="bedPerRoomSuggestion"><span style="color:red">*</span>Each room should have at least one bed, and the number of beds cannot exceed a certain limit. Additionally, make sure that there are no duplicate bed allocations across rooms</label>
                      </div>
                    </div>
                    <div class="form-group row ">
                      <div class="col-md-2 col-sm-12 ">
                        <label for="rentPerBed">Rent per Bed * :</label>
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <input type="number" id="rentPerBed" value="<?php echo $res->rentPerBed;?>" class="form-control" name="rentPerBed" required autocomplete="off" />
                      </div>
                      <div class="col-md-5 col-sm-12 ">
                        <label for="rentPerBedSuggestion"><span style="color:red">*</span>The rent amount should be a positive number and within a certain range. Additionally, consider any specific rules or criteria for setting the rent amount, such as currency format or minimum/maximum limits.</label>
                      </div>
                    </div>
                    <br />
                    <button class="btn btn-primary" type="submit" name="editRoom" style="float: right;">Update</button>
                  </form>
                  <!-- end form for validations -->
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

      <script>
        $(document).ready(function() {
          $('#addFloor').empty().append('<option value="">---Select Floor---</option>');
          // AJAX request to fetch floor numbers
          $.ajax({
            url: '../config/autoFetching3.php?type=floor',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              if (response.length > 0) {
                // Populate floor select box
                $.each(response, function(index, floor) {
                  $('#addFloor').append('<option value="' + floor.id + '">' + floor.name + '</option>');
                });
              } else {
                $('#addFloor').append('<option value="">No floor found</option>');
              }
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
              alert('Error fetching floor. Please check the console for details.');
            }
          });
        });
      </script>