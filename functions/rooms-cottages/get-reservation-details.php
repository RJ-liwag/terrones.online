<?php
// Include database connection
include '../../conn.php';

// Get the reference number and email from the GET request
$reference_no = $_GET['reference_number'];
$email = $_GET['email'];

// Prepare and bind
$stmt = $mysqli->prepare("SELECT * FROM tbl_reservations WHERE reference_number = ? AND email = ?");
$stmt->bind_param("ss", $reference_no, $email);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$response = array();

// Check if a row was returned
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $row = $result->fetch_assoc();
    $type = $row['type'] . "s";
    $facilityID = $row['facility_id'];
    $img_sql = $mysqli->query("SELECT * FROM $type WHERE room_id = '$facilityID'");
    $img_row = $img_sql->fetch_assoc();
    $img_name = $img_row['room_img'];
    // Decode the reservation_date JSON
    $reservation_dates = json_decode($row['reservation_date'], true); // Decoding as an associative array

    // Prepare the response
    $response['success'] = true;
    $response['details'] = array(
        'reference_number' => $row['reference_number'], // Adjust according to your column names
        'room_name' => $row['facility_name'], // Adjust according to your column names
        'check_in' => isset($reservation_dates[0]) ? $reservation_dates[0] : null, // First date
        'check_out' => isset($reservation_dates[1]) ? $reservation_dates[1] : null, // Second date
        'tour_type' => $row['tour_type'],
        'no_pax' => $row['pax'],
        'name' => $row['name'],
        'created_at' => $row['created_date'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'address' => isset($row['address']) ? $row['address'] : null, // Check if total exists
        'status' => $row['status'],
        'img_name' => $img_row['room_img']
    );
} else {
    // No reservation found
    $response['success'] = false;
}

// Close the statement and connection
$stmt->close();
$mysqli->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
