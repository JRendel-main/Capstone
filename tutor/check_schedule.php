<?php
include_once("../includes/conn.php");
// Get the form values
$topic = $_POST['topic'];
$date = $_POST['date'];
$startTime = $_POST['startTime'];

// Convert date and start time to a DateTime object
$selectedDateTime = new DateTime($date . ' ' . $startTime);

// Connect to your database

// Prepare and execute a query to check for conflicting schedules
$sql = "SELECT * FROM tbl_schedule WHERE date = '$date' AND start_time = '$startTime'";
$result = mysqli_query($conn, $sql);

$response = array();
$response['conflict'] = false;

// Check if there is a conflicting schedule
if (mysqli_num_rows($result) > 0) {
    $response['conflict'] = true;
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
