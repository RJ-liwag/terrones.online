<?php

include '../conn.php';

// GET THE DATA FROM DATABASE ROOMS 

$rooms_query = $mysqli->query("SELECT * FROM cottages ");
$row = $rooms_query->fetch_array();
