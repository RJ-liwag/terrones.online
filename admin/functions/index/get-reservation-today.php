<?php
include_once("../../../conn.php");

$requestData = $_REQUEST;

$columns = array(
    0 => 'reference_number',
    1 => 'facility_id',
    2 => 'name',
    3 => 'address',
    4 => 'email',
    5 => 'phone',
    6 => 'tour_type',
    7 => 'type',
    8 => 'status',
    9 => 'reservation_date'
);

$date = date('Y-m-d');

$get_total = $mysqli->query("SELECT * FROM tbl_reservations WHERE created_date = '$date'");
// $get_total = $mysqli->query("SELECT * FROM tbl_reservations");

$totalData = mysqli_num_rows($get_total);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT * FROM tbl_reservations WHERE created_date = '$date'";
// $sql = "SELECT * FROM tbl_reservations";

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (";
    $sql .= "    reference_number LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR facility_id LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR name LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR address LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR email LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR phone LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR tour_type LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR type LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR status LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR reservation_date LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= ")";
}
$sql_query = $mysqli->query($sql);
$totalFiltered = mysqli_num_rows($sql_query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

if (isset($requestData['order'])) {
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
}

$sql_query = $mysqli->query($sql);

$data = [];

while ($row = $sql_query->fetch_array()) {

    $nestedData = array();


    $nestedData[] = ucfirst($row['reference_number']);
    $nestedData[] = ucfirst($row['facility_id']);
    $nestedData[] = ucfirst($row['name']);
    $nestedData[] = ucfirst($row['address']);
    $nestedData[] = $row['email'] ? $row['email'] : "";
    $nestedData[] = ucfirst($row['phone']);
    $nestedData[] = ucfirst($row['tour_type']);
    $nestedData[] = $row['pax'] ? $row['pax'] : "";
    $nestedData[] = ucfirst($row['type']);
    $nestedData[] = ucfirst($row['status']);
    // Assuming $row['reservation_date'] contains the JSON string
    $jsonString = $row['reservation_date']; // e.g., '["2024-09-29","2024-09-29"]'

    // Decode the JSON string into a PHP array
    $datesArray = json_decode($jsonString, true); // true for associative array

    if (json_last_error() === JSON_ERROR_NONE) {
        $formattedDates = [];

        // Loop through each date in the array
        foreach ($datesArray as $reservationDate) {
            // Create a DateTime object
            $date = new DateTime($reservationDate);

            // Format the date to "F j, Y" for better presentation
            $formattedDates[] = $date->format('F j, Y'); // e.g., "September 29, 2024"
        }

        // Join the formatted dates into a single string for display
        $nestedData[] = implode(' - ', $formattedDates); // Outputs: "September 29, 2024, September 29, 2024"
    } else {
        // Handle JSON error
        echo "Error decoding JSON: " . json_last_error_msg();
    }
    date_default_timezone_set('Asia/Manila');
    $created_date = $row['created_date'];
    $nestedData[] = date('F j, Y', strtotime($created_date));
    $data[] = $nestedData;
}

$json_data = array(
    "recordsTotal" => intval($totalData),
    // total number of records
    "recordsFiltered" => intval($totalFiltered),
    // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data // total data array
);
// echo $sql;
echo json_encode($json_data); // send data as json format
