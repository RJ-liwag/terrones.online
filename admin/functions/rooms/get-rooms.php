<?php


include '../conn.php';

// GET THE DATA FROM DATABASE ROOMS 
$rooms_query = $mysqli->query("SELECT * FROM rooms");
$row = $rooms_query->fetch_array();


?>