<?php
// Get the form values
$id = $_POST['id'];
$topic = $_POST['topic'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];
$startTime = $_POST['startTime'];
$duration = $_POST['duration'];
$maxTutee = $_POST['maxTutee'];

// Connect to your database
// Replace the database credentials with your own
include_once('../includes/conn.php');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Check if the selected date and time are in the past
if ($date < date('Y-m-d') || ($date == date('Y-m-d') && $startTime < date('H:i'))) {
    // Return an error response
    echo json_encode(['status' => 'error', 'message' => 'You cannot edit a schedule that is in the past']);
    exit;
}

// Check if there is an existing schedule with the same date and start time
$sql = "SELECT * FROM tbl_schedule WHERE date='$date' AND start_time='$startTime' AND scheduleid!='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Return an error response
    echo json_encode(['status' => 'error', 'message' => 'There is already a schedule with the same date and start time']);
    exit;
}

// Prepare and execute a query to update the schedule
$sql = "UPDATE tbl_schedule SET title='$topic', description='$description', date='$date', location='$location', start_time='$startTime', duration='$duration', max_tutee='$maxTutee' WHERE scheduleid='$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // If the update is successful, return a success response
    echo json_encode(['status' => 'success']);
} else {
    // If there is an error, return an error response
    echo json_encode(['status' => 'error', 'message' => 'There was an error while updating the schedule']);
}

// Close the database connection
mysqli_close($conn);
?>
