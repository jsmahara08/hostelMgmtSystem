<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
include('../config/DbFunction.php'); 
$obj=new DbFunction();
$rs=$obj->showPurchase();
if(isset($_GET['del'])){
   $obj->deletePurchase(intval($_GET['del']));
}
if (isset($_POST["addVendor"])){
   extract($_POST);
   $obj->addVendor(
        $vendorName,
        $vendorContactPerson,
        $vendorContact,
        $vendorGmail,
        $vendorAddress
    );
}
$vendor = $obj->showVendor();
if (isset($_POST["addPurchase"])) {
    extract($_POST);
    $totalAmount = $quantity * $rate;
    $dueAmount = $totalAmount - $paidAmount;
    if ($totalAmount == $dueAmount) {
        $status = "Unpaid";
    } elseif ($totalAmount == $paidAmount) {
        $status = "Paid";
    } else {
        $status = "Partial Payment";
    }
    $obj->addPurchase(
        $vendor_id,
        $item,
        $billNumber,
        $quantity,
        $unit,
        $rate,
        $totalAmount,
        $paidAmount,
        $dueAmount,
        $purchaseDate,
        $status
    );
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

    #paidAmount {
      padding-left: 50px;
    }

    #paidAmount::placeholder,
    #unit::placeholder {
      padding-left: 50px;
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
                           window.location.href = "purchase.php";
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
                           window.location.href = "purchase.php";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>

                <div class="x_title">
                  <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchase Detail</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="dashboard.php?page=purchase"> <i class="fa fa-list-ol"></i> Purchase List</a>
                    </li>
                    <li class="nav-item">
                      <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" class="dropdown">
                          <a id="drop4" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" style="font-size:15px">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>

                            Add Purchase
                            <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" data-toggle='modal' data-target='.addPurchase'>Add Purchase</a>
                            <a class="dropdown-item" data-toggle='modal' data-target='.addVendor'>Add New Vendor</a>
                          </div>

                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="row">
                    <div class="col-sm-12" id="PurchaseDetails">
                      <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #5a738e">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>Item Name</th>
                              <th>Bill Number</th>
                              <th>Quantity</th>
                              <th>Rate</th>
                              <th>Total Amount</th>
                              <th>Paid Amount</th>
                              <th>Due Amount</th>
                              <th>Purchase Date</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                         $sn=1;
                                     while($res=$rs->fetch_object()){?>
                            <tr class="">
                              <td><?php echo $sn?></td>
                              <td><?php echo htmlentities($res->item);?></td>
                              <td><?php echo htmlentities($res->billNumber);?></td>
                              <td><?php echo htmlentities($res->quantity)." ".htmlentities($res->unit);?></td>
                              <td><?php echo htmlentities($res->rate);?></td>
                              <td><?php echo htmlentities($res->totalAmount);?></td>
                              <td><?php echo htmlentities($res->paidAmount);?></td>
                              <td><?php echo htmlentities($res->dueAmount);?></td>
                              <td><?php echo htmlentities($res->purchaseDate);?></td>
                              <td><?php echo htmlentities($res->status);?></td>
                              <td>&nbsp;&nbsp;<a href="editPurchase.php?p_id=<?php echo htmlentities($res->purchase_id);?>"><button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button></a>
                                <a href="purchaseDetail.php?p_id=<?php echo htmlentities($res->purchase_id); ?>&v_id=<?php echo htmlentities($res->vendor_id); ?>"> <button class="btn btn-success"><i class="fa fa-list"></i> Details</button>
                              </td>

                            </tr>

                            <?php $sn++;}?>
                          </tbody>
                        </table>
                        <!--add purchase modal  -->
                        <div id="myModal" class="modal fade bs-example-modal-lg addPurchase" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <form method="post" id="demo-form" data-parsley-validate>

                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel2">Add Purchase</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body" id="modalContent">
                                  <form class="demo-form" action="" method="post" data-parsley-validate>
                                    <fieldset class="scheduler-border">
                                      <legend class="scheduler-border">Add Purchase</legend>
                                      <form method="post" data-parsley-validate>
                                        <div class="form-group row ">
                                          <label class="control-label col-md-2 col-sm-2 ">Vendor Name<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-6 col-sm-12 ">
                                            <select type="text" id="vendor_id" name="vendor_id" required="required" class="form-control" autocomplete="off">
                                              <option value="" disabled selected>Select Vendor</option>
                                              <?php if ($vendor->num_rows > 0) {
                                           while (
                                               $row = $vendor->fetch_object()
                                           ) { ?>
                                              <option value="<?php echo htmlentities(
                                           $row->vendor_id
                                       ); ?>"><?php echo htmlentities($row->vendorName); ?></option>

                                              <?php }
                                       } else {
                                            ?>
                                              <option value="" disabled>No vendors found</option>

                                              <?php
                                       } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-2 ">Particular's Name<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-6 col-sm-12">
                                            <input type="text" class="form-control" id="item" name="item" required placeholder="Enter particular name">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Bill Number</label>
                                          <div class="col-md-6 col-sm-12">
                                            <input type="number" class="form-control" id="billNumber" name="billNumber" placeholder="Enter bill number">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Quantity<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-4 col-sm-9">
                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required onchange="calculateAmount()">
                                          </div>
                                          <div class="col-md-2 col-sm-3  form-group has-feedback">
                                            <input type="text" class="form-control" id="unit" name="unit" required>
                                            <span class="form-control-feedback right text-secondary" aria-hidden="true">unit<span class="text-danger">*</span> </span>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Rate<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-6 col-sm-12 ">
                                            <input type="number" step="0.01" id="rate" name="rate" class="form-control" autocomplete="off" required placeholder="Enter rate" onchange="calculateAmount()">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Purchase Date<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-6 col-sm-12 ">
                                            <input id="purchaseDate" name="purchaseDate" autocomplete="off" class="date-picker form-control" placeholder="MM-DD-YYYY" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'">

                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Total Amount</label>
                                          <div class="col-md-6 col-sm-12">
                                            <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Paid Amount<span class="required" style="color: red">*</span></label>
                                          <div class="col-md-6 col-sm-12  form-group has-feedback">
                                            <input type="number" step="0.01" class="form-control" id="paidAmount" name="paidAmount" required placeholder="Enter paid amount" onchange="calculateDueAmount()">
                                            <span class="form-control-feedback left text-secondary" aria-hidden="true">Rs<span class="text-danger">*</span> </span>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="control-label col-md-2 col-sm-12 ">Due Amount</label>

                                          <div class="col-md-6 col-sm-12">
                                            <input type="text" class="form-control" id="dueAmount" name="dueAmount" readonly>

                                          </div>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" id="addPurchase" class="btn btn-primary" name="addPurchase">Add
                                </div>
                              </form>
                            </div>

                          </div>
                        </div>
                        <!--add purchase modal end -->

                        <!--add  modal  vendor-->
                        <div id="myModal" class="modal fade bs-example-modal-lg addVendor" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <form method="post" id="demo-form" data-parsley-validate>

                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel2">Add New Vendor</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body" id="modalContent">
                                  <form class="demo-form" action="" method="post" data-parsley-validate>
                                    <fieldset class="scheduler-border">
                                      <legend class="scheduler-border">Add Vendor</legend>
                                      <form method="post" data-parsley-validate>
                                        <div class="form-group row ">
                                          <label class="control-label col-md-2 col-sm-2 ">Vendor Name*</label>
                                          <div class="col-md-4 col-sm-10 ">
                                            <input type="text" id="vendorName" name="vendorName" required="required" class="form-control" autocomplete="off">
                                          </div>
                                          <label class="control-label col-md-2 col-sm-2 ">Contact Person*</label>
                                          <div class="col-md-4 col-sm-10 ">
                                            <input type="text" id="vendorContactPerson" name="vendorContactPerson" class="form-control" autocomplete="off" required>
                                          </div>
                                        </div>
                                        <div class="form-group row ">
                                          <label class="control-label col-md-2 col-sm-2 ">Contact Number*</label>
                                          <div class="col-md-4 col-sm-10 ">
                                            <input type="text" id="vendorContact" name="vendorContact" class="form-control" autocomplete="off" required>
                                          </div>
                                          <label class="control-label col-md-2 col-sm-2 ">Gmail</label>
                                          <div class="col-md-4 col-sm-10 ">
                                            <input type="email" id="vendorGmail" name="vendorGmail" class="form-control" autocomplete="off">
                                          </div>
                                        </div>
                                        <div class="form-group row ">
                                          <label class="control-label col-md-2 col-sm-2 ">Address*</label>
                                          <div class="col-md-4 col-sm-10 ">
                                            <textarea type="text" id="vendorAddress" name="vendorAddress" class="form-control" autocomplete="off" required>
                                 </textarea>
                                          </div>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" id="addVendor" class="btn btn-primary" name="addVendor">Add
                                </div>
                              </form>
                            </div>

                          </div>
                        </div>
                        <!--add vendor modal end -->
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
  function calculateAmount() {
    var quantity = parseFloat(document.getElementById("quantity").value);
    var rate = parseFloat(document.getElementById("rate").value);
    var totalAmount = quantity * rate;
    if (!isNaN(totalAmount)) {
      document.getElementById("totalAmount").value = totalAmount.toFixed(2);
    } else {
      document.getElementById("totalAmount").value = "";
    }
    calculateDueAmount(); // Call calculateDueAmount after calculating amount
  }

  function calculateDueAmount() {
    var totalAmount = parseFloat(document.getElementById("totalAmount").value);
    var paidAmount = parseFloat(document.getElementById("paidAmount").value);
    var dueAmount = totalAmount - paidAmount;
    if (!isNaN(dueAmount)) {
      document.getElementById("dueAmount").value = dueAmount.toFixed(2);
    } else {
      document.getElementById("dueAmount").value = "";
    }
  }
</script>