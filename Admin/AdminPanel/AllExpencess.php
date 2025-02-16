<?php

require_once '../DbActions/Db.conn.php';
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Colombo");

if (!$_SESSION['UserName'] && !$_SESSION['UserId']) {
  header('Location: ../index.html');
  exit();
}

$userId = (int)$_SESSION['UserId'];

$sql = "
SELECT 
    expencess.*, 
    users.UserName 
FROM 
    expencess 
LEFT JOIN 
    users 
ON 
    expencess.user_id = users.UserId ORDER BY expencess.date DESC ";

$result = mysqli_query($conn, $sql);

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
              if ($_SESSION['AdminAccess'] == 2) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"
                  <?php
                  if ($_SESSION['AdminAccess'] == 2) {
                    echo 'style="display:none;"';
                  }
                  ?>></i><span>My Tasks</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./MyAllTask.php">All Tasks</a></li>
                <li><a class="nav-link" href="./myCompletedTasks.php">Completed Tasks</a></li>
                <li><a class="nav-link" href="./myOngoing.php">On Going Task</a></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Expences</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./CreateExpencess.php">Your Expenses</a></li>
                <li><a class="nav-link" href="./MyallExpencess.php">My All Expenses</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Commotions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./myAllCommitions.php">My All Commotions</a></li>
              </ul>
            </li>

            <li class="menu-header"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>Task Functions</li>
            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Main Functions</span></a>
              <ul class="dropdown-menu"
                <?php
                if ($_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
                ?>>
                <li><a class="nav-link" href="./createTask.php">Create Task</a></li>
                <li><a class="nav-link" href="./deleteTask.php">Delete Task</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>All Tasks</span></a>
              <ul class="dropdown-menu"

                <?php
                if ($_SESSION['AdminAccess'] == 0) {
                  echo 'style="display:none;"';
                }
                ?>>
                <li><a class="nav-link" href="./AllTasks.php">All Tasks</a></li>
                <li><a class="nav-link" href="./allOngoingTask.php">On Going Task</a></li>
                <li><a class="nav-link" href="./allCompletedTask.php">Completed Tasks</a></li>
              </ul>
            </li>

            <li class="menu-header"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>User Functions</li>
            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Main Functions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./createUser.php">Create User</a></li>
                <li><a class="nav-link" href="badge.html">Update User</a></li>
                <li><a class="nav-link" href="./DeleteUser.php">Delete User</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> All Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./allUsers.php">All Users</a></li>
                <li><a class="nav-link" href="./adminUsers.php">Admin Users</a></li>
                <li><a class="nav-link" href="./nonAdminUsers.php">Non Admin Users</a></li>
              </ul>
            </li>

            <li class="menu-header"
              <?php
              if ($_SESSION['AdminAccess'] == 0 || $_SESSION['AdminAccess'] == 2) {
                echo 'style="display:none;"';
              }
              ?>>Expensess & Commitions</li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> All Expencess</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./ExpencessSummery.php">Expencess Summery</a></li>
                <li><a class="nav-link" href="./AllExpencess.php">All Expencess</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> All Commitions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./AllCommitions.php">Commotions Summary</a></li>
                <li><a class="nav-link" href="./taskCreatorCommition.php">Task Creator Commition</a></li>
                <li><a class="nav-link" href="./CommitionSummery.php">All Commotions</a></li>
              </ul>
            </li>

            <!-- summery Settings -->
            <li class="menu-header"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>Summary Settings (Daily)</li>
            <!-- end of summery settings -->
            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> Summary (Daily Buisness)</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./CreateDailyBuisness.php" style="cursor: pointer;">Add Daily Buisness</a></li>
                <li><a class="nav-link" href="./AllDailyBuisness.php" style="cursor: pointer;">All Daily Buisness</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Other Cost (Daily)</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./createDailyOtherCost.php" style="cursor: pointer;">Add Other Cost</a></li>
                <li><a class="nav-link" href="./AllDailyOtherCost.php" style="cursor: pointer;">All Other Costs</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Board Camping (Daily)</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./CreateDailyBoardCamping.php" style="cursor: pointer;">Add Board Cost</a></li>
                <li><a class="nav-link" href="./AllDailyBoardCampingCost.php" style="cursor: pointer;">All Board Costs</a></li>
              </ul>
            </li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> Reports </span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./DailyReport.php" style="cursor: pointer;">Daily Report</a></li>
                <li><a class="nav-link" href="./MonthlyReport.php" style="cursor: pointer;">Monthly Report</a></li>
              </ul>
            </li>

            <!-- emd of full settingss -->


            <li class="menu-header"
              <?php
              if ($_SESSION['AdminAccess'] == 0 || $_SESSION['AdminAccess'] == 2) {
                echo 'style="display:none;"';
              }
              ?>>Advance Settings</li>

            <li class="dropdown"
              <?php
              if ($_SESSION['AdminAccess'] == 2 || $_SESSION['AdminAccess'] == 0) {
                echo 'style="display:none;"';
              }
              ?>>
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span> Advance Stettings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" onclick="ClearExp()" style="cursor: pointer;">Clear Expencess</a></li>
                <li><a class="nav-link" onclick="ClearCommi()" style="cursor: pointer;">Clear Commitions</a></li>
              </ul>
            </li>
            <!-- 
        sweet alert
         -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
              async function ClearExp() {
                const {
                  value: password
                } = await Swal.fire({
                  title: "Enter your password",
                  input: "password",
                  inputLabel: "Password",
                  inputPlaceholder: "Enter your password",
                  inputAttributes: {
                    maxlength: "100",
                    autocapitalize: "off",
                    autocorrect: "off"
                  }
                });
                if (password === "admin@2024") {

                  location.href = "../DbActions/Advance/clearExpencess.php";
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Provide Correct Password To Continive this Task !",
                  });
                }
              }

              async function ClearCommi() {
                const {
                  value: password
                } = await Swal.fire({
                  title: "Enter your password",
                  input: "password",
                  inputLabel: "Password",
                  inputPlaceholder: "Enter your password",
                  inputAttributes: {
                    maxlength: "100",
                    autocapitalize: "off",
                    autocorrect: "off"
                  }
                });
                if (password === "admin@2024") {

                  location.href = "../DbActions/Advance/clearExpencess.php";
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Provide Correct Password To Continive this Task !",
                  });
                }
              }
            </script>
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
                          <th>Expencess Type</th>
                          <th>UserName/th>
                          <th>Distance</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Approved</th>
                          <th>Change Approved</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($rows = $result->fetch_assoc()) { ?>
                          <tr>
                            <td><?php echo $rows['expencess_type']; ?></td>
                            <td><?php echo $rows['UserName']; ?></td>
                            <td><?php echo $rows['distance']; ?></td>
                            <td><?php echo "Rs ." . $rows['amount'] . ".00"; ?></td>
                            <td><?php echo $rows['date']; ?></td>
                            <td><?php

                                if ($rows['approved_exp'] == 0) {
                                  echo '<p style="color:orange;font-weight:bold;font-size:14px;">Pending</p>';
                                } else {
                                  echo '<p style="color:green;font-weight:bold;font-size:14px;">Approved</p>';
                                }

                                ?></td>
                            <td
                              <?php
                              if ($rows['approved_exp'] != 0) {
                                echo 'style="display:none;"';
                              }
                              ?>>
                              <form id="approvalForm" action="../DbActions/expencess/changeApproval.php" method="post">
                                <input type="hidden" name="expId" value="<?php echo $rows['expenxess_id']; ?>">
                                <input type="submit" value="Approved" name="approval" class="btn btn-success" id="approveBtn">
                              </form>

                              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                              <script>
                                document.getElementById('approveBtn').addEventListener('click', function(event) {
                                  event.preventDefault(); // Prevent the form from submitting immediately

                                  Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to approve this?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, approve it!',
                                    cancelButtonText: 'No, cancel!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      // If confirmed, submit the form
                                      document.getElementById('approvalForm').submit();
                                    }
                                  });
                                });
                              </script>

                            </td>

                            <td
                              <?php
                              if ($rows['approved_exp'] == 0) {
                                echo 'style="display:none;"';
                              }
                              ?>>
                              <form id="approvalForm2" action="../DbActions/expencess/removeApp.php" method="post">
                                <input type="hidden" name="expId" value="<?php echo $rows['expenxess_id']; ?>">
                                <input type="submit" value="Remove Approved" name="removeapp" class="btn btn-danger" id="approveBtn2">
                              </form>

                              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                              <script>
                                document.getElementById('approveBtn2').addEventListener('click', function(event) {
                                  event.preventDefault(); // Prevent the form from submitting immediately

                                  Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to remove approve this?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, approve it!',
                                    cancelButtonText: 'No, cancel!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      // If confirmed, submit the form
                                      document.getElementById('approvalForm2').submit();
                                    }
                                  });
                                });
                              </script>

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