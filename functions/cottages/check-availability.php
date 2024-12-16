<?php

include '../../conn.php';

// Get the POST data
$room_id = isset($_POST['room_id']) ? $_POST['room_id'] : "";
$check_in = isset($_POST['check_in']) ? $_POST['check_in'] : "";
$check_out = isset($_POST['check_out']) ? $_POST['check_out'] : "";

// Initialize variable to track availability
$is_available = true;

// Prepare the SQL query using a placeholder
$sql = "SELECT * FROM tbl_reservations WHERE facility_id = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind the parameter for the query
$stmt->bind_param("i", $room_id); // Assuming room_id is an integer (use 's' if it's a string)

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Loop through the reservations to check availability
while ($row = $result->fetch_assoc()) {
    $dates_db = json_decode($row["reservation_date"], true); // Convert JSON to array
    
    if (count($dates_db) === 2) {
        $reserved_check_in = $dates_db[0];
        $reserved_check_out = $dates_db[1];
        
        // Check if the requested dates overlap with the existing reservation
        if (($check_in >= $reserved_check_in && $check_in <= $reserved_check_out) || 
            ($check_out >= $reserved_check_in && $check_out <= $reserved_check_out) ||
            ($check_in <= $reserved_check_in && $check_out >= $reserved_check_out)) {
            $is_available = false;
            break; // No need to check further if a conflict is found
        }
    }
}

// Output the result based on availability
if (!$is_available) {
    echo "Unavailable";
} else {
    echo "Available";
}

// Close the statement
$stmt->close();

?>
