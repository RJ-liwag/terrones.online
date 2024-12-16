<?php
include_once("../../../conn.php");

$requestData = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'title',
    2 => 'content',
    3 => 'date_posted',
    4 => 'expiry_date'




);

$date = date('m/d/Y h:i:s a', time());

// $get_total = $mysqli->query("SELECT * FROM reviews WHERE created_date = '$date'");
$get_total = $mysqli->query("SELECT * FROM announcements");

$totalData = mysqli_num_rows($get_total);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

// $sql = "SELECT * FROM announcements WHERE created_date = '$date'";
$sql = "SELECT * FROM announcements";

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (";
    $sql .= "    id LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR title LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR content LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR date_posted LIKE '%" . $requestData['search']['value'] . "%'";
    $sql .= " OR expiry_date LIKE '%" . $requestData['search']['value'] . "%'";


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
$nestedData[] = $row['title'];
$nestedData[] = $row['content'];
$nestedData[] = $row['date_posted'];
$nestedData[] = $row['expiry_date'];


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
