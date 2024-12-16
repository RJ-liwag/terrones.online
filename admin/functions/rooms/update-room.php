<?php

include '../../../conn.php';

$edit_room_id = isset($_POST['room_id']) ? $_POST['room_id'] : "";
$status = isset($_POST['status']) ? $_POST['status'] : "";
$edit_room_name = isset($_POST['room_name']) ? $_POST['room_name'] : "";
$edit_price = isset($_POST['price']) ? $_POST['price'] : "";
$edit_max_capacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : "";
$edit_description = isset($_POST['description']) ? $_POST['description'] : "";

$now_time = date('YmdHis');

date_default_timezone_set("Asia/Manila");
$datenow = date('F j, Y') . " | " . date("h:i A");

$room_img = "";
if (isset($_FILES["room_img"]) && !empty($_FILES["room_img"]["tmp_name"])) {
    $room_img = $edit_room_name . '-' . $now_time;
    $ext2 = pathinfo($_FILES["room_img"]["name"], PATHINFO_EXTENSION);
    $target_dir = realpath(__DIR__ . '/../../assets/rooms-cottages');
    $room_img = $room_img . '.' . $ext2;
    $target_file = $target_dir . '/' . $room_img;

    if (!move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file)) {
        echo "Failed to move upload file for room_img.";
    }
}

// Prepare the SQL query dynamically
if ($room_img) {
    $sql = "UPDATE rooms SET
        room_name = ?, 
        price = ?, 
        max_capacity = ?, 
        description = ?, 
        room_img = ?, 
        status = ?, 
        room_status = 'Available', 
        updated_date = ?
        WHERE room_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssissssi", $edit_room_name, $edit_price, $edit_max_capacity, $edit_description, $room_img, $status, $datenow, $edit_room_id);
} else {
    $sql = "UPDATE rooms SET
        room_name = ?, 
        price = ?, 
        max_capacity = ?, 
        description = ?, 
        status = ?, 
        updated_date = ?
        WHERE room_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssisssi", $edit_room_name, $edit_price, $edit_max_capacity, $edit_description, $status, $datenow, $edit_room_id);
}

if ($stmt->execute()) {
    echo "Successful";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>
