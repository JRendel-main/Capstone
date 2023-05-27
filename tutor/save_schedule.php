<?php
// Assuming you have established a database connection
include_once('../includes/conn.php');

// get the tutorid
$tutorid = $_GET['tutorid'];
// Get the form values
$topic = $_POST['topic'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];
$startTime = $_POST['startTime'];
$duration = $_POST['duration'];
$maxTutee = $_POST['maxTutee'];

// check if there is already schedule on start_time plus the duration(hours)
$endTime = date('H:i', strtotime($startTime . ' + ' . $duration . ' hours'));
$sql = "SELECT * FROM tbl_schedule WHERE date='$date' AND start_time='$startTime' AND end_time='$endTime' AND tutorid='$tutorid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // Return an error response
  echo json_encode(['message' => 'There is already a schedule with the same date and start time']);
  exit;
}

// Prepare the SQL query
$sql = "INSERT INTO tbl_schedule (tutorid, title, description, date, location, start_time, duration, max_tutee) 
        VALUES ('$tutorid','$topic', '$description', '$date', '$location', '$startTime', '$duration', '$maxTutee')";

// Execute the query
if (mysqli_query($conn, $sql)) {
  // Return a success response
  echo json_encode(['message' => 'successful']);
} else {
  // Return an error response
  echo json_encode(['message' => 'An error occurred while saving the schedule']);
}

// Close the database connection
mysqli_close($conn);
?>
