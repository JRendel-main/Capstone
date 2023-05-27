<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
  // Initialize the calendar
  $('#calendar').fullCalendar({
    // Calendar options...
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    select: function(start, end) {
      // Display the modal.
      // You could fill in the start and end fields based on the parameters
      $('#modal-add-schedule').modal('show');
    },
    events: {
      url: 'get-events.php', // Replace with your server endpoint to fetch events
      type: 'GET',
      error: function() {
        // add sweetalert
        swal("Failed", "There was an error while fetching events (Error Code: 0001)", "error");
      }
    }
  });

  // Handle form submission
  $('#add-schedule-form').submit(function(event) {
    event.preventDefault();

    // Get the form values
    var topic = $('#schedule-topic').val();
    var description = $('#schedule-description').val();
    var date = $('#schedule-date').val();
    var location = $('#schedule-location').val();
    var startTime = $('#schedule-start-time').val();
    var duration = $('#schedule-duration').val();
    var maxTutee = $('#schedule-max-tutee').val();

    // Prepare the schedule data
    var scheduleData = {
      topic: topic,
      description: description,
      date: date,
      location: location,
      startTime: startTime,
      duration: duration,
      maxTutee: maxTutee
    };

    // Perform an AJAX request to save the schedule
    $.ajax({
      url: 'save-schedule.php', // Replace with your server endpoint to save the schedule
      type: 'POST',
      data: scheduleData,
      success: function(response) {
        // Add the new event to the calendar
        scheduleData.id = response.id; // Assuming the response contains the newly created event's ID
        $('#calendar').fullCalendar('renderEvent', scheduleData, true);

        // Clear the form
        $('#add-schedule-form')[0].reset();

        // Show success message
        swal("Success!", "Schedule added!", "success");
        //refresh the page
        location.reload();
      },
      error: function(xhr, status, error) {
        // Show error message
        swal("Error!", "An error occurred. Please try again.", "error");
      }
    });
  });
});

</script>
</body>

</html>