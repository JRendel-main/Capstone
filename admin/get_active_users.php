<?php
include('../includes/conn.php');

// retrieve data about active users from the database
$sql = "SELECT COUNT(*) as count, UNIX_TIMESTAMP(login_time)*1000 as time FROM users WHERE status = 'active' GROUP BY UNIX_TIMESTAMP(login_time) ORDER BY UNIX_TIMESTAMP(login_time) DESC LIMIT 50";
$result = $conn->query($sql);

// process the query results and build an array of data points
$data = array();
$max_active_users = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $count = intval($row["count"]);
        $time = intval($row["time"]);
        $data_point = array($time, $count);
        array_push($data, $data_point);
        $max_active_users = max($max_active_users, $count);
    }
}

// close the database connection
$conn->close();

// return the data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>
