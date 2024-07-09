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
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 ">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?php echo $totalUsers->total_users; ?></div>
                <h5>Total Students</h5>
                <p id="clock" class="text-info"></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 ">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-cart-plus"></i></div>
                <div class="count"><?php echo $amount->total_purchase; ?></div>
                <h5>Total Purchase Amount</h5>
                <p>Amount Paid: <strong class="text-danger"><i class="fa fa-arrow-down"></i><?php echo $amount->total_paid ?><br /></strong> Unpaid Balance: <strong class="text-warning"><i class="fa fa-arrows-h"></i><?php echo $amount->total_due?></strong></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 ">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-cart-arrow-down"></i></div>
                <div class="count"><?php echo $payments->total_rent ?></div>
                <h5>Total Room Rent</h5>
                <p>Rental Payment:<strong class="text-success"><i class="fa fa-arrow-up"></i><?php echo $payments->total_paid  ?></strong><br />Due Amount:<strong class="text-warning"><i class="fa fa-arrows-h"></i><?php echo $payments->total_due  ?></strong></p>
              </div>
            </div>
          </div>
      <div id="responseMessage"></div>
          <div class="row">
            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2 class="">Unpaid Profile</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- Search input field -->
<input type="text" class="form-control" id="searchInput" placeholder="Search by name or month">
<br>
                  <!-- List of profiles -->
<ul class="list-unstyled top_profiles scroll-view" id="profileList">
    <!-- Profile items -->
    <?php while($statusUnpaid = $unpaid->fetch_object()) { ?>
    <li class="media event" data-name="<?php echo strtolower($statusUnpaid->fullName); ?>" data-month="<?php echo strtolower($statusUnpaid->months_years); ?>">
        <a class="pull-left border-aero profile_thumb" href="dashboard.php?page=userProfile&user_id=<?php echo $statusUnpaid->user_id; ?>">
            <img src="../public/user/<?php echo $statusUnpaid->image; ?>" alt="student">
        </a>
        <div class="media-body">
            <a class="title" href="dashboard.php?page=userProfile&user_id=<?php echo $statusUnpaid->user_id; ?>"><?php echo $statusUnpaid->fullName; ?></a>
            <p><strong>Rs<?php echo $statusUnpaid->total_due; ?> </strong><?php echo $statusUnpaid->months_years; ?></p>
            <p><small class="bg-warning text-white"><?php echo $statusUnpaid->status; ?></small></p>
            <a href="./message.php"><button type="submit" class="btn text-success float-right compose-btn"><i class="fa fa-comment" aria-hidden="true"></i></button></a>
        </div>
    </li>
<?php } ?>

</ul>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Purchase History</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php while($purchases=$purchase->fetch_object()){ ?>
                  <article class="media event">
                    <a class="pull-left date bg-success">
                      <p class="month"><?php echo $purchases->pmonth ?></p>
                      <p class="day"><?php echo $purchases->pdate ?></p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#"><?php echo $purchases->vendorName ?></a>
                      <p><strong>Amount: <?php echo $purchases->totalAmountSum." Due Amount: ".$purchases->dueAmountSum ?></strong></p>
                      <i>Bill Number: <?php echo $purchases->billNumber?></i>
                      <p><?php echo $purchases->paymentDate?>
                        <?php 
                        if($purchases->status=="Paid"){
                          echo " <small class='bg-success text-white'>$purchases->status</small></p>";
                          }
                          else if($purchases->status=="Unpaid"){
                          echo " <small class='bg-danger text-white'>$purchases->status</small></p>";
                          }
                          else{
                            echo " <small class='bg-warning text-white'>$purchases->status</small>";
                          }

                         ?>
                      </p>

                    </div>
                  </article>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Top Profiles <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                      </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">April</p>
                      <p class="day">23</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Item One Title</a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">April</p>
                      <p class="day">23</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Item Two Title</a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">April</p>
                      <p class="day">23</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Item Two Title</a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">April</p>
                      <p class="day">23</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Item Two Title</a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">April</p>
                      <p class="day">23</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Item Three Title</a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </article>
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
<script>
  // JavaScript to show loader while page content is loading
  window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    // Hide loader with a slight delay
    setTimeout(function() {
      loader.style.display = 'none';
    }, 1000); // 50 milliseconds delay
  });
</script>
<script>
  // Function to update the clock
  function updateClock() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var meridiem = "AM"; // Default to AM
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var day = days[currentTime.getDay()];
    var month = months[currentTime.getMonth()];
    var date = currentTime.getDate();
    var year = currentTime.getFullYear();
    // Convert from 24-hour to 12-hour format
    if (hours > 12) {
      hours = hours - 12;
      meridiem = "PM";
    }
    // Pad single digit minutes and seconds with leading zeros
    minutes = (minutes < 10 ? "0" : "") + minutes;
    seconds = (seconds < 10 ? "0" : "") + seconds;
    // Get the current time string
    var currentTimeString = hours + ":" + minutes + ":" + seconds + " " + meridiem;
    // Update the clock element
    document.getElementById('clock').innerHTML = day + ', ' + month + ' ' + date + ', ' + year + '<br/>' + currentTimeString;
  }
  // Call updateClock function every second
  setInterval(updateClock, 1000);
  // Initial call to update clock immediately
  updateClock();


  // Get the search input field
    const searchInput = document.getElementById('searchInput');

    // Get the list of profiles
    const profileList = document.getElementById('profileList');

    // Attach event listener to the search input field
    searchInput.addEventListener('input', filterProfiles);

    // Function to filter profiles based on search criteria
    function filterProfiles() {
        // Get the search query
        const query = searchInput.value.toLowerCase().trim();

        // Filter the list of profiles
        Array.from(profileList.children).forEach(function(profile) {
            const name = profile.dataset.name;
            const month = profile.dataset.month;

            // Check if the search query matches the name or month
            const match = name.includes(query) || month.includes(query);

            // Show or hide the profile based on the search query
            if (match) {
                profile.style.display = 'block';
            } else {
                profile.style.display = 'none';
            }
        });
    }

// +++++++++++=send sms=++++++++++++++// 

$(document).ready(function() {
    // When the form is submitted
    $('.smsForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        
          
        // Get form data
        var guardianPhone = $(this).find('input[name="guardianPhone"]').val();
        var guardianName = $(this).find('input[name="guardianName"]').val();
        var fullName = $(this).find('input[name="studentName"]').val();
        var message="hello demo msg from trimurti hostel.com";

        // Send AJAX request to send_sms.php
        $.ajax({
            type: 'POST',
            url: '../config/send_sms.php',
            data: {
                phone: guardianPhone,
                message: message
            },
            dataType: 'json',
            success: function(response) {
                // Display success message
                $('#responseMessage').html('<div class="success">' + response.message + '</div>');
            },
            error: function(xhr, status, error) {
                // Display error message
                $('#responseMessage').html('<div class="error">Failed to send SMS. Please try again later.</div>');
                console.error(xhr.responseText);
            }
        });

 
    });
});


</script>
