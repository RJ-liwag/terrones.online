<?php


include 'conn.php';

// GET THE DATA FROM DATABASE ROOMS 
$rooms_query = $mysqli->query("SELECT * FROM rooms WHERE status = 'Active'");
$cottage_query = $mysqli->query("SELECT * FROM cottages WHERE status = 'Active'");
$row = $rooms_query->fetch_array();
$cottage_row = $cottage_query->fetch_array();


?>