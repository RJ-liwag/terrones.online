<?php
include_once("../../../conn.php");

$requestData = $_REQUEST;

$columns = array(
    0 => 'name',
    1 => 'rating',
    2 => 'comment',
    3 => 'created_at',
    4 => 'date',



);

$date = date('m/d/Y h:i:s a', time());

// $get_total = $mysqli->query("SELECT * FROM reviews WHERE created_date = '$date'");
$get_total = $mysqli->query("SELECT * FROM reviews");

$totalData = mysqli_num_rows($get_total);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

// $sql = "SELECT * FROM reviews WHERE created_date = '$date'";
$sql = "SELECT * FROM reviews";

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (";
    $sql .= "    name LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR rating LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR comment LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR created_at LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR date LIKE '%" . $requestData['search']['value'] . "%'";


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
$nestedData[] = $row['name'];
$nestedData[] = $row['comment'];
$nestedData[] = $row['rating'];
// $nestedData[] = $row['created_at'];


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
