<?php 
@session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
 }
 include_once '../config/DbFunction.php';
 $obj=new DbFunction(); 
 if(isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
 $userId=$_SESSION['user_id'];
 $user=$obj->showAdmin($userId);
 $row=$user->fetch_object();
 }
 ?>
 <style>
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
 </style>
       <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;background: #ddd;">
            <a href="dashboard.php" class="site_title">
              <img src="../public/logo.png" width="50px">
              <small style="color:black">Trimurti Boys Hostel</small>
            </a>
          </div>
          <div class="clearfix"></div>
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
              </ul>
            </div>
            <div class="menu_section">
              <h3>Manage</h3>
              <ul class="nav side-menu">
                <li>
                  <a><i class="fa fa-user-secret" aria-hidden="true"></i>
                    Student
                    <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="user.php">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        View Student
                      </a>
                    </li>
                    <li><a href="addUser.php">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Add Student
                      </a>
                    </li>
                  </ul>
                </li>
                <li><a href="room.php"><i class="fa fa-bed" aria-hidden="true"></i>Room</a></li>
                <li><a href="payment.php"><i class="fa fa-money" aria-hidden="true"></i>Payment</a></li>
                <li><a href="message.php"><i class="fa fa-comment" aria-hidden="true"></i>Message</a></li>
                <li><a href="statement.php"><i class="fa fa-file" aria-hidden="true"></i> Statement</a></li>
                <li><a href="purchase.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Purchase</a></li>
              </ul>
            </div>
            <div class="menu_section">
              <h3>Setting</h3>
              <ul class="nav side-menu">
                <li>
                  <a href="dashboard.php?page=setting"><i class="fa fa-wrench" aria-hidden="true"></i>
                    General Setting
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>
      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="../public/user/<?php echo$row->image?>" alt=""><?php echo $_SESSION['username'] ?>
                </a>

                <!-- loader -->
                <div class="loader" id="loader"></div>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"><?php echo $row->name ;?></a>
                  <a class="dropdown-item" href="adminProfile.php"> Profile</a>
                  <a class="dropdown-item" href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      