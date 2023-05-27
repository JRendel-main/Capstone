<?php
// Include your database connection code here
include_once("../includes/conn.php");
// Fetch events from the tbl_schedule table

//get the tutorid from link
$tutorid = $_GET['tutorid'];

$sql = "SELECT * FROM tbl_schedule WHERE tutorid = '$tutorid'";
$result = mysqli_query($conn, $sql);


// Prepare an array to store the events
$events = array();

// Iterate through the result set
while ($row = mysqli_fetch_assoc($result)) {
    $scheduleid = $row['scheduleid'];
    $date = $row['date'];
    $topic = $row['title'];
    $description = $row['description'];
    $location = $row['location'];
    $start_time = $row['start_time'];
    $duration = $row['duration'];
    $max_tutee = $row['max_tutee'];

    $sql2 = "SELECT * FROM tbl_peerinfo WHERE peerid = '$tutorid'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $firstname = $row2['firstname'];
    $middlename = $row2['middlename'];
    $lastname = $row2['lastname'];
    $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
    // Create an event object with the required fields
    $start = $row['date'] . 'T' . $row['start_time'];
    $end = $row['date'] . 'T' . date('H:i:s', strtotime($row['start_time'] . '+ ' . $row['duration'] . ' hours'));

    $event = array(
        'id' => $scheduleid,
        'title' => $topic,
        'start' => $start,
        'end' => $end,
        'description' => $description,
        'location' => $location,
        'tutor' => $fullname,
        'duration' => $duration,
        'max_tutee' => $max_tutee
    );

    // Add the event to the events array
    $events[] = $event;
}

// Return the events as JSON AS POST
echo json_encode($events);
