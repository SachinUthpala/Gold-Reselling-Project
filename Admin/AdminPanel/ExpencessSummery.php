<?php

require_once '../DbActions/Db.conn.php';
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Colombo");

if(!$_SESSION['UserName'] && !$_SESSION['UserId']){
  header('Location: ../index.html');
  exit();
}

$userId = (int)$_SESSION['UserId'];

$stmt = $conn->prepare("SELECT * FROM `total_expencess` WHERE userID = ?");
$stmt->bind_param("i", $userId);

$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

$n = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Swarna Sahana</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo $_SESSION['userImage']; ?>" class="user-img-radious-style">
              <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $_SESSION['UserName']; ?></div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile</a>
              <a href="#" class="dropdown-item has-icon"><i class="fas fa-cog"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a href="../DbActions/logOut/logout.php" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="admin.php"> <span class="logo-name">Swarna Sahana</spanclass=>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="admin.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown"
            <?php
                  if($_SESSION['AdminAccess'] == 2) {
                    echo 'style="display:none;"';
                  }
                ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"
                    <?php
                  if($_SESSION['AdminAccess'] == 2) {
                    echo 'style="display:none;"';
                  }
                ?>
                  ></i><span>My Tasks</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./MyAllTask.php">All Tasks</a></li>
                <li><a class="nav-link" href="./myCompletedTasks.php">Completed Tasks</a></li>
                <li><a class="nav-link" href="./myOngoing.php">On Going Task</a></li>
              </ul>
            </li>
            <li class="dropdown"
            <?php
                  if($_SESSION['AdminAccess'] == 2) {
                    echo 'style="display:none;"';
                  }
                ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Expences</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./CreateExpencess.php">Your Expences</a></li>
              </ul>
            </li>
            
            <li class="menu-header"
            <?php
                if( $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >Task Functions</li>
            <li class="dropdown"
            <?php
                if( $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"
                
              ><i data-feather="copy"></i><span>Main Functions</span></a>
              <ul class="dropdown-menu"
              <?php
                if( $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
              >
                <li><a class="nav-link" href="./createTask.php">Create Task</a></li>
                <li><a class="nav-link" href="./UpdateTask.php">Update Task</a></li>
                <li><a class="nav-link" href="./deleteTask.php">Delete Task</a></li>
              </ul>
            </li>

            <li class="dropdown"
            <?php
                if( $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>All Tasks</span></a>
              <ul class="dropdown-menu"
             
              <?php
                if( $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
              
              >
                <li><a class="nav-link" href="./AllTasks.php">All Tasks</a></li>
                <li><a class="nav-link" href="./allOngoingTask.php">On Going Task</a></li>
                <li><a class="nav-link" href="./allCompletedTask.php">Completed Tasks</a></li>
              </ul>
            </li>

            <li class="menu-header"
            <?php
                if($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >User Functions</li>
            <li class="dropdown"
            <?php
                if($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Main Functions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./createUser.php">Create User</a></li>
                <li><a class="nav-link" href="badge.html">Update User</a></li>
                <li><a class="nav-link" href="./DeleteUser.php">Delete User</a></li>
              </ul>
            </li>

            <li class="dropdown"
            <?php
                if($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"
             
              ><i data-feather="copy"></i><span> All Users</span></a>
              <ul class="dropdown-menu"
             
              >
                <li><a class="nav-link" href="./allUsers.php">All Users</a></li>
                <li><a class="nav-link" href="./adminUsers.php">Admin Users</a></li>
                <li><a class="nav-link" href="./nonAdminUsers.php">Non Admin Users</a></li>
              </ul>
            </li>

            <li class="dropdown"
            <?php
                if($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
              ?>
            >
              <a href="#" class="menu-toggle nav-link has-dropdown"
             
              ><i data-feather="copy"></i><span> All Expencess</span></a>
              <ul class="dropdown-menu"
             
              >
                <li><a class="nav-link" href="./ExpencessSummery.php">Expencess Summery</a></li>
              </ul>
            </li>

            
            
            
          
            
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <!-- Date & Time Cards -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Date</h5>
                          <h2 class="mb-3 font-18"><?php echo date('Y-m-d'); ?></h2>
                          <p class="mb-0"><span class="col-green">Have a good Day</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Time</h5>
                          <h2 class="mb-3 font-18"><?php echo date('H:i:s'); ?></h2>
                        </div>
                      </div>
                      <div class="col-lg-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Expenses Table -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Expenses Table</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>
                        <tr>
                          <th>TID</th>
                          <th>User Id</th>
                          <th>User Name</th>
                          <th>Total Expenses</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($rows = $result->fetch_assoc()) { ?>
                          <tr>
                            <td><?php echo $rows['tID']; ?></td>
                            <td><?php echo $rows['userID']; ?></td>
                            <td><?php echo $rows['userName']; ?></td>
                            <td><?php echo "Rs ." .$rows['amount']."00"; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/js/page/datatables.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>
