<?php

include '../../../conn.php';



$room_name = isset($_POST['room_name']) ? $_POST['room_name'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$max_capacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";

$now_time = date('YmdHis');

date_default_timezone_set("Asia/Manila");
$datenow = date('F j, Y') . " | " . date("h:i A");

// move_uploaded_file($_FILES['room_img']['tmp_name'], __DIR__.'/../../assets/rooms'. $_FILES["room_img"]['name']);



if (isset($_FILES["room_img"]) && !empty($_FILES["room_img"]["tmp_name"])) {
    $room_img = $room_name . '-' . $now_time ;
    $ext2 = pathinfo($_FILES["room_img"]["name"], PATHINFO_EXTENSION);
    $target_dir = realpath(__DIR__ . '/../../assets/rooms-cottages');
    $room_img = $room_img . '.' . $ext2;
    $target_file = $target_dir . '/' . $room_img;

    if (move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file)){

    } else {
        echo "Failed to move upload file for room_img.";
    }
}
// $target_dir = "../assets/rooms-cottages/";
// $room_img = $target_dir . basename($_FILES["room_img"]["name"]);

// if (!is_writable($target_dir)) {
//     die("Error: Target directory is not writable.");
// }

// if (move_uploaded_file($_FILES["room_img"]["tmp_name"], $room_img)) {
//     echo "The file has been uploaded.";
// } else {
//     echo "Failed to move upload file for room_img.";
// }



$addroom_query = $mysqli->query("
    INSERT INTO rooms
    set
    room_name = '$room_name',
    price = '$price',
    max_capacity = '$max_capacity',
    description = '$description',
    room_img = '$room_img',
    status = 'Active',
    room_status = 'Available',
    created_date = '$datenow'
    ");
if ($addroom_query) {
    echo "Successful";
}
