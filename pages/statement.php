<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
include('../config/DbFunction.php'); 
$obj=new DbFunction();
$rs=$obj->showPayment();
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
                  <h2><i class="fa fa-file" aria-hidden="true"></i> Statement</h2>
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
                           window.location.href = "statement.php";
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
                           window.location.href = "statement.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>
                <div class="x_content">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="?page=statement"> <i class="fa fa-list-ol"></i> All Statement</a>
                    </li>
                    <!-- <li class="nav-item">
                        <button class="nav-link btn btn-primary " data-toggle='modal' data-target='.addRoom' > <i class="fa fa-plus"></i> Add Room</button>
                     </li> -->
                  </ul>
                  <div class="row">
                    <div class="col-sm-12" id="HostailerDetail">
                      <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #5a738e">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Year/Month</th>
                              <th>Rent</th>
                              <th>Extra Charge</th>
                              <th>Remarks</th>
                              <th>Paid Amount</th>
                              <th>Due Amount</th>
                              <th>Status</th>
                              <th>Payed Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                         $sn=1;
                                     while($res=$rs->fetch_object()){?>
                            <tr class="">
                              <td><?php echo $sn?></td>
                              <td> <img width="40px" height="40px" src="../public/user/<?php echo htmlentities( strtoupper($res->image));?>"> </td>
                              <td><?php echo htmlentities(strtoupper($res->fullName));?></td>
                              <td><?php echo htmlentities($res->year."/".$res->month);?></td>
                              <td><?php echo htmlentities($res->rent);?></td>
                              <td><?php echo htmlentities($res->additionalCharge);?></td>
                              <td><?php echo htmlentities($res->remarks);?></td>
                              <td><?php echo htmlentities($res->paidAmount);?></td>
                              <td><?php echo htmlentities($res->dueAmount);?>
                              <td><?php echo htmlentities($res->status);?>
                              <td><?php echo htmlentities($res->paymentDate);?></td>
                              </td>
                              </td>
                              <td>&nbsp;&nbsp;<a href="dashboard.php?page=statement&pdf_id=<?php echo htmlentities($res->id);?>"><button class="btn btn-info"><i class="fa fa-edit"></i> Generate Pdf</button></a>

                              </td>

                            </tr>

                            <?php $sn++;}?>
                          </tbody>
                        </table>
                        <!--add room modal  -->
                        <div id="myModal" class="modal fade bs-example-modal-lg addRoom" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <form method="post" id="demo-form" data-parsley-validate>

                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel2">Add Room</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body" id="modalContent">
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
                                      <input type="number" id="roomNumber" class="form-control" name="roomNumber" required autocomplete="off" />
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
                                      <input type="number" id="bedPerRoom" class="form-control" name="bedPerRoom" required autocomplete="off" />
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
                                      <input type="number" id="rentPerBed" class="form-control" name="rentPerBed" required autocomplete="off" />
                                    </div>
                                    <div class="col-md-5 col-sm-12 ">
                                      <label for="rentPerBedSuggestion"><span style="color:red">*</span>The rent amount should be a positive number and within a certain range. Additionally, consider any specific rules or criteria for setting the rent amount, such as currency format or minimum/maximum limits.</label>
                                    </div>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" id="addRoom" class="btn btn-primary" name="addRoom">Add
                                </div>
                              </form>
                            </div>

                          </div>
                        </div>
                        <!-- modal end -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ===================FOOTER START=============== -->
      <?php include 'include/footer.php'; ?>
      <!-- ===================FOOTER END================= -->
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