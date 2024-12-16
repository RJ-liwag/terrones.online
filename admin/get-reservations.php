<?php
include_once("../conn.php");

$sql = "SELECT * FROM tbl_reservations";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {

    $reference_number = isset($row["reference_number"]) ? $row["reference_number"] : "";
    $facility_id = isset($row["facility_id"]) ? $row["facility_id"] : "";
    $name = isset($row["name"]) ? $row["name"] : "";
    $address = isset($row["address"]) ? $row["address"] : "";
    $email = isset($row["email"]) ? $row["email"] : "";
    $phone = isset($row["phone"]) ? $row["phone"] : "";
    $tour_type = isset($row["tour_type"]) ? $row["tour_type"] : "";
    $type = isset($row["type"]) ? $row["type"] : "";
    $status = isset($row["status"]) ? $row["status"] : "";
    $reservation_date = isset($row["reservation_date"]) ? $row["reservation_date"] : "";
}

$date = date('Y-m-d');

// Total Today's Reservation
$sql2 = "SELECT COUNT(*) FROM tbl_reservations WHERE created_date = '$date'";
$result2 = mysqli_query($mysqli, $sql2);
$count = mysqli_fetch_row($result2)[0];

//Total Bookings
$sql_total_bookings = "SELECT COUNT(*) FROM tbl_reservations";
$result_total_bookings = mysqli_query($mysqli, $sql_total_bookings);
$total_booking_count = mysqli_fetch_row($result_total_bookings)[0];

// Total Pending Reservation
$sql_pendings = "SELECT COUNT(*) FROM tbl_reservations WHERE status = 'pending'";
$pending_results = mysqli_query($mysqli, $sql_pendings);
$pending_counts = mysqli_fetch_row($pending_results)[0];


// Total Cancelled Bookings
$sql_cancelled = "SELECT COUNT(*) FROM tbl_reservations WHERE status = 'Not Approved'";
$cancelled_results = mysqli_query($mysqli, $sql_cancelled);
$cancelled_counts = mysqli_fetch_row($cancelled_results)[0];

// Total Confirmed Bookings
$sql_confirmed = "SELECT COUNT(*) FROM tbl_reservations WHERE status = 'Approved'";
$confirmed_results = mysqli_query($mysqli, $sql_confirmed);
$confirmed_counts = mysqli_fetch_row($confirmed_results)[0];

$sql2 = "SELECT SUM(pax) as total_pax FROM tbl_reservations WHERE created_date = '$date' AND status != 'Not Approved'";
$result2 = mysqli_query($mysqli, $sql2);

if ($result2) {
    $row = mysqli_fetch_assoc($result2);
    $totalPax = $row['total_pax'] ? $row['total_pax'] : 0; // If no rows match, total_pax will be NULL, so default to 0
} else {
    echo "Error: " . mysqli_error($mysqli);
}
