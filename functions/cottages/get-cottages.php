<?php

include 'conn.php';

// Prepare the SQL query for rooms
$rooms_query = $mysqli->prepare("SELECT * FROM db_terrones_resort.rooms WHERE status = ?");
$status = 'Active'; // You can change this status dynamically if needed
$rooms_query->bind_param("s", $status); // 's' for string (status)
$rooms_query->execute();
$rooms_result = $rooms_query->get_result(); // Get the result

// Prepare the SQL query for cottages
$cottage_query = $mysqli->prepare("SELECT * FROM db_terrones_resort.cottages WHERE status = ?");
$cottage_query->bind_param("s", $status); // 's' for string (status)
$cottage_query->execute();
$cottage_result = $cottage_query->get_result(); // Get the result

// Fetch the first room row
$row = $rooms_result->fetch_array();

// Fetch the first cottage row
$cottage_row = $cottage_result->fetch_array();

?>