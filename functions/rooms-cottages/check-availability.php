<?php

include '../../conn.php';

// Get the POST data
$room_id = isset($_POST['room_id']) ? $_POST['room_id'] : "";
$check_in = isset($_POST['check_in']) ? $_POST['check_in'] : "";
$check_out = isset($_POST['check_out']) ? $_POST['check_out'] : "";
$tour_type = isset($_POST['tour_type']) ? $_POST['tour_type'] : ""; 
$type = isset($_POST['type']) ? $_POST['type'] : ""; 

// Adjust check-out date for night tours
$adjusted_check_out = $check_out;
if ($tour_type === "night") {
    $adjusted_check_out = date('Y-m-d', strtotime($check_in . ' +1 day'));
}

// Prepare the SQL query to fetch existing reservations for the specified room and type
$sql = "SELECT * FROM u113108177_terrones_db.tbl_reservations
        WHERE facility_id = ? AND type = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind the parameters to the query
$stmt->bind_param("ss", $room_id, $type); // 'ss' means two string parameters

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$is_available = true;

// Loop through the existing reservations to check for overlaps
while ($row = $result->fetch_assoc()) {
    $dates_db = json_decode($row["reservation_date"], true); // Convert JSON to array
    $reserved_tour_type = $row["tour_type"]; // Get the tour type from the database
    
    if (count($dates_db) === 2) {
        $reserved_check_in = $dates_db[0];
        $reserved_check_out = $dates_db[1];
        
        // Check if the requested dates overlap with the existing reservation
        if (($check_in >= $reserved_check_in && $check_in <= $reserved_check_out) || 
            ($adjusted_check_out >= $reserved_check_in && $adjusted_check_out <= $reserved_check_out) ||
            ($check_in <= $reserved_check_in && $adjusted_check_out >= $reserved_check_out)) {
            
            // If the tour type matches and there's an overlap, mark as unavailable
            if ($tour_type === $reserved_tour_type) {
                $is_available = false;
                break; // No need to check further if a conflict is found
            }
        }
    }
}

// Output the availability status
if (!$is_available) {
    echo "Unavailable";
} else {
    echo "Available";
}

// Close the statement
$stmt->close();

?>
