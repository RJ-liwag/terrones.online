<?php

include '../../../conn.php';

// Get the room_id from POST
$room_id = isset($_POST['room_id']) ? $_POST['room_id'] : "";

// Prepare the SQL query using a prepared statement
$sql = "UPDATE cottages SET status = 'Inactive' WHERE room_id = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the prepared statement was successful
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind the parameters (s for string)
$stmt->bind_param("i", $room_id); // Assuming room_id is an integer (use 'i' for integer)

// Execute the query
if ($stmt->execute()) {
    echo "Successful";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

?>
