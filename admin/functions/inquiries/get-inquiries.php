<?php
include_once("../../../conn.php");

$requestData = $_REQUEST;

$columns = array(
    0 => 'user_name',
    1 => 'user_email',
    2 => 'user_mobileno',
    3 => 'user_subject',
    4 => 'user_message',
    5 => 'created_date',
    6 => 'status'

);

$date = date('m/d/Y h:i:s a', time());

// $get_total = $mysqli->query("SELECT * FROM user_inquries WHERE created_date = '$date'");
$get_total = $mysqli->query("SELECT * FROM user_inquries");

$totalData = mysqli_num_rows($get_total);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

// $sql = "SELECT * FROM user_inquries WHERE created_date = '$date'";
$sql = "SELECT * FROM user_inquries";

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (";
    $sql .= "    user_name LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR user_email LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR user_mobileno LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR user_subject LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR user_message LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR created_date LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR status LIKE '%" . $requestData['search']['value'] . "%'";

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

$nestedData[] = $row['id'];
$nestedData[] = $row['user_name'];
$nestedData[] = $row['user_email'];
$nestedData[] = $row['user_mobileno'];
$nestedData[] = $row['user_subject'];
$nestedData[] = $row['user_message'];
// $nestedData[] = $row['status'];
$nestedData[] = $row['created_date'];

    $data[] = $nestedData;
}

$json_data = array(
    "recordsTotal" => intval($totalData),
    // total number of records
    "recordsFiltered" => intval($totalFiltered),
    // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data // total data array
);

echo json_encode($json_data); // send data as json format
