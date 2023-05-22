<?php
include_once('includes/conn.php');
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

//get the peerid from get
$peerid = $_GET['peerid'];

// get the datetime now for logs
$date = date('Y-m-d H:i:s');
//insert the login logs
$sql3 = "INSERT INTO tbl_logs (peerid, action, timestamp) VALUES (?, ?, ?)";
if ($stmt3 = mysqli_prepare($conn, $sql3)) {
  mysqli_stmt_bind_param($stmt3, "sss", $peerid, $action, $date);
  $action = 1;
  mysqli_stmt_execute($stmt3);
  mysqli_stmt_close($stmt3);
}


// Redirect the user to the login page
header("location: login.php");
exit();
?>
