<?php
include("conn.php");
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
// Check for connection errors
if ($mysqli->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Fetch the 4 most recent reviews based on created_at
$sql = "SELECT name, rating, comment, created_at FROM reviews ORDER BY created_at DESC LIMIT 10"; // Adjust limit as needed
$result = $mysqli->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = [
            'name' => $row['name'],
            'rating' => $row['rating'],
            'comment' => $row['comment'],
            'date' => $row['created_at']
        ];
    }
}

echo json_encode($reviews); // Send the reviews as JSON

$mysqli->close();
?>
