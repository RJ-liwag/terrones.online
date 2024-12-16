<?php

include '../../conn.php';

// Get the reference number from POST
$reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : "";

// Prepare the SQL query using a placeholder
$sql = "UPDATE tbl_reservations SET status = 'Cancelled' WHERE reference_number = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind the reference_number parameter to the placeholder
$stmt->bind_param("s", $reference_number); // "s" for string

// Execute the query
if ($stmt->execute()) {
    echo "Successful";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

?>
