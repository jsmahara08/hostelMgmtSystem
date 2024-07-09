<?php
session_start();
if (!isset($_SESSION["username"]) && !isset($_SESSION["user_id"])) {
    header('location:../index.php');
}
if (!isset($_GET['v_id']) || $_GET['v_id'] === "") {
   header('Location:purchase.php');
   exit; // It's a good practice to exit after a header redirect
}
include('../config/DbFunction.php');
$obj=new DbFunction();
if (isset($_REQUEST["p_id"]) ? $_REQUEST["p_id"] : "") {
    $purchaseId = $_REQUEST["p_id"];
    $rs = $obj->showPurchase1($purchaseId);
    $res = $rs->fetch_object();
}
if (isset($_REQUEST["v_id"]) ? $_REQUEST["v_id"] : "") {
    $vendorId = $_REQUEST["v_id"];
    $rs1 = $obj->showPurchaseWithVendor($vendorId);
    $data = [];
    while ($row = $rs1->fetch_object()) {
        $data[] = $row;
    }
    $jsonData = json_encode($data);
}

if (isset($_POST["payNow"])) {
    extract($_POST);
    $vendorId = $_REQUEST["v_id"];
    $purchaseId = $_REQUEST["p_id"];
    $paymentDate=date('Y-m-d');
    if ($dueAmount == $amount) {
        $status = "Paid";
    } else {
        $status = "Partial Payment";
    }
    $obj->payPurchaseDueAmount(
        $amount,
        $status,
        $payId,
        $vendorId,
        $purchaseId,
        $paymentDate
    );
    // Make sure to exit after the header redirect to prevent further execution
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
                  <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchase Details</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                 <?php
              // success message 
              if(isset($_SESSION['success'])){
                  echo '<script>';
                  echo 'swal({
                      title: "Success!",
                      text: "' . $_SESSION['success'] . '",
                      icon: "success",
                      button: "Ok",
                      }).then(function() {
                      window.location.href = "purchaseDetail.php?p_id=' . $purchaseId . '&v_id=' . $vendorId . '";
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
                           window.location.href = "purchaseDetail.php?p_id=' . $purchaseId . '&v_id=' . $vendorId . '";
                         });';
                         echo '</script>';
                         unset($_SESSION['error']);
                     }
                      ?>
                </div>

                <div class="x_content">
                  <div class="col-md-3 col-sm-3  profile_left">
                    <h4><u>Vendor's info</u></h4>
                    <h4><i class="fa fa-university"> <?php echo strtoupper(
                          $res->vendorName
                      ); ?></i></h4>

                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo strtolower(
                            $res->vendorAddress
                        ); ?>
                      </li>

                      <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="mailto:<?php echo $res->vendorGmail; ?>" target="_blank"><?php echo $res->vendorGmail; ?></a>
                      </li>
                      <li class="m-top-xs">
                        <i class="fa fa-phone user-profile-icon"></i>
                        <a href="tel:<?php echo $res->vendorContact; ?>" target="_blank"><?php echo $res->vendorContact; ?></a>
                      </li>
                    </ul>

                    <a href="purchase.php" class="btn btn-primary text-white">All Purchase List</a>

                  </div>
                  <div class="col-md-9 col-sm-9 ">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Purchase Details</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">All Purchase</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                          <table width="50%">
                            <tr>
                              <th>Particular</th>
                              <td><?php echo htmlentities($res->item); ?></td>
                            </tr>
                            <tr>
                              <th>Bill Number</th>
                              <td><?php echo htmlentities(
                                $res->billNumber
                            ); ?></td>
                            </tr>
                            <tr>
                              <th>Quantity</th>
                              <td><?php echo htmlentities($res->quantity) .
                                " " .
                                htmlentities($res->unit); ?></td>
                            </tr>
                            <tr>
                              <th>Rate</th>
                              <td><?php echo htmlentities($res->rate); ?></td>
                            </tr>
                            <tr>
                              <th>Total Amount</th>
                              <td><?php echo htmlentities(
                                $res->totalAmount
                            ); ?></td>
                            </tr>
                            <tr>
                              <th>Paid Amount</th>
                              <td><?php echo htmlentities(
                                $res->paidAmount
                            ); ?></td>
                            </tr>
                            <tr>
                              <th>Due Amount</th>
                              <td><?php echo htmlentities(
                                $res->dueAmount
                            ); ?></td>
                            </tr>
                            <tr>
                              <th>Status</th>
                              <?php if ($res->status == "Paid") {
                                echo "<td style='background:green;color:White' class='text-center'>$res->status</td>";
                            } elseif ($res->status == "Unpaid") {
                                echo "<td style='background:red;color:yellow' class='text-center'>$res->status</td>
                               ";
                            } elseif ($res->status == "Partial Payment") {
                                echo "<td style='background:yellow;color:#883f3f' class='text-center'>$res->status</td>
                               ";
                            } ?>

                            </tr>
                            <tr>
                              <th>Purchase Date</th>
                              <td><?php echo htmlentities(
                                $res->purchaseDate
                            ); ?></td>
                            </tr>
                            <?php 
                           if($res->paymentDate!=""){
                            ?>
                            <tr>
                              <th>Last Paid Date</th>
                              <td><?php echo htmlentities(
                                $res->paymentDate
                            ); ?></td>
                            </tr>
                            <?php } ?>

                          </table>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #5a738e">
                              <thead>
                                <tr>
                                  <th>SN</th>
                                  <th>Particular</th>
                                  <th>BillNumber</th>
                                  <th>Quantity</th>
                                  <th>Rate</th>
                                  <th>TotalAmount</th>
                                  <th>PaidAmount</th>
                                  <th>DueAmount</th>
                                  <th>PurchaseDate</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                 $sn = 1;
                                 foreach ($data as $res1) { ?>
                                <tr class="">
                                  <td><?php echo $sn; ?></td>
                                  <td><?php echo htmlentities(
                                                strtoupper($res1->item)
                                            ); ?></td>
                                  <td><?php echo htmlentities(
                                                strtoupper($res1->billNumber)
                                            ); ?></td>
                                  <td><?php echo htmlentities(
                                                strtoupper($res1->quantity)
                                            ) .
                                                " " .
                                                htmlentities(
                                                    strtoupper($res1->unit)
                                                ); ?></td>
                                  <td><?php echo htmlentities(
                                                $res1->rate
                                            ); ?></td>
                                  <td><?php echo htmlentities(
                                                $res1->totalAmount
                                            ); ?></td>
                                  <td><?php echo htmlentities(
                                                $res1->paidAmount
                                            ); ?></td>
                                  <td><?php echo htmlentities(
                                                 $res1->dueAmount
                                             ); ?></td>
                                  <td><?php echo htmlentities(
                                                 $res1->purchaseDate
                                             ); ?></td>

                                  <?php if (
                                                 $res1->status == "Paid"
                                             ) {
                                                 echo "<td style='background:green;color:White'>$res1->status</td>
                                        <td><button class='btn btn btn-primary' disabled>Pay</button></td>";
                                             } elseif (
                                                 $res1->status == "Unpaid"
                                             ) {
                                                 echo "<td style='background:red;color:yellow'>$res1->status</td>
                               <td><button class='btn btn btn-primary showModalBtn' data-toggle='modal' data-target='.bs-example-modal-sm' data-row-id='$res1->purchase_id'>Pay</button></td>
                               ";
                                             } else {
                               echo "<td style='background:yellow;color:#883f3f'>$res1->status</td>
                               <td><button class='btn btn btn-primary showModalBtn' data-toggle='modal' data-target='.bs-example-modal-sm' data-row-id='$res1->purchase_id'>Pay</button></td>
                                
                               ";
                                             } ?>

                                </tr>

                                <?php $sn++;}
                                 ?>
                              </tbody>
                            </table>

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
                                    <form method="post">
                                      <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Purchase Id</label>
                                        <div class="col-md-6 col-sm-9">
                                          <input type="text" id="payId" name="payId" required="required" class="form-control" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Due Ammount</label>
                                        <div class="col-md-6 col-sm-9">
                                          <input type="text" id="dueAmount" name="dueAmount" required="required" class="form-control" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Amount(Rs)</label>
                                        <div class="col-md-6 col-sm-9 ">
                                          <input type="number" id="amount" name="amount" class="form-control" autocomplete="off" required="required">
                                        </div>

                                      </div>

                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="  payNow">Pay</button>
                                  </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                            <!-- modle end -->
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
      </div>
      <!-- /page content -->
      <!-- ===================FOOTER START=============== -->
      <?php include "include/footer.php"; ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Handle click event for "Show Details" button
    $('.showModalBtn').click(function() {
      var rowId = $(this).data('row-id'); // Get the row ID associated with the button
      var jsonData = <?php echo $jsonData; ?> ; // Get all data from PHP
      console.log(jsonData);
      const item = jsonData.find(item => item.purchase_id == rowId);
      // console.log(item.purchase_id);
      document.getElementById("payId").value = item.purchase_id;
      document.getElementById("dueAmount").value = item.dueAmount;
      document.getElementById("amount").value = item.dueAmount;
    });
  });
</script>