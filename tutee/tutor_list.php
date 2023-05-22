<?php
$active_page = "tutor_list";

include('../includes/conn.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<style>
  .card {
    border: none;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    cursor: pointer;
  }

  .card:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background-color: #FBC02D; /* Yellow */
    transform: scaleY(1);
    transition: all 0.5s;
    transform-origin: bottom;
  }

  .card:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background-color: #EF5350; /* Red */
    transform: scaleY(0);
    transition: all 0.5s;
    transform-origin: bottom;
  }

  .card:hover::after {
    transform: scaleY(1);
  }

  .fonts {
    font-size: 11px;
  }

  .social-list {
    display: flex;
    list-style: none;
    justify-content: center;
    padding: 0;
  }

  .social-list li {
    padding: 10px;
    color: #EF5350; /* Red */
    font-size: 19px;
  }

  .buttons button:nth-child(1) {
    border: 1px solid #EF5350 !important; /* Red */
    color: #EF5350; /* Red */
    height: 40px;
  }

  .buttons button:nth-child(1):hover {
    border: 1px solid #EF5350 !important; /* Red */
    color: #fff;
    height: 40px;
    background-color: #EF5350; /* Red */
  }

  .buttons button:nth-child(2) {
    border: 1px solid #EF5350 !important; /* Red */
    background-color: #EF5350; /* Red */
    color: #fff;
    height: 40px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8">
          <h1 class="m-0">Tutor Lists</h1>
        </div><!-- /.col -->
        <div class="col-sm-4 text-right">
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-search"></i> / <i class="fa fa-filter"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Filter options -->
          <h4>Filter by:</h4>
          <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" class="form-control">
              <option value="">All</option>
              <option value="math">Math</option>
              <option value="science">Science</option>
              <option value="languages">Languages</option>
              <!-- Add more options as needed -->
            </select>
          </div>
        </div>

        <div class="col-md-9">
          <div class="row">
            <h4>Search Result (0):</h4>
            <hr>
          </div>

          <div class="row">
            <?php
            function getColor($tutor_course)
            {
              switch ($tutor_course) {
                case 'CICT':
                  return array('bg-gradient-bsit', 'College of Information and Communication Technology (CICT)');
                case 'COE':
                  return array('bg-gradient-coe', 'College of Engineering (COE)');
                  break;
                case 'COED':
                  return array('bg-gradient-coed', 'College of Education (COED)');
                  break;
                case 'CAS':
                  return array('bg-gradient-cas', 'College of Arts and Sciences (CAS)');
                  break;
                case 'COC':
                  return array('bg-gradient-coc', 'College of Criminology (COC)');
                  break;
                case 'CON':
                  return array('bg-gradient-con', 'College of Nursing (CON)');
                  break;
                case 'CMBT':
                  return array('bg-gradient-cmbt', 'College of Management and Business Technology (CMBT)');
                  break;
                case 'CIT':
                  return array('bg-gradient-cit', 'College of Industrial Technology (CIT)');
                  break;
                case 'CPADM':
                  return array('bg-gradient-cpadm', 'College of Public Administration (CPADM)');
                  break;
                case 'LBH':
                  return array('bg-gradient-lbh', 'Laboratory High School (LBH)');
                  break;
                default:
                  return array('bg-gradient-default', 'Undefined');
              }
            }
            $sql = "SELECT * FROM tbl_peerinfo WHERE category =2";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $peerid = $row['peerid'];
                $firstname = $row['firstname'];
                $middlename = $row['middlename'];
                $lastname = $row['lastname'];
                $category = $row['category'];
                $email = $row['email'];
                $course = $row['course'];
                $sex = $row['sex'];
                $bday = $row['dob'];

                //calculate the age from today using bday
                $from = new DateTime($bday);
                $to   = new DateTime('today');
                $age = $from->diff($to)->y;
                $age = $age . " years old";

                $sql2 = "SELECT bio FROM tbl_tutorprofile where tutorid = '$peerid'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                // check if tbl_tutorprofile set if not
                if (mysqli_num_rows($result2) > 0) {
                  $bio = $row2['bio'];
                } else {
                  $bio = "No bio set.";
                }


                $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
                //Camel case the name
                $fullname = ucwords($fullname);

                $colorData = getColor($course);
                $headColor = $colorData[0];
                $headerText = $colorData[1];
                $profileImage = "https://bootdey.com/img/Content/avatar/avatar" . ($peerid % 8 + 1) . ".png";

                echo '
                <div class="row d-flex justify-content-start w-100">
                  <div class="col-md-12">
                    <div class="card p-3 py-4 w-100 mx-auto">
                      <div class="text-center">
                        <img src="' . $profileImage . '" width="100" class="rounded-circle">
                      </div>
                      <div class="text-center mt-3">
                        <span class="bg-secondary p-1 px-4 rounded">Newbie</span>
                        <h5 class="mt-2 mb-0">'. $fullname .'</h5>
                        <span>'.$bio.'</span>
                        <div class="px-4 mt-1">
                          <p class="fonts">'.$headerText.'</p>
                        </div>
                        <ul class="social-list">
                          <span class="badge badge-pill badge-primary">Expertise 1</span>
                          <span class="badge badge-pill badge-secondary">Expertise 2</span>
                          <span class="badge badge-pill badge-info">Expertise 3</span>
                        </ul>
                        <div class="buttons">
                          <a href="viewprofile.php?tutorid='.$peerid.'" class="btn btn-danger btn-sm">View Profile</a>
                          <a href="#" class="btn btn-warning btn-sm">Message</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                ';
              }
            }
            ?>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
    </div>
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Filter popup -->
  <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filter Tutors</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="filterForm">
            <!-- Department filter -->
            <div class="form-group">
              <label for="department">Department</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="department[]" id="dept1" value="Computer Science">
                <label class="form-check-label" for="dept1">
                  Computer Science
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="department[]" id="dept2" value="Mathematics">
                <label class="form-check-label" for="dept2">
                  Mathematics
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="department[]" id="dept3" value="Physics">
                <label class="form-check-label" for="dept3">
                  Physics
                </label>
              </div>
            </div>
            <!-- Rating filter -->
            <div class="form-group">
              <label for="rating">Rating</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="rating[]" id="rating1" value="4 or more">
                <label class="form-check-label" for="rating1">
                  4 or more
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="rating[]" id="rating2" value="3 or more">
                <label class="form-check-label" for="rating2">
                  3 or more
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="rating[]" id="rating3" value="2 or more">
                <label class="form-check-label" for="rating3">
                  2 or more
                </label>
              </div>
            </div>
            <!-- Interest filter -->
            <div class="form-group">
              <label for="interest">Interest</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="interest[]" id="interest1" value="Coding">
                <label class="form-check-label" for="interest1">
                  Coding
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="interest[]" id="interest2" value="Data Science">
                <label class="form-check-label" for="interest2">
                  Data Science
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="interest[]" id="interest3" value="Machine Learning">
                <label class="form-check-label" for="interest3">
                  Machine Learning
                </label>
              </div>
            </div>
            <!-- Search bar -->
            <div class="form-group">
              <label for="search">Search</label>
              <input type="text" class="form-control" name="search" id="search" placeholder="Search by tutor name or subject">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <!-- Filter button -->
          <button type="button" class="btn btn-primary" id="filterBtn">Filter</button>
          <!-- Sort by dropdown menu -->
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="sortByBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort By
            </button>
            <div class="dropdown-menu" aria-labelledby="sortByBtn">
              <a class="dropdown-item" href="#">Rating (High to Low)</a>
              <a class="dropdown-item" href="#">Rating (Low to High)</a>
              <a class="dropdown-item" href="#">Price (Low to High)</a>
              <a class="dropdown-item" href="#">Price (High to Low)</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>