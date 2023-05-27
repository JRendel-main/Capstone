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

<!-- Bootstrap 4 -->

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $('#edit-schedule-btn').hide();
  $('#delete-schedule-btn').hide();
  $('#cancel-schedule-btn').hide();
  $('#view-schedule-btn').hide();
  $(document).ready(function() {
    // Initialize the calendar
    $('#calendar').fullCalendar({
      // Calendar options...
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        // Display the modal.
        // You could fill in the start and end fields based on the parameters
      },
      events: {
        url: 'get_schedule.php?tutorid=<?php echo $peerid ?>', // Replace with your server endpoint to fetch events
        type: 'GET',
        error: function() {
          // add sweetalert
          swal('Failed', 'There was an error while fetching events (Error Code: 0001)', 'error');
        }
      },
      eventClick: function(event, element) {
        // Put the schedule from json to form
        $('#schedule-id').val(event.id);
        $('#schedule-topic').val(event.title);
        $('#schedule-description').val(event.description);
        $('#schedule-date').val(moment(event.start).format('YYYY-MM-DD'));
        $('#schedule-location').val(event.location);
        $('#schedule-start-time').val(moment(event.start).format('HH:mm'));
        $('#schedule-duration').val(event.duration);
        $('#schedule-max-tutee').val(event.max_tutee);

        // remove the add button and add edit button
        $('#add-schedule-btn').hide();
        $('#edit-schedule-btn').show();
        $('#delete-schedule-btn').show();
        $('#cancel-schedule-btn').show();
        $('#view-schedule-btn').show();
      }
    });

    // Cancel button
    $('#cancel-schedule-btn').click(function() {
      // Clear the form
      $('#schedule-id').val('');
      $('#schedule-topic').val('');
      $('#schedule-description').val('');
      $('#schedule-date').val('');
      $('#schedule-location').val('');
      $('#schedule-start-time').val('');
      $('#schedule-duration').val('');
      $('#schedule-max-tutee').val('');

      // remove the edit button and add add button
      $('#add-schedule-btn').show();
      $('#edit-schedule-btn').hide();
      $('#delete-schedule-btn').hide();
      $('#cancel-schedule-btn').hide();
      $('#view-schedule-btn').hide();
    });

    //handle edit button
    $('#edit-schedule-btn').click(function() {
      // Get the form values
      var id = $('#schedule-id').val();
      var topic = $('#schedule-topic').val();
      var description = $('#schedule-description').val();
      var date = $('#schedule-date').val();
      var location = $('#schedule-location').val();
      var startTime = $('#schedule-start-time').val();
      var duration = $('#schedule-duration').val();
      var maxTutee = $('#schedule-max-tutee').val();

      // Prepare the schedule data
      var scheduleData = {
        id: id,
        topic: topic,
        description: description,
        date: date,
        location: location,
        startTime: startTime,
        duration: duration,
        maxTutee: maxTutee
      };

      // Get the current date and time
      var currentDate = new Date();
      var currentDateTime = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), currentDate.getHours(), currentDate.getMinutes());

      // Convert the selected date and start time to a Date object
      var selectedDateTime = new Date(date + ' ' + startTime);

      // Check if the selected date and time is in the past
      if (selectedDateTime < currentDateTime) {
        // add sweetalert
        swal('Failed', 'You cannot edit a schedule that is in the past', 'error');
        return;
      }


      // Send the schedule data to the server
      $.ajax({
        url: 'edit_schedule.php',
        type: 'POST',
        data: scheduleData,
        success: function(response) {
          console.log(response);
          // get the status response from json file sent by server
          var status = JSON.parse(response);
          console.log(status.status);
          if (status.status == 'success') {
            // Reload the calendar
            $('#calendar').fullCalendar('refetchEvents');

            // Clear the form
            $('#schedule-id').val('');
            $('#schedule-topic').val('');
            $('#schedule-description').val('');
            $('#schedule-date').val('');
            $('#schedule-location').val('');
            $('#schedule-start-time').val('');
            $('#schedule-duration').val('');
            $('#schedule-max-tutee').val('');

            // remove the edit button and add add button
            $('#add-schedule-btn').show();
            $('#edit-schedule-btn').hide();
            $('#delete-schedule-btn').hide();
            $('#cancel-schedule-btn').hide();
            $('#view-schedule-btn').hide();

            // add sweetalert
            swal('Success', 'Schedule has been updated', 'success');
          } else {
            var message = status.message
            swal('Failed', message, 'error');
            // get the error message and print to swal
          }
        },
        error: function() {
          // add sweetalert
          swal('Failed', 'There was an error while updating schedule (Error Code: 0003)', 'error');
        }
      });
    });


    //

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

      // Get the current date and time
      var currentDate = new Date();
      var currentDateTime = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), currentDate.getHours(), currentDate.getMinutes());

      // Convert the selected date and start time to a Date object
      var selectedDateTime = new Date(date + ' ' + startTime);

      // Check if the selected date and time are in the past
      if (selectedDateTime < currentDateTime) {
        // Show error message for past dates
        swal('Error', 'Please select a future date and time.', 'error');
        return;
      }

      // Perform an AJAX request to check if there is a schedule with the same date and start time
      $.ajax({
        url: 'check_schedule.php', // Replace with your server endpoint to check for conflicting schedules
        type: 'POST',
        data: scheduleData,
        success: function(response) {
          // Get the response from the server
          var message = JSON.parse(response);
          console.log(message);
          if (message.conflict == false) {
            // Perform an AJAX request to save the schedule
            $.ajax({
              url: 'save_schedule.php?tutorid=<?php echo $peerid; ?>', // Replace with your server endpoint to save the schedule
              type: 'POST',
              data: scheduleData,
              success: function(response) {
                // Show success message
                swal('Success', 'Schedule added successfully!', 'success');
                // Clear the form
                $('#add-schedule-form')[0].reset();
                //refresh the calendar
                $('#calendar').fullCalendar('refetchEvents');
              },
              error: function(xhr, status, error) {
                // Show error message
                swal('Error', 'An error occurred. Please try again.', 'error');
              }
            });
          } else {
            // Show error message for conflicting schedules
            swal('Error', 'There\'s already schedule on that time ', 'error');
          }
        },
        error: function(xhr, status, error) {
          // Show error message
          swal('Error', 'An error occurred. Please try again.', 'error');
        }
      });
    });


    // handle delete button
    $('#delete-schedule-btn').click(function() {
      // Get the schedule id
      var scheduleId = $('#schedule-id').val();
      var topic = $('#schedule-topic').val();

      // Prepare the schedule data
      var scheduleData = {
        scheduleId: scheduleId
      };
      // popup a swal
      swal({
        title: 'Are you sure?',
        text: 'You are about to delete the schedule "' + topic + '"',
        icon: 'warning',
        buttons: true,
        dangerMode: true
      }).then((willDelete) => {
        if (willDelete) {
          // Perform an AJAX request to delete the schedule
          // Replace the URL and data with your own implementation
          $.ajax({
            url: 'delete-schedule.php',
            type: 'POST',
            data: scheduleData,
            success: function(response) {
              // Show success message
              swal('Success', 'Schedule deleted successfully!', 'success');
            },
            error: function(xhr, status, error) {
              // Show error message
              swal('Error', 'An error occurred. Please try again.', 'error');
            }
          });
        }
      });
    });
  });
  $(document).ready(function() {
    // Event listener for the "View Enrolled" button
    $('#view-schedule-btn').on('click', function() {
      // Perform an AJAX request to fetch the enrolled tutees data
      $.ajax({
        url: 'fetch-enrolled-tutees.php', // Replace with your server endpoint to fetch enrolled tutees data
        type: 'GET',
        success: function(response) {
          // Clear the existing list
          $('#enrolled-tutees-list').empty();

          // Iterate through the enrolled tutees data
          response.forEach(function(tutee) {
            // Create a Bootstrap card for each tutee
            var card = '<div class="col-md-4">' +
              '<div class="card">' +
              '<div class="card-body">' +
              '<h5 class="card-title">' + tutee.name + '</h5>' +
              '<p class="card-text">Email: ' + tutee.email + '</p>' +
              '<p class="card-text">Phone: ' + tutee.phone + '</p>' +
              '</div>' +
              '</div>' +
              '</div>';

            // Append the card to the enrolled tutees list
            $('#enrolled-tutees-list').append(card);
          });

          // Show the modal popup
          $('#enrolled-modal').modal('show');
        },
        error: function() {
          // Show error message
          swal('Error', 'An error occurred while fetching enrolled tutees.', 'error');
        }
      });
    });
  });
</script>
<script src="../dist/js/adminlte.min.js"></script>
</body>

</html>