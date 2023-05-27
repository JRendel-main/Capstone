<?php
$active_page = "schedule";
include('../includes/conn.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>
<style>
    /* Container for the calendar */
    #calendar-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        border-radius: 0px;
    }

    /* Minimal styling for the calendar */
    .fc {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .fc .fc-header-toolbar {
        padding: 0 1em;
        margin-bottom: 1em;
    }

    .fc .fc-header-toolbar .fc-toolbar-chunk {
        white-space: nowrap;
    }

    .fc .fc-header-toolbar .fc-toolbar-chunk .fc-button {
        margin: 0 .25em;
    }

    .fc .fc-header-toolbar .fc-toolbar-chunk .fc-button-primary {
        background: #007bff;
        border-color: #007bff;
    }

    .fc .fc-header-toolbar .fc-toolbar-chunk .fc-button-primary:not(:disabled):active {
        background: #0069d9;
        border-color: #0062cc;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

    .add-schedule {
        margin-bottom: 20px;
    }

    .add-schedule .card-title {
        display: flex;
        align-items: center;
    }

    .add-schedule .card-title i {
        margin-right: 10px;
    }

    .add-schedule .form-group label {
        display: flex;
        align-items: center;
    }

    .add-schedule .form-group label i {
        margin-right: 10px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Schedule Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-danger add-schedule">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Add Schedule</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-info btn-sm" id="view-schedule-btn">
                                        <i class="fas fa-user"></i> View Enrolled
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="add-schedule-form">
                                <input type="hidden" id="schedule-id">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="schedule-topic" placeholder="Topic" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea class="form-control" id="schedule-description" rows="3" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="schedule-date" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="schedule-location" placeholder="Meetup Place" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="time" class="form-control" id="schedule-start-time" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="schedule-duration" placeholder="Duration (in hours)" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="schedule-max-tutee" placeholder="Max Tutee" required>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-warning" id="add-schedule-btn"><i class="fas fa-plus"></i> Add</button>
                                        <button type="button" class="btn btn-info" id="edit-schedule-btn"><i class="fas fa-edit"></i> Edit</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger" id="delete-schedule-btn"><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-outline-danger justify-content-end" id="cancel-schedule-btn"><i class="fa fa-ban"></i> Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-body p-0 m-2">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->
<div class="modal-body">
    <div class="row" id="enrolled-tutees-list"></div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<?php include('includes/footer.php'); ?>