<?php 
session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
}
if (!isset($_GET['p_id']) || $_GET['p_id'] === "") {
   header('Location: purchase.php');
   exit; // It's a good practice to exit after a header redirect
}
include('../config/DbFunction.php');
$obj=new DbFunction(); 
$v_list=$obj->showVendor();
$pId=$_REQUEST['p_id'];
$rs=$obj->showPurchase1($pId);
$res=$rs->fetch_object();
if(isset($_POST['updatePurchase'])){
   extract($_POST);
   $totalAmount=$quantity*$rate;
   $dueAmount=$totalAmount-$paidAmount;
   if($totalAmount==$dueAmount){
      $status="Unpaid";
   }
   else if($totalAmount==$paidAmount){
      $status="Paid";
   }
   else{
      $status="Partial Payment";
   }
   $obj->editPurchase($vendor_id, $item,$billNumber, $quantity, $unit, $rate, $totalAmount, $paidAmount, $dueAmount, $purchaseDate, $status, $pId);
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

    #paidAmount {
      padding-left: 50px;
    }

    #paidAmount::placeholder,
    #unit::placeholder {
      text-align: center;
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
          <div class="row" style="max-height: 1096px">

            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-shopping-cart"></i> Update Purchase</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
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
                </div>
                <div class="x_content">
                  <form class="demo-form" method="post" data-parsley-validate>
                    <div class="form-group row ">
                      <label class="control-label col-md-2 col-sm-12 ">Vendor Name<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12 ">
                        <select type="text" id="vendor_id" name="vendor_id" required="required" class="form-control" autocomplete="off">
                          <option value="" disabled selected>Select Vendor</option>
                          <?php 
                                      $purchase_vendor_id=$res->vendor_id;

                                      if ($v_list->num_rows > 0) {
                                     while($vendors=$v_list->fetch_object()){ 
                                       $selected = (htmlentities($vendors->vendor_id) == $purchase_vendor_id) ? "selected" : "";
                                       echo "<option value='".htmlentities($vendors->vendor_id)  . "' $selected>" . htmlentities($vendors->vendorName) . "</option>";
                                      }

                                  }else{
                                
                                 echo "<option value=''>No vendors found</option>";

                                 } ?>

                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Particular's Name<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $res->item;?>" id="item" name="item" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Bill Number<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12">
                        <input type="number" class="form-control" value="<?php echo $res->billNumber;?>" id="billNumber" name="billNumber">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-2 ">Quantity<span class="required" style="color: red">*</span></label>
                      <div class="col-md-3 col-sm-9">
                        <input type="number" class="form-control" value="<?php echo $res->quantity;?>" id="quantity" name="quantity" placeholder="Enter Quantity*" required onchange="calculateAmount()">
                      </div>
                      <div class="col-md-2 col-sm-3  form-group has-feedback">
                        <input type="text" class="form-control" value="<?php echo $res->unit;?>" id="unit" name="unit" required>
                        <span class="form-control-feedback right text-secondary" aria-hidden="true">unit<span class="text-danger">*</span> </span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Rate<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12 ">
                        <input type="number" step="0.01" value="<?php echo $res->rate;?>" id="rate" name="rate" class="form-control" autocomplete="off" required onchange="calculateAmount()">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Purchase Date<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12 ">
                        <input value="<?php echo $res->purchaseDate;?>" id="purchaseDate" name="purchaseDate" autocomplete="off" class="date-picker form-control" placeholder="Purchase Date*" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'">

                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Total Amount</label>
                      <div class="col-md-5 col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $res->totalAmount;?>" id="totalAmount" name="totalAmount" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-2 ">Paid Amount<span class="required" style="color: red">*</span></label>
                      <div class="col-md-5 col-sm-12  form-group has-feedback">
                        <input type="number" step="0.01" class="form-control" value="<?php echo $res->paidAmount;?>" id="paidAmount" name="paidAmount" required placeholder="Paid Amount*" onchange="calculateDueAmount()">
                        <span class="form-control-feedback left text-secondary" aria-hidden="true">Rs<span class="text-danger">*</span> </span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-12 ">Due Amount</label>
                      <div class="col-md-5 col-sm-8">
                        <input type="text" class="form-control" value="<?php echo $res->dueAmount;?>" id="dueAmount" name="dueAmount" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-5 col-sm-12 text-right">
                        <button class="btn btn-primary" type="submit" name="updatePurchase" style="text-align: right;">Update</button>
                      </div>
                    </div>
                  </form>

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