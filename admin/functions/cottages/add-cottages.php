<?php

include '../../../conn.php';

$room_name = isset($_POST['room_name']) ? $_POST['room_name'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$max_capacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";

$now_time = date('YmdHis');

date_default_timezone_set("Asia/Manila");
$datenow = date('F j, Y') . " | " . date("h:i A");

// File upload handling
if (isset($_FILES["room_img"]) && !empty($_FILES["room_img"]["tmp_name"])) {
    $room_img = $room_name . '-' . $now_time ;
    $ext2 = pathinfo($_FILES["room_img"]["name"], PATHINFO_EXTENSION);
    $target_dir = realpath(__DIR__ . '/../../assets/rooms-cottages');
    $room_img = $room_img . '.' . $ext2;
    $target_file = $target_dir . '/' . $room_img;

    if (move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file)) {
        // File uploaded successfully
    } else {
        echo "Failed to move upload file for room_img.";
        exit;
    }
}

// Prepare the SQL query using prepared statements
$stmt = $mysqli->prepare("
    INSERT INTO cottages (room_name, price, max_capacity, description, room_img, status, room_status, created_date)
    VALUES (?, ?, ?, ?, ?, 'Active', 'Available', ?)
");

// Check if the prepared statement was created successfully
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind parameters to the prepared statement
$stmt->bind_param(
    'ssssss', // Define types: s = string
    $room_name,
    $price,
    $max_capacity,
    $description,
    $room_img,
    $datenow
);

// Execute the statement
if ($stmt->execute()) {
    echo "Successful";
} else {
    echo "Error executing the query: " . $stmt->error;
}

// Close the statement
$stmt->close();

?>
