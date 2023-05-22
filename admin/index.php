<?php
include('../includes/conn.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    $total_tutors = 0;
    $total_tutees = 0;
    $active_sessions = 0;
    $completed_sessions = 0;
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- Total Number of Tutors -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_tutors; ?></h3>
                            <p>Total Number of Tutors</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- Total Number of Tutees -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_tutees; ?></h3>
                            <p>Total Number of Tutees</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- Number of Active Sessions -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $active_sessions; ?></h3>
                            <p>Number of Active Sessions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- Total Number of Completed Sessions -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $completed_sessions; ?></h3>
                            <p>Total Number of Completed Sessions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-square"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent User who just logged in</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Fullname</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // get the timestamp on tbl_logs
                            $sql = "SELECT * FROM tbl_logs ORDER BY timestamp DESC";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $timestamp = $row['timestamp'];
                                $peerid = $row['peerid'];
                                $action = $row['action'];

                                // reformat the date for more readable
                                $timestamp = date("F j, Y, g:i a", strtotime($timestamp));

                                if ($action == 0) {
                                    $action = "Logged In";
                                } else {
                                    $action = "Logged Out";
                                }

                                // get the fullname of the user from tbl_peerinfo using peerid
                                $sql2 = "SELECT * FROM tbl_peerinfo WHERE peerid = '$peerid'";
                                $result2 = mysqli_query($conn, $sql2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $firstname = $row2['firstname'];
                                    $lastname = $row2['lastname'];
                                    $fullname = $firstname . " " . $lastname;
                                }

                                echo "<tr>";
                                echo "<td>" . $timestamp . "</td>";
                                echo "<td>" . $fullname . "</td>";
                                echo "<td>" . $action . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?php include('includes/footer.php'); ?>