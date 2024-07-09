<?php
session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
include('../config/DbFunction.php');
$obj=new DbFunction();
$rs=$obj->showPayment();
if(isset($_POST["generateBill"])){
   extract($_POST);
   $obj->addPayment($year,$month);
}
if(isset($_POST["deletePayment"])){
   extract($_POST);
   $obj->deletePaymentList($deleteYear,$deleteMonth);
}
if(isset($_POST["addExtraCharge"])){
   extract($_POST);
   $obj->addExtraCharge($studentId,$chargeYear,$chargeMonth,$chargeAmount,$remarks);
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
  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">
    .nav-link.btn.btn-primary {
      transition: ease all 1.3s;
    }

    .nav-link.btn.btn-primary:hover {
      color: #007BFF;
      background: #ffffff;
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
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-money" aria-hidden="true"></i> Payment</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
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
                           window.location.href = "payment.php";
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
                           window.location.href = "payment.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>
                <div class="x_content">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="dashboard.php?page=payment"> <i class="fa fa-list-ol"></i> payment Info</a>
                    </li>
                    <li class="nav-item">
                      <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" class="dropdown">
                          <a id="drop4" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" style="font-size:15px">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>

                            Payment Option
                            <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" data-toggle='modal' data-target='.generateBill'>Generate Bill</a>
                            <a class="dropdown-item" data-toggle='modal' data-target='.additionalCharge'>Additional Charge</a>
                            <a class="dropdown-item" data-toggle='modal' data-target='.deleteBill'>Delete Bill</a>
                          </div>

                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="row">
                    <div class="col-sm-12" id="HostailerDetail">
                      <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #5a738e">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>Full Name</th>
                              <th>Rent</th>
                              <th>Additional charge</th>
                              <th>Reason</th>
                              <th>Year/Month</th>
                              <th>Status</th>
                              <th>Bill Generated Date</th>
                              <th>Action</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                         $sn=1;
                                     while($res=$rs->fetch_object()){?>
                            <tr class="">
                              <td><?php echo $sn?></td>
                              <td><?php echo htmlentities( strtoupper($res->fullName));?></td>
                              <td><?php echo htmlentities($res->rent);?></td>
                              <td><?php echo htmlentities($res->additionalCharge);?></td>
                              <td><?php echo htmlentities($res->remarks);?></td>
                              <td><?php echo htmlentities($res->year."/". $res->month);?></td>
                              <td><?php echo htmlentities($res->status);?></td>
                              <td><?php echo htmlentities($res->billGeneratedDate);?></td>
                              <td><a class="btn btn-primary" href="userProfile.php?user_id=<?php echo htmlentities($res->user_id);?>"><i class="fa fa-paypal"></i> Get Payment</a></td>

                            </tr>

                            <?php $sn++;}?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Generate Bill modal  -->
                <div id="myModal" class="modal fade bs-example-modal-sm generateBill" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form method="post">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Generate Bill</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" id="modalContent">
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3">Year</label>
                            <div class="col-md-6 col-sm-9">
                              <select id="year" name="year" required="required" class="form-control">
                                <option value="" disabled selected>--select--</option>
                                <option value="2080">2080</option>
                                <option value="2081">2081</option>
                                <option value="2082">2082</option>
                                <option value="2083">2083</option>
                                <option value="2084">2084</option>
                                <option value="2086">2086</option>
                                <option value="2087">2087</option>
                                <option value="2088">2088</option>
                                <option value="2089">2089</option>
                                <option value="2090">2090</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3 ">Month</label>
                            <div class="col-md-6 col-sm-9">
                              <select id="month" name="month" required="required" class="form-control">
                                <option value="" disabled selected>--select--</option>
                                <option value="Baishakh">Baishakh</option>
                                <option value="Jestha">Jestha</option>
                                <option value="Asar">Asar</option>
                                <option value="Shrawan">Shrawan</option>
                                <option value="Bhadra">Bhadra</option>
                                <option value="Asoj">Asoj</option>
                                <option value="Kartik">Kartik</option>
                                <option value="Mansir">Mansir</option>
                                <option value="Push">Push</option>
                                <option value="Magh">Magh</option>
                                <option value="Falgun">Falgun</option>
                                <option value="Chaitra">Chaitra</option>
                              </select>
                            </div>
                          </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="generateBill">Generate</button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
                <!-- modle end -->
                <!--deleteadd for payment modal  -->
                <div id="myModal" class="modal fade bs-example-modal-sm deleteBill" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">Confirm Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <form method="post">
                        <div class="modal-body" id="modalContent">
                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3 ">Year*</label>
                            <div class="col-md-6 col-sm-9">
                              <select id="deleteYear" name="deleteYear" required="required" class="form-control">
                                <option value="" disabled selected>--select--</option>
                                <option value="2080">2080</option>
                                <option value="2081">2081</option>
                                <option value="2082">2082</option>
                                <option value="2083">2083</option>
                                <option value="2084">2084</option>
                                <option value="2086">2086</option>
                                <option value="2087">2087</option>
                                <option value="2088">2088</option>
                                <option value="2089">2089</option>
                                <option value="2090">2090</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3 ">Month*</label>
                            <div class="col-md-6 col-sm-9">
                              <select id="deleteMonth" name="deleteMonth" required="required" class="form-control">
                                <option value="" disabled selected>--select--</option>
                                <option value="Baishakh">Baishakh</option>
                                <option value="Jestha">Jestha</option>
                                <option value="Asar">Asar</option>
                                <option value="Shrawan">Shrawan</option>
                                <option value="Bhadra">Bhadra</option>
                                <option value="Asoj">Asoj</option>
                                <option value="Kartik">Kartik</option>
                                <option value="Mansir">Mansir</option>
                                <option value="Push">Push</option>
                                <option value="Magh">Magh</option>
                                <option value="Falgun">Falgun</option>
                                <option value="Chaitra">Chaitra</option>
                              </select>
                            </div>
                          </div>

                          <h6>Are you sure you want to delete those bill?</h6>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" id="confirmDelete" class="btn btn-danger" name="deletePayment">Delete
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
                <!-- modal end -->

                <!--additional charge modal  -->
                <div id="myModal" class="modal fade bs-example-modal-sm additionalCharge" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">Additional Charge</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body" id="modalContent">
                        <form method="post">
                          <div class="row ">
                            <div class="col-md-10 col-sm-10" style="padding-left:20px">
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Student Name*</label>
                                <div class="col-md-9 col-sm-9">
                                  <select class="form-control" id="studentId" name="studentId" required>

                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Year*</label>
                                <div class="col-md-9 col-sm-9">
                                  <select id="chargeYear" name="chargeYear" required="required" class="form-control">
                                    <option value="" disabled selected>--select--</option>
                                    <option value="2080">2080</option>
                                    <option value="2081">2081</option>
                                    <option value="2082">2082</option>
                                    <option value="2083">2083</option>
                                    <option value="2084">2084</option>
                                    <option value="2086">2086</option>
                                    <option value="2087">2087</option>
                                    <option value="2088">2088</option>
                                    <option value="2089">2089</option>
                                    <option value="2090">2090</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Month*</label>
                                <div class="col-md-9 col-sm-9">
                                  <select id="month" name="chargeMonth" required="required" class="form-control">
                                    <option value="" disabled selected>--select--</option>
                                    <option value="Baishakh">Baishakh</option>
                                    <option value="Jestha">Jestha</option>
                                    <option value="Asar">Asar</option>
                                    <option value="Shrawan">Shrawan</option>
                                    <option value="Bhadra">Bhadra</option>
                                    <option value="Asoj">Asoj</option>
                                    <option value="Kartik">Kartik</option>
                                    <option value="Mansir">Mansir</option>
                                    <option value="Push">Push</option>
                                    <option value="Magh">Magh</option>
                                    <option value="Falgun">Falgun</option>
                                    <option value="Chaitra">Chaitra</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Amount*</label>
                                <div class="col-md-9 col-sm-9 ">
                                  <input type="number" id="chargeAmount" name="chargeAmount" class="form-control" autocomplete="off" step="0.01" required="required">
                                </div>
                              </div>
                              <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Remarks*</label>
                                <div class="col-md-9 col-sm-9 ">
                                  <textarea id="remarks" name="remarks" class="form-control" autocomplete="off" required="required">

                                 </textarea>
                                </div>
                              </div>

                            </div>
                            <div class="col-md-2 col-sm-2 text-center" id="image">
                              <img src="" id="profileImage" alt="student image here" height="100px" width="80px" border="solid 2px gray">

                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addExtraCharge">Add Charge</button>
                          </div>
                        </form>

                      </div>
                    </div>
                  </div>
                  <!--additional charge modal end -->

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
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<script>
  $(document).ready(function() {
    $('#studentId').empty().append('<option value="" selected disabled>--Select--</option>');
    // AJAX request to fetch students
    $.ajax({
      url: '../config/autoFetching1.php?type=student',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.length > 0) {
          // Populate floor select box
          $.each(response, function(index, student) {
            $('#studentId').append('<option value="' + student.id + '">' + student.firstName + " " + student.middleName + " " + student.lastName + '</option>');
          });
        } else {
          $('#studentId').append('<option value="">No students found</option>');
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        alert('Error fetching student. Please check the console for details.');
      }
    });
    // Handle change event for student list dropdown
    $('#studentId').on('change', function() {
      var student_id = $(this).val();
      if (student_id) {
        $.ajax({
          url: '../config/autoFetching1.php?type=image&studentId=' + student_id,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response) {
              // Populate rent in inputs
              const src = "../public/user/";
              $('#profileImage').attr("src", src + response.image);
            } else {
              alert('Rent not found.');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching rent. Please check the console for details.');
          }
        });
      }
    });
  });
</script>