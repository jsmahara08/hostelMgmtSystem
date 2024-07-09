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
$userId=$_REQUEST['user_id'];
$rs=$obj->showUser1($userId);
$res=$rs->fetch_object();
$payment=$obj->showPayment1($userId);

if(isset($_POST["changeImage"])){
  $img_name=$_FILES['pic']['name'];
  $img_tmpName=$_FILES['pic']['tmp_name'];
  $obj->userImage($img_name,$img_tmpName,$userId);
}
if(isset($_POST['payNow'])){
  extract($_POST);
  if($amountPay==$totalAmount){
      $status="Paid";
      }
  else if($amountPay<$totalAmount){
      $status="Partial Payment";
      }
  else if($amountPay>$totalAmount){
      $status="Advance Payment";
      }
  $obj->paymentProcess($amountPay,$paymentMethod,$status,$paidDate,$paymentId,$userId);
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
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
                           window.location.href = "userProfile.php?user_id='.$_REQUEST['user_id'].'";
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
                           window.location.href = "userProfile.php?user_id='.$_REQUEST['user_id'].'";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Profile <small class="bg-danger text-white"><?php if($res->status==="Leave") {
                      echo $res->status." hostel on ".$res->leaveDate;
                    }?> </small></h2>
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
                    <!-- Current avatar -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="profile_img">
                         <input type="file" name="pic" id="pic" accept="image/*">
                        <img class="img-responsive avatar-view" src="../public/user/<?php echo$res->image?>" alt="profile" title="user image">
                        <?php
                       if($res->status==="active") {?>
                        <?php } ?>
                        <br />
                      </div>
                      <?php if($res->status==="active") {?>
                      <button class="btn btn-primary" name="changeImage">Change Image</button>
                      <?php } ?>

                    </form>
                    <h4><?php echo strtoupper($res->firstName." ".$res->middleName." ".$res->lastName);?></h4>

                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-map-marker user-profile-icon"></i> <?php 
                        echo strtolower($res->province.",".$res->district." district ".$res->municipality.",".$res->wardNumber." ". $res->tole);?>
                      </li>

                      <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $res->profession. " at ".$res->organization.",".$res->userPost; ?>
                      </li>

                      <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="mailto:<?php echo $res->email ?>" target="_blank"><?php echo $res->email ?></a>
                      </li>
                      <li class="m-top-xs">
                        <i class="fa fa-phone user-profile-icon"></i>
                        <a href="tel:<?php echo $res->phone ?>" target="_blank"><?php echo $res->phone ?></a>
                      </li>
                    </ul>
                    <?php if($res->status==="active") {?>

                    <a href="editUser.php?user_id=<?php echo $res->id ?>" class="btn btn-primary text-white"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                    <?php } ?>
                    <br /><br />
                    <h4><u>General Information</u></h4>
                    <strong>Date of Birth:</strong>
                    <i><?php echo $res->dateOfBirth; ?></i><br />

                    <strong>Gender:</strong>
                    <i><?php echo $res->gender; ?></i><br />

                    <strong>Caste:</strong>
                    <i><?php if($res->caste==""){echo "N/A";} else{echo $res->caste; }?></i><br />
                    <strong>Religion:</strong>
                    <i><?php if($res->religion==""){echo "N/A";}else{echo $res->religion;} ?></i><br />
                    <strong>Nationality:</strong>
                    <i><?php if($res->nationality==""){echo "N/A";}echo $res->nationality; ?></i><br />
                    <strong>Blood Group:</strong>
                    <i><?php if($res->bloodGroup==""){echo "N/A";}echo $res->bloodGroup; ?></i><br />

                  </div>
                  <div class="col-md-9 col-sm-9 ">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Hostel Information</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">More Information</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                            <tr>
                              <td>Floor</td>
                              <td><i><?php echo $res->floorname ?></i></td>
                            </tr>
                            <tr>
                              <td>Room Number</td>
                              <td><i><?php echo $res->roomNumber ?></i></td>
                            </tr>
                            <tr>
                              <td>Number of bed</td>
                              <td><i><?php echo $res->bedPerRoom ?></i></td>
                            <tr>
                              <td>Total Rent</td>
                              <td><i><?php echo $res->rentPerBed ?></i></td>
                            </tr>
                            </tr>
                          </table>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                            <tr>
                              <td>Father's Name</td>
                              <td><i><?php echo $res->fatherName ?></i></td>
                              <td>Mother's Name</td>
                              <td><i><?php echo $res->motherName ?></i></td>
                            </tr>
                            <tr>
                              <td>Father's Education</td>
                              <td><i><?php if($res->fatherEducation=="") {echo "N/A";}echo $res->fatherEducation ?></i></td>
                              <td>Mother's Education</td>
                              <td><i><?php if($res->motherEducation=="") {echo "N/A";}echo $res->motherEducation ?></i></td>
                            </tr>
                            <tr>
                              <td>Father's Profession</td>
                              <td><i><?php if($res->fatherProfession==""){echo "N/A";}echo $res->fatherProfession ?></i></td>
                              <td>Mother's Profession</td>
                              <td><i><?php if($res->motherProfession=="") {echo "N/A";}echo $res->motherProfession ?></i></td>
                            <tr>
                              <td>Father's Phone </td>
                              <td><i><?php if($res->fatherMobile=="") {echo "N/A";}echo $res->fatherMobile ?></i></td>
                              <td>Mother's Phone </td>
                              <td><i><?php if($res->motherMobile=="") {echo "N/A";}echo $res->motherMobile ?></i></td>
                            </tr>
                            <tr>
                              <td>Guardian Name</td>
                              <td><i><?php echo $res->guardianName ?></< /i>
                              </td>
                              <td>Relation with Guardian</td>
                              <td><i><?php echo $res->relationWithGuardian ?></i></td>
                            </tr>
                            <tr>
                              <td>Guardian Phone</td>
                              <td><a href="tel:<?php echo $res->guardianPhone ?>"><?php echo $res->guardianPhone ?></a></td>
                              <?php if($res->status==="active") {?>
                              <td><a href="message.php"><button class="btn btn-primary"><i class="fa fa-envelope"></i>Send Message</button></a></td>
                              <?php } ?>
                            </tr>
                          </table>

                        </div>
                      </div>
                    </div>
                    <?php if($res->status==="active") {
                       echo "<button class='btn btn btn-success showModalBtn' data-toggle='modal' data-target='.bs-example-modal-sm' data-row-id='$res->id'><i class='fa fa-paypal'></i> Pay Now</button>";
                     } ?>
                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Statement</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <?php while($payinfo=$payment->fetch_object()){ ?>
                            <article class="media event">
                              <a class="pull-left date bg-success">
                                <p class="month"><?php echo $payinfo->month; ?></p>
                                <p class="day"><small><?php echo $payinfo->year; ?></small></p>
                              </a>
                              <div class="media-body">
                                <a class="title" href="#">Total Amount: <?php echo $payinfo->rent+$payinfo->additionalCharge; ?></a>
                                <p>Rent: <?php echo $payinfo->rent?>

                                  <?php 
                                     if($payinfo->additionalCharge>0){
                                       echo "Additional Charge: $payinfo->additionalCharge for $payinfo->remarks";
                                     }

                                      ?>
                                </p>

                                <i><?php echo $payinfo->paymentDate?>
                                  <?php 
                                         if($payinfo->status=="Paid"){
                                         echo  "<span class='bg-success text-white'>$payinfo->status</span>";
                                       }
                                       else if($payinfo->status=="Unpaid"){
                                        echo  "<span class='bg-danger text-white'>$payinfo->status</span>";

                                       }
                                      else if($payinfo->status=="Partial Payment"){
                                        echo  "<span class='bg-warning text-white'>$payinfo->status</span>";

                                       }
                                       else if($payinfo->status=="Advance Payment"){
                                        echo  "<span class='bg-info text-white'>$payinfo->status</span>";

                                       }
                                       if($payinfo->status !="Unpaid"){
                                        echo " Paid Amount: $payinfo->paidAmount";
                                       }

                                        ?>
                                </i>
                                <p>

                              </div>
                            </article>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->

                    <!-- moodle  -->
                    <div id="myModal" class="modal fade bs-example-modal-sm" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Pay Now</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body" id="modalContent">
                            <form method="post" id="demo-form" data-parsley-validate>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Year/Month</label>
                                <div class="col-md-6 col-sm-9">
                                  <select class="form-control" required name="paymentId" id="paymentId">

                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Rent Amount</label>
                                <div class="col-md-6 col-sm-9">
                                  <input type="text" id="rentAmount" name="rentAmount" required="required" class="form-control" readonly>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Extra Charge</label>
                                <div class="col-md-6 col-sm-9 ">
                                  <input type="number" id="extraAmount" name="extraAmount" class="form-control" autocomplete="off" required="required" readonly>
                                </div>

                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Remarks</label>
                                <div class="col-md-6 col-sm-9 ">
                                  <input type="text" id="remarks" name="remarks" class="form-control" autocomplete="off" readonly>
                                </div>

                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Total Amount</label>
                                <div class="col-md-6 col-sm-9 ">
                                  <input type="number" id="totalAmount" name="totalAmount" class="form-control" value="" required="required" readonly>
                                </div>

                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Amount(RS)</label>
                                <div class="col-md-6 col-sm-9 ">
                                  <input type="number" id="amountPay" name="amountPay" class="form-control" autocomplete="off" step="0.01" required="required">
                                </div>

                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Payment Method</label>
                                <div class="col-md-6 col-sm-9 ">
                                  <select class="form-control" required id="paymentMethod" name="paymentMethod">
                                    <option value="" selected disabled>esewa/khalti/bank account/cash</option>
                                    <option value="Esewa">Esewa</option>
                                    <option value="Khalti">Khalti</option>
                                    <option value="Bank Account">Bank Account</option>
                                    <option value="cash in hand">cash in hand</option>

                                  </select>
                                </div>

                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Paid Date</label>
                                <div class="col-md-6 col-sm-6 ">
                                  <input id="paidDate" name="paidDate" class="date-picker form-control" placeholder="MM-DD-YYYY" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'">
                                </div>
                              </div>

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="payNow">Process to payment</button>
                          </div>
                          </form>

                        </div>
                      </div>
                    </div>
                    <!--pay Now modal end -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
      <!-- ===================FOOTER START=============== -->
      <?php include 'include/footer.php'; ?>
      <!-- ===================FOOTER END================= -->
    </div>
  </div>
</body>
</html>
<!-- morris.js -->
<script src="../vendors/raphael/raphael.min.js"></script>
<script src="../vendors/morris.js/morris.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

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
    // Handle click event for "Show Details" button
    $('.showModalBtn').click(function() {
      let userId = $(this).data('row-id'); // Get the row ID associated with the button
      $('#paymentId').empty().append('<option value="" selected disabled>--select--</option>');
      // AJAX request to fetch floor numbers
      $.ajax({
        url: '../config/autoFetching4.php?type=paymentId&userId=' + userId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.length > 0) {
            // Populate floor select box
            $.each(response, function(index, payment) {
              $('#paymentId').append('<option value="' + payment.payment_id + '">' + payment.year_month + '</option>');
            });
          } else {
            $('#paymentId').append('<option value="">No unpaid payment found</option>');
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('Error fetching floor. Please check the console for details.');
        }
      });
      // Handle change event for room number dropdown
      $('#paymentId').on('change', function() {
        var paymentId = $(this).val();
        // Clear payment detail inputs
        $('#rentAmount').val('');
        $('#extraAmount').val('');
        $('#remarks').val('');
        $('#totalAmount').val('');
        // Fetch paymentinfo details based on the selected payment id
        if (paymentId) {
          $.ajax({
            url: '../config/autoFetching4.php?type=paymentDetail&paymentId=' + paymentId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              if (response) {
                $('#rentAmount').val(response.rent);
                $('#extraAmount').val(response.extraAmount);
                $('#remarks').val(response.remarks);
                $('#totalAmount').val(response.totalAmount);
              } else {
                alert('payment details not found.');
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
  });
</script>
