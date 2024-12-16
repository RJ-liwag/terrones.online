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

$date = date('m/d/Y h:i:s a', time());

$get_total = $mysqli->query("SELECT * FROM tbl_reservations");

$totalData = mysqli_num_rows($get_total);
$totalFiltered = $totalData;

$sql = "SELECT * FROM tbl_reservations WHERE 1=1";

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

if (!empty($requestData['statusFilter'])) {
    $sql .= " AND status = '" . $requestData['statusFilter'] . "'";
}

$sql_query = $mysqli->query($sql);
$totalFiltered = mysqli_num_rows($sql_query);

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
    $nestedData[] = $row['email'];
    $nestedData[] = ucfirst($row['phone']);
    $nestedData[] = ucfirst($row['tour_type']);
    $nestedData[] = ucfirst($row['type']);
    $nestedData[] = ucfirst($row['status']);
    $jsonString =   ucfirst($row['reservation_date']);

    $datesArray = json_decode($jsonString, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $formattedDates = [];
        foreach ($datesArray as $reservationDate) {
            $date = new DateTime($reservationDate);
            $formattedDates[] = $date->format('F j, Y');
        }
        $nestedData[] = implode(' - ', $formattedDates);
    } else {
        echo "Error decoding JSON: " . json_last_error_msg();
    }

    $btn  = "<div class='btn-action_wrap'>";
    if ($row['status'] == 'Not Approved' || $row['status'] == 'Cancelled' || $row['status'] == 'Approved') {

        $btn .= "<button class='btn btn-primary btn-xs mx-1 btn_confirm d-none' style='top:0; bottom:0;' data-id='" . $row['id'] . "' data-email='" . $row['email'] . "'><i class='fas fa-check'></i></button>";
    } else {

        $btn .= "<button class='btn btn-primary btn-xs mx-1 btn_confirm' style='top:0; bottom:0;' data-id='" . $row['id'] . "' data-email='" . $row['email'] . "'><i class='fas fa-check'></i></button>";
    }

    if ($row['status'] == 'Not Approved' || $row['status'] == 'Cancelled' || $row['status'] == 'Approved') {

        $btn .= "<button class='btn btn-danger btn-xs mx-1 btn_cancel d-none'  style='top:0; bottom:0;' data-id='" . $row['id'] . "' data-email='" . $row['email'] . "'><i class='fas fa-xmark'></i></button>";
    } else {
        $btn .= "<button class='btn btn-danger btn-xs mx-1 btn_cancel'  style='top:0; bottom:0;' data-id='" . $row['id'] . "' data-email='" . $row['email'] . "'><i class='fas fa-xmark'></i></button>";
    }
    $btn .= "</div>";

    date_default_timezone_set('Asia/Manila');
    $created_date = $row['created_date'];
    $nestedData[] = date('F j, Y', strtotime($created_date));
    $nestedData[] = $btn;
    $data[] = $nestedData;
}

$json_data = array(
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);
