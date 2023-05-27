<?php
$active_page = "";

include('../includes/conn.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<?php
// get the tutorid on get
$tutorid = $_GET['tutorid'];
// select the row from the table
$query = "SELECT * FROM tbl_peerinfo WHERE peerid = '$tutorid'";
$query_run = mysqli_query($conn, $query);
$row = mysqli_fetch_array($query_run);

$firstname = $row['firstname'];
$middlename = $row['middlename'];
$lastname = $row['lastname'];

$fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
//format the fullname to camel case
$fullname = ucwords($fullname);
// display the fullname
?>
<style>
    /* Container for the calendar */
    #calendar-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Minimal styling for the calendar */
    .fc {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .fc-header {
        background-color: #f0f0f0;
        padding: 10px;
        text-align: center;
    }

    .fc-header-title {
        font-weight: bold;
        text-align: center;
    }

    .fc-prev-button,
    .fc-next-button {
        background-color: #ddd;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .fc-prev-button:hover,
    .fc-next-button:hover {
        background-color: #bbb;
    }

    .fc-prev-button span,
    .fc-next-button span {
        font-weight: bold;
    }

    .fc-day-header {
        background-color: #f0f0f0;
        padding: 10px;
        text-align: center;
    }

    .fc-day {
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .fc-today {
        background-color: #f0f0f0;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #ccc;
    }

    .card-body {
        background-color: #fff;
        border-radius: 0 0 10px 10px;
    }

    .schedule-details {
        border-radius: 10px;
        border: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .schedule-details {
        cursor: pointer;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <a href="tutor_list.php" class="text-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tutor List</a>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-danger schedule-details">
                        <div class="card-body">
                            <!-- Display the details of Schedule -->
                            <h5 id="schedule-title"></h5>
                            <p id="schedule-date"></p>
                            <p id="schedule-location"></p>
                            <p id="schedule-start-time"></p>
                            <p id="schedule-duration"></p>
                            <p id="schedule-max-tutee"></p>
                            <p id="schedule-type"></p>
                            <p id="schedule-description"></p>
                            <button id="add-button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-body p-0 m-2">
                            <!-- THE CALENDAR -->
                            <div id="calendar">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?php include('includes/footer.php'); ?>