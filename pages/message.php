<?php 
   session_start();
   if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
     header('location:../index.php');
   }
   date_default_timezone_set('Asia/Kathmandu');
      include('../config/DbFunction.php'); 
      $obj=new DbFunction();
      $totalUser=$obj->countUser();
      $totalUsers=$totalUser->fetch_object();
      $purchase=$obj->countPurchaseAmount();
      $amount=$purchase->fetch_object();
      $payment= $obj->userPayment();
      $payments=$payment->fetch_object();
      $unpaid=$obj->showUnpaidStatus1();
      $purchase=$obj->showPurchaseDashboard();
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
         .icon {
         margin-top: 15px;
         }
         .profile_thumb {
         position: relative;
         padding: 0;
         border: none;
         }
         .profile_thumb img {
         position: absolute;
         height: 50px;
         width: 50px;
         border-radius: 50%;
         top: 0;
         left: 0;
         border: solid 2px var(--primary);
         transition: ease all 0.5s;
         }
         .tile-stats{
         padding:12px ;
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
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12">
                        <div class="tile-stats">
                           <div class="col-md-4 col-sm-12  form-group has-feedback" style="float: right;">
                              <input type="text" class="form-control rounded" id="searchInput" onkeyup="filterCards()" placeholder="search by name">
                              <span class="form-control-feedback right text-primary" aria-hidden="true"><i class="fa fa-search"></i></span>
                           </div>
                        </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 ">
                        <div class="container-fluid" style="overflow-x: auto;">
                           <div class="tile-stats">
                              <div class="row">
                                 <div class="col-md-8">
                                    <div class="x_panel">
                                       <div class="x_title">
                                          <h2>Send SMS</h2>
                                          <div class="clearfix"></div>
                                       </div>
                                       <div class="x_content">
                                          main
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="x_panel">
                                       <div class="x_title">
                                          <h2>Contact</h2>
                                          <p class="text-danger" style="float:right"><small><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> The rent hasn't been paid yet. Send messages on their parent's phone.</small></p>
                                          <div class="clearfix"></div>
                                       </div>
                                       <div id="responseMessage"></div>
                                       <br/>
                                       <button class="btn btn-primary" type="submit" id="sendMessageBtn" style="display: none;">Send Message</button>
                                       <div class="x_content">
                                          <div class="card-box table-responsive">
                                             <table id="datatable-buttons" class="table table-striped  dt-responsive nowrap" cellspacing="0" width="100%"
                                                style="color: #5a738e">
                                                <thead>
                                                   <tr>
                                                      <th><input id="selectAll" type="checkbox" name="" class="form-control-sm"></th>
                                                      <th>Profile</th>
                                                      <th>Name</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php while($statusUnpaid = $unpaid->fetch_object()) {  ?>
                                                   <tr class="profile-row">
                                                      <td><input type="checkbox" name="" class="form-control-sm"></td>
                                                      <td><img src="../public/user/<?php echo $statusUnpaid->image; ?>" alt="profile" height="60px"
                                                         width="50px"></td>
                                                      <td>
                                                         <?php echo strtoupper($statusUnpaid->fullName); ?>
                                                         <p class="phone" style="display:none"><?php echo strtoupper($statusUnpaid->guardianPhone); ?></p>
                                                         <p class="studentName"
                                                            style="display:none"><?php echo strtoupper($statusUnpaid->fullName); ?></p>
                                                         <p class="guardianName"
                                                            style="display:none"><?php echo strtoupper($statusUnpaid->guardianName); ?></p>
                                                         <p class="dueAmount" style="display:none"><?php echo strtoupper($statusUnpaid->total_due); ?></p>
                                                         <p class="monthsYears"
                                                            style="display:none"><?php echo strtoupper($statusUnpaid->months_years); ?></p>
                                                      </td>
                                                   </tr>
                                                   <?php } ?>
                                                </tbody>
                                             </table>
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
         </div>
         <!-- /page content -->
         <!-- ===================FOOTER START=============== -->
         <?php include 'include/footer.php'; ?>
         <!-- ===================FOOTER END================= -->
      </div>
      </div>
      <!-- compose -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="static" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="exampleModalLongTitle">Sent Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-danger">&times;</span>
                  </button>
               </div>
               <div class="modal-body" style="overflow-y: auto;">
                  ...
               </div>
               <div class="modal-footer">
                  <div class="input-group">
                     <textarea class="form-control" aria-label="With textarea" placeholder="type Message..."></textarea>
                     <div class="input-group-prepend">
                        <span class="input-group-text bg-white"><button class="btn btn-success" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Sent
                        </button></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /compose -->
   </body>
</html>
<script>
        function filterCards() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("datatable-buttons");
            tr = table.getElementsByClassName("profile-row");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2]; // Assuming name is in the third column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
 
<script>
   $(document).ready(function() {
       // Event listener for Select All checkbox
       $('#selectAll').on('change', function() {
           if ($(this).is(':checked')) {
               $('tbody input[type="checkbox"]').prop('checked', true);
               $('#sendMessageBtn').show();
           } else {
               $('tbody input[type="checkbox"]').prop('checked', false);
               $('#sendMessageBtn').hide();
           }
       });
   
       // Event listener for individual checkboxes
       $('tbody input[type="checkbox"]').on('change', function() {
           var allChecked = true;
           $('tbody input[type="checkbox"]').each(function() {
               if (!$(this).is(':checked')) {
                   allChecked = false;
               }
           });
           if (allChecked) {
               $('#selectAll').prop('checked', true);
           } else {
               $('#selectAll').prop('checked', false);
           }
   
           if ($('tbody input[type="checkbox"]:checked').length > 0) {
               $('#sendMessageBtn').show();
           } else {
               $('#sendMessageBtn').hide();
           }
       });
   
       // Event listener for Send Message button click
       $('#sendMessageBtn').on('click', function() {
           var phones = [];
           var messages = [];
   
           $('tbody input[type="checkbox"]:checked').each(function() {
               var row = $(this).closest('tr');
               var phone = row.find('.phone').text().trim();
               var studentName = row.find('.studentName').text().trim();
               var dueAmount = row.find('.dueAmount').text().trim();
               var monthsYears = row.find('.monthsYears').text().trim();
   
               phones.push(phone);
   
               // Format the message for each recipient
               var message = "आदरणिय अभिभावक!! तपाईको बाबु/नानी " + studentName + " को आजसम्मको तिर्नुपर्ने रकम (रु) " + dueAmount + " बाँकि छ। कृपया समयमै भुक्तानी गरिदिनहुन अनुरोध गर्दछौ। \n धन्यबाद।। \n TRIMURTI BOYS HOSTEL";
               messages.push(message);
           });
          console.log(phones);
          console.log(messages);
// Construct the URL parameters
// Construct the URL parameters
var params = {
  phones: JSON.stringify(phones),
  messages: JSON.stringify(messages)
};

// Make an AJAX GET request using jQuery
$.ajax({
  url: '../config/send_sms.php',
  type: 'GET',
  data: params,
  success: function(responseData) {
    // Check if responseData indicates success
    if (responseData.success === true) {
      // Display a success alert
      alert("Message sent successfully!");
    } else {
      // Display an error alert if responseData indicates failure
      alert("Failed to send message: " + responseData.error);
    }
  },
  error: function(xhr, status, error) {
    // Error message
    console.error('Request failed with status:', status);
    console.error('Response Text:', xhr.responseText); // Log the response text for debugging
  }
});

       });
   });
</script>
