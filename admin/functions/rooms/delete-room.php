<?php

include '../../../conn.php';

$room_id= isset($_POST['room_id'])?$_POST['room_id']:"";

$update_room_query = $mysqli->query("UPDATE rooms SET status = 'Inactive' WHERE `room_id` = '$room_id'");
if($update_room_query) {
    echo "Successful";

   
} 
